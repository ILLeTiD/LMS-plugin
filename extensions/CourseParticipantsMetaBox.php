<?php

namespace LmsPlugin;

use FishyMinds\WordPress\MetaBox;

class CourseParticipantsMetaBox extends MetaBox
{
    protected $id = 'lms_course_participants_meta_box';
    protected $title = 'Participants';
    protected $screen = 'course';
    protected $context = 'aside';
    protected $priority = 'default';

    public function callback()
    {
        $this->view('meta-boxes.course-participants');
    }
}