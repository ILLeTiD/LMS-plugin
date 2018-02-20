<?php

$course = \LmsPlugin\Models\Course::find(get_the_ID());
$isEnrolled = $course->hasParticipant(get_current_user_id());
$slides = $course->slides();

if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}
//@TODO remove comment when go live
if (!$isEnrolled) {
//    wp_redirect(home_url());
//    exit;
}

get_header('course');
?>

    <main class="lms-course-page">
        <?php lms_get_template('course-parts/course-player.php', ['course' => $course, 'slides' => $slides]); ?>
        <?php lms_get_template('course-parts/course-page-content.php') ?>
    </main>
<?php
get_footer('course');
//lms_get_template('course-footer.php');
