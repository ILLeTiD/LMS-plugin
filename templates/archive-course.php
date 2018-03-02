<?php
/**
 * Template Name: Course
 */

get_header();
?>
    <section class="lms-courses">
        <header class="lms-courses__header">
            <h2 class="lms-courses__title">
                <?php _e('All Courses', 'lms-plugin') ?>
            </h2>
        </header>
        <?php
        $currentCourseNo = 0;
        $courseIndex = 0;
        ?>

        <?php
        // Get some course info
        $user = lms_user();
        $enrollments = $user->enrollments()->get();
        ?>
        <?php if ($enrollments->count() > 0) : ?>
            <div class="lms-courses-list">
                <?php
                // Loop enrolled courses
                foreach ($enrollments as $enrollment) {
                    // Grab the current course
                    $theCourse = $enrollment->course;
                    ?>

<!--<pre>--><?php //d($enrollment) ?><!--</pre>-->
                    <?php
                    $vars = [
                        'enrollment' => $enrollment,
                        'theCourse' => $theCourse,
                        'currentCourseNo' => $currentCourseNo,
                        'courseIndex' => $courseIndex
                    ];
                    lms_get_template('courses-parts/course-item.php', $vars);
                    ?>
                    <?php $courseIndex++; ?>
                    <!-- End the foreach-loop -->
                <?php } ?>
            </div>
        <?php else : ?>
            <div class="lms-courses-list">
                <?php lms_get_template('courses-parts/course-not-found.php'); ?>
            </div>

        <?php endif ?>

    </section>

<?php get_footer(); ?>