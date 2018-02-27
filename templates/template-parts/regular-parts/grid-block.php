<?php
include 'section-settings.php';
?>

<?php if ($link) : ?>
<a href="<?= $link ?>" target="<?= $linkTarget ?>"
   class="<?= $isFirst ?> lms-grid-block lms-grid-block-<?= $template; ?> lms-grid-block-<?= $index; ?> lms-grid-block--link <?= $image && !$isBg ? 'lms-grid-block--image' : ''; ?>"
    <?php if ($audio) : ?>
        <?= 'data-audio-src="' . $audio . '"'; ?>
    <?php endif; ?>
   id="<?= $randomId; ?>"
   data-icon-color="<?= $textC? $textC : '#fff' ?>"
   data-bg-src="<?= $backgroundStyle ? $backgroundStyle : '' ?>"
   style=" background-position: 50%;
           background-repeat: no-repeat;
           background-size: cover;">
<?php else: ?>
<div
  class="<?= $isFirst ?> lms-grid-block lms-grid-block-<?= $template; ?> lms-grid-block-<?= $index; ?> <?= $image && !$isBg ? 'lms-grid-block--image' : ''; ?>"
        <?php if ($audio) : ?>
            <?= 'data-audio-src="' . $audio . '"'; ?>
        <?php endif; ?>
        id="<?= $randomId; ?>"
        data-icon-color="<?= $textC? $textC : '#fff' ?>"
        <?= $isBg ? 'data-src="' . $backgroundStyle . '"' : '' ?>
            style=" background-position: 50%;
                 background-repeat: no-repeat;
                 background-size: cover;">
        <?php endif; ?>
        <div class="lms-grid-block__wrapper">
            <?php if ($video) : ?>
                <?php
                global $wp_embed;
                echo $wp_embed->run_shortcode('[embed]' . $video . '[/embed]');
                ?>
            <?php elseif ($image && !$isBg) : ?>
                <img data-src="<?= $image ?>" class="lms-grid-block__image">
            <?php elseif ($text) : ?>
                <div class="lms-grid-block__text">
                    <?= apply_filters('the_content', $text); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($link) : ?>
</a>
<?php else: ?>
    </div>
<?php endif; ?>
