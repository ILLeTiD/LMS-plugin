<?php

namespace LmsPlugin\Models\Repositories;

use LmsPlugin\Models\User;
use WP_User_Query;

class UserRepository
{
    public static function get($arguments)
    {
        $result = [];

        $wp_users = new WP_User_Query($arguments);

        foreach ($wp_users->results as $user) {
            $result[] = new User($user);
        }

        return $result;
    }
}