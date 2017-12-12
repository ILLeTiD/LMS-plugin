<?php

namespace LmsPlugin;

use FishyMinds\WordPress\MetaBox;

class SlideFormatMetaBox extends MetaBox
{
    protected $id = 'lms_slide_format_meta_box';
    protected $title = 'Format';
    protected $screen = 'slide';
    protected $context = 'side';

    public function callback()
    {
        $format = get_post_meta($_GET['post'], 'slide_format', true);

        $this->view('meta-boxes.slide.format', compact('format'));
    }
}