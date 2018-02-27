<?php

namespace LmsPlugin\Models;

use FishyMinds\Collection;
use LmsPlugin\Models\Repositories\CourseRepository;
use WP_User;

class User
{
    private $wp_user;

    public function __construct($wp_user)
    {
        $this->wp_user = $wp_user;
    }

    public static function find($id)
    {
        $wp_user = new WP_User($id);

        return new static($wp_user);
    }

    public function __isset($property)
    {
        switch ($property) {
            case 'id':
                return isset($this->wp_user->ID);
            case 'email':
                return isset($this->wp_user->user_email);
            case 'name':
                return isset($this->wp_user->display_name);
            case 'enrollments':
                return $this->enrollments()->get();
            case 'role':
                return isset($this->wp_user->roles[0]);
            default:
                return isset($this->wp_user->$property);
        }
    }

    public function __get($property)
    {
        switch ($property) {
            case 'id':
                return $this->wp_user->ID;
            case 'email':
                return $this->wp_user->user_email;
            case 'name':
                return $this->wp_user->display_name;
            case 'enrollments':
                return $this->enrollments()->get();
            case 'role':
                return $this->wp_user->roles[0];
            default:
                return $this->wp_user->$property;
        }
    }

    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->wp_user, $method], $arguments);
    }

    public function enrollments()
    {
        return Enrollment::where(['user_id' => $this->id]);
    }

    public function activities()
    {
        return Activity::where(['user_id' => $this->id])->get();
    }
}