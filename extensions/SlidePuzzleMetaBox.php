<?php

namespace LmsPlugin;

use FishyMinds\WordPress\MetaBox;

class SlidePuzzleMetaBox extends MetaBox
{
    protected $id = 'lms_slide_puzzle_meta_box';
    protected $title = 'Puzzle';
    protected $screen = 'slide';
    protected $context = 'normal';

    public function callback()
    {
        global $post;

        $puzzle = get_post_meta($post->ID, 'puzzle', true);

        $this->view('meta-boxes.slide.puzzle', compact('post', 'puzzle'));
    }
}