<?php

namespace LmsPlugin\Controllers\Auth;

use LmsPlugin\Controllers\Controller;
use WP_Error;

class LoginController extends Controller
{
    private $redirect_to = '/course';

    public function showForm()
    {
        if (is_user_logged_in()) {
            wp_redirect($this->redirect_to);
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

        if (is_wp_error($user)) {
            return $this->view('auth.login', [
                'email' => $email,
                'errors' => $user
            ]);
        }

        if (isset($user->lms_status) && $user->lms_status != 'accepted') {
            wp_logout();

            $errors = new WP_Error;
            $errors->add('user.inactive', __('Your account is inactive.', 'lms-plugin'));

            $this->view('auth.login', compact('email', 'errors'));
        }

        wp_redirect($this->redirect_to);
    }

    public function logout()
    {
        wp_logout();

        wp_safe_redirect('/');
    }
}