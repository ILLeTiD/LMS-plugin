<?php

namespace LmsPlugin\Slide;

use FishyMinds\WordPress\MetaBox;

class ContentMetaBox extends MetaBox
{
    protected $id = 'lms_slide_content_meta_box';
    protected $title = 'Slide Content';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        global $post;

        wp_enqueue_editor();

        $course = isset($post->course) ? $post->course : $_GET['course'];
        $content = get_post_meta($post->ID, 'slide_content', true);
        $slideNumber = -1;

        $slideThemeOptions = [
            'dark' => 'Dark',
            'light' => 'Light'
        ];
        $imageAlignmentOptions = [
            'center center' => 'center center',
            'top center' => 'top center',
            'bottom center' => 'bottom center',
            'center left' => 'center left',
            'top left' => 'top left',
            'bottom left' => 'bottom left',
            'center right' => 'center right',
            'top right' => 'top right',
            'bottom right' => 'bottom right',
        ];
        $linkTargetOptions = [
            '_blank' => 'New tab',
            '_self' => 'Same window'
        ];

        $this->view('meta-boxes.slide.content', compact(
            'post',
            'course',
            'content',
            'slideNumber',
            'slideThemeOptions',
            'imageAlignmentOptions',
            'linkTargetOptions'
        ));
    }
}