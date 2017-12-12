<?php

namespace LmsPlugin;

use FishyMinds\WordPress\MetaBox;

class CourseSlidesMetaBox extends MetaBox
{
    protected $id = 'lms_course_slides_meta_box';
    protected $title = 'Slides';
    protected $screen = 'course';
    protected $context = 'normal';

    public function callback()
    {
        $this->view('meta-boxes.course.slides');
    }
}