<div class="slide-section-display-<?= $sectionsDisplay; ?> slide slide-<?= $template ?> slide-regular"
     data-section-display="<?= $sectionsDisplay; ?>"
     data-section-count="<?= $sectionsCount; ?>"
     data-slide-id="<?= $id ?>" data-type="regular">
    <?php if ($displayHeader == 'regular') :
        lms_get_template('template-parts/regular-parts/slide-header.php', ['title' => $title]);
    endif; ?>
    <?php if ($content) : ?>
        <div class="grid-container grid-container-<?= $template ?> grid-container-<?= $sectionsCount ?>">
            <?php
            foreach ($content as $key => $block) {
                lms_get_template('template-parts/regular-parts/grid-block.php', ['block' => $block, 'template' => $template, 'index' => $key + 1]);
            }
            ?>
        </div>
    <?php endif; ?>
</div>