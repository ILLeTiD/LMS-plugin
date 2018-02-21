<?php

$puzzles = $slide->puzzle;
array_walk($puzzles, function (&$item, $key) {
    $item['index'] = $key;
});
shuffle($puzzles);
?>

<?php if ($puzzles) : ?>
<div class="lms-quiz__wrapper">
    <div class="lms-quiz-puzzle lms-puzzles-grid">
        <?php foreach ($puzzles as $puzzle) : ?>
            <div class="lms-puzzles-grid__item"
                 data-index="<?= $puzzle['index'] ?>">
                <img class="lms-puzzles-grid__item-image"
                    <?= $puzzle['width'] ? 'style=" width:' . $puzzle['width'] . '%;"' : ''; ?>
                     src="<?= $puzzle['image'] ?>" alt="">
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <button class="lms-check lms-check-puzzle lms-quiz-check-button">Check puzzle</button>
</div>