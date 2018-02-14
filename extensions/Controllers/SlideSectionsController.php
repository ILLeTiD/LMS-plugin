<?php

namespace LmsPlugin\Controllers;

use LmsPlugin\Models\Section;

class SlideSectionsController extends Controller
{
    public function create()
    {
        $i = array_get($_GET, 'section_id');

        $this->view('meta-boxes.slide.components.content', [
            'imageAlignmentOptions' => Section::IMAGE_ALIGNMENT_OPTIONS,
            'linkTargetOption' => Section::LINK_TARGET_OPTIONS,
            'slide' => [],
            'i' => $i
        ]);

        die;
    }
}