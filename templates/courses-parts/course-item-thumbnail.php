<?php if ( has_post_thumbnail($theCourse->id ) ) : ?>
    <div class="lms-courses-course__thumbnail thumbnail-wrapper">
        <div class="helper-wrapper">
            <!-- Used to center the thumbnail -->
        </div>
        <!-- Used as a workaround for the thumbnail -->
        <img src=<?= wp_get_attachment_image_src(get_post_thumbnail_id($theCourse->id))[0]; ?>>
    </div>
<?php endif; ?>