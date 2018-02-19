<?php

namespace LmsPlugin\Slide;

use FishyMinds\WordPress\MetaBox;
use LmsPlugin\Models\Slide;

class DragAndDropMetaBox extends MetaBox
{
    protected $id = 'lms_slide_drag_and_drop_meta_box';
    protected $title = 'Drag and Drop';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        $slide = new Slide();

        $drag_and_drop = get_post_meta($slide->id, 'drag_and_drop', true);
        $objects = array_get($drag_and_drop, 'objects');
        $drop_zones = array_get($drag_and_drop, 'drop_zones');

        $this->view(
            'meta-boxes.slide.drag-and-drop',
            compact(
                'slide',
                'objects',
                'drop_zones'
            )
        );
    }
}