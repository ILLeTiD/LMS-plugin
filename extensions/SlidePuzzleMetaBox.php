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

        $this->view('meta-boxes.slide.forms', compact('post'));
    }
}