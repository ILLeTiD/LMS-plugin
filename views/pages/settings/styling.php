<h2 class="lms-settings-section__title">
    <?= __('Styling', 'lms-plugin'); ?>
</h2>

<div id="lms_settings_styling_meta_box" class="postbox">
    <button type="button" class="handlediv" aria-expanded="true">
        <span class="screen-reader-text">Toggle panel: Styling</span>
        <span class="toggle-indicator" aria-hidden="true"></span>
    </button>
    <h2 class="hndle ui-sortable-handle">
        <span><?= __('Colors', 'lms-plugin'); ?></span>
    </h2>
    <div class="inside">

        <div class="row">
            <div class="col-2">
                <h4 class="field__title">
                    <?= __('Default colors', 'lms-plugin'); ?>
                </h4>
            </div>
            <div class="col-10">
                <label class="lms-color-picker-wrap">
                    <input type="color"
                           name="settings[colors][background]"
                           value="<?= array_get($settings, 'colors.background', '#fff'); ?>"
                    >
                    <?= __('Background', 'lms-plugin'); ?>
                </label>

                <label class="lms-color-picker-wrap">
                    <input type="color"
                           name="settings[colors][text]"
                           value="<?= array_get($settings, 'colors.text', '#000'); ?>"
                    >
                    <?= __('Text', 'lms-plugin'); ?>
                </label>

                <label class="lms-color-picker-wrap">
                    <input type="color"
                           name="settings[colors][header_background]"
                           value="<?= array_get($settings, 'colors.header_background', '#fff'); ?>"
                    >
                    <?= __('Header Background', 'lms-plugin'); ?>
                </label>

                <label class="lms-color-picker-wrap">
                    <input type="color"
                           name="settings[colors][header]"
                           value="<?= array_get($settings, 'colors.header', '#000'); ?>"
                    >
                    <?= __('Header', 'lms-plugin'); ?>
                </label>

            </div>
        </div>

    </div>
</div>

