<?php

$course = \LmsPlugin\Models\Course::find(get_the_ID());
$isEnrolled = $course->hasParticipant(get_current_user_id());
$slides = $course->slides();

if (!is_user_logged_in() && $isEnrolled) {
    wp_redirect(home_url());
    exit;
}
get_header('course');
?>
    <section class="course unloaded" id="course" data-id="<?= $course->id; ?>"
             data-user-id="<?= get_current_user_id() ?>">
        <?php
        lms_get_template('template-parts/course-preloader.php');
        ?>
        <div class="course__wrapper">
            <div id="slides" class="slides">
                <?php
                foreach ($slides as $key => $slide) {
                    if ($slide->slide_format == 'quiz') {
                        lms_get_template('template-parts/slide-quiz.php', ['slide' => $slide, 'slide_index' => $key]);
                    } elseif ($slide->slide_format == 'regular') {
                        lms_get_template('template-parts/slide-text.php', ['slide' => $slide, 'slide_index' => $key]);
                    }
                }
                ?>
            </div>
            <?php
            lms_get_template('template-parts/course-controls.php');
            ?>
        </div>
    </section>
<?php get_footer('course');
