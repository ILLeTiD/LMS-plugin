<div class="field">
    <div class="field__title">
        <?= __('Type', 'lms-plugin'); ?>
    </div>
    <div class="field__value lms-forms-select">
        <select name="forms_type">
            <?php foreach ($formsTypeOptions as $type => $name): ?>
                <option value="<?= $type; ?>" <?= selected($post->forms_type, $type); ?>><?= __($name, 'lms-plugin'); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="field__title lms-checkbox-question">
        <?= __('Correct?', 'lms-plugin'); ?>
    </div>
</div>

<?php for ($i = 0; $i < 3; $i++): ?>
    <div class="field lms-forms-input-wrap">
        <div class="field__title">
            <?= __('Answer ' . ($i + 1), 'lms-plugin'); ?>
        </div>
        <div class="field__value">
            <input type="text" name="forms_answers[<?= $i; ?>][text]" value="<?= isset($formsAnswers[$i]) ? $formsAnswers[$i]['text'] : ''; ?>">
            <input type="checkbox" name="forms_answers[<?= $i; ?>][correct]" <?= isset($formsAnswers[$i]) ? checked($formsAnswers[$i]['correct'], 'on') : ''; ?>>
        </div>
    </div>
<?php endfor; ?>