<?php

namespace LmsPlugin\Slide;

use FishyMinds\WordPress\MetaBox;
use LmsPlugin\Models\Slide;

class DropMetaBox extends MetaBox
{
    protected $id = 'lms_slide_drop_meta_box';
    protected $title = '...and Drop';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        $slide = new Slide();

        $drag_and_drop = get_post_meta($slide->id, 'drag_and_drop', true);
        $drop_zones = array_get($drag_and_drop, 'drop_zones');

        $this->view(
            'meta-boxes.slide.drop',
            compact(
                'slide',
                'drop_zones'
            )
        );
    }
}