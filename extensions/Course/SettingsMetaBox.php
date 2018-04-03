<?php

namespace LmsPlugin\Course;

use FishyMinds\WordPress\MetaBox;

class SettingsMetaBox extends MetaBox
{
    protected $id = 'lms_course_settings_meta_box';
    protected $title = 'Settings';
    protected $screen = 'course';
    protected $context = 'normal';

    public function callback()
    {
        global $post;

        $visibilityOptions = [
            'all' => __('All users', 'lms-plugin'),
            'invited' => __('Invites only', 'lms-plugin'),
            // 'role' => __('Specific roles', 'lms-plugin'),
            'admin' => __('Amin only', 'lms-plugin'),
            'hidden' => __('Hidden', 'lms-plugin'),
        ];

        $this->view( 'meta-boxes.course.settings', [ 
            'course' => $post,
            'visibilityOptions' => $visibilityOptions
        ]);
    }    
}