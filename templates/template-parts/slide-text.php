<?php
$id = $slide->ID;
$content = $slide->slide_content;
$title = $slide->post_title;
$displayHeader = $slide->slide_content_display;
$sectionsCount = count($content);
?>

<div class="slide slide-regular" data-slide-id="<?= $id ?>" data-type="regular">
    <?php if ($displayHeader == 'regular') :
        lms_get_template('template-parts/regular-parts/slide-header.php', ['title' => $title]);
    endif; ?>
    <?php if ($content) : ?>
        <div class="grid-container grid-container-<?= $sectionsCount ?>">
            <?php
            foreach ($content as $key => $block) {
                lms_get_template('template-parts/regular-parts/grid-block.php', ['block' => $block, 'index' => $key+1]);
            }
            ?>
        </div>
    <?php endif; ?>
</div>