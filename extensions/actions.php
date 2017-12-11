<?php

$action->add('init', 'CoursePostType@register');
$action->add('init', 'CourseCategoryTaxonomy@register');
$action->add('admin_menu', 'DashboardMenu@create');

$action->add('manage_course_posts_custom_column', function ($columnName, $postID) {
    if ($columnName == 'participants') {
        // TODO: Implement course participation.
        echo 0;
    }

    if ($columnName == 'overall_progress') {
        // TODO: Implement course completion ratio.
        echo '0%';
    }
});



