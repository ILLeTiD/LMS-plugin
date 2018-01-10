<?php

namespace LmsPlugin\Models;

class Enrollment
{
    private $user;
    public $course;

    public function __construct($user, $course)
    {
        $this->user = $user;
        $this->course = $course;
    }

    public function __get($property)
    {
        switch ($property) {
            case 'enrollment_date':
                $enrollment_date = $this->user->{'invited_'.$this->course->id};

                if ( ! $enrollment_date) {
                    return false;
                }

                return date(
                    get_option('date_format'),
                    $enrollment_date
                );
            case 'last_activity':
                $last_activity = $this->user->{'last_activity_'.$this->course->id};

                if ( ! $last_activity) {
                    return false;
                }

                return date(
                    get_option('date_format'),
                    $this->user->{'last_activity_'.$this->course->id}
                );
            case 'progress':
                return $this->getProgress();
            case 'status':
                return $this->user->{'status_'.$this->course->id};
        }
    }

    public function save()
    {
        update_user_meta(
            $this->user,
            'status_' . $this->course,
            'invited'
        );

        add_user_meta(
            $this->user,
            'invited_' . $this->course,
            time(),
            true
        );
    }

    public function getProgress()
    {
        global $wpdb;

        $slides = $this->course->slides();

        if ( ! $slides->count()) {
            return 0;
        }

        $slide_ids_placeholder = implode(', ', array_fill(0, $slides->count(), '%d'));
        $sql = <<<SQL
          SELECT COUNT(*)
          FROM {$wpdb->prefix}lms_activity
          WHERE course_id = %d
                AND slide_id IN ({$slide_ids_placeholder})
                AND description = 'Completed';
SQL;

        $values = $slides->pluck('id');
        array_unshift($values, $this->course->id);

        $sql = $wpdb->prepare($sql, $values);
        $completed_slides = $wpdb->get_var($sql);

        $rate = $slides->count() * $completed_slides;

        return $rate ? round(100 / $rate) : 0;
    }
}