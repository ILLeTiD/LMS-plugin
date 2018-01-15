<?php

namespace LmsPlugin\Models\Factories;

use LmsPlugin\Models\Enrollment;

class EnrollmentFactory
{
    public static function create($data)
    {
        $instance = new Enrollment($data['user_id'], $data['course_id']);

        $instance->id = $data['id'];
        $instance->status = $data['status'];
        $instance->grade = $data['grade'];
        $instance->created_at = $data['created_at'];
        $instance->updated_at = $data['updated_at'];

        return $instance;
    }
}