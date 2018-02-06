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

$script->add('jquery-ui')
       ->source('jquery-ui.min.js');

$script->add('settings-scripts')
    ->source('settings.js')
    ->dependencies(['postbox', 'accordion', 'jquery-ui-sortable'])
    ->condition(function () {
        return $this->getCurrentScreen()->id == 'course_page_settings';
    });

