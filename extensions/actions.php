<?php

$action->add('init', 'CoursePostType@register');
$action->add('init', 'CourseCategoryTaxonomy@register');
$action->add('admin_menu', 'DashboardMenu@create');

$action->add('add_meta_boxes', 'CourseParticipantsMetaBox@add');
$action->add('add_meta_boxes', 'CourseProgressMetaBox@add');
$action->add('add_meta_boxes', 'CourseSlidesMetaBox@add');

$action->add('init', 'SlidePostType@register');
$action->add('add_meta_boxes', 'SlideFormatMetaBox@add');
$action->add('add_meta_boxes', 'SlideSettingsMetaBox@add');
$action->add('add_meta_boxes', 'SlideContentMetaBox@add');
$action->add('add_meta_boxes', 'SlideQuizMetaBox@add');
$action->add('add_meta_boxes', 'SlideCustomCssMetaBox@add');

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

$action->add('save_post', function ($postID) {
    $fields = [
        'course',
        'slide_format',
        'slide_content',
        'slide_custom_css'
    ];

    foreach ($fields as $field) {
        update_post_meta($postID, $field, $_POST[$field]);
    }
});



