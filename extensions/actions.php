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
    if (array_key_exists('slide_format', $_POST)) {
        update_post_meta($postID, 'slide_format', $_POST['slide_format']);
    }

    if (array_key_exists('slide_custom_css', $_POST)) {
        update_post_meta($postID, 'slide_custom_css', $_POST['slide_custom_css']);
    }

    if (array_key_exists('slide_content', $_POST)) {
        var_dump($_POST['slide_content']);
        die;
    }
});



