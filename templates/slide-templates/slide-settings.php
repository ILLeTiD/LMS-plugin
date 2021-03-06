<?php
$hasVideoMedia = isset($content[0]["video_media"]) ? $content[0]["video_media"] : null;
$hasVideoEmbed = isset($content[0]["embed_video"]) ? $content[0]["embed_video"] : null;

$singleGridVideoClass = '';
if ($sectionsCount == 1 && ($hasVideoEmbed || $hasVideoMedia)) {
    $singleGridVideoClass = 'lms-grid-container--single-video';
} ?>
<style>
    #slide-<?= $id ?> {
        background-color: <?= array_get($colors,"background"); ?>;
        color: <?= array_get($colors,"text"); ?>;
        background-image: url(<?= array_get($slideBackground,"image"); ?>);
        background-position: 50%;
        -webkit-background-size: cover;
        background-size: cover;
    }

    #slide-<?= $id ?> .lms-grid-block-arrow {
        border-color: <?= array_get($colors,"background"); ?>;
    }

    #slide-<?= $id ?> .lms-slide-header {
        background-color: <?= array_get($colors,"header_background"); ?>;
        color: <?= array_get($colors,"header"); ?>;
    }
</style>
