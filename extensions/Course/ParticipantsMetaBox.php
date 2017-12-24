<?php

namespace LmsPlugin\Course;

use FishyMinds\WordPress\MetaBox;

class ParticipantsMetaBox extends MetaBox
{
    protected $id = 'lms_course_participants_meta_box';
    protected $title = 'Participants';
    protected $screen = 'course';
    protected $context = 'side';

    public function callback()
    {
        $this->view('meta-boxes.course.participants');
    }
}