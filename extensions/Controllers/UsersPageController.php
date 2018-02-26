<?php

namespace LmsPlugin\Controllers;

use FishyMinds\WordPress\Pagination;
use LmsPlugin\UsersListTable;

class UsersPageController extends Controller
{
    const USERS_PER_PAGE = 5;

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
            'users' => $users
        ]);
    }

    private function getViews()
    {
        $views = [
            'all' => [
                'label' => __('All', 'lms-plugin'),
                'link' => 'users.php?page=users',
                'arguments' => [
                    'count_total' => true
                ]
            ],
            'admin' => [
                'label' => __('Admin', 'lms-plugin'),
                'link' => 'users.php?page=users&view=admin',
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
                    'meta_key' => 'status',
                    'meta_value' => 'invited'
                ]
            ],
            'suspended' => [
                'label' => __('Suspended', 'lms-plugin'),
                'link' => 'users.php?page=users&view=suspended',
                'arguments' => [
                    'meta_key' => 'status',
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

        if ($current_view == 'admin') {
            $arguments['role'] = 'Administrator';
        }

        if ($current_view == 'waiting') {
            $arguments['meta_key'] = 'lms_status';
            $arguments['meta_value'] = 'waiting';
        }

        if ($current_view == 'invited') {
            $arguments['meta_key'] = 'lms_status';
            $arguments['meta_value'] = 'invited';
        }

        return $arguments;
    }
}