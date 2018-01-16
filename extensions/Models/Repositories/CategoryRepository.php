<?php

namespace LmsPlugin\Models\Repositories;

use FishyMinds\Collection;
use WP_Term_Query;

class CategoryRepository
{
    public static function get($arguments)
    {
        $results = new WP_Term_Query([
            'taxonomy' => 'course_category',
            'hide_empty' => true
        ]);

        return new Collection($results->terms ? $results->terms : []);
    }
}