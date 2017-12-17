<?php

namespace LmsPlugin;

use FishyMinds\WordPress\MetaBox;

class SlideSettingsMetaBox extends MetaBox
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

        $slideContentDisplayOptions = [
            'once_at_a_time' => 'Once at a time',
            'all_at_once' => 'All at once'
        ];

        $this->view('meta-boxes.slide.settings', compact(
            'post',
            'slideTemplateOptions',
            'slideContentDisplayOptions'
        ));
    }
}