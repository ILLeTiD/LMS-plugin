<?php

namespace LmsPlugin\Controllers\Auth;

use FishyMinds\Request;
use LmsPlugin\Controllers\Controller;
use WP_Error;

class ResetPasswordController extends Controller
{
    /**
     * Show password reset form.
     */
    public function showForm()
    {
        $this->view('auth.reset-password');
    }

    /**
     * Process user's input.
     *
     * @param \FishyMinds\Request $request
     */
    public function resetPassword(Request $request)
    {
        $email = $request->get('email');

        $errors = $this->validate($email);

        if (count($errors->get_error_messages())) {
            return $this->view('auth.reset-password', compact('errors'));
        }

        do_action('lms_event_reset_password', $email);

        $this->view('auth.reset-password', [
            'success' => __('A reset link has been sent to your mail.', 'lms-plugin')
        ]);
    }

    /**
     * Validate email against rules:
     *  - Email should not be an empty string.
     *  - Email should be a valid email.
     *  - There should be a user with the email.
     *
     * @param string $email
     *
     * @return \WP_Error
     */
    private function validate($email)
    {
        $errors = new WP_Error;

        if (empty($email)) {
            $errors->add('email_empty', 'Email is required.');

            return $errors;
        }

        if ( ! is_email($email)) {
            $errors->add('email_invalid', 'Email is not valid.');

            return $errors;
        }

        if (! email_exists($email)) {
            $errors->add('email_exists', 'Email not found.');

            return $errors;
        }

        return $errors;
    }
}