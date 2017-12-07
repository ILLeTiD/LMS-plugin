<?php

$action->add('init', function () {
    register_post_type('acme_product', [
        'labels' => [
            'name' => __('Courses'),
            'singular_name' => __('Course')
        ],
        'public' => true,
        'has_archive' => true,
    ]);
});
