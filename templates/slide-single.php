<?php
/**
 * Template Name: Account Page
 */

if (!is_user_logged_in()) {
    wp_redirect(home_url() . '/login');
    exit;
}
$all_meta_for_user = get_user_meta(get_current_user_id());

get_header();

$userID = get_current_user_id();
$courseID = 227;
//$courseID = get_the_ID();
$course = \LmsPlugin\Models\Course::find($courseID);
$slides = [];
$slides[] = \LmsPlugin\Models\Slide::find(get_the_ID());
$user = \LmsPlugin\Models\User::find($userID);
//lms_get_template('course-header.php');
lms_get_template('course-parts/course-settings.php', ['course' => $course]);


?>
    <main class="lms-course-page">
        <div class="lms-course__outher">
            <section class="lms-course"
                     id="lms-course"
                     data-enrollment-status="<?= $enrollmentStatus ?>"
                     data-id="<?= $course->id; ?>"
                     data-user-id="<?= get_current_user_id() ?>">
                <?php
                //     lms_get_template('template-parts/course-preloader.php');
                ?>
                <div class="lms-course__wrapper">
                    <div id="lms-slides" class="lms-slides">
                        <?php
                        foreach ($slides as $key => $slide) {
                            if ($slide->slide_format == 'quiz') {
                                lms_get_template('slide-quiz.php', ['slide' => $slide, 'slide_index' => $key]);
                            } elseif ($slide->slide_format == 'regular') {
                                lms_get_template('slide-text.php', ['slide' => $slide, 'slide_index' => $key]);
                            }
                        }
                        ?>
                    </div>
                    <?php
                    lms_get_template('template-parts/course-controls.php');
                    ?>
                </div>
            </section>
        </div>
    </main>

<?php
get_footer();