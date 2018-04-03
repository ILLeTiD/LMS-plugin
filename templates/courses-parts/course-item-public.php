<div class="lms-courses-list__item lms-list-course lms-courses-course lms-courses-course--invited"
     data-course-status="invited"
     data-item-index=""
     data-course-id="<?= get_the_ID(); ?>">

    <?php lms_get_template('courses-parts/public-parts/course-item-thumbnail.php', ['public' => true]); ?>

    <div class="lms-courses-course__wrapper ">
        <div class="lms-courses-course__content">
            <?php lms_get_template('courses-parts/public-parts/course-item-title.php', ['public' => true]); ?>
            <?php lms_get_template('courses-parts/public-parts/course-item-button.php', ['public' => true]); ?>
            <?php lms_get_template('courses-parts/public-parts/course-item-description.php', ['public' => true]); ?>
        </div>
        <div class="lms-courses-course__info">
            <?php lms_get_template('courses-parts/public-parts/course-item-stats.php', ['public' => true]); ?>
            <?php lms_get_template('courses-parts/public-parts/course-item-progress.php', ['public' => true]); ?>
        </div>
    </div>
</div>
