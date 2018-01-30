<div id="lms_settings_styling_meta_box" class="postbox">
    <button type="button" class="handlediv" aria-expanded="true">
        <span class="screen-reader-text">Toggle panel: Registration</span>
        <span class="toggle-indicator" aria-hidden="true"></span>
    </button>
    <h2 class="hndle ui-sortable-handle">
                <span><?= __('Registration', 'lms-plugin'); ?></span>
    </h2>
    <div class="inside">

        <!-- Membership -->
        <div class="row">
            <div class="col-2">
                <h4 class="field__title">
                    <?= __('Membership', 'lms-plugin'); ?>
                </h4>
            </div>
            <div class="col-3">
                <label>
                    <input type="checkbox"
                           name="membership"
                           <?= checked($membership); ?>
                    >
                    <?= __('Any one can register', 'lms-plugin'); ?>
                </label>
            </div>
        </div>

        <!-- User Restriction -->
        <div class="row">
            <div class="col-2">
                <h4 class="field__title">
                    <?= __('User Restriction', 'lms-plugin'); ?>
                </h4>
            </div>
            <div class="col-3">
                <label class="lms-color-picker-wrap">
                    <input type="text"
                           name="settings[register][restriction]"
                           value="<?= array_get($settings, 'register.restriction'); ?>"
                    >
                </label>
            </div>
            <div class="col-4">
                <span>
                    <?= __('Only enable users with email URL to register and participate in courses.', 'lms-plugin'); ?>
                </span>
            </div>
        </div>

        <!-- Support -->
        <div class="row">
            <div class="col-2">
                <h4 class="field__title">
                    <?= __('Support', 'lms-plugin'); ?>
                </h4>
            </div>
            <div class="col-3">
                <select name="settings[register][support]">
                    <option value=""><?= __('Nobody', 'lms-plugin'); ?></option>
                </select>
            </div>
            <div class="col-4">
                <span>
                    <?= __('The person that will receive an email when an user is requesting registration or reaching out for support.', 'lms-plugin'); ?>
                </span>
            </div>
        </div>

    </div>
</div>

