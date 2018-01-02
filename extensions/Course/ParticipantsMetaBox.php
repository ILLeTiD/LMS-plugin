<?php

namespace LmsPlugin\Course;

use FishyMinds\WordPress\MetaBox;
use LmsPlugin\Models\Course;

class ParticipantsMetaBox extends MetaBox
{
    protected $id = 'lms_course_participants_meta_box';
    protected $title = 'Participants';
    protected $screen = 'course';
    protected $context = 'side';

    public function callback()
    {
        $course = new Course();

        $this->view('meta-boxes.course.participants', compact('course'));
    }
}