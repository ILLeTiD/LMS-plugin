<?php

namespace LmsPlugin\Misc;

use LmsPlugin\Models\User;

class UserInviter
{
    public function invite($name, $email, $role)
    {
        list($first_name, $last_name) = explode(' ', $name);

        $user_id = wp_insert_user([
            'user_login' => $email,
            'user_email' => $email,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'role' => $role
        ]);

        update_user_meta($user_id, 'lms_status', 'invited');

        return new User($user_id);
    }
}