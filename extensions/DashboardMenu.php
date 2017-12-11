<?php

namespace LmsPlugin;

use FishyMinds\WordPress\Plugin\HasPlugin;

class DashboardMenu
{
    use HasPlugin;

    public function create()
    {
        add_submenu_page(
            'edit.php?post_type=course',
            __('Participants', 'lms-plugin'),
            __('Participants', 'lms-plugin'),
            'manage_options',
            'participants',
            function () {
                echo 'Hello world';
            }
        );

        add_submenu_page(
            'edit.php?post_type=course',
            __('Statistics', 'lms-plugin'),
            __('Statistics', 'lms-plugin'),
            'manage_options',
            'statistics',
            function () {
                echo 'Hello world';
            }
        );
    }

    public function changeOrder($menuOrder)
    {
        global $submenu;

        /*
        // Alternative implementation:
        $submenu['edit.php?post_type=course'][14] = $submenu['edit.php?post_type=course'][16];
        unset($submenu['edit.php?post_type=course'][16]);
        ksort($submenu['edit.php?post_type=course']);
        */

        $statistics = array_pop($submenu['edit.php?post_type=course']);
        $participants = array_pop($submenu['edit.php?post_type=course']);
        $categories = array_pop($submenu['edit.php?post_type=course']);

        $submenu['edit.php?post_type=course'][] = $participants;
        $submenu['edit.php?post_type=course'][] = $categories;
        $submenu['edit.php?post_type=course'][] = $statistics;

        return $menuOrder;
    }
}