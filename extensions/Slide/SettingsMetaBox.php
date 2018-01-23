<?php

namespace LmsPlugin\Slide;

use FishyMinds\WordPress\MetaBox;

class SettingsMetaBox extends MetaBox
{
    protected $id = 'lms_slide_settings_meta_box';
    protected $title = 'Slide Settings';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        global $post;

        $slideTemplateOptions = [
            'vertical' => 'Vertical Split Screen',
            'horizontal' => 'Horizontal Split Screen',
            'centered' => 'Centered'
        ];

        $slideDisplayHeaderOptions = [
            'regular' => 'Regular',
            'hide' => 'Hide',
            'in_separate_section' => 'In separate section'
        ];

        $weight = $post->slide_weight ?: PHP_INT_MAX;

        $this->view('meta-boxes.slide.settings', compact(
            'post',
            'slideTemplateOptions',
            'slideDisplayHeaderOptions',
            'weight'
        ));
    }
}