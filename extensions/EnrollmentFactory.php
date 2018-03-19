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
            $isEnrolled = Enrollment::where('user_id', $user)
                ->where('course_id', $course)
                ->count();
            if (!$isEnrolled) {
                $result[] = new Enrollment(['user_id' => $user, 'course_id' => $course]);
            }

        }

        return $result;
    }
}