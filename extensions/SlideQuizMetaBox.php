<?php

namespace LmsPlugin;

use FishyMinds\WordPress\MetaBox;

class SlideQuizMetaBox extends MetaBox
{
    protected $id = 'lms_slide_quiz_meta_box';
    protected $title = 'Quiz';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        $this->view('meta-boxes.slide.quiz');
    }
}