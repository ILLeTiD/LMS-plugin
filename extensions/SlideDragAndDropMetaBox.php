<?php

namespace LmsPlugin;

use FishyMinds\WordPress\MetaBox;

class SlideDragAndDropMetaBox extends MetaBox
{
    protected $id = 'lms_slide_drag_and_drop_meta_box';
    protected $title = 'Drag and Drop';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        global $post;

        $dragAndDropLayoutOptions = [
            'vertical' => 'Vertical',
            'horizontal' => 'Horizontal'
        ];

        $images = get_post_meta($post->ID, 'drag_and_drop_images', true);
        $zones = get_post_meta($post->ID, 'drag_and_drop_zones', true);

        $this->view('meta-boxes.slide.drag-and-drop', compact('post', 'dragAndDropLayoutOptions', 'images', 'zones'));
    }
}