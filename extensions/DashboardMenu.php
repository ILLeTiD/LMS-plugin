<?php

namespace LmsPlugin;

use FishyMinds\Request;
use FishyMinds\WordPress\Plugin\HasPlugin;

class DashboardMenu
{
    use HasPlugin;

    public function create()
    {
        $this->addPage(
            'all_participants',
            __('Participants', 'lms-plugin'),
            'ParticipantsPageController@all',
            'edit.php?post_type=course'
        );

        $this->addPage(
            'course_participants',
            __('Participants', 'lms-plugin'),
            'ParticipantsPageController@course'
        );

        $this->addPage(
            'statistics',
            __('Statistics', 'lms-plugin'),
            'StatisticsPageController@index',
            'edit.php?post_type=course'
        );

        $this->addPage(
            'settings',
            __('Settings', 'lms-plugin'),
            'SettingsPageController@index',
            'edit.php?post_type=course'
        );

        $this->addPage(
            'participant',
            __('Participant', 'lms-plugin'),
            'ParticipantPageController@index'
        );

        $this->addPage(
            'participant_courses',
            __('Participant Courses', 'lms-plugin'),
            'ParticipantPageController@courses'
        );

        $this->addPage(
            'participant_activities',
            __('Participant Activities', 'lms-plugin'),
            'ParticipantPageController@activities'
        );

        $this->addPage(
            'profile_field.create',
            __('Create Profile Field', 'lms-plugin'),
            'ProfileFieldsPageController@create'
        );

        $this->addPage(
            'profile_field.edit',
            __('Edit Profile Field', 'lms-plugin'),
            'ProfileFieldsPageController@edit'
        );

        $this->addPage(
            'users',
            __('Users', 'lms-plugin'),
            'UsersPageController@index'
        );

        $this->addPage(
            'users&filter=waiting',
            __('Registrations', 'lms-plugin'),
            'UsersPageController@index',
            'users.php'
        );

        $this->addPage(
            'users&filter=invited',
            __('Invites', 'lms-plugin'),
            'UsersPageController@index',
            'users.php'
        );

        $this->addPage(
            'users&filter=suspended',
            __('Suspensions', 'lms-plugin'),
            'UsersPageController@index',
            'users.php'
        );
    }

    private function addPage($name, $title, $handler, $parent = null)
    {
        list($controller, $action) = explode('@', $handler);

        $controller = $this->createControllerObject($controller);

        if (! method_exists($controller, $action)) {
            throw new \InvalidArgumentException('Action not found.');
        }

        add_submenu_page(
            $parent,
            $title,
            $title,
            'manage_options',
            $name,
            [$controller, $action]
        );
    }

    private function createControllerObject($class)
    {
        $class = $this->plugin->getNamespace() . '\\Controllers\\' . $class;

        if (! class_exists($class)) {
            throw new \InvalidArgumentException('Controller\'s class not found.');
        }

        return new $class($this->plugin, new Request($_REQUEST));
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