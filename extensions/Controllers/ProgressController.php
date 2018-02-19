<?php

namespace LmsPlugin\Controllers;


use LmsPlugin\Models\Activity;

class ProgressController extends Controller
{
    public function commit()
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
                'name' => $_POST['commit_message']
            ]);

            $activityNew->save();
        }

        wp_send_json(['reached_step' => $activityBool,
            'newStep' => $activityNew,
            'post' => $_POST]);
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