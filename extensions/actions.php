<?php
$action->add('activate_' . $plugin, function () {
    (new \FishyMinds\WordPress\Plugin\Router\Router($this->plugin))->registerRoutes();

    flush_rewrite_rules();
});
$action->add('deactivate_' . $plugin, 'flush_rewrite_rules');

$action->add('activate_' . $plugin, 'CustomRoles@add');
$action->add('deactivate_' . $plugin, 'CustomRoles@remove');

$action->add('activate_' . $plugin, 'DataBase\CreateActivitiesTable@up');
$action->add('activate_' . $plugin, 'DataBase\CreateEnrollmentsTable@up');

/**
 * Session.
 */
$action->add('init', 'session_start', 1);
$action->add('wp_login', 'session_destroy');
$action->add('wp_logout', 'session_destroy');


$action->add('admin_menu', 'DashboardMenu@create');

$action->add('init', 'Course\CoursePostType@register');
$action->add('init', 'Course\CategoryTaxonomy@register');
$action->add('add_meta_boxes', 'Course\ParticipantsMetaBox@add');
$action->add('add_meta_boxes', 'Course\ProgressMetaBox@add');
$action->add('add_meta_boxes', 'Course\SlidesMetaBox@add');
$action->add('save_post', 'Course\Saver@save');


$action->add('init', 'Slide\SlidePostType@register');
$action->add('add_meta_boxes', 'Slide\FormatMetaBox@add');
$action->add('add_meta_boxes', 'Slide\SettingsMetaBox@add');
$action->add('add_meta_boxes', 'Slide\ContentMetaBox@add');
$action->add('add_meta_boxes', 'Slide\QuizMetaBox@add');
$action->add('add_meta_boxes', 'Slide\FormsMetaBox@add');
$action->add('add_meta_boxes', 'Slide\DragAndDropMetaBox@add');
$action->add('add_meta_boxes', 'Slide\PuzzleMetaBox@add');
$action->add('add_meta_boxes', 'Slide\CustomCssMetaBox@add');
$action->add('save_post', 'Slide\Saver@save');

$action->add('manage_course_posts_custom_column', function ($column_name, $course_id) {
    if ($column_name == 'participants') {
        $course = \LmsPlugin\Models\Course::find($course_id);
        echo $course->enrollments()->count();

        return;
    }

    if ($column_name == 'overall_progress') {
        // TODO: Implement course completion ratio.
        echo '0%';
    }
});

$action->add('init', function () {
    add_image_size('slide_thumbnail', 150, 75, true);
});

$action->add('wp_ajax_invite_by_role_name', 'Controllers\ParticipantsPageController@inviteByRoleName');
$action->add('wp_ajax_invite_by_user_id', 'Controllers\ParticipantsPageController@inviteByUserId');
$action->add('wp_ajax_search_user', 'Controllers\ParticipantsPageController@search');
$action->add('wp_ajax_change_status', 'Controllers\ParticipantPageController@changeStatus');
$action->add('wp_ajax_new_slide_section', 'Controllers\SlideSectionsController@create');

$action->add('wp_ajax_sort_slides', 'Controllers\CoursesController@sortSlides');
$action->add('wp_ajax_delete_slide', 'Controllers\SlidesController@delete');

$action->add('wp_ajax_add_profile_field', 'Controllers\SettingsPageController@addField');

