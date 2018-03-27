<?php

namespace LmsPlugin\Controllers;

use LmsPlugin\Models\User;
use LmsPlugin\ProfileFieldsManager;
use LmsPlugin\Profile;
use LmsPlugin\Misc\UserActionsPerformer;
use FishyMinds\WordPress\Plugin\Plugin;

class UserProfileController extends Controller
{
    protected $plugin;
    protected $fieldManager;
    protected $fields = [];
    protected $custom_fields_slug = [];


    public function __construct(Plugin $plugin)
    {
        parent::__construct($plugin);
        $this->fieldManager = new ProfileFieldsManager($plugin);
        $this->fields = $this->fieldManager->get();
        $this->custom_fields_slug = $this->fieldManager->getCustomFieldsSlugs();
    }

    public function getAjax()
    {
        $user_id = $_POST['user_id'];
        if (!$user_id) wp_send_json(['error' => 'Invalid arguments']);

        $user = User::find($user_id);
        $profile = new Profile($user);

        $userFields = array_map(function ($item) use ($user_id) {
            $item['user_value'] = get_user_meta($user_id, $item['slug'], true);
            return $item;
        }, $this->custom_fields_slug);
        wp_send_json(['fields' => $userFields]);
    }

    public function save()
    {
        $user_id = $_POST['user_id'];
        if (!$user_id) wp_send_json(['error' => 'Invalid arguments']);

        $user = User::find($user_id);

        $profile = new Profile($user);

        $profile->setFields(
            array_only(
                $_POST,
                $this->fields_manager->getCustomFieldsSlugs()
            )
        )->save();
    }
}