<?php
$isLoggedIn = is_user_logged_in();
// if (!$isLoggedIn) {
    // wp_redirect(home_url() . '/login');
    // exit;
// }

get_header();

?>
<?php 
if($isLoggedIn) {
    lms_get_template('archive-course-content.php'); 
} else {
    lms_get_template('archive-course-content-public.php'); 
}

?>
<?php get_footer(); ?>