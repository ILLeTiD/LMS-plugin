<?php

namespace LmsPlugin;

use FishyMinds\WordPress\MetaBox;

class SlideCustomCssMetaBox extends MetaBox
{
    protected $id = 'lms_slide_custom_css_meta_box';
    protected $title = 'Custom CSS';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        $customCSS = get_post_meta($_GET['post'], 'slide_custom_css', true);

        $this->view('meta-boxes.slide.custom-css', compact('customCSS'));
    }
}