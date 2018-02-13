<?php

namespace LmsPlugin\Controllers;

use WP_User_Query;

class SettingsPageController extends Controller
{
    public function index()
    {
        $messages = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->plugin->setSettings(array_get($_POST, 'settings'));

            $this->saveProfileFieldsOrder(array_get($_POST, 'fields_order'));

            $membership = array_get($_POST, 'membership');
            update_option('users_can_register', !! $membership);

            $messages['success'] = __('Settings saved.', 'lms-plugin');
        }

        $settings = $this->plugin->getSettings();
        $membership = get_option('users_can_register');
        $support = new WP_User_Query(['role' => 'administrator']);
        $fields = $this->getProfileFields();

        $this->view(
            'pages.settings.index',
            compact(
                'settings',
                'membership',
                'messages',
                'support',
                'fields'
            )
        );
    }

    public function addField()
    {
        $i = array_get($_GET, 'id', 0);

        $this->view('pages.settings.components.field', compact('i'));
        die;
    }

    private function getProfileFields()
    {
        $default = [
            [
                'name' => 'Full name',
                'slug' => 'full-name',
                'type' => 'text',
                'required' => true,
                'standard' => true
            ], [
                'name' => 'Email',
                'slug' => 'email',
                'type' => 'mail',
                'required' => true,
                'standard' => true
            ], [
                'name' => 'Password',
                'slug' => 'password',
                'type' => 'password',
                'required' => true,
                'standard' => true
            ]
        ];

        return $this->plugin->getOption('profile_fields', $default);
    }

    private function setProfileFields($data)
    {
        foreach ($data as &$field) {
            if (empty($field['slug'])) {
                $field['slug'] = kebab_case($field['name']);
            }
        }

        $this->plugin->setOption('profile_fields', $data);
    }

    private function saveProfileFieldsOrder($order)
    {
        $fields = $this->getProfileFields();

        $fieldsWithNewOrder = array_combine($order, $fields);

        ksort($fieldsWithNewOrder);

        $this->plugin->setOption('profile_fields', $fieldsWithNewOrder);
    }
}