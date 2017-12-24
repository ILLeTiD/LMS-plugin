<?php

namespace LmsPlugin\Slide;

class Saver
{
    private $fields = [
        'course',
        'slide_template',
        'slide_content_display',
        'slide_format',
        'slide_content',
        'slide_custom_css',
        'quiz_type',
        'quiz_tolerance',
        'quiz_hint',
        'forms_type',
        'forms_answers',
        'drag_and_drop_layout',
        'drag_and_drop_images',
        'drag_and_drop_zones',
        'puzzle'
    ];

    public function save($slideID)
    {
        if (get_post_type($slideID) != 'slide') {
            return;
        }

        foreach ($this->fields as $field) {
            if ( ! empty($_POST[$field])) {
                update_post_meta($slideID, $field, $_POST[$field]);
            }
        }
    }
}