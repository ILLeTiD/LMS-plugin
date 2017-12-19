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
            'meta_key' => 'course',
            'meta_value' => $post->ID
        ]);

        $slideTemplates = [
            'vertical' => 'Vertical Split Screen',
            'horizontal' => 'Horizontal Split Screen',
            'centered' => 'Centered'
        ];

        $this->view('meta-boxes.course.slides', compact('post', 'slides', 'slideTemplates'));
    }
}