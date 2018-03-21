<?php

namespace LmsPlugin\Misc;

use LmsPlugin\Models\User;

class UserInviter
{
    const TOKEN_LENGTH = 16;

    public function invite($name, $email, $role)
    {
        $arguments = [
            'user_login' => $email,
            'user_email' => $email,
            'role' => $role
        ];

        if (!empty($name)) {
            list($first_name, $last_name) = explode(' ', $name);

            $arguments['first_name'] = $first_name;
            $arguments['last_name'] = $last_name;
        }

        $user_id = wp_insert_user($arguments);

        update_user_meta($user_id, 'lms_status', 'invited');
        update_user_meta($user_id, 'lms_last_activity', time());
        update_user_meta($user_id, 'lms_invite_token', $this->getInviteToken());

        return User::find($user_id);
    }

    private function getInviteToken()
    {
        return bin2hex(random_bytes(self::TOKEN_LENGTH));
    }
}
