<?php

$puzzles = $slide->puzzle;
shuffle($puzzles);
?>

<?php if ($puzzles) : ?>
    <div class="lms-puzzles-grid">
        <?php foreach ($puzzles as $puzzle) : ?>
            <div class="lms-puzzles-grid__item">
                <img src="<?= $puzzle['thumbnail'] ?>" alt="">
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>