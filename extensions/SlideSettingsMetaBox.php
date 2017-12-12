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
        $this->view('meta-boxes.slide.settings');
    }
}