<?php

namespace LmsPlugin\Controllers;

use FishyMinds\Request;
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

    public function getUserFields()
    {

        $user_id = get_current_user_id();

        $user = User::find($user_id);

        //prepare data to frontend
        $userFields = array_map(function ($item) use ($user_id, $user) {
            $item['user_value'] = get_user_meta($user_id, $item['slug'], true);

            if ($item['slug'] == 'full-name') {
                $firstName = get_user_meta($user_id, 'first_name', true);
                $lastName = get_user_meta($user_id, 'last_name', true);
                $item['user_value'] = $firstName . ' ' . $lastName;
            }
            if ($item['slug'] == 'email') {
                $item['user_value'] = $user->user_email;
            }
            if ($item['slug'] == 'password') {
                return;
            }
            return $item;
        }, $this->fields);

        $userFields = array_filter($userFields, function ($item) {
            return $item;
        });

        $this->view('profile.account-page', compact('userFields'));
    }


    public function save(Request $request)
    {

        $user_id = get_current_user_id();
        // dd($request);
        $user = User::find($user_id);
        $fullName = $request->get('full-name');
        list($first_name, $last_name) = explode(' ', $fullName);
        update_user_meta($user->id, 'first_name', $first_name);
        update_user_meta($user->id, 'last_name', $last_name);

        $profile = new Profile($user);

        $newEmail = $request->get('email');


        $isChangePass = $request->get('change-pass');
        if ($isChangePass && $request->get('new-pass')) {
            $user_id = wp_insert_user([
                'ID' => $user->id,
                'user_login' => $user->email,
                'user_email' => $user->email,
                'user_pass' => wp_hash_password($request->get('new-pass')),
                'first_name' => $first_name,
                'last_name' => $last_name
            ]);
        } else {
            $user_id = wp_insert_user([
                'ID' => $user->id,
                'user_login' => $newEmail,
                'user_email' => $newEmail,
                'first_name' => $first_name,
                'last_name' => $last_name
            ]);
        }

        $profile->setFields(
            $request->only($this->fieldManager->getCustomFieldsSlugs())
        )->save();

        wp_redirect('/lms-profile');
    }
}