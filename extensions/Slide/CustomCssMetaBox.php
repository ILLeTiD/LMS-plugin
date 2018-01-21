<?php

namespace LmsPlugin\Slide;

use FishyMinds\WordPress\MetaBox;

class CustomCssMetaBox extends MetaBox
{
    protected $id = 'lms_slide_custom_css_meta_box';
    protected $title = 'Custom CSS';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        global $post;

        $customCSS = get_post_meta($post->ID, 'slide_custom_css', true);

        $this->view('meta-boxes.slide.custom-css', compact('customCSS'));
    }
}