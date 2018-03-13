<section class="lms-course-page-content">
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
        <div class="lms-course-page-buttons">
            <a class="lms-link"
               href="<?php get_post_type_archive_link('course'); ?>">
                <?php _e('Back to Courses', 'lms-plugin') ?>
            </a>
            <button type="button" class="lms-course__button lms-course__button--hollow lms-course-reject-button"
                    data-course-id="<?= get_the_ID(); ?>"
                    data-user-id="<?= get_current_user_id() ?>"
            >
                <?php _e("Reset process", "lms-plugin"); ?>
            </button>
        </div>
    </div>
</section>
