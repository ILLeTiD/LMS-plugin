<div class="lms-slide-section-display-<?= $sectionsDisplay; ?> lms-slide lms-slide-<?= $template ?> <?= $isPassed ? 'passed' : '' ?> lms-slide-regular"
     id="slide-<?= $id ?>"
     data-section-display="<?= $sectionsDisplay; ?>"
     data-section-count="<?= $sectionsCount; ?>"
     data-slide-layout="<?= $template ?>"
     data-passed="<?= $isPassed ? 'true' : 'false' ?>"
     data-slide-index="<?= $slide_index ?>"
     data-latest="<?= $isLatest ?>"
     data-icon-color="<?= array_get($colors, "text", '#fff'); ?>"
     data-slide-id="<?= $id ?>"
     data-type="regular">
    <?php
    include 'slide-settings.php';
    ?>
    <?php if ($displayHeader == 'regular') :
        lms_get_template('template-parts/regular-parts/slide-header.php', ['title' => $title]);
    endif; ?>
    <?php if ($content) : ?>

        <div class="lms-grid-container lms-grid-container-<?= $template ?> lms-grid-container-<?= $sectionsCount ?> <?= $singleGridVideoClass; ?>">
            <?php
            foreach ($content as $key => $block) {
                lms_get_template('template-parts/regular-parts/grid-block.php', ['block' => $block, 'template' => $template, 'grid_length' => count($content), 'index' => $key + 1]);
            }
            ?>
        </div>
    <?php endif; ?>
</div>