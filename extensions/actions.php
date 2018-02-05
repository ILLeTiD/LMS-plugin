<?php
$action->add('activate_' . $plugin, 'CustomRoles@add');
$action->add('deactivate_' . $plugin, 'CustomRoles@remove');

$action->add('activate_' . $plugin, 'DataBase\CreateActivitiesTable@up');
$action->add('activate_' . $plugin, 'DataBase\CreateEnrollmentsTable@up');

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

//frontend actions
$action->add('wp_ajax_progress_commit', 'Controllers\ProgressController@commit');
$action->add('wp_ajax_nopriv_progress_commit', 'Controllers\ProgressController@commit');
$action->add('wp_ajax_progress_get', 'Controllers\ProgressController@getStep');
$action->add('wp_ajax_nopriv_progress_get', 'Controllers\ProgressController@getStep');
$action->add('wp_ajax_progress_get_all', 'Controllers\ProgressController@getAllUserSteps');
$action->add('wp_ajax_nopriv_progress_get_all', 'Controllers\ProgressController@getAllUserSteps');
$action->add('wp_ajax_check_options_answer', 'Controllers\QuizAnswerController@checkOptionsAnswer');
$action->add('wp_ajax_nopriv_check_options_answer', 'Controllers\QuizAnswerController@checkOptionsAnswer');
$action->add('wp_ajax_get_course_answers', 'Controllers\QuizAnswerController@getAllCourseAnswers');
$action->add('wp_ajax_nopriv_get_course_answers', 'Controllers\QuizAnswerController@getAllCourseAnswers');

if (!class_exists('_WP_Editors', false)) {
    require(ABSPATH . WPINC . '/class-wp-editor.php');
}
$action->add('admin_print_footer_scripts', ['_WP_Editors', 'print_default_editor_scripts']);

$action->add('init', function () {
    add_rewrite_rule('^register/?', 'index.php?controller=AuthController&action=register', 'top');
});

$action->add('template_redirect', function () {
    global $wp_query;

    $controller = $wp_query->get('controller');
    $action = $wp_query->get('action');

    if (empty($controller) || empty($action)) {
        return;
    }

    $controller = $this->plugin->getNamespace() . '\\Controllers\\' . $controller;

    if (!class_exists($controller)) {
        // Controller not found.
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        die;
    }

    $controller = new $controller($this->plugin);

    if (!method_exists($controller, $action)) {
        // Action not found.
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        die;
    }

    $controller->$action();
    die;
});


