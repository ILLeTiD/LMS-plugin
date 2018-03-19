<?php if (has_post_thumbnail()) :
    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    ?>
    <div class="lms-course-page-thumbnail"
         style="background: url(<?= $featured_img_url; ?>) 50% no-repeat;
             background-size: cover;">
    </div>
<?php endif; ?>