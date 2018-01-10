<?php

$script->add('course-scripts')
       ->source('course.js')
       ->condition(function () {
           return $this->getCurrentScreen()->id == 'course';
       });

$script->add('slide-scripts')
       ->source('slide.js')
       ->condition(function () {
           return $this->getCurrentScreen()->id == 'slide';
       });

$script->add('invite-scripts')
    ->source('invite.js')
    ->dependencies(['accordion'])
    ->condition(function () {
        return $this->getCurrentScreen()->id == 'course_page_course_participants';
    });

