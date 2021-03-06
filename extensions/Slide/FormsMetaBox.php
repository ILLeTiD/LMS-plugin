<?php

namespace LmsPlugin\Slide;

use FishyMinds\WordPress\MetaBox;

class FormsMetaBox extends MetaBox
{
    protected $id = 'lms_slide_forms_meta_box';
    protected $title = 'Forms';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        global $post;

        $formsTypeOptions = [
            'text_field' => 'Text field',
            'text_area' => 'Text area',
            'options' => 'Options'
        ];

        $formsAnswers = get_post_meta($post->ID, 'forms_answers', true);

        $this->view('meta-boxes.slide.forms', compact('post', 'formsTypeOptions', 'formsAnswers'));
    }
}