<?php

if (!is_user_logged_in()) {
    wp_redirect(home_url() . '/login');
    exit;
}

get_header();

?>
<?php lms_get_template('archive-course-content.php'); ?>
<?php get_footer(); ?>