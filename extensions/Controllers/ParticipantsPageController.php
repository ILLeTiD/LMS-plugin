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

    public function index()
    {
        add_thickbox();

        $cid = array_get($_GET, 'cid');
        $course = WP_Post::get_instance($cid);

        $roles = CustomRoles::roles();

        $this->view('pages.participants.index', compact('course', 'roles'));
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