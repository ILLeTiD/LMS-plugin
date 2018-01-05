<?php

namespace LmsPlugin\Controllers;

use FishyMinds\View;
use FishyMinds\WordPress\Plugin\HasPlugin;
use LmsPlugin\CustomRoles;
use LmsPlugin\EnrollmentFactory;
use LmsPlugin\Models\Role;
use WP_Post;
use WP_User_Query;

class ParticipantsPageController
{
    use HasPlugin;

    protected function view($name, $variables = [])
    {
        (new View($this->plugin))
            ->template($name)
            ->with($variables)
            ->display();
    }

    public function all()
    {
        $roles = CustomRoles::roles();

        $users = new WP_User_Query([
            'role__in' => array_keys(CustomRoles::roles())
        ]);

        $this->view('pages.participants.all', compact('users', 'roles'));
    }

    public function course()
    {
        add_thickbox();

        $cid = array_get($_GET, 'cid');
        $course = WP_Post::get_instance($cid);
        $users = new WP_User_Query([
            'role__in' => array_keys(CustomRoles::roles()),
            'meta_key' => 'status_' . $course->ID,
            'meta_value' => ['invited', 'in_progress', 'completed', 'failed'],
            'meta_compare' => 'IN'
        ]);

        $enrolledUsers = new WP_User_Query([
            'role__in' => array_keys(CustomRoles::roles()),
            'meta_key' => 'status_' . $course->ID,
            'meta_value' => ['in_progress', 'completed', 'failed'],
            'meta_compare' => 'IN'
        ]);

        $invitedUsers = new WP_User_Query([
            'role__in' => array_keys(CustomRoles::roles()),
            'meta_key' => 'status_' . $course->ID,
            'meta_value' => 'invited'
        ]);

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
                'statuses'
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
        $course = array_get($_POST, 'course');
        $users = array_get($_POST, 'users');

        $this->enrollUsers($course, $users);

        die;
    }

    public function search()
    {
        $search = sprintf('*%s*', $_POST['search'] ?: '');

        $users = new WP_User_Query([
            'role__in' => ['backoffice', 'technician', 'sales'],
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