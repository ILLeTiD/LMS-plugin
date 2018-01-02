<?php

namespace LmsPlugin\Models;

use WP_Post;

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

    public function __get($property)
    {
        return $this->post->$property;
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
}