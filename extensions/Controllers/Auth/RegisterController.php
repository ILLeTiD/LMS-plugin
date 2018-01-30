<?php

namespace LmsPlugin\Controllers\Auth;

use LmsPlugin\Controllers\Controller;

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
        list($first_name, $last_name) = explode(' ', $_POST['name']);

        wp_insert_user([
            'user_login' => $_POST['email'],
            'user_email' => $_POST['email'],
            'user_pass' => $_POST['password'],
            'first_name' => $first_name,
            'last_name' => $last_name
        ]);
    }

    private function canUsersRegister()
    {
        return get_option('users_can_register');
    }
}