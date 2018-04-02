<?php

namespace LmsPlugin\Models;

use FishyMinds\Collection;

/**
 * Class Course
 *
 * @property int $id
 * @property string $name
 */
class Course extends Post
{
    const POST_TYPE = 'course';

    public static function statuses()
    {
        return [
            'invited' => __('Invited', 'lms-plugin'),
            'enrolled' => __('Enrolled', 'lms-plugin'),
            'in_progress' => __('In Progress', 'lms-plugin'),
            'completed' => __('Completed', 'lms-plugin'),
            'failed' => __('Failed', 'lms-plugin')
        ];
    }

    public function __isset($property)
    {
        switch ($property) {
            case 'name':
                return isset($this->post->post_title);
            default:
                return isset($this->post->$property);
        }
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
            case 'content':
                return apply_filters('the_content', $this->post_content);
            case 'excerpt':
                return get_the_excerpt($this->id);
            case 'category':
                $terms = get_the_terms($this->id, 'course_category');

                return $terms ? $terms[0] : false;
            case 'participants':
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

    /**
     * Alias for enrollments.
     *
     * @return \FishyMinds\QueryBuilder
     */
    public function participants()
    {
        return $this->enrollments();
    }

    public function hasParticipant($ID)
    {
        return $this->enrollments()->where('user_id', $ID)->count() > 0 ? true : false;
    }

    public function __toString()
    {
        return (string)$this->id;
    }
}
