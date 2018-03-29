<?php

namespace LmsPlugin\Slide;

use FishyMinds\WordPress\MetaBox;
use LmsPlugin\Models\Slide;
use LmsPlugin\Models\Course;

class SettingsMetaBox extends MetaBox
{
    protected $id = 'lms_slide_settings_meta_box';
    protected $title = 'Slide Settings';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        $post = new Slide();
        $course_id = array_get($_GET, 'course');

        $slideSectionDisplayOptions = Slide::SECTION_DISPLAY_OPTIONS;
        $slideTemplateOptions = Slide::TEMPLATE_OPTIONS;
        $slideDisplayHeaderOptions = Slide::DISPLAY_HEADER_OPTIONS;

        $defaultColors = array_get(get_option('lms-plugin'), 'colors');
        $colors = get_post_meta($post->id, 'slide_colors', true);
        $colors = !$colors ? $defaultColors : $colors;
        $background = get_post_meta($post->id, 'slide_background', true);

        $weight = (null != $post->slide_weight) ? $post->slide_weight : PHP_INT_MAX;
        $index = (null != $post->slide_index) ? $post->slide_index : Course::find($course_id)->slides()->count() + 1;

        $this->view('meta-boxes.slide.settings', compact(
            'slideSectionDisplayOptions',
            'slideDisplayHeaderOptions',
            'slideTemplateOptions',
            'background',
            'colors',
            'weight',
            'index',
            'post',
            'course_id'
        ));
    }
}