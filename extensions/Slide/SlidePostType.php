<?php

namespace LmsPlugin\Slide;

use FishyMinds\WordPress\PostType;

class SlidePostType extends PostType
{
    protected $name = 'slide';

    protected function arguments()
    {
        return [
            'labels' => [
                'name' => __('Slides', 'lms-plugin'),
                'singular_name' => __('Slide', 'lms-plugin'),
                'all_items' => __('All Slides', 'lms-plugin'),
                'search_items' => __('Search Slides', 'lms-plugin')
            ],
            'public' => true,
            'show_in_menu' => false,
            'supports' => ['title', 'editor', 'thumbnail'],
            'rewrite' => true,
        ];
    }
}