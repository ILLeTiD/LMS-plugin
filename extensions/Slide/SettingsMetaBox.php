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
        global $post;

        $slideSectionDisplayOptions = Slide::SECTION_DISPLAY_OPTIONS;
        $slideTemplateOptions = Slide::TEMPLATE_OPTIONS;
        $slideDisplayHeaderOptions = Slide::DISPLAY_HEADER_OPTIONS;

        $weight = $post->slide_weight ?: PHP_INT_MAX;

        $this->view('meta-boxes.slide.settings', compact(
            'slideSectionDisplayOptions',
            'slideDisplayHeaderOptions',
            'slideTemplateOptions',
            'weight',
            'post'
        ));
    }
}