<?php

namespace LmsPlugin;

use FishyMinds\WordPress\MetaBox;

class CourseProgressMetaBox extends MetaBox
{
    protected $id = 'lms_course_progress_meta_box';
    protected $title = 'Progress';
    protected $screen = 'course';
    protected $context = 'normal';
    protected $priority = 'default';

    public function callback()
    {
        $this->view('meta-boxes.course-progress');
    }
}