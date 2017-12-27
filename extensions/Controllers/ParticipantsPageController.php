<?php

namespace LmsPlugin\Controllers;

use FishyMinds\View;
use FishyMinds\WordPress\Plugin\HasPlugin;
use LmsPlugin\CustomRoles;
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
        $course = \WP_Post::get_instance($cid);

        $roles = CustomRoles::roles();

        $this->view('pages.participants.index', compact('course', 'roles'));
    }

    public function invite()
    {
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
}