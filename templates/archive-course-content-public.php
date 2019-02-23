<section class="lms-courses">
    <header class="lms-courses__header">
        <h2 class="lms-courses__title">
            <?php _e('All Courses', 'lms-plugin')?>
        </h2>
    </header>

    <?php $publicCourse_args = array(
        'post_type' => 'course',
        'post_status' => 'publish',
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'posts_per_page' => -1,
        'meta_query' => [
            'relation' => 'OR', [
                'course_visibility' => [
                    'key' => 'course_visibility',
                    'value' => 'public',
                    'compare' => '=',
                ],
            ],
        ],
    );?>

    <?php $publicCourse = new WP_Query($publicCourse_args);?>
    <?php
    $currentCourseNo = 0;
    $courseIndex = 0;
    ?>


    <?php if (!$publicCourse->have_posts()): ?>
    <div class="lms-courses-list">
        <?php lms_get_template('courses-parts/course-not-found.php');?>
    </div>
    <?php endif; ?>

    <?php if ($publicCourse->have_posts()): ?>
    <?php while ($publicCourse->have_posts()): $publicCourse->the_post();?>
    <?php
    lms_get_template('courses-parts/course-item-public.php');
    ?>
    <?php endwhile;?>
    <?php endif;?>


</section>