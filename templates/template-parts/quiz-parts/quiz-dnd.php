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
                        <div class="board-item"
                             data-real-index="<?= $object['index'] ?>"
                             data-dz="<?= $object["drop_zone"] ?>">
                            <div class="board-item-content">
                                <?php if ($object['type'] == 'image') : ?>
                                    <img src="<?= $object["thumbnail"] ?>" alt="">
                                <?php else: ?>
                                    <h4 class="board-content__text">
                                        <?= $object["text"]; ?>
                                    </h4>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
            $index = 1;
            foreach ($drop_zones as $key => $zone): ?>
                <div class="board-column">
                    <?php if ($zone['type'] == 'text') : ?>
                        <h4 class="board-content__text">
                            <?= $zone["text"] ?>
                        </h4>
                    <?php endif; ?>
                    <div class="board-column-content">
                        <?php if ($zone['type'] == 'image') : ?>
                            <div class="board-column-content-placeholder">
                                <img src="<?= $zone["image"] ?>" alt="">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                $index++;
            endforeach; ?>
        </div>
    </section>
    <button class="lms-check lms-quiz-check-button lms-check-dnd">Check quiz</button>
</div>