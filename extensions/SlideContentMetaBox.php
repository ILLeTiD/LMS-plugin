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

        $course = $_GET['course'];
        $content = get_post_meta($post->ID, 'slide_content', true);
        $slideNumber = -1;

        $this->view('meta-boxes.slide.content', compact('post', 'course', 'content', 'slideNumber'));
    }
}