<?php

namespace LmsPlugin\Controllers;

class SlideSectionsController extends Controller
{
    public function create()
    {
        $slide = [];

        $i = array_get($_GET, 'section_id');

        $this->view('meta-boxes.slide.components.content', compact('slide', 'i'));

        die;
    }
}