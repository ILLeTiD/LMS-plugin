<div class="lms-field">
    <div class="lms-field__title">
        <?= __('Visibility', 'lms-plugin'); ?>
    </div>

    <div class="lms-field__value">
        <select name="course_visibility">
            <?php foreach ($visibilityOptions as $value => $name): ?>
                <option value="<?= $value; ?>" <?= selected($course->course_visibility, $value); ?>><?= $name; ?></option>
            <?php endforeach; ?>
        </select>

        <span class="field__help"><?= __('Choose how course will be accessed.'); ?></span>
    </div>
</div>