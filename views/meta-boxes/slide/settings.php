<div style="display: flex;">
    <div style="width: 200px;">
        <?= __('Template', 'lms-plugin'); ?>
    </div>
    <div style="max-width: 250px; width: 100%;">
        <select name="lms_slide_settings_template" style="width: 100%;">
            <option value=""><?= __('Vertical Split Screen', 'lms-plugin'); ?></option>
            <option value=""><?= __('Horizontal Split Screen', 'lms-plugin'); ?></option>
            <option value=""><?= __('Centered', 'lms-plugin'); ?></option>
        </select>
    </div>
    <div>
        <span><?= __('Choose template to change layout of the slide.'); ?></span>
    </div>
</div>

<div style="display: flex;">
    <div style="width: 200px;">
        <?= __('Content Display', 'lms-plugin'); ?>
    </div>
    <div style="max-width: 250px; width: 100%;">
        <select name="lms_slide_settings_content_display" style="width: 100%;">
            <option value=""><?= __('Once at a time', 'lms-plugin'); ?></option>
        </select>
    </div>
    <div>
        <span><?= __('All content will be visible as default.'); ?></span>
    </div>
</div>
