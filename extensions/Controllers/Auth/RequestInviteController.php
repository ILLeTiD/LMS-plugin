<?php

namespace LmsPlugin\Controllers\Auth;

use LmsPlugin\Controllers\Controller;
use WP_Error;

class RequestInviteController extends Controller
{
    private $redirect_to = '/';

    public function showForm()
    {
        $this->view('auth.request-invite');
    }

    public function requestInvite()
    {
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

        do_action('lms_event_invite_requested', $email);

        // TODO: Show a success message.

        wp_safe_redirect($this->redirect_to);
    }
}