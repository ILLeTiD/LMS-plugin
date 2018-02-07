<?php

$puzzles = $slide->puzzle;
array_walk($puzzles, function (&$item, $key) {
    $item['index'] = $key;
});
shuffle($puzzles);
?>

<?php if ($puzzles) : ?>
    <div class="lms-puzzles-grid">
        <?php foreach ($puzzles as $puzzle) : ?>
            <div class="lms-puzzles-grid__item" data-index="<?= $puzzle['index'] ?>">
                <img src="<?= $puzzle['thumbnail'] ?>" alt="">
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<button class="check-puzzle">Check puzzle</button>
