<?php
$colors = lms_get_options('colors');
$backgroundColor = $colors["background"] ? $colors["background"] : null;
$headerColor = $colors["header"] ? $colors["header"] : null;
$textColor = $colors["text"] ? $colors["text"] : null;
?>

<style>
    .lms-slide-header {
        background: <?= $headerColor; ?>;
    }

    .lms-grid-block, .lms-course {
        color: <?= $textColor ?>;
        background: <?= $backgroundColor; ?>;
    }
</style>