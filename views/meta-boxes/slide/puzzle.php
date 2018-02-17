<!-- Pieces -->
<div class="lms-field">
    <div class="lms-field__title">
        <?= __('Pieces', 'lms-plugin'); ?>
    </div>
    <div class="lms-field__value">
        <select name="quiz_tolerance" class="lms-quiz-tolerance">
            <option value="6"><?= __('6 pieces', 'lms-plugin'); ?></option>
        </select>
    </div>
</div>

<div class="lms-puzzle-wrap">
    <?php for ($i = 0; $i < 6; $i++): ?>
        <div class="lms-puzzle-piece">
            <span><?= __('Piece ' . ($i + 1), 'lms-plugin'); ?></span>

            <?php component('components.image', [
                'name' => "puzzle[{$i}]",
                'image' => array_get($puzzle, "{$i}.image"),
                'thumbnail' => array_get($puzzle, "{$i}.thumbnail")
            ]); ?>

            <input type="text"
                   name="puzzle[<?= $i; ?>][width]"
                   value="<?= array_get($puzzle, "{$i}.width"); ?>"
                   placeholder="<?= __('Width (px or %)', 'lms-plugin'); ?>"
            >
        </div>
    <?php endfor; ?>
</div>
