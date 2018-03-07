<?php

$action->add('init', function () {
    // $router = new \FishyMinds\WordPress\Plugin\Router\Router($this->plugin);
    $router = $this->plugin->getRouter();
    $router->registerRoutes();
});

$action->add('activate_' . $plugin, 'flush_rewrite_rules');
$action->add('deactivate_' . $plugin, 'flush_rewrite_rules');

$action->add('activate_' . $plugin, 'CustomRoles@add');
$action->add('deactivate_' . $plugin, 'CustomRoles@remove');

$action->add('activate_' . $plugin, 'DataBase\CreateActivitiesTable@up');
// $action->add('deactivate_' . $plugin, 'DataBase\CreateActivitiesTable@down');
$action->add('activate_' . $plugin, 'DataBase\CreateEnrollmentsTable@up');
$action->add('activate_' . $plugin, 'DataBase\CreateQuizResultsTable@up');
$action->add('activate_' . $plugin, 'DataBase\CreateProgressTable@up');

$action->add('activate_' . $plugin, 'CustomPages@addActivity');
$action->add('deactivate_' . $plugin, 'CustomPages@removeActivity');

/**
 * Session.
 */
$action->add('init', function () {
    session_start();
}, 1);

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
$action->add('add_meta_boxes', 'Slide\DragMetaBox@add');
$action->add('add_meta_boxes', 'Slide\DropMetaBox@add');
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

$action->add('wp_ajax_save_settings', 'Controllers\SettingsPageController@save');

$action->add('wp_ajax_store_profile_field', 'Controllers\ProfileFieldsPageController@store');
$action->add('wp_ajax_update_profile_field', 'Controllers\ProfileFieldsPageController@update');
$action->add('wp_ajax_delete_profile_field', 'Controllers\ProfileFieldsPageController@delete');
$action->add('wp_ajax_add_profile_field_option', 'Controllers\ProfileFieldsPageController@addOption');

$action->add('wp_ajax_print_version', 'Controllers\PrintReportController@printReport');

$action->add('wp_ajax_accept_user', 'Controllers\UsersPageController@accept');
$action->add('wp_ajax_deny_user', 'Controllers\UsersPageController@deny');
$action->add('wp_ajax_invite_user', 'Controllers\UsersPageController@invite');

$action->add('wp_ajax_progress_commit', 'Controllers\ProgressController@commitProgress');
$action->add('wp_ajax_nopriv_progress_commit', 'Controllers\ProgressController@commitProgress');
$action->add('wp_ajax_activity_commit', 'Controllers\ProgressController@commitActivity');
$action->add('wp_ajax_nopriv_activity_commit', 'Controllers\ProgressController@commitActivity');
$action->add('wp_ajax_activity_accept_invite', 'Controllers\ProgressController@acceptInvite');
$action->add('wp_ajax_nopriv_activity_accept_invite', 'Controllers\ProgressController@acceptInvite');
$action->add('wp_ajax_activity_reject_invite', 'Controllers\ProgressController@rejectInvite');
$action->add('wp_ajax_nopriv_activity_reject_invite', 'Controllers\ProgressController@rejectInvite');
$action->add('wp_ajax_activity_redo_course', 'Controllers\ProgressController@restartCourse');
$action->add('wp_ajax_nopriv_activity_redo_course', 'Controllers\ProgressController@restartCourse');

$action->add('wp_ajax_load_user_activity', 'Controllers\ProgressController@loadUserActivity');
$action->add('wp_ajax_nopriv_load_user_activity', 'Controllers\ProgressController@loadUserActivity');

$action->add('wp_ajax_progress_restart', 'Controllers\ProgressController@restartCourse');
$action->add('wp_ajax_nopriv_progress_restart', 'Controllers\ProgressController@restartCourse');
$action->add('wp_ajax_progress_get', 'Controllers\ProgressController@getStep');
$action->add('wp_ajax_nopriv_progress_get', 'Controllers\ProgressController@getStep');
$action->add('wp_ajax_progress_get_all', 'Controllers\ProgressController@getAllUserSteps');
$action->add('wp_ajax_nopriv_progress_get_all', 'Controllers\ProgressController@getAllUserSteps');
$action->add('wp_ajax_check_options_answer', 'Controllers\QuizAnswerController@checkOptionsAnswer');
$action->add('wp_ajax_nopriv_check_options_answer', 'Controllers\QuizAnswerController@checkOptionsAnswer');
$action->add('wp_ajax_get_course_answers', 'Controllers\QuizAnswerController@getAllCourseAnswers');
$action->add('wp_ajax_nopriv_get_course_answers', 'Controllers\QuizAnswerController@getAllCourseAnswers');
$action->add('wp_ajax_check_text_answer', 'Controllers\QuizAnswerController@checkTextAnswer');
$action->add('wp_ajax_nopriv_check_text_answer', 'Controllers\QuizAnswerController@checkTextAnswer');

/**
 * Events.
 */
$action->add('lms_event_invite_requested', function ($email) {
    $admin_id = $this->plugin->getSettings('register.support');

    $admin = \LmsPlugin\Models\User::find($admin_id);

    $subject = __('A new invite request.', 'lms-plugin');
    $message = __('A new invite request from', 'lms-plugin') . ': ' . $email;

    wp_mail($admin->email, $subject, $message);
});

$action->add('lms_event_user_registered', 'Listeners\SendWelcomeEmail@handle');
$action->add('lms_event_reset_password', 'Listeners\SendPasswordResetEmail@handle');
$action->add('lms_event_user_activity', 'Listeners\ActivityLogger@handle');


/**
 * For test purposes.
 */

$action->add('wp_ajax_test', function () {
    (new \LmsPlugin\Models\Activity([
        'user_id' => 1,
        'course_id' => 412,
        'type' => 'course',
        'name' => 'finished'
    ]))->save();

    (new \LmsPlugin\Models\Progress([
        'user_id' => 1,
        'course_id' => 412,
        'slide_id' => 444,
        'name' => 'finished'
    ]))->save();
});

$action->add('phpmailer_init', function ($phpmailer) {
    // Define that we are sending with SMTP
    $phpmailer->isSMTP();

    // The hostname of the mailserver
    $phpmailer->Host = 'localhost';

    // Use SMTP authentication (true|false)
    $phpmailer->SMTPAuth = false;

    // SMTP port number
    // Mailhog normally run on port 1025
    $phpmailer->Port = WP_DEBUG ? '1025' : '25';

    // Username to use for SMTP authentication
    // $phpmailer->Username = 'yourusername';

    // Password to use for SMTP authentication
    // $phpmailer->Password = 'yourpassword';

    // The encryption system to use - ssl (deprecated) or tls
    // $phpmailer->SMTPSecure = 'tls';

    $phpmailer->From = 'noreply@fishy-minds.localhost';
    $phpmailer->FromName = 'WP DEV';
});

/**
 * Shortcodes.
 */
add_shortcode('button', function ($attributes) {
    $action = array_get($attributes, 'action');
    $text = array_get($attributes, 'value');

    return "<button class='lms-shortcode-button lms-shortcode-{$action}'>{$text}</button>";
});
