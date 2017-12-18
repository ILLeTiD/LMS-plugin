<div class="field">
    <div class="field__title">
        <?= __('Type', 'lms-plugin'); ?>
    </div>
    <div class="field__value">
        <select name="quiz_tolerance">
            <?php foreach ($formsTypeOptions as $type => $name): ?>
                <option value="<?= $type; ?>" <?= selected($post->forms_type, $type); ?>><?= __($name, 'lms-plugin'); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<?php for ($i = 0; $i < 3; $i++): ?>
    <div class="field">
        <div class="field__title">
            <?= __('Answer' . ($i + 1), 'lms-plugin'); ?>
        </div>
        <div class="field__value">
            <input type="text" name="slide_forms_answers[<?= $i; ?>][text]" value="<?= $post->forms_answers[$i]['text']; ?>">
            <input type="checkbox" name="slide_forms_answers[<?= $i; ?>][correct]" <?= checked($post->forms_answers[$i]['correct']); ?>>
        </div>
    </div>
<?php endfor; ?>