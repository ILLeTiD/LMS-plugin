<?php

namespace LmsPlugin;

use FishyMinds\WordPress\MetaBox;
use WP_Query;

class CourseSlidesMetaBox extends MetaBox
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
            'meta_query' => [
                'relation' => 'AND', [
                    'course_clause' => [
                        'key' => 'course',
                        'value' => (int) $post->ID,
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
            'vertical' => 'Vertical Split Screen',
            'horizontal' => 'Horizontal Split Screen',
            'centered' => 'Centered'
        ];

        $this->view('meta-boxes.course.slides', compact('post', 'slides', 'slideTemplates'));
    }
}