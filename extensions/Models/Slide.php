<?php

namespace LmsPlugin\Models;

use WP_Post;

class Slide
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
}