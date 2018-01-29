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

    public function __get($property)
    {
        switch ($property) {
            case 'id':
                return $this->wp_user->ID;
            case 'name':
                return $this->wp_user->display_name;
            case 'enrollments':
                return $this->enrollments()->get();
            default:
                return $this->wp_user->$property;
        }
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