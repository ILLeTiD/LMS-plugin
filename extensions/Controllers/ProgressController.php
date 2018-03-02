<?php

namespace LmsPlugin\Controllers;


use LmsPlugin\Models\Activity;
use LmsPlugin\Models\Enrollment;
use LmsPlugin\Models\User;

class ProgressController extends Controller
{
    public function commitProgress()
    {
        $activity = Activity::where('user_id', $_REQUEST['user_id'])
            ->where('course_id', $_REQUEST['course_id'])
            ->where('slide_id', intval($_REQUEST['slide_id']))
            ->where('name', 'finished')
            ->count();

        $activityBool = !!$activity;

        if (!$activityBool) {

            $activityNew = new Activity([
                'user_id' => $_POST['user_id'],
                'course_id' => $_POST['course_id'],
                'slide_id' => $_POST['slide_id'],
                'name' => $_POST['commit_message'],
                'description' => $_POST['commit_description']
            ]);

            $activityNew->save();
        }

        wp_send_json(['reached_step' => $activityBool,
            'newStep' => $activityNew,
            'post' => $_POST]);
    }

    public function commitActivity()
    {
        $activityNew = new Activity([
            'user_id' => $_POST['user_id'],
            'course_id' => $_POST['course_id'],
            'name' => $_POST['commit_message'],
            'description' => $_POST['commit_message'],
        ]);

        $activityNew->save();
        wp_send_json([
            'post' => $_POST]);
    }

    public function acceptInvite()
    {
        if (!isset($_POST['user_id']) || !isset($_POST['course_id'])) {
            wp_send_json(['error' => 'provide correct arguments']);
        }
        $userID = $_POST['user_id'];
        $courseID = $_POST['course_id'];
        $user = User::find($userID);
        $enrollment = $user->enrollments()
            ->where('course_id', '=', $courseID)
            ->first();
        $enrollment->status = 'in_progress';

        $enrollment->save();
        wp_send_json(['enrollment' => $enrollment->status]);
    }

    public function restartCourse()
    {
        $user_id = $_POST['user_id'];
        $courseId = $_POST['course_id'];
        try {
            lms_restart_course($user_id, $courseId);
            wp_send_json(['message' => 'course data deleted', 'post' => $_POST]);
        } catch (\Exception $e) {
            wp_send_json(['error' => $e->getMessage(), 'post' => $_POST]);
        }

    }

    public function getStep()
    {
        $activity = Activity::where('user_id', $_POST['user_id'])
            ->where('course_id', $_POST['course_id'])
            ->where('name', 'finished')
            ->orderBy(['date' => 'DESC'])
            ->first();

        try {
            wp_send_json(['id' => $activity->slide->id, 'post' => $_POST]);
        } catch (\Exception $e) {
            wp_send_json(['error' => $e->getMessage(), 'post' => $_POST]);
        }
    }

    public function getAllUserSteps()
    {
        try {
            $activity = Activity::where('user_id', $_POST['user_id'])
                ->where('course_id', $_POST['course_id'])
                ->where('name', 'finished')
                ->orderBy(['date' => 'DESC'])
                ->get();
            $passedSlides = [];

            foreach ($activity as $item) {
                $passedSlides[] = $item->slide->id;
            }
            wp_send_json(['ids' => $passedSlides, 'post' => $_POST]);
        } catch (\Exception $e) {
            wp_send_json(['error' => $e->getMessage(), 'post' => $_POST]);
        }
    }
}