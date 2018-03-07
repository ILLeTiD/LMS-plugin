<?php

namespace LmsPlugin\Misc;

class InviteesValidator
{
    public function validate($invitees)
    {
        foreach ($invitees as $invitee) {
            $this->validateEmail(array_get($invitee, 'email'));
        }
    }

    private function validateEmail($email)
    {
        if (email_exists($email)) {
            $message = __('Email %s already exists', 'lms-plugin');
            wp_send_json_error(['message' => sprintf($message, $email)]);
        }
    }
}