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
        <div class="lms-dnd-quiz-board lms-dnd-quiz-board-layout--<?= $dnd_layout; ?>">
            <div class="lms-dnd-quiz-drag ">
                <?php foreach ($dragObjects as $object): ?>
                    <div class="lms-dnd-quiz-drag__item lms-dnd-quiz-drag__item--<?= $object['type'] ?>"
                         data-real-index="<?= $object['index'] ?>"
                         data-dz="<?= $object["drop_zone"] ?>">
                        <div class="lms-dnd-quiz-drag__item-content  lms-dnd-dragula"
                            <?php if ($object['width']) : ?>
                                style="width: <?= $object['width'] ?>%"
                            <?php endif; ?>
                        >
                            <?php if ($object['type'] == 'image') : ?>
                                <img class="lms-dnd-quiz-drag__object"
                                     src="<?= $object["thumbnail"] ?>" alt=""
                                     data-real-index="<?= $object['index'] ?>"
                                     data-dz="<?= $object["drop_zone"] ?>">
                            <?php else: ?>
                                <h4 class="lms-dnd-quiz-drag__item-text lms-dnd-quiz-drag__object"
                                    data-real-index="<?= $object['index'] ?>"
                                    data-dz="<?= $object["drop_zone"] ?>">
                                    <?= $object["text"]; ?>
                                </h4>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="lms-dnd-quiz-drop">
                <?php
                $index = 1;
                foreach ($drop_zones as $key => $zone): ?>
                    <div class="lms-dnd-quiz-drop__zone-outher">
                        <div class="lms-dnd-quiz-drop__zone  lms-dnd-quiz-drop__zone--<?= $zone["type"] ?>"
                             data-dz="<?= $index; ?>"
                             style="
                             <?php if ($zone['type'] == 'image') : ?>
                                     background: url(<?= $zone["image"] ?>) 50% no-repeat;
                                     background-size: cover;
                             <?php endif; ?>
                             <?php if ($zone['width']): ?>
                                     width: <?= $zone['width'] ?>%;
                             <?php endif; ?>
                                     ">
                            <?php if ($zone['type'] == 'text') : ?>
                                <h4 class="lms-dnd-quiz-drop__zone-text">
                                    <?= $zone["text"] ?>
                                </h4>
                            <?php endif; ?>
                            <div class="lms-dnd-quiz-drop__zone-content lms-dnd-dragula ">

                            </div>
                        </div>
                    </div>
                    <?php
                    $index++;
                endforeach; ?>
            </div>
        </div>
    </section>
    <button class="lms-check lms-quiz-check-button lms-check-dnd">Check quiz</button>
</div>