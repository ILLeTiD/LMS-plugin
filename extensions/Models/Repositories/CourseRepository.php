<?php

namespace LmsPlugin\Models\Repositories;

use LmsPlugin\Models\Course;
use WP_Query;

class CourseRepository
{
    public static function get($arguments)
    {
        $result = [];

        $wp_posts = new WP_Query($arguments);

        foreach ($wp_posts->posts as $course) {
            $result[] = new Course($course);
        }

        return $result;
    }
}