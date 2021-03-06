<h2 class="lms-settings-section__title">
    <?= __('User settings', 'lms-plugin'); ?>
</h2>

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

        <!-- Membership Moderation -->
        <div class="row">
            <div class="col-2">
                <h4 class="field__title">
                    <?= __('Account moderation', 'lms-plugin'); ?>
                </h4>
            </div>
            <div class="col-3">
                <label>
                    <input type="checkbox"
                           name="settings[account_moderation]"
                           <?= checked(array_get($settings, 'account_moderation')); ?>
                           value="1"
                    >
                    <?= __('Admin moderates accounts.', 'lms-plugin'); ?>
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
                <div class="lms-form-input-domain">
                    <input type="text"
                           name="settings[register][restriction]"
                           value="<?= array_get($settings, 'register.restriction'); ?>"
                    >
                </div>
            </div>
            <div class="col-4">
                <p class="lms-form-text">
                    <?= __('Only enable users with email URL to register and participate in courses.', 'lms-plugin'); ?>
                </p>
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
                    <?php foreach ($support->results as $admin): ?>
                        <option value="<?= $admin->ID; ?>"
                                <?= selected($admin->ID, $settings['register']['support']); ?>
                        >
                            <?= $admin->display_name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-4">
                <p class="lms-form-text">
                    <?= __('The person that will receive an email when an user is requesting registration or reaching out for support.', 'lms-plugin'); ?>
                </p>
            </div>
        </div>

        <!-- Default Role -->
        <div class="row">
            <div class="col-2">
                <h4 class="field__title">
                    <?= __('Default Role', 'lms-plugin'); ?>
                </h4>
            </div>
            <div class="col-3">
                <select name="settings[register][default_role]">
                    <?= lms_dropdown_roles(array_get($settings, 'register.default_role', 'subscriber'), ['administrator']); ?>
                </select>
            </div>
            <div class="col-4">
                <p class="lms-form-text">
                    <?= __('Default role which will be assigned to newly created users.', 'lms-plugin'); ?>
                </p>
            </div>
        </div>

        <!-- Sender -->
        <div class="row">
            <div class="col-2">
                <h4 class="field__title">
                    <?= __('Email Sender', 'lms-plugin'); ?>
                </h4>
            </div>
            <div class="col-3">
                <div class="lms-form-input-sender">
                    <input type="text"
                        name="settings[register][sender][name]"
                        value="<?= array_get($settings, 'register.sender.name') ?: lms_sender_name(); ?>">
                    <input type="text"
                        name="settings[register][sender][email]"
                        value="<?= array_get($settings, 'register.sender.email') ?: lms_sender_email(); ?>">
                </div>
            </div>
            <div class="col-4">
                <p class="lms-form-text">
                    <?= __('Name and email to send email from.', 'lms-plugin'); ?>
                </p>
            </div>
        </div>

    </div>
</div>

