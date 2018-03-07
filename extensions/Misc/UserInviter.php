<?php

namespace LmsPlugin\Misc;

use LmsPlugin\Models\User;

class UserInviter
{
    public function invite($name, $email, $role)
    {
        $arguments = [
            'user_login' => $email,
            'user_email' => $email,
            'role' => $role
        ];

        if (! empty($name)) {
            list($first_name, $last_name) = explode(' ', $name);

            $arguments['first_name'] = $first_name;
            $arguments['last_name'] = $last_name;
        }

        $user_id = wp_insert_user($arguments);

        update_user_meta($user_id, 'lms_status', 'invited');

        return new User($user_id);
    }
}