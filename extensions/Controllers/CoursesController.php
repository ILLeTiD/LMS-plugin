<?php

namespace LmsPlugin\Controllers;

class CoursesController extends Controller
{
    public function sortSlides()
    {
        $slides = array_get($_POST, 'slide_weight');

        foreach ($slides as $weight => $slide_id) {
            update_post_meta($slide_id, 'slide_weight', $weight);
        }

        die;
    }
}