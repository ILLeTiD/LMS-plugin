<?php

namespace LmsPlugin;

use FishyMinds\WordPress\Plugin\HasPlugin;

class CoursePostType
{
    use HasPlugin;

    private $name = 'course';

    private function arguments()
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
            'menu_icon' => 'dashicons-welcome-learn-more'
        ];
    }

    public function register()
    {
        register_post_type($this->name, $this->arguments());
    }
}