<?php

namespace LmsPlugin\Course;

use FishyMinds\WordPress\MetaBox;
use LmsPlugin\Models\Course;
use LmsPlugin\Models\DataSuppliers\CourseProgressDataSupplier;

class ProgressMetaBox extends MetaBox
{
    protected $id = 'lms_course_progress_meta_box';
    protected $title = 'Progress';
    protected $screen = 'course';
    protected $context = 'normal';

    public function callback()
    {
        global $wp_post;

        $course = new Course($wp_post);

        $statuses = Course::statuses();

        $course_progress_data_supplier = new CourseProgressDataSupplier($course);
        $progress = $course_progress_data_supplier->getData();

        $this->view('meta-boxes.course.progress', compact('course', 'statuses', 'progress'));
    }
}