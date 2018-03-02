<div class="lms-courses-course__content-wrapper">
    <div id="blox-post-content-<?php echo $courseIndex ?>" class="lms-courses-course__description">
        <?php
        echo apply_filters('the_content', $theCourse->content);
        ?>
    </div>
    <a class="lms-courses-course__read-more" id="read-more-<?php echo $courseIndex ?>"
       href="#"><?php _e('Read more', 'lms-plugin') ?></a>
    <a class="lms-courses-course__read-less" id="read-less-<?php echo $courseIndex ?>"
       href="#">
        <?php _e('Read less', 'lms-plugin') ?></a>
</div>