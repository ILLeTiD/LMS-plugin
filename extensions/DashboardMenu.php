<?php

namespace LmsPlugin;

use FishyMinds\WordPress\Plugin\HasPlugin;
use LmsPlugin\Controllers\ParticipantsPageController;
use LmsPlugin\Controllers\ParticipantPageController;
use LmsPlugin\Controllers\SettingsPageController;
use LmsPlugin\Controllers\StatisticsPageController;

class DashboardMenu
{
    use HasPlugin;

    public function create()
    {
        $participantsPageController = new ParticipantsPageController($this->plugin);
        $participantPageController = new ParticipantPageController($this->plugin);
        $statisticsPageController = new StatisticsPageController($this->plugin);
        $settingsPageController = new SettingsPageController($this->plugin);

        add_submenu_page(
            'edit.php?post_type=course',
            __('Participants', 'lms-plugin'),
            __('Participants', 'lms-plugin'),
            'manage_options',
            'all_participants',
            [$participantsPageController, 'all']
        );

        add_submenu_page(
            null,
            __('Participants', 'lms-plugin'),
            __('Participants', 'lms-plugin'),
            'manage_options',
            'course_participants',
            [$participantsPageController, 'course']
        );

        add_submenu_page(
            'edit.php?post_type=course',
            __('Statistics', 'lms-plugin'),
            __('Statistics', 'lms-plugin'),
            'manage_options',
            'statistics',
            [$statisticsPageController, 'index']
        );

        add_submenu_page(
            'edit.php?post_type=course',
            __('Settings', 'lms-plugin'),
            __('Settings', 'lms-plugin'),
            'manage_options',
            'settings',
            [$settingsPageController, 'index']
        );

        add_submenu_page(
            null,
            __('Participant', 'lms-plugin'),
            __('Participant', 'lms-plugin'),
            'manage_options',
            'participant',
            [$participantPageController, 'index']
        );

        add_submenu_page(
            null,
            __('Participant Courses', 'lms-plugin'),
            __('Participant Courses', 'lms-plugin'),
            'manage_options',
            'participant_courses',
            [$participantPageController, 'courses']
        );

        add_submenu_page(
            null,
            __('Participant Activities', 'lms-plugin'),
            __('Participant Activities', 'lms-plugin'),
            'manage_options',
            'participant_activities',
            [$participantPageController, 'activities']
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

        if (empty($submenu['edit.php?post_type=course'])) return $menuOrder;

        $settings = array_pop($submenu['edit.php?post_type=course']);
        $statistics = array_pop($submenu['edit.php?post_type=course']);
        $participants = array_pop($submenu['edit.php?post_type=course']);
        $categories = array_pop($submenu['edit.php?post_type=course']);

        $submenu['edit.php?post_type=course'][] = $participants;
        $submenu['edit.php?post_type=course'][] = $categories;
        $submenu['edit.php?post_type=course'][] = $statistics;
        $submenu['edit.php?post_type=course'][] = $settings;

        return $menuOrder;
    }
}