<style>
    #slide-<?= $id ?> {
        background-color: <?= array_get($colors,"background"); ?>;
        color: <?= array_get($colors,"text"); ?>;
        background-image: url(<?= array_get($slideBackground,"image"); ?>);
        background-position: 50%;
        -webkit-background-size: cover;
        background-size: cover;
    }

    #slide-<?= $id ?> .lms-slide-header {
        background-color: <?= array_get($colors,"header_background"); ?>;
        color: <?= array_get($colors,"header"); ?>;
    }
</style>
