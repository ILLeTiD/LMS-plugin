<?php

namespace LmsPlugin;

use FishyMinds\WordPress\Plugin\Plugin;

class Profile
{
    const DEFAULT_FIELDS = [
        [
            'name' => 'Full name',
            'slug' => 'full-name',
            'type' => 'text',
            'required' => true,
            'standard' => true
        ], [
            'name' => 'Email',
            'slug' => 'email',
            'type' => 'mail',
            'required' => true,
            'standard' => true
        ], [
            'name' => 'Password',
            'slug' => 'password',
            'type' => 'password',
            'required' => true,
            'standard' => true
        ]
    ];
}