<?php
$action->add('activate_' . $plugin, 'CustomRoles@add');
$action->add('deactivate_' . $plugin, 'CustomRoles@remove');

$action->add('activate_' . $plugin, function () {
    global $wpdb;

    $table_name = $wpdb->prefix . 'lms_activity';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
              id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
              user_id BIGINT NOT NULL,
              course_id BIGINT NOT NULL,
              slide_id BIGINT,
              name VARCHAR(255) NOT NULL,
              description VARCHAR(255),
              date DATETIME DEFAULT CURRENT_TIMESTAMP
            ) {$charset_collate};";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
});

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

$action->add('manage_course_posts_custom_column', function ($column_name, $post_id) {
    if ($column_name == 'participants') {
        // TODO: Implement course participation.
        echo 0;
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



