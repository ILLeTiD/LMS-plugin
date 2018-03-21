<?php

namespace LmsPlugin\Controllers;

use FishyMinds\WordPress\Pagination;
use LmsPlugin\Models\User;
use LmsPlugin\Misc\UserActionsPerformer;

class UsersPageController extends Controller
{
    const USERS_PER_PAGE = 15;

    public function index()
    {
        $current_view = $this->request->get('view', 'all');
        $page = $this->request->get('paged', 1);

        $arguments = $this->getQueryArguments();
        $users = new \WP_User_Query($arguments);

        $views = $this->getViews();

        $pagination = new Pagination(
            $page,
            $users->get_total(),
            self::USERS_PER_PAGE
        );

        $this->view('pages.users.index', [
            'request' => $this->request,
            'views' => $views,
            'current_view' => $current_view,
            'pagination' => $pagination,
            'users' => $users,
            'search' => $this->request->get('s'),
            'filter_role' => $this->request->get('role'),
            'filter_from' => $this->request->get('from'),
            'filter_to' => $this->request->get('to')
        ]);
    }

    private function getViews()
    {
        $views = [
            'all' => [
                'label' => __('All', 'lms-plugin'),
                'link' => 'users.php',
                'arguments' => [
                    'count_total' => true
                ]
            ],
            'admin' => [
                'label' => __('Admin', 'lms-plugin'),
                'link' => 'users.php?role=administrator',
                'arguments' => [
                    'role' => 'Administrator'
                ]
            ],
            'waiting' => [
                'label' => __('Waiting', 'lms-plugin'),
                'link' => 'users.php?page=users&view=waiting',
                'arguments' => [
                    'meta_key' => 'lms_status',
                    'meta_value' => 'waiting'
                ]
            ],
            'invited' => [
                'label' => __('Invited', 'lms-plugin'),
                'link' => 'users.php?page=users&view=invited',
                'arguments' => [
                    'meta_key' => 'lms_status',
                    'meta_value' => 'invited'
                ]
            ],
            'suspended' => [
                'label' => __('Suspended', 'lms-plugin'),
                'link' => 'users.php?page=users&view=suspended',
                'arguments' => [
                    'meta_key' => 'lms_status',
                    'meta_value' => ['denied', 'uninvited'],
                    'meta_compare' => 'IN'
                ]
            ]
        ];

        foreach ($views as $name => &$view) {
            $view['total'] = (new \WP_User_Query($view['arguments']))->get_total();
        }

        return $views;
    }

    private function getQueryArguments()
    {
        $current_view = $this->request->get('view', 'all');
        $page = $this->request->get('paged', 1);

        $arguments = [
            'paged' => $page,
            'number' => self::USERS_PER_PAGE
        ];

        if ($current_view == 'waiting') {
            $arguments['meta_key'] = 'lms_status';
            $arguments['meta_value'] = 'waiting';
        }

        if ($current_view == 'invited') {
            $arguments['meta_query'] = [
                'relation' => 'AND',
                [
                    'key' => 'lms_status',
                    'value' => 'invited'
                ]
            ];
        }

        if ($current_view == 'suspended') {
            $arguments['meta_key'] = 'lms_status';
            $arguments['meta_value'] = ['denied', 'uninvited'];
            $arguments['meta_compare'] = 'IN';
        }

        // Search.
        if ($search = $this->request->get('s')) {
            $arguments['search'] = "*{$search}*";
        }

        // Filter by role.
        if ($role = $this->request->get('role')) {
            $arguments['role'] = $role;
        }

        // Filter by last activity.
        if ($from = $this->request->get('from')) {
            $arguments['meta_query'][] = [
                'key' => 'lms_last_activity',
                'value' => strtotime($from),
                'type' => 'numeric',
                'compare' => '>='
            ];
        }

        if ($to = $this->request->get('to')) {
            $arguments['meta_query'][] = [
                'key' => 'lms_last_activity',
                'value' => strtotime($to) + (3600 * 24),
                'type' => 'numeric',
                'compare' => '<='
            ];
        }

        return $arguments;
    }

    public function accept()
    {
        $user_id = array_get($_POST, 'user');
        $role = array_get($_POST, 'role');

        if (empty($role)) {
            wp_send_json([
                'status' => 'error',
                'message' => __('Role needs to be selected.', 'lms-plugin')
            ]);
        }

        $this->perform('accept', $user_id, $role);

        wp_send_json([
            'status' => 'success',
            'message' => __('The user(s) registration is completed.', 'lms-plugin')
        ]);
    }

    public function deny()
    {
        $user_id = array_get($_POST, 'user');

        $this->perform('deny', $user_id);

        wp_send_json([
            'status' => 'success',
            'message' => __('The user(s) registration is suspended.', 'lms-plugin')
        ]);
    }

    public function resendInvite()
    {
        $user_id = array_get($_POST, 'user');

        $this->perform('resend_invite', $user_id);

        wp_send_json([
            'message' => __('Invite(s) was sent again.', 'lms-plugin')
        ]);
    }

    public function uninvite()
    {
        $user_id = array_get($_POST, 'user');

        $this->perform('uninvite', $user_id);

        wp_send_json([
            'message' => __('User(s) was uninvited.', 'lms-plugin')
        ]);
    }

    public function delete()
    {
        $user_id = array_get($_POST, 'user');

        $this->perform('delete', $user_id);

        wp_send_json([
            'message' => __('User(s) was deleted.', 'lms-plugin')
        ]);
    }

    public function perform($action, $users, $role = '')
    {
        $users = is_array($users) ? $users : [$users];

        $performer = new UserActionsPerformer();
        $action = camel_case($action);

        if (! method_exists($performer, $action)) {
            return;
        }

        foreach ($users as $user) {
            call_user_func([$performer, $action], $user, $role);
        }
    }
}