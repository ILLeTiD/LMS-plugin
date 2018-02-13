<?php
include 'slide-settings.php';
?>

<?php if ($link) : ?>
<a href="<?= $link ?>" target="<?= $linkTarget ?>"
   class="grid-block grid-block-<?= $index; ?> grid-block--link <?= $image && !$isBg ? 'grid-block--image' : ''; ?>"
    <?php if ($audio) : ?>
        <?= 'data-audio-src="' . $audio . '"'; ?>
    <?php endif; ?>
   id="<?= $randomId; ?>"
   data-bg-src="<?= $backgroundStyle ? $backgroundStyle : '' ?>"
   style=" background-position: 50%;
           background-repeat: no-repeat;
           background-size: cover;">
<?php else: ?>
    <div
        class="grid-block grid-block-<?= $index; ?> <?= $image && !$isBg ? 'grid-block--image' : ''; ?>"
        <?php if ($audio) : ?>
            <?= 'data-audio-src="' . $audio . '"'; ?>
        <?php endif; ?>
         id="<?= $randomId; ?>"
        <?= $isBg ? 'data-src="' . $backgroundStyle . '"' : '' ?>
         style=" background-position: 50%;
                 background-repeat: no-repeat;
                 background-size: cover;">
        <?php endif; ?>
        <div class="grid-block__wrapper">
            <?php if ($image && !$isBg) : ?>
                <img data-src="<?= $image ?>" class="grid-block__image">
            <?php elseif ($text) : ?>
                <div class="grid-block__text">
                    <?= $text ?>
                </div>
            <?php endif; ?>
            <?php if ($video) : ?>
                <?php
                global $wp_embed;
                echo $wp_embed->run_shortcode('[embed]' . $video . '[/embed]');
                ?>
            <?php endif; ?>
        </div>
<?php if ($link) : ?>
</a>
<?php else: ?>
</div>
<?php endif; ?>
