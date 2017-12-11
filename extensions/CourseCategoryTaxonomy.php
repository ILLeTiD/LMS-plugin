<?php

namespace LmsPlugin;

use FishyMinds\WordPress\Plugin\HasPlugin;

class CourseCategoryTaxonomy
{
    use HasPlugin;

    private $name = 'course_category';

    private $postType = 'course';

    private function arguments()
    {
        return [
            'label' => __('Categories', 'lms-plugin'),
            'rewrite' => ['slug' => 'course_category'],
            'hierarchical' => true
        ];
    }

    public function register()
    {
        register_taxonomy($this->name, $this->postType, $this->arguments());
    }
}