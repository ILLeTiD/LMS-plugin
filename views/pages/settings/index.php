<div class="wrap">
    <h1 class="wp-heading-inline">
        <?= __('Settings', 'lms-plugin'); ?>
    </h1>

    <form action="" method="POST">

        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-2">
                <div id="postbox-container-2" class="postbox-container">
                    <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                        <div id="lms_settings_styling_meta_box" class="postbox">
                            <button type="button" class="handlediv" aria-expanded="true">
                                <span class="screen-reader-text">Toggle panel: Progress</span>
                                <span class="toggle-indicator" aria-hidden="true"></span>
                            </button>
                            <h2 class="hndle ui-sortable-handle">
                                <span><?= __('Styling', 'lms-plugin'); ?></span>
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
                                                   value="<?= array_get($settings, 'colors.background', '#4990E2'); ?>"
                                            >
                                            <?= __('Background', 'lms-plugin'); ?>
                                        </label>

                                        <label class="lms-color-picker-wrap">
                                            <input type="color"
                                                   name="settings[colors][header]"
                                                   value="<?= array_get($settings, 'colors.header', '#F1F1F1'); ?>"
                                            >
                                            <?= __('Header', 'lms-plugin'); ?>
                                        </label>

                                        <label class="lms-color-picker-wrap">
                                            <input type="color"
                                                   name="settings[colors][text]"
                                                   value="<?= array_get($settings, 'colors.text', '#FFFFFF'); ?>"
                                            >
                                            <?= __('Text', 'lms-plugin'); ?>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="clear"></div>

        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="<?= __('Save Changes', 'lms-plugin'); ?>">
        </p>

    </form>

</div>
