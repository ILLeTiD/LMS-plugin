<?php

namespace LmsPlugin\Controllers;

use LmsPlugin\Models\Activity;
use LmsPlugin\Models\Progress;
use LmsPlugin\Models\Enrollment;
use LmsPlugin\Models\User;

class ProgressController extends Controller
{
    public function commitProgress()
    {
        $progress = Progress::where('user_id', $_REQUEST['user_id'])
            ->where('course_id', $_REQUEST['course_id'])
            ->where('slide_id', intval($_REQUEST['slide_id']))
            ->where('name', $_REQUEST['name'])
            ->count();

        $progressBool = !!$progress;

        if (!$progressBool) {
            $progressNew = new Progress([
                'user_id' => $_POST['user_id'],
                'course_id' => $_POST['course_id'],
                'slide_id' => $_POST['slide_id'],
                'name' => $_POST['name'],
            ]);

            $progressNew->save();
        }

        wp_send_json(['reached_step' => $progressBool,
            'newStep' => $progressNew,
            'post' => $_POST]);
    }

    public function resetProgress()
    {
        if (!isset($_POST['user_id']) || !isset($_POST['course_id'])) {
            wp_send_json(['error' => 'provide correct arguments']);
        }
        $user_id = $_POST['user_id'];
        $course_id = $_POST['course_id'];

        global $wpdb;


        $wpdb->delete(
            $wpdb->prefix . 'lms_quiz_results',
            [
                'user_id' => $user_id,
                'course_id' => $course_id
            ],
            ['%d', '%d']
        );
        $wpdb->delete(
            $wpdb->prefix . 'lms_progress',
            [
                'user_id' => $user_id,
                'course_id' => $course_id
            ],
            ['%d', '%d']
        );

        wp_send_json(['message' => 'course progress reseted']);
    }

    public function commitActivity()
    {
        $activityNew = new Activity([
            'user_id' => $_POST['user_id'],
            'course_id' => $_POST['course_id'],
            'type' => $_POST['activity_type'],
            'name' => $_POST['activity_name']
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
        $enrollment->status = 'enrolled';

        $enrollment->save();
        $link = get_the_permalink($courseID);
        wp_send_json(['enrollment' => $enrollment->status, 'course_link' => $link]);
    }

    public function startCourse()
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
        $link = get_the_permalink($courseID);
        wp_send_json(['enrollment' => $enrollment->status, 'course_link' => $link]);
    }

    public function rejectInvite()
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

        $dbRowId = $enrollment->id;
        global $wpdb;

        $wpdb->delete(
            $wpdb->prefix . 'lms_enrollments',
            [
                'id' => $dbRowId
            ],
            ['%d']
        );

        wp_send_json(['deleted' => $dbRowId]);
    }

    public function restartCourse()
    {
        $user_id = $_POST['user_id'];
        $courseId = $_POST['course_id'];
        try {
            lms_restart_course($user_id, $courseId);
            wp_send_json(['message' => 'course data deleted', 'course_link' => get_the_permalink($courseId), 'post' => $_POST]);
        } catch (\Exception $e) {
            wp_send_json(['error' => $e->getMessage(), 'post' => $_POST]);
        }
    }

    public function completeCourse()
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
        $enrollment->status = 'completed';

        $enrollment->save();
        wp_send_json(['enrollment' => $enrollment->status]);
    }

    public function getStep()
    {
        $activity = Progress::where('user_id', $_POST['user_id'])
            ->where('course_id', $_POST['course_id'])
            ->where('name', 'finished')
            ->orderBy(['created_at' => 'DESC'])
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
            $activity = Progress::where('user_id', $_POST['user_id'])
                ->where('course_id', $_POST['course_id'])
                ->where('name', 'finished')
                ->orderBy(['created_at' => 'DESC'])
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

    public function logOutUser()
    {
        wp_logout();
        exit();
    }

    public function getAllUserCourses()
    {
        if (!isset($_POST['user_id'])) {
            wp_send_json(['error' => 'Wrong arguments', 'post' => $_POST]);
        }
        $userID = $_POST['user_id'];
        $user = User::find($userID);
        $courses = $user->enrollments()
            ->get();
        $filteredCourses = [];
        foreach ($courses as $course) {
            $filteredCourse['id'] = $course->course->id;
            $filteredCourse['status'] = $course->status;
            $filteredCourse['viewed'] = $course->viewed;
            $filteredCourse['is_new'] = true;

            $filteredCourses[] = $filteredCourse;

        }

        wp_send_json(['courses' => $filteredCourses]);
    }

    public function setCoursesAsViewed()
    {
        if (!isset($_POST['user_id'])) {
            wp_send_json(['error' => 'Wrong arguments', 'post' => $_POST]);
        }
        $userID = $_POST['user_id'];
        $user = User::find($userID);
        $courses = $user->enrollments()
            ->get();
        foreach ($courses as $course) {
            $course->viewed = 1;
            $course->save();
        }

        wp_send_json(['msg' => 'marked as viewd all user enrolments', 'post' => $_POST]);
    }

    public function loadUserActivity()
    {
        if (!isset($_POST['filters'])) {
            wp_send_json(['error' => 'Wrong arguments', 'post' => $_POST]);
        }
        $filters = $_POST['filters'];
        $userID = $filters['user_id'];
        $type = $filters['type'] ? $filters['type'] : null;
        $fromDate = $filters['from_date'] ? $filters['from_date'] : null;
        $toDate = $filters['to_date'] ? $filters['to_date'] : null;
        $activity = Activity::where('user_id', $userID);

        if ($type && $type != 'all') {
            $activity->where('type', $type);
        }

        if ($fromDate) {

            $activity->where('created_at', '>=', $fromDate . ' 00:00:01');
        }

        if ($toDate) {
            $activity->where('created_at', '<=', $toDate . ' 23:59:59');
        }


        $activity = $activity->orderBy('created_at', 'DESC')->get();


        $messages = require($this->plugin->getDirectory('/templates/activity-parts/activity-message.php'));


        $filteredActivity = [];
        foreach ($activity as $item) {
            $link = sprintf('<a href="%s">%s</a>', get_the_permalink($item->course_id), get_the_title($item->course_id));
            $text = sprintf($messages[$item->name], $link);
            $filteredActivity[] = [
                'id' => $item->id,
                'type' => $item->type,
                'text' => $text,
                'date' => $item->raw_date
            ];
        }
        usort($filteredActivity, function ($a, $b) {
            return $a['date'] < $b['date'];
        });

        wp_send_json(['items' => $filteredActivity, 'from' => $fromDate, 'to' => $toDate, 'post' => $_POST]);
    }
}