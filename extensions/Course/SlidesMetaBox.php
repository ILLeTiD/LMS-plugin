<?php

namespace LmsPlugin\Course;

use FishyMinds\WordPress\MetaBox;
use WP_Query;

class SlidesMetaBox extends MetaBox
{
    protected $id = 'lms_course_slides_meta_box';
    protected $title = 'Slides';
    protected $screen = 'course';
    protected $context = 'normal';

    public function callback()
    {
        global $post;

        $slides = new WP_Query([
            'post_type' => 'slide',
            'posts_per_page' => -1,
            'meta_query' => [
                'relation' => 'AND', [
                    'course_clause' => [
                        'key' => 'course',
                        'value' => (int)$post->ID,
                        'type' => 'NUMERIC'
                    ],
                    'slide_weight_clause' => [
                        'key' => 'slide_weight',
                        'value' => 0,
                        'compare' => '>=',
                        'type' => 'NUMERIC'
                    ]
                ]
            ],
            'orderby' => [
                'slide_weight_clause' => 'ASC',
                'ID' => 'ASC'
            ],
        ]);

        $slideTemplates = [
            'dynamic' => 'Dynamic template',
            'full-width' => 'Full width',
        ];

        $this->view('meta-boxes.course.slides', compact('post', 'slides', 'slideTemplates'));
    }
}