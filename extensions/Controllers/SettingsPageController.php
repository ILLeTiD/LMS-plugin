<?php

namespace LmsPlugin\Controllers;

use FishyMinds\WordPress\Plugin\Plugin;
use LmsPlugin\ProfileFieldsManager;
use WP_User_Query;

class SettingsPageController extends Controller
{
    private $fields_manager;

    public function __construct(Plugin $plugin)
    {
        $this->fields_manager = new ProfileFieldsManager($plugin);

        parent::__construct($plugin);
    }

    public function index()
    {
        $settings = $this->plugin->getSettings();
        $membership = get_option('users_can_register');
        $support = new WP_User_Query(['role' => 'administrator']);

        $fields = $this->fields_manager->get();

        $this->view(
            'pages.settings.index',
            compact(
                'membership',
                'settings',
                'support',
                'fields'
            )
        );
    }

    public function save()
    {
        $settings = array_get($_POST, 'settings');
        $membership = array_get($_POST, 'membership');
        $order = array_get($_POST, 'fields_order');

        $this->plugin->setSettings($settings);
        $this->fields_manager
             ->reorder($order)
             ->save();
        update_option('users_can_register', !!$membership);

        $_SESSION['messages'] = [
            'success' => __('Settings saved.', 'lms-plugin')
        ];

        wp_safe_redirect(
            admin_url('edit.php?post_type=course&page=settings')
        );
    }
}