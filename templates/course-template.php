<?php

$userID = get_current_user_id();
$courseID = get_the_ID();
$course = \LmsPlugin\Models\Course::find($courseID);
$user = \LmsPlugin\Models\User::find($userID);
$isEnrolled = $course->hasParticipant($userID);
$slides = $course->slides();


//if (!is_user_logged_in()) {
//    wp_redirect(home_url());
//    exit;
//}
//
//if (!$isEnrolled && !current_user_can('administrator')) {
//    wp_redirect(home_url());
//    exit;
//}


get_header('course');
?>

    <main class="lms-course-page">
        <?php if (current_user_can('administrator')) : ?>
            <?php
            lms_get_template('course-parts/course-player.php', ['course' => $course, 'slides' => $slides, 'enrollmentStatus' =>'in_progress']);
            lms_get_template('course-parts/course-page-content.php');
            ?>
        <?php elseif (!is_user_logged_in() || !$isEnrolled) : ?>
            <?php lms_get_template('course-parts/course-content-not-invited.php'); ?>
        <?php else : ?>
            <?php
            $enrollment = $user->enrollments()
                ->where('course_id', '=', $courseID)
                ->first();
            $enrollmentStatus = $enrollment->status;
            switch ($enrollmentStatus) {
                case 'in_progress':
                case 'enrolled':
                    lms_get_template('course-parts/course-player.php', ['course' => $course, 'slides' => $slides, 'enrollmentStatus' => $enrollment->status]);
                    lms_get_template('course-parts/course-page-content.php', ['enrollmentStatus' => $enrollment->status]);
                    break;
                case 'invited':
                    lms_get_template('course-parts/course-content-invited.php', ['course' => $course, 'enrollment' => $enrollment, 'slides' => $slides]);
                    break;
                case 'completed':
                    lms_get_template('course-parts/course-content-completed.php', ['course' => $course, 'enrollment' => $enrollment, 'slides' => $slides]);
                    break;
            }
            ?>
        <?php endif; ?>
    </main>
<?php
get_footer('course');
//lms_get_template('course-footer.php');
