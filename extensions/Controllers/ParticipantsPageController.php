<?php

namespace LmsPlugin\Controllers;

use FishyMinds\View;
use FishyMinds\WordPress\Plugin\HasPlugin;
use LmsPlugin\CustomRoles;
use LmsPlugin\EnrollmentFactory;
use LmsPlugin\Models\Course;
use LmsPlugin\Models\Enrollment;
use LmsPlugin\Models\Repositories\UserRepository;
use LmsPlugin\Models\Role;
use LmsPlugin\Models\User;
use WP_Post;
use WP_User_Query;

class ParticipantsPageController extends Controller
{
    public function all()
    {
        $roles = CustomRoles::roles();

        $users = UserRepository::get([
            'role__in' => array_keys(CustomRoles::roles())
        ]);

        $this->view('pages.participants.all', compact('users', 'roles'));
    }

    public function course()
    {
        add_thickbox();

        $cid = array_get($_GET, 'cid');
        $status = array_get($_GET, 'status');

        $course = Course::find($cid);

        if ($status) {
            $participants = $course->participants()
                                   ->where(['status' => $status])
                                   ->get();
        } else {
            $participants = $course->participants;
        }

        // $allUsers = new WP_User_Query([
        //     'role__in' => array_keys(CustomRoles::roles()),
        //     'meta_key' => 'status_' . $course->ID,
        //     'meta_value' => ['invited', 'in_progress', 'completed', 'failed'],
        //     'meta_compare' => 'IN'
        // ]);
        //
        // $enrolledUsers = new WP_User_Query([
        //     'role__in' => array_keys(CustomRoles::roles()),
        //     'meta_key' => 'status_' . $course->ID,
        //     'meta_value' => ['in_progress', 'completed', 'failed'],
        //     'meta_compare' => 'IN'
        // ]);
        //
        // $invitedUsers = new WP_User_Query([
        //     'role__in' => array_keys(CustomRoles::roles()),
        //     'meta_key' => 'status_' . $course->ID,
        //     'meta_value' => 'invited'
        // ]);

        $roles = CustomRoles::roles();

        $statuses = [
            'invited' => __('Invited', 'lms-plugin'),
            'in_progress' => __('In progress', 'lms-plugin'),
            'completed' => __('Completed', 'lms-plugin'),
            'failed' => __('Failed', 'lms-plugin'),
        ];

        $this->view(
            'pages.participants.course',
            compact(
                'course',
                'users',
                'enrolledUsers',
                'invitedUsers',
                'roles',
                'statuses',
                'status',
                'participants'
            )
        );
    }

    public function inviteByRoleName()
    {
        $course = array_get($_POST, 'course');
        $role = new Role(array_get($_POST, 'roles'));

        $users = $role->users();

        $this->enrollUsers($course, $users);

        die;
    }

    public function inviteByUserId()
    {
        $course = array_get($_REQUEST, 'course');
        $users = array_get($_REQUEST, 'users');

        $this->enrollUsers($course, $users);

        die;
    }

    public function search()
    {
        $search = sprintf('*%s*', $_POST['search'] ?: '');

        $users = new WP_User_Query([
            'role__in' => ['backoffice', 'technicians', 'sales'],
            'search' => $search,
        ]);

        if ($users->total_users) {
            $this->view('pages.participants.users', compact('users'));
        }

        die;
    }

    private function enrollUsers($course, $users)
    {
        $factory = new EnrollmentFactory;
        $enrollments = $factory->create($course, $users);

        foreach ($enrollments as $enrollment) {
            $enrollment->save();
        }
    }
}