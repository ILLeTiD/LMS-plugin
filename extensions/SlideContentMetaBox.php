<?php

namespace LmsPlugin;

use FishyMinds\WordPress\MetaBox;

class SlideContentMetaBox extends MetaBox
{
    protected $id = 'lms_slide_content_meta_box';
    protected $title = 'Slide Content';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        global $post;

        $content = get_post_meta($_GET['post'], 'slide_content', true);

        $this->view('meta-boxes.slide.content', compact('post', 'content'));
    }
}