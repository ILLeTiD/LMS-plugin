<?php

namespace LmsPlugin\Models;

use FishyMinds\Collection;
use LmsPlugin\Models\Repositories\CourseRepository;
use WP_User;

class User
{
    private $wp_user;

    public function __construct($wp_user)
    {
        $this->wp_user = $wp_user;
    }

    public static function find($id)
    {
        $wp_user = new WP_User($id);

        return new static($wp_user);
    }

    public function __get($property)
    {
        switch ($property) {
            case 'name':
                return $this->wp_user->display_name;
            default:
                return $this->wp_user->$property;
        }
    }

    public function invited()
    {
        return $this->status('invited');
    }

    public function inProgress()
    {
        return $this->status('in_progress');
    }

    public function completed()
    {
        return $this->status('completed');
    }

    public function failed()
    {
        return $this->status('failed');
    }

    public function status($name)
    {
        global $wpdb;

        $sql = $wpdb->prepare("
                SELECT umeta_id 
                FROM {$wpdb->usermeta}
                WHERE user_id = %d 
                  AND meta_key LIKE 'status_%' 
                  AND meta_value = '%s';
                ", $this->wp_user->ID, $name);

        return $wpdb->get_results($sql);
    }

    public function courses()
    {
        global $wpdb;

        $sql = $wpdb->prepare("
                SELECT SUBSTRING_INDEX(meta_key, '_', -1) AS course_id 
                FROM {$wpdb->usermeta}
                WHERE user_id = %d 
                  AND meta_key LIKE 'status_%';
                ", $this->ID);

        $result = $wpdb->get_results($sql, ARRAY_A);

        $courses = array_column($result, 'course_id');

        return CourseRepository::get([
            'post_type' => 'course',
            'post__in' => $courses
        ]);
    }

    public function enrollments()
    {
        global $wpdb;

        $enrollments = [];

        $sql = $wpdb->prepare("
                SELECT SUBSTRING_INDEX(meta_key, '_', -1) AS course_id 
                FROM {$wpdb->usermeta}
                WHERE user_id = %d 
                  AND meta_key LIKE 'status_%';
                ", $this->ID);

        $results = $wpdb->get_results($sql, ARRAY_A);

        $courses = array_column($results, 'course_id');

        $courses =  CourseRepository::get([
            'post_type' => 'course',
            'post__in' => $courses
        ]);

        foreach ($courses as $course) {
            $enrollments[] = new Enrollment($this, $course);
        }

        return new Collection($enrollments);
    }

    public function activities()
    {
         global $wpdb;

        $activities = [];

        $sql = $wpdb->prepare("
                SELECT *
                FROM {$wpdb->prefix}lms_activity
                WHERE user_id = %d
                ORDER BY date DESC;
                ", $this->id);

        $results = $wpdb->get_results($sql);

        foreach ($results as $activity) {
            $activities[] = new Activity(
                $activity->id,
                $activity->user_id,
                $activity->course_id,
                $activity->slide_id,
                $activity->name,
                isset($activity->description) ? $activity->description : null,
                $activity->date
            );
        }

        return new Collection($activities);
    }
}