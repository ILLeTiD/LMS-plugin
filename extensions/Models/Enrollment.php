<?php

namespace LmsPlugin\Models;

class Enrollment extends Model
{
    const TABLE = 'lms_enrollments';

    public function __construct($attributes)
    {
        $this->attributes = $attributes;

        if (array_key_exists('user_id', $this->attributes)) {
            $this->attributes['user'] = User::find($this->attributes['user_id']);
        }

        if (array_key_exists('course_id', $this->attributes)) {
            $this->attributes['course'] = Course::find($this->attributes['course_id']);
        }
    }

    public static function create($attributes = [])
    {
        $instance = new self($attributes);

        return $instance->save();
    }

    public function __get($property)
    {
        switch ($property) {
            case 'created_at':
                return date(
                    get_option('date_format'),
                    strtotime($this->attributes['created_at'])
                );
            case 'updated_at':
                return date(
                    get_option('date_format'),
                    strtotime($this->attributes['updated_at'])
                );
            case 'progress':
                return $this->computeProgress();
        }

        return parent::__get($property);
    }

    public function computeProgress()
    {
        global $wpdb;

        $slides = $this->course->slides();

        if (!$slides->count()) {
            return 0;
        }

        $slide_ids_placeholder = implode(', ', array_fill(0, $slides->count(), '%d'));
        $sql = <<<SQL
          SELECT COUNT(*)
          FROM {$wpdb->prefix}lms_activities
          WHERE course_id = %d
                AND slide_id IN ({$slide_ids_placeholder})
                AND description = 'Completed';
SQL;

        $values = $slides->pluck('id');
        array_unshift($values, $this->course->id);

        $sql = $wpdb->prepare($sql, $values);
        $completed_slides = $wpdb->get_var($sql);

        $rate = ($completed_slides / $slides->count()) * 100;

        return $rate ? round($rate) : 0;
    }

    protected function insert()
    {
        global $wpdb;

        $wpdb->insert($wpdb->prefix . self::TABLE, [
            'user_id' => $this->user->id,
            'course_id' => $this->course->id
        ]);

        $this->id = $wpdb->insert_id;

        return $this;
    }

    protected function update()
    {
        global $wpdb;

        $data = [];

        foreach ($this->attributes as $name => $value) {
            if (in_array($name, ['id', 'user', 'course', 'created_at', 'updated_at'])) continue;
            $data[$name] = $value;
        }

        $wpdb->update($wpdb->prefix . self::TABLE, $data, ['id' => $this->id]);
    }
}