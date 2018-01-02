<?php

namespace LmsPlugin\Models;

class Enrollment
{
    private $course;
    private $user;

    public function __construct($course, $user)
    {
        $this->course = $course;
        $this->user = $user;
    }

    public function save()
    {
        update_user_meta(
            $this->user,
            'status_' . $this->course,
            'invited'
        );

        add_user_meta(
            $this->user,
            'invited_' . $this->course,
            time(),
            true
        );
    }
}