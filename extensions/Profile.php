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

    private $user;
    private $fields;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function setFields($fields)
    {
        $this->fields = $fields;

        return $this;
    }

    public function save()
    {
        foreach ($this->fields as $key => $value) {
            update_user_meta($this->user->id, $key, $value);
        }
    }
}