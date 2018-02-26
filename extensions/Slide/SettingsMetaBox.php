<?php

namespace LmsPlugin\Slide;

use FishyMinds\WordPress\MetaBox;
use LmsPlugin\Models\Slide;

class SettingsMetaBox extends MetaBox
{
    protected $id = 'lms_slide_settings_meta_box';
    protected $title = 'Slide Settings';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        $post = new Slide();

        $slideSectionDisplayOptions = Slide::SECTION_DISPLAY_OPTIONS;
        $slideTemplateOptions = Slide::TEMPLATE_OPTIONS;
        $slideDisplayHeaderOptions = Slide::DISPLAY_HEADER_OPTIONS;

        $colors = get_post_meta($post->id, 'slide_colors', true);
        $background = get_post_meta($post->id, 'slide_background', true);

        $weight = $post->slide_weight ?: PHP_INT_MAX;

        $this->view('meta-boxes.slide.settings', compact(
            'slideSectionDisplayOptions',
            'slideDisplayHeaderOptions',
            'slideTemplateOptions',
            'background',
            'colors',
            'weight',
            'post'
        ));
    }
}