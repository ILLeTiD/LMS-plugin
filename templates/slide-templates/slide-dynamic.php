<div class="lms-slide-section-display-<?= $sectionsDisplay; ?> lms-slide lms-slide-<?= $template ?> lms-slide-regular"
     data-section-display="<?= $sectionsDisplay; ?>"
     data-section-count="<?= $sectionsCount; ?>"
     data-passed="<?= $isPassed ?>"
     data-slide-index="<?= $slide_index ?>"
     data-latest="<?= $isLatest ?>"
     data-slide-id="<?= $id ?>" data-type="regular">
    <?php if ($displayHeader == 'regular') :
        lms_get_template('template-parts/regular-parts/slide-header.php', ['title' => $title]);
    endif; ?>
    <?php if ($content) : ?>
        <div class="lms-grid-container lms-grid-container-<?= $template ?> lms-grid-container-<?= $sectionsCount ?>">
            <?php
            foreach ($content as $key => $block) {
                lms_get_template('template-parts/regular-parts/grid-block.php', ['block' => $block, 'template' => $template, 'index' => $key + 1]);
            }
            ?>
        </div>
    <?php endif; ?>
</div>