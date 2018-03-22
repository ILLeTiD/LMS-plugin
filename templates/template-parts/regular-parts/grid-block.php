<?php
include 'section-settings.php';

?>



<?php if ($link) : ?>
<a href="<?= $link ?>" target="<?= $linkTarget ?>"
   class="<?= $isFirst ?> lms-grid-block lms-grid-block-<?= $template; ?> <?= $arrowClass ?> lms-grid-block-<?= $index; ?> lms-grid-block--link <?= $image && !$isBg ? 'lms-grid-block--image' : ''; ?>"
    <?php if ($audio) : ?>
        <?= 'data-audio-src="' . $audio . '"'; ?>
        <?= 'data-audio-loop="' . $audioIsLoop . '"'; ?>
    <?php endif; ?>
   id="<?= $randomId; ?>"
   data-icon-color="<?= $textC ? $textC : '#fff' ?>"
   data-section-number="<?= $index; ?>"
    <?= $linkedTo ? 'data-linked-to="' . $linkedTo . '"' : '' ?>
   data-bg-src="<?= $backgroundStyle ? $backgroundStyle : '' ?>"
   style=" background-position: 50%;
           background-repeat: no-repeat;
           background-size: cover;">
    <?php else: ?>
    <div
            class="<?= $isFirst ?> lms-grid-block lms-grid-block-<?= $template; ?>  <?= $arrowClass ?> lms-grid-block-<?= $index; ?> <?= $image && !$isBg ? 'lms-grid-block--image' : ''; ?>"
        <?php if ($audio) : ?>
            <?= 'data-audio-src="' . $audio . '"'; ?>
            <?= 'data-audio-loop="' . $audioIsLoop . '"'; ?>
        <?php endif; ?>
            id="<?= $randomId; ?>"
            data-icon-color="<?= $textC ? $textC : '#fff' ?>"
            data-section-number="<?= $index; ?>"
        <?= $linkedTo ? 'data-linked-to="' . $linkedTo . '"' : ''; ?>
        <?= $isBg ? 'data-src="' . $backgroundStyle . '"' : '' ?>
            style=" background-position: 50%;
                 background-repeat: no-repeat;
                 background-size: cover;">
        <?php endif; ?>
        <div class="lms-grid-block__wrapper">
            <?php
            if ($videoEmbed || $videoMedia) : ?>
                <?php
                if ($videoType) : ?>
                    <video
                            src="<?= $videoEmbed ?>"
                            style="max-width: 100%;"
                            controls="controls"
                            class="lms-video-player   <?= $videoAutoplay ? 'autoplay' : ''; ?> <?= $videoHideControls ? 'lms-video-player--disabled' : ''; ?>"></video>
                <?php else : ?>
                    <video src="<?= $videoMedia; ?>"
                           style="max-width: 100%;"
                           controls="controls" width="100%"
                           height="100%"
                           class="lms-video-player    <?= $videoAutoplay ? 'autoplay' : ''; ?><?= $videoHideControls ? 'lms-video-player--disabled' : ''; ?>"></video>

                    <?php
                    // echo wp_video_shortcode(['src' => $videoMedia]);
                endif;
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
