<?php
/**
 * Template Name: Activity
 */

if (!is_user_logged_in()) {
    wp_redirect(home_url() . '/login');
    exit;
}

get_header('activity');
?>
    <section class="lms-activity-page">
        <div class="lms-activity-page__wrapper">
            <?php lms_get_template('activity-parts/activity-header.php'); ?>
            <?php lms_get_template('activity-parts/activity-filters.php'); ?>
            <div class="lms-activity-list"></div>
            <?php lms_get_template('activity-parts/activity-item.php'); ?>
        </div>
    </section>
<?php
get_footer('activity');
