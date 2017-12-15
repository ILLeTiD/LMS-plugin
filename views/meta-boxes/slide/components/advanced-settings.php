<div class="slide-content__advance-settings hidden">
    <div class="advanced-settings">
        <div class="advanced-settings__heading"><?= __('Color Theme', 'lms-plugin'); ?></div>
        <div class="advanced-settings__field">
            <select name="slide_content[<?= $i; ?>][color_theme]">
                <option value="dark"><?= __('Dark', 'lms-plugin'); ?></option>
            </select>
            <div class="advanced-settings__description">
                <?= __('Inverts the colors of the background and text.', 'lms-plugin'); ?>
            </div>
        </div>
    </div>
</div>
