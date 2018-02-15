<?php
$colors = lms_get_options('colors');
$backgroundColor = $colors["background"] ? $colors["background"] : null;
$headerColor = $colors["header"] ? $colors["header"] : null;
$textColor = $colors["text"] ? $colors["text"] : null;
?>

<style>
    .slide-header {
        background: <?= $headerColor; ?>;
    }

    .grid-block, .course {
        color: <?= $textColor ?>;
        background: <?= $backgroundColor; ?>;
    }
</style>