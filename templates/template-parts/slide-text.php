<?php
$content = $slide->slide_content;
$title = $slide->post_title;
$sectionsCount = count($content);
?>
<div class="slide slide-regular" data-type="regular">
    <?php if ($content) : ?>
        <div class="grid-container grid-container-<?= $sectionsCount ?>">
            <?php
            foreach ($content as $block) {
                lms_get_template('template-parts/regular-parts/grid-block.php', ['block' => $block]);
            }
            ?>
        </div>
    <?php endif; ?>

</div>