<?php

namespace LmsPlugin\Controllers;

class SettingsPageController extends Controller
{
    public function index()
    {
        $messages = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->plugin->setSettings(array_get($_POST, 'settings'));

            $membership = array_get($_POST, 'membership');
            update_option('users_can_register', !! $membership);

            $messages['success'] = __('Settings saved.', 'lms-plugin');
        }

        $settings = $this->plugin->getSettings();
        $membership = get_option('users_can_register');

        $this->view('pages.settings.index', compact('settings', 'membership', 'messages'));
    }
}