<?php

namespace LmsPlugin\Slide;

use FishyMinds\WordPress\MetaBox;
use LmsPlugin\Models\Slide;

class QuizMetaBox extends MetaBox
{
    protected $id = 'lms_slide_quiz_meta_box';
    protected $title = 'Quiz';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        $post = new Slide();

        $colors = get_post_meta($post->id, 'quiz_colors', true);
        $background = get_post_meta($post->id, 'quiz_background', true);

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

        $this->view(
            'meta-boxes.slide.quiz',
            compact(
                'post',
                'colors',
                'background',
                'quizTypeOptions',
                'quizToleranceOptions'
            )
        );
    }
}