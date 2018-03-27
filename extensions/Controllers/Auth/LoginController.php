<?php

namespace LmsPlugin\Controllers\Auth;

use FishyMinds\Request;
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

        $success = array_pull($_SESSION, 'success');

        $this->view('auth.login', compact('success'));
    }

    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $errors = $this->validate($email, $password);

        if (count($errors->get_error_messages())) {
            return $this->view('auth.login', compact('email', 'errors'));
        }

        $user = wp_signon([
            'user_login' => $email,
            'user_password' => $password
        ]);

        if (is_wp_error($user)) {
            $errors = new WP_Error;
            $errors->add('email.required', __('Incorrect credentials.', 'lms-plugin'));

            return $this->view('auth.login', compact('email', 'errors'));
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

    private function validate($email, $password)
    {
        $errors = new WP_Error;

        if (empty($email)) {
            $errors->add('email.required', __('Email is required.', 'lms-plugin'));
        }

        if (!email_exists($email)) {
            $errors->add('email.exists', __('Incorrect credentials', 'lms-plugin'));
        }

        if (empty($password)) {
            $errors->add('password.exists', __('Password is required.', 'lms-plugin'));
        }

        if (strlen($password) < 6) {
            $errors->add('password.short', __('Password must be at least 6 characters.', 'lms-plugin'));
        }

        return $errors;
    }
}