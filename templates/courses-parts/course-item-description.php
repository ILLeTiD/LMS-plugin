<div class="lms-courses-course__content-wrapper">
    <div id="blox-post-content-<?php echo $courseIndex ?>" class="lms-courses-course__description">
        <!--        @TODO cleenup-->
        <?php
        // echo lms_get_the_excerpt($theCourse->id);
        //        echo get_the_excerpt($theCourse->id);
        echo wp_trim_words(strip_shortcodes(apply_filters('the_content', $theCourse->content)), 30, '');
        ?>
        <a class=""
           href="<?= get_the_permalink($theCourse->id) ?>"><?php _e('Read more', 'lms-plugin') ?></a>
    </div>
    <!--    <a class="lms-courses-course__read-more" id="read-more---><?php //echo $courseIndex ?><!--"-->
    <!--       href="#">--><?php //_e('Read more', 'lms-plugin') ?><!--</a>-->
    <!--    <a class="lms-courses-course__read-less" id="read-less---><?php //echo $courseIndex ?><!--"-->
    <!--       href="#">-->
    <!--        --><?php //_e('Read less', 'lms-plugin') ?><!--</a>-->
</div>