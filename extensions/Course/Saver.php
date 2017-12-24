<?php

namespace LmsPlugin\Course;

class Saver
{
    public function save($courseID)
    {
        if (get_post_type($courseID) != 'course') {
            return;
        }

        if ( ! array_key_exists('slide_weight', $_POST)) {
            return;
        }

        foreach ($_POST['slide_weight'] as $weight => $slideID) {
            update_post_meta($slideID, 'slide_weight', $weight);
        }
    }
}