<?php
$colors = lms_get_options('colors');
$backgroundColor = $colors["background"] ? $colors["background"] : null;
$headerColor = $colors["header"] ? $colors["header"] : null;
$headerBgColor = $colors["header_background"] ? $colors["header_background"] : null;
$textColor = $colors["text"] ? $colors["text"] : null;
?>

<style>
    .lms-slide-header {
        background: <?= $headerBgColor; ?>;
        color: <?= $headerColor ?>;
    }

    .lms-grid-block, .lms-course {
        color: <?= $textColor ?>;
        background: <?= $backgroundColor; ?>;
    }
</style>