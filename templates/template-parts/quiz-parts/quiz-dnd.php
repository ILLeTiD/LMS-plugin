<?php
$dnd_layout = $slide->drag_and_drop_layout;
$images = $slide->drag_and_drop_images;
$drop_zones = $slide->drag_and_drop_zones;
array_walk($images, function (&$item, $key) {
    $item['index'] = $key;
});

?>

<div class="lms-quiz__wrapper">
    <section class="lms-dnd-quiz">
        <div class="board board-layout-<?= $dnd_layout; ?>">
            <div class="board-column initial">
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
                    <h3>zone <?= $index; ?></h3>
                    <!--                    <img src="--><?//= $zone['thumbnail'] ?><!--" alt="">-->
                    <div class="board-column-content">

                    </div>
                </div>
                <?php
                $index++;
            endforeach; ?>
        </div>

    </section>
    <button class="lms-check-dnd">Check quiz</button>
</div>