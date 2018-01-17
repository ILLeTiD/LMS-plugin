<?php

namespace LmsPlugin;

use LmsPlugin\Models\Enrollment;

class EnrollmentFactory
{
    /**
     * @param int $course
     * @param array $users
     */
    public function create($course, $users)
    {
        $result = [];

        foreach ($users as $user) {
            $result[] = new Enrollment(['user_id' => $user, 'course_id' => $course]);
        }

        return $result;
    }
}