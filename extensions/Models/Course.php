<?php

namespace LmsPlugin\Models;

use FishyMinds\Collection;
use FishyMinds\QueryBuilder;
use WP_Post;
use WP_Query;

/**
 * Class Course
 *
 * @property int $id
 *
 * @package LmsPlugin\Models
 */
class Course
{
    private $post;

    public function __construct($post = null)
    {
        if (!$post) {
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
            case 'enrollments':
                return $this->enrollments()->get();
            default:
                return $this->post->$property;
        }
    }

    public function slides()
    {
        $results = [];

        global $post;
        $slides = new \WP_Query([
            'post_type' => 'slide',
            'posts_per_page' => -1,
            'meta_query' => [
                'relation' => 'AND', [
                    'course_clause' => [
                        'key' => 'course',
                        'value' => $this->id,
                        'type' => 'NUMERIC'
                    ],
                    'slide_weight_clause' => [
                        'key' => 'slide_weight',
                        'value' => 0,
                        'compare' => '>=',
                        'type' => 'NUMERIC'
                    ]
                ]
            ],
            'orderby' => [
                'slide_weight_clause' => 'ASC',
                'ID' => 'ASC'
            ],
        ]);

        foreach ($slides->posts as $slide) {
            $results[] = Slide::find($slide->ID);
        }

        return new Collection($results);
    }

    /**
     * @return \FishyMinds\QueryBuilder
     */
    public function enrollments()
    {
        return Enrollment::where(['course_id' => $this->id]);
    }

    public function hasParticipant($ID)
    {
        return !!$this->enrollments()->where('user_id', $ID)->count();
    }

    public function __toString()
    {
        return (string)$this->id;
    }
}