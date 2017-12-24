<?php

namespace LmsPlugin\Slide;

use FishyMinds\WordPress\MetaBox;

class QuizMetaBox extends MetaBox
{
    protected $id = 'lms_slide_quiz_meta_box';
    protected $title = 'Quiz';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        global $post;

        $quizTypeOptions = [
            'forms' => 'Forms',
            'drag_and_drop' => 'Drag and Drop',
            'puzzle' => 'Puzzle'
        ];

        $quizToleranceOptions = [
            'strict' => 'Strict',
            'flexible' => 'Flexible',
            'loose' => 'Loose'
        ];

        $this->view('meta-boxes.slide.quiz', compact('post', 'quizTypeOptions', 'quizToleranceOptions'));
    }
}