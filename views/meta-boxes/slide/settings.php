<input type="hidden" name="slide_weight" value="<?= $weight; ?>">

<div class="field">
    <div class="field__title">
        <?= __('Template', 'lms-plugin'); ?>
    </div>

    <div class="field__value">
        <select name="slide_template">
            <?php foreach ($slideTemplateOptions as $value => $name): ?>
                    <option value="<?= $value; ?>" <?= selected($post->slide_template, $value); ?>><?= __($name, 'lms-plugin'); ?></option>
                <?php endforeach; ?>
        </select>

        <span class="field__help"><?= __('Choose template to change layout of the slide.'); ?></span>
    </div>
</div>

<div class="field">
    <div class="field__title">
        <?= __('Display Header', 'lms-plugin'); ?>
    </div>
    <div class="field__value">
        <select name="slide_content_display">
            <?php foreach ($slideDisplayHeaderOptions as $value => $name): ?>
                <option value="<?= $value; ?>" <?= selected($post->slide_content_display, $value); ?>><?= __($name, 'lms-plugin'); ?></option>
            <?php endforeach; ?>
        </select>

        <span class="field__help"><?= __('All content will be visible as default.'); ?></span>
    </div>
</div>

