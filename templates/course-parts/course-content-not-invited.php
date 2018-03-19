<section class="lms-course-page-content">
    <?php lms_get_template('course-parts/course-page-thumbnail.php') ?>
    <div class="lms-course-page-content__wrapper">
        <header class="lms-course-page__header">
            <h2 class="lms-course-page__title">
                <?php the_title(); ?>
            </h2>
        </header>
        <div class="lms-course-page-description">
            <?php
            the_post();
            the_content(); ?>
        </div>
    </div>
</section>
