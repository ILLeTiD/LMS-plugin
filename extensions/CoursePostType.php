<?php

namespace LmsPlugin;

use FishyMinds\WordPress\PostType;

class CoursePostType extends PostType
{
    protected $name = 'course';

    protected function arguments()
    {
        return [
            'labels' => [
                'name' => __('Courses', 'lms-plugin'),
                'singular_name' => __('Course', 'lms-plugin'),
                'all_items' => __('All Courses', 'lms-plugin'),
                'search_items' => __('Search Courses', 'lms-plugin')
            ],
            'public' => true,
            'has_archive' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'taxonomies' => ['course_category'],
            'menu_icon' => 'dashicons-welcome-learn-more',
            'menu_position' => 6
        ];
    }
}