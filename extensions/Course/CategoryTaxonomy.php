<?php

namespace LmsPlugin\Course;

use FishyMinds\WordPress\Plugin\HasPlugin;

class CategoryTaxonomy
{
    use HasPlugin;

    private $name = 'course_category';

    private $postType = 'course';

    private function arguments()
    {
        return [
            'label' => __('Categories', 'lms-plugin'),
            'rewrite' => ['slug' => 'course_category'],
            'hierarchical' => true,
            'show_admin_column' => true
        ];
    }

    public function register()
    {
        register_taxonomy($this->name, $this->postType, $this->arguments());
    }
}