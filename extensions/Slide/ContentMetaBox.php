<?php

namespace LmsPlugin\Slide;

use FishyMinds\WordPress\MetaBox;
use LmsPlugin\Models\Section;

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

        $imageAlignmentOptions = Section::IMAGE_ALIGNMENT_OPTIONS;
        $linkTargetOptions = Section::LINK_TARGET_OPTIONS;

        $values = range(0, count($content) - 1);
        $labels = array_map(function ($value) {
            return __('Section', 'lms-plugin') . ' ' . ($value + 1);
        }, $values);

        $connectedToOptions = array_combine($values, $labels);

        $this->view('meta-boxes.slide.content', compact(
            'imageAlignmentOptions',
            'connectedToOptions',
            'linkTargetOptions',
            'slideNumber',
            'content',
            'course',
            'post'
        ));
    }
}