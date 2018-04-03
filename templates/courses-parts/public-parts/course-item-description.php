<div class="lms-courses-course__content-wrapper">
    <div id="blox-post-content-<?php echo $courseIndex ?>" class="lms-courses-course__description">
        <?php
        echo wp_trim_words(strip_shortcodes(apply_filters('the_content', get_the_content())), 30, '');
        ?>
        <a class=""
           href="<?= get_the_permalink() ?>"><?php _e('Read more', 'lms-plugin') ?></a>
    </div>

</div>