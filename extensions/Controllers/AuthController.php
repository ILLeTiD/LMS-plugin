<?php

namespace LmsPlugin\Controllers;

use WP_Error;

class AuthController extends Controller
{
    public function register()
    {
        if ( ! $this->isRegistrationOpened()) {
            $this->requestInvite();

            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            list($first_name, $last_name) = explode(' ', $_POST['name']);

            wp_insert_user([
                'user_login' => $_POST['email'],
                'user_email' => $_POST['email'],
                'user_pass' => $_POST['password'],
                'first_name' => $first_name,
                'last_name' => $last_name
            ]);
        }

        $this->view('auth.register');
    }

    public function requestInvite()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = new WP_Error;
            $email = array_get($_POST, 'email');

            if (empty($email)) {
                $errors->add('email_empty', 'Email is required.');
            }

            if ( ! is_email($email)) {
                $errors->add('email_invalid', 'Email is not valid.');
            }

            if (email_exists($email)) {
                $errors->add('email_exists', 'Email already in use.');
            }

            if (count($errors->get_error_messages())) {
                $this->view('auth.request-invite', compact('errors'));
            }

            // Notify administrator.
            // Redirect.
        }

        $this->view('auth.request-invite');
    }

    private function isRegistrationOpened()
    {
        return get_option('users_can_register');
    }
}