<?php

namespace LmsPlugin\Controllers\Auth;

use LmsPlugin\Controllers\Controller;
use WP_Error;

class LoginController extends Controller
{
    private $redirect_to = '/';

    public function showForm()
    {
        if (is_user_logged_in()) {
            wp_safe_redirect($this->redirect_to);
        }

        $this->view('auth.login');
    }

    public function login()
    {
        $email = array_get($_POST, 'email');
        $password = array_get($_POST, 'password');

        $user = wp_signon([
            'user_login' => $email,
            'user_password' => $password
        ]);

        if (! is_wp_error($user)) {
            wp_safe_redirect($this->redirect_to);
        }

        $errors = $user;

        $this->view('auth.login', compact('email', 'errors'));
    }

    public function logout()
    {
        wp_logout();

        wp_safe_redirect('/');
    }
}