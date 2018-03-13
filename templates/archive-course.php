<?php


get_header();

?>
    <section class="lms-courses">
        <header class="lms-courses__header">
            <h2 class="lms-courses__title">
                <?php _e('All Courses', 'lms-plugin') ?>
            </h2>
        </header>
        <?php if (current_user_can('administrator')) : ?>
            <?php $course_args = array(
                'post_type' => 'course',
                'post_status' => 'publish',
                'order' => 'ASC',
                'orderby' => 'menu_order',
                'posts_per_page' => -1,
            ); ?>
            <?php $course = new WP_Query($course_args); ?>
            <?php if ($course->have_posts()) : ?>
                <?php while ($course->have_posts()) : $course->the_post();
                    $theCourse = get_post(get_the_ID());
                    ?>
                    <div class="lms-courses-list">
                        <div class="lms-courses-list__item lms-list-course lms-courses-course"
                             data-course-id="<?= get_the_ID() ?>">
                            <?php lms_get_template('courses-parts/course-item-thumbnail.php', ['theCourse' => $theCourse]); ?>
                            <div class="lms-courses-course__wrapper ">
                                <div class="lms-courses-course__content">
                                    <div class="lms-courses-course__title-wrapper">
                                        <h2 id="lms-courses-course__title-link">
                                            <a class="lms-courses-course__title"
                                               href="<?php echo get_the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>
                                    </div>
                                    <div class="lms-courses-course__content-wrapper">
                                        <div id="blox-post-content-<?php echo $courseIndex ?>"
                                             class="lms-courses-course__description">
                                            <?php
                                            echo wp_trim_words(strip_shortcodes(apply_filters('the_content', get_the_content())), 30, '');
                                            ?>
                                            <a class=""
                                               href="<?= get_the_permalink() ?>"><?php _e('Read more', 'lms-plugin') ?></a>
                                        </div>

                                    </div>
                                </div>
                                <div class="lms-courses-course__info">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif;
            wp_reset_query(); ?>
        <?php else: ?>
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
        <?php endif; ?>


    </section>

<?php get_footer(); ?>