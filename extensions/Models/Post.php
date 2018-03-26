<?php

namespace LmsPlugin\Models;

use FishyMinds\Collection;

class Post
{
    const POST_TYPE = 'post';

    protected $post;

    public function __construct($post = null)
    {
        if (!$post) {
            global $post;
        }

        $this->post = $post;
    }

    public static function find($id)
    {
        $post = \WP_Post::get_instance($id);

        return new static($post);
    }

    public static function all()
    {
        $query = new \WP_Query([
            'post_type' => static::POST_TYPE,
            'nopaging' => true
        ]);

        $objects = array_map(function ($object) {
            return new static($object);
        }, $query->posts);

        return new Collection($objects);
    }
}
