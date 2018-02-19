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
                 style="background-image: url(<?= $puzzle['image'] ?>);"
                 data-index="<?= $puzzle['index'] ?>">
                <div class="dd">
                </div>
                <!--                <img src="--><? //= $puzzle['thumbnail'] ?><!--" alt="">-->
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <button class="lms-check-puzzle lms-quiz-check-button">Check puzzle</button>
</div>