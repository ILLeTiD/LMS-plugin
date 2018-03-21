<?php

namespace LmsPlugin\Course;

use FishyMinds\WordPress\MetaBox;

class CustomCssMetaBox extends MetaBox
{
    protected $id = 'lms_course_custom_css_meta_box';
    protected $title = 'Custom CSS';
    protected $screen = 'course';
    protected $context = 'normal';

    public function callback()
    {
        global $post;

        $customCSS = get_post_meta($post->ID, 'course_custom_css', true);

        $this->view('meta-boxes.course.custom-css', compact('customCSS'));
    }
}