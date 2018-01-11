<?php

namespace LmsPlugin\Models;

use FishyMinds\Collection;
use LmsPlugin\Models\Repositories\UserRepository;
use WP_Post;
use WP_Query;

class Course
{
    private $post;

    public function __construct($post = null)
    {
        if (! $post) {
            global $post;
        }

        $this->post = $post;
    }

    public static function find($id)
    {
        $post = WP_Post::get_instance($id);

        return new static($post);
    }

    public static function statuses()
    {
        return [
            'invited' => __('Invited', 'lms-plugin'),
            'in_progress' => __('In Progress', 'lms-plugin'),
            'completed' => __('Completed', 'lms-plugin'),
            'failed' => __('Failed', 'lms-plugin')
        ];
    }

    public function __get($property)
    {
        switch ($property) {
            case 'id':
                return $this->post->ID;
            case 'author':
                return User::find($this->post->post_author);
            case 'name':
                return $this->post->post_title;
            case 'category':
                $terms = get_the_terms($this->id, 'course_category');

                return $terms ? $terms[0] : false;
            default:
                return $this->post->$property;
        }
    }

    public function getNumberOfParticipants()
    {
        global $wpdb;

        return $wpdb->get_var("
            SELECT COUNT(*) 
            FROM {$wpdb->usermeta} 
            WHERE meta_key = 'status_{$this->post->ID}'
        ");
    }

    public function getNumberOfEnrolledParticipants()
    {
        global $wpdb;

        return $wpdb->get_var("
            SELECT COUNT(*) 
            FROM {$wpdb->usermeta} 
            WHERE meta_key = 'status_{$this->post->ID}' 
                AND meta_value = 'in_progress'
        ");
    }

    public function getNumberOfInvitedParticipants()
    {
        global $wpdb;

        return $wpdb->get_var("
            SELECT COUNT(*) 
            FROM {$wpdb->usermeta} 
            WHERE meta_key = 'status_{$this->post->ID}' 
                AND meta_value = 'invited'
        ");
    }

    public function slides()
    {
        $results = [];

        $slides = new WP_Query([
            'post_type' => 'slide',
            'meta_key' => 'course',
            'meta_value' => $this->id,
            'fields' => 'ids'
        ]);

        foreach ($slides->posts as $slide) {
            $results[] = Slide::find($slide);
        }

        return new Collection($results);
    }

    public function participants()
    {
        return UserRepository::get([
            'meta_key' => 'status_' . $this->id
        ]);
    }
}