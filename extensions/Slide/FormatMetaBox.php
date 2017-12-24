<?php

namespace LmsPlugin\Slide;

use FishyMinds\WordPress\MetaBox;

class FormatMetaBox extends MetaBox
{
    const DEFAULT_SLIDE_FORMAT = 'regular';

    protected $id = 'lms_slide_format_meta_box';
    protected $title = 'Format';
    protected $screen = 'slide';
    protected $context = 'side';

    public function callback()
    {
        $format = isset($_GET['post'])
            ? get_post_meta($_GET['post'], 'slide_format', true)
            : self::DEFAULT_SLIDE_FORMAT;

        $this->view('meta-boxes.slide.format', compact('format'));
    }
}