<?php

namespace LmsPlugin\Controllers\Auth;

use LmsPlugin\Controllers\Controller;
use WP_Error;

class RegisterController extends Controller
{
    private $redirect_to = '/';

    public function showForm()
    {
        if ( ! $this->canUsersRegister()) {
            wp_safe_redirect('/request_invite');
        }

        $this->view('auth.register');
    }

    public function register()
    {
        $name = array_get($_POST, 'name');
        $email = array_get($_POST, 'email');
        $password = array_get($_POST, 'password');
        $role = array_get($_POST, 'role');

        $allowed_domain = $this->plugin->getSettings('register.restriction');
        $domain = strstr($email, '@');
        $errors = new WP_Error;

        if ($name == '') {
            $errors->add('name.required', __('Full name is required.', 'lms-plugin'));
        }

        if (empty($email)) {
            $errors->add('email.required', __('Email is required.', 'lms-plugin'));
        }

        if (email_exists($email)) {
            $errors->add('email.exists', __('Email already in use.', 'lms-plugin'));
        }

        if ($allowed_domain && $domain != $allowed_domain) {
            $errors->add('email.domain', __('Email is not allowed to be registered.', 'lms-plugin'));
        }

        if (empty($password)) {
            $errors->add('password.exists', __('Password is required.', 'lms-plugin'));
        }

        if (strlen($password) < 6) {
            $errors->add('password.short', __('Password must be at least 6 characters.', 'lms-plugin'));
        }

        if (count($errors->get_error_messages())) {
            $this->view('auth.register', compact('errors'));

            return;
        }

        list($first_name, $last_name) = explode(' ', $_POST['name']);

        wp_insert_user([
            'user_login' => $_POST['email'],
            'user_email' => $_POST['email'],
            'user_pass' => $_POST['password'],
            'first_name' => $first_name,
            'last_name' => $last_name
        ]);

        // wp_safe_redirect($this->redirect_to);
    }

    private function canUsersRegister()
    {
        return get_option('users_can_register');
    }
}