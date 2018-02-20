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
            <?php echo apply_filters('the_content', get_post_field('post_content', get_the_ID())); ?>
            <a href="#" class="button">
                Fake button
            </a>
            <a href="#" class="button">
                Fake button
            </a>
        </div>
    </div>
</section>
