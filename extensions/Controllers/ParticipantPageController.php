<?php

namespace LmsPlugin\Controllers;

use LmsPlugin\CustomRoles;
use LmsPlugin\Models\Course;
use LmsPlugin\Models\DataSuppliers\ParticipantProgressDataSupplier;
use LmsPlugin\Models\Enrollment;
use LmsPlugin\Models\User;

class ParticipantPageController extends Controller
{
    public function index()
    {
        $user_id = array_get($_GET, 'uid');

        $user = User::find($user_id);

        $progress_data_supplier = new ParticipantProgressDataSupplier($user_id);
        $progress = $progress_data_supplier->getData();

        $roles = CustomRoles::roles();

        $statuses = Course::statuses();
        $statuses['uninvited'] = __('Uninvited', 'lms-plugin');

        $dictionary = require $this->plugin->getDirectory('languages/activities.php');

        $this->view('pages.participant.index', compact('user', 'statuses', 'progress', 'roles', 'dictionary'));
    }

    public function courses()
    {
        $user_id = array_get($_GET, 'uid');
        $user = User::find($user_id);

        $statuses = Course::statuses();
        $statuses['uninvited'] = __('Uninvited', 'lms-plugin');

        $this->view('pages.participant.courses', compact('user', 'statuses'));
    }

    public function activities()
    {
        $user_id = array_get($_GET, 'uid');
        $filter = array_get($_GET, 'filter');
        $search = array_get($_GET, 'search');

        $user = User::find($user_id);

        $activities = $user->activities()
                           ->where('created_at', '>=', array_get($filter, 'from'))
                           ->where('created_at', '<=', array_get($filter, 'to'))
                           ->where('type', array_get($filter, 'type'))
                           ->where('course_id', array_get($filter, 'course'))
                           ->where('name', 'LIKE', $search ? "%{$search}%" : '')
                           ->orderBy(['created_at' => 'DESC'])
                           ->paginate(10);

        $dictionary = require $this->plugin->getDirectory('languages/activities.php');

        $courses = Course::all();

        $this->view(
            'pages.participant.activities',
            compact(
                'activities', 
                'dictionary', 
                'courses', 
                'filter', 
                'search',
                'user'
            )
        );
    }

    public function changeStatus()
    {
        $user_id = array_get($_POST, 'user_id');
        $course_id = array_get($_POST, 'course_id');
        $status = array_get($_POST, 'status');

        $enrollment = Enrollment::where(['user_id' => $user_id])
                                ->where(['course_id' => $course_id])
                                ->first();

        $enrollment->status = $status;
        $enrollment->save();

        wp_safe_redirect(wp_get_referer());

        die;
    }
}
