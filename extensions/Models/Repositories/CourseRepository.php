<?php

namespace LmsPlugin\Models\Repositories;

use FishyMinds\Collection;
use LmsPlugin\Models\Course;
use WP_Query;

class CourseRepository
{
    private static $default_arguments = [
        'post_type' => 'course'
    ];

    public static function get($arguments = [])
    {
        $result = [];

        $arguments = array_merge($arguments, self::$default_arguments);

        $wp_posts = new WP_Query($arguments);

        foreach ($wp_posts->posts as $course) {
            $result[] = new Course($course);
        }

        return new Collection($result);
    }
}