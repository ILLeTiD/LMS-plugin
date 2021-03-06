<?php if ($link) : ?>
<a href="<?= $link ?>" target="<?= $linkTarget ?>"
   class="lms-grid-block lms-grid-block--link <?= $image && !$isBg ? 'lms-grid-block--image' : ''; ?>"
    <?php if ($audio) : ?>
        <?= 'data-audio-src="' . $audio . '"'; ?>
    <?php endif; ?>
   id="<?= $randomId; ?>"
   data-bg-src="<?= $backgroundStyle ? $backgroundStyle : '' ?>"
   style=" background-image: url( );
           background-position: 50%;
           background-repeat: no-repeat;
           background-size: cover;">
    <?php else: ?>
    <div class="lms-grid-block <?= $image && !$isBg ? 'lms-grid-block--image' : ''; ?>"
        <?php if ($audio) : ?>
            <?= 'data-audio-src="' . $audio . '"'; ?>
        <?php endif; ?>
         id="<?= $randomId; ?>"
        <?= $isBg ? 'data-src="' . $backgroundStyle . '"' : '' ?>
         style=" background-image: url( );
                 background-position: 50%;
                 background-repeat: no-repeat;
                 background-size: cover;">
        <?php endif; ?>
        <div class="lms-grid-block__wrapper">

            <?php if ($image && !$isBg) : ?>
                <img data-src="<?= $image ?>" class="lms-grid-block__image">
            <?php elseif ($text) : ?>
                <div class="lms-grid-block__text">
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
