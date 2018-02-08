<?php
$dnd_layout = $slide->drag_and_drop_layout;
$images = $slide->drag_and_drop_images;
$drop_zones = $slide->drag_and_drop_zones;
array_walk($images, function (&$item, $key) {
    $item['index'] = $key;
});
//d($drop_zones);
?>
<div class="quiz__wrapper">
    <section class="dnd-quiz">
        <div class="board board-layout-<?= $dnd_layout; ?>">
            <div class="board-column initial">
                <div class="board-column-header">Images To Drag</div>
                <div class="board-column-content">
                    <?php foreach ($images as $image): ?>
                        <div class="board-item"
                             data-real-index="<?= $image['index'] ?>"
                             data-dz="<?= $image["drop_zone"] ?>">
                            <div class="board-item-content">
                                <img src="<?= $image["thumbnail"] ?>" alt="">
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
            <?php
            $index = 1;
            foreach ($drop_zones as $zone): ?>
                <div class="board-column done">
                    <div class="board-column-header">Zone <?= $index ?></div>
                    <div class="board-column-content">
                        <!--                    <img src="--><?//= $zone['image'] ?><!--" alt="">-->
                    </div>
                </div>
                <?php
                $index++;
            endforeach; ?>
        </div>

    </section>
    <button class="check-dnd">Check quiz</button>
</div>