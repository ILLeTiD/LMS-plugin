<?php

$filter->add('custom_menu_order', '__return_true');
$filter->add('menu_order', 'DashboardMenu@changeOrder');

$filter->add('manage_course_posts_columns', function ($defaults) {
    unset($defaults['date']);
    unset($defaults['categories']);
    $defaults['author'] = 'Author';
    $defaults['categories'] = 'Categories';
    $defaults['participants'] = 'Participants';
    $defaults['overall_progress'] = 'Overall progress';
    $defaults['date'] = 'Date';

    return $defaults;
});

