<?php

$userID = get_current_user_id();
$courseID = get_the_ID();
$course = \LmsPlugin\Models\Course::find($courseID);
$user = \LmsPlugin\Models\User::find($userID);
$isEnrolled = $course->hasParticipant($userID);
$slides = $course->slides();

if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

if (!$isEnrolled) {
    wp_redirect(home_url());
    exit;
}

$enrollment = $user->enrollments()
    ->where('course_id', '=', $courseID)
    ->first();
$enrollmentStatus = $enrollment->status;
get_header('course');
?>

    <main class="lms-course-page">
        <?php
        switch ($enrollmentStatus) {
            case 'in_progress':
                lms_get_template('course-parts/course-player.php', ['course' => $course, 'slides' => $slides]);
                lms_get_template('course-parts/course-page-content.php');
                break;
            case 'invited':
                lms_get_template('course-parts/course-content-invited.php', ['course' => $course, 'enrollment' => $enrollment, 'slides' => $slides]);
                break;
            case 'completed':
                lms_get_template('course-parts/course-content-completed.php', ['course' => $course, 'enrollment' => $enrollment, 'slides' => $slides]);
                break;
        }
        ?>
        <?php ?>
    </main>
<?php
get_footer('course');
//lms_get_template('course-footer.php');
