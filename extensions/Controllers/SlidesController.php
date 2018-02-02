<?php

namespace LmsPlugin\Controllers;

class SlidesController extends Controller
{
    public function delete()
    {
        $slide_id = array_get($_POST, 'slide_id');

        $slide = wp_delete_post($slide_id, true);

        wp_send_json([
            'slide' => $slide
        ]);
    }
}