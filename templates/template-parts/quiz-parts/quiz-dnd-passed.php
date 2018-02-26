<?php
$dnd_layout = $slide->drag_and_drop_layout ? $slide->drag_and_drop_layout : null;
$images = $slide->drag_and_drop_images ? $slide->drag_and_drop_images : null;

$drop_zones = $slide->drag_and_drop['drop_zones'] ? $slide->drag_and_drop['drop_zones'] : null;
$dragObjects = $slide->drag_and_drop['objects'] ? $slide->drag_and_drop['objects'] : null;
array_walk($dragObjects, function (&$item, $key) {
    $item['index'] = $key;
});

if (!$passed) {
    shuffle($dragObjects);
}
?>
<div class="lms-quiz__wrapper">
    <section class="lms-dnd-quiz">
        <div class="board board-layout-<?= $dnd_layout; ?>">
            <div class="board-column initial">
                <div class="board-column-content">
                    <?php foreach ($dragObjects as $object): ?>

                    <?php endforeach; ?>
                </div>
            </div>
            <?php
            $index = 1;
            foreach ($drop_zones as $key => $zone): ?>
                <div class="board-column done">
                    <?php if ($zone['type'] == 'text') : ?>
                        <h4 class="board-content__text">
                            <?= $zone["text"] ?>
                        </h4>
                    <?php endif; ?>
                    <div class="board-column-content">
                        <?php if ($zone['type'] == 'image') : ?>
                            <div class="board-column-content-placeholder">
                                <img src="<?= $zone["image"] ?>"
                                     style="width:<?= $zone["width"] ? $zone["width"] . '%' : ''; ?>;"
                                     alt="">
                            </div>
                        <?php endif; ?>
                        <div class="board-item"
                             data-real-index="<?= $dragObjects[$index - 1]['index'] ?>"
                             data-dz="<?= $dragObjects[$index - 1]["drop_zone"] ?>">
                            <div class="board-item-content drag">
                                 <?php if ($dragObjects[$index - 1]['type'] == 'image') : ?>
                                    <img src="<?= $dragObjects[$index - 1]["image"] ?>"
                                         style="width:<?= $dragObjects[$index - 1]["width"] ? $dragObjects[$index - 1]["width"] . '%' : ''; ?>;">
                                 <?php else: ?>
                                    <h4 class="board-content__text"
                                        style="width:<?= $dragObjects[$index - 1]["width"] ? $dragObjects[$index - 1]["width"] . '%' : ''; ?>;">
                                    <?= $dragObjects[$index - 1]["text"]; ?>
                                    </h4>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $index++;
            endforeach; ?>
        </div>
    </section>
    <button class="lms-check lms-quiz-check-button lms-check-dnd">Check quiz</button>
</div>