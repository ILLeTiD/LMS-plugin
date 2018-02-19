<?php

namespace LmsPlugin\Slide;

use FishyMinds\WordPress\MetaBox;
use LmsPlugin\Models\Slide;

class DragMetaBox extends MetaBox
{
    protected $id = 'lms_slide_drag_meta_box';
    protected $title = 'Drag...';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        $slide = new Slide();

        $drag_and_drop = get_post_meta($slide->id, 'drag_and_drop', true);
        $objects = array_get($drag_and_drop, 'objects');

        $this->view(
            'meta-boxes.slide.drag',
            compact(
                'slide',
                'objects'
            )
        );
    }
}