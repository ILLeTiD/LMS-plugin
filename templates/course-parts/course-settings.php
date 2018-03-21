<?php
$colors = lms_get_options('colors');
$backgroundColor = $colors["background"] ? $colors["background"] : null;
$headerColor = $colors["header"] ? $colors["header"] : null;
$headerBgColor = $colors["header_background"] ? $colors["header_background"] : null;
$textColor = $colors["text"] ? $colors["text"] : null;
$customCSS = get_post_meta($course->id, 'course_custom_css', true);
?>

<style>
    .lms-slide-header {
        background: <?= $headerBgColor; ?>;
        color: <?= $headerColor ?>;
    }

    .lms-slide, .lms-course {
        color: <?= $textColor ?>;
        background: <?= $backgroundColor; ?>;
    }
    <?= $customCSS; ?>
</style>