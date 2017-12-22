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
$action->add('add_meta_boxes', 'SlideFormsMetaBox@add');
$action->add('add_meta_boxes', 'SlideDragAndDropMetaBox@add');
$action->add('add_meta_boxes', 'SlidePuzzleMetaBox@add');
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

    // TODO: Needs refactoring.

    $fields = [
        'course',
        'slide_template',
        'slide_content_display',
        'slide_format',
        'slide_content',
        'slide_custom_css',
        'quiz_type',
        'quiz_tolerance',
        'quiz_hint',
        'forms_type',
        'forms_answers',
        'drag_and_drop_layout',
        'drag_and_drop_images',
        'drag_and_drop_zones',
        'puzzle'
    ];

    if (get_post_type($postID) == 'course' && array_key_exists('slide_weight', $_POST)) {
        foreach ($_POST['slide_weight'] as $weight => $slideID) {
            update_post_meta($slideID, 'slide_weight', $weight);
        }
    }

    if (get_post_type($postID) == 'slide' && array_key_exists('slide_weight', $_POST)) {
        update_post_meta($postID, 'slide_weight', $_POST['slide_weight']);
    }

    foreach ($fields as $field) {
        if (! empty($_POST[$field])) {
            update_post_meta($postID, $field, $_POST[$field]);
        }
    }
});

$action->add('init', function () {
    add_image_size('slide_thumbnail', 150, 75, true);
});



