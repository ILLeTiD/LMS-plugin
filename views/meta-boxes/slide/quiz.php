<div class="field">
    <div class="field__title">
        <?= __('Type', 'lms-plugin'); ?>
    </div>

    <div class="field__value">
        <select name="quiz_type">
            <?php foreach ($quizTypeOptions as $type => $name): ?>
                <option value="<?= $type; ?>" <?= selected($post->quiz_type, $type); ?>><?= __($name, 'lms-plugin'); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="field">
    <div class="field__title">
        <?= __('Tolerance', 'lms-plugin'); ?>
    </div>

    <div class="field__value">
        <select name="quiz_tolerance">
            <?php foreach ($quizToleranceOptions as $type => $name): ?>
                <option value="<?= $type; ?>" <?= selected($post->quiz_tolerance, $type); ?>><?= __($name, 'lms-plugin'); ?></option>
            <?php endforeach; ?>
        </select>

        <span class="field__help">
            <?= __('If strict is set all the answers has to be answered correctly, if flexible is set at least on answer has to be correct and if loose is set any choice will pass.', 'lms-plugin'); ?>
        </span>
    </div>
</div>

<div class="field">
    <div class="field__title">
        <?= __('Hint', 'lms-plugin'); ?>
    </div>

    <div class="field__value">
        <input type="text" name="quiz_hint" value="<?= $post->quiz_hint; ?>">
    </div>
</div>
