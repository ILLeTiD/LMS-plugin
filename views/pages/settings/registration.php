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

        <div class="row">
            <div class="col-2">
                <h4 class="field__title">
                    <?= __('Custom fields', 'lms-plugin'); ?>
                </h4>
            </div>
            <div class="col-10">
                <div class="lms-profile-fields">
                    <?php if (count($fields)): ?>
                        <?php $i = 0; ?>
                        <?php foreach($fields as $field): ?>
                            <?php include('components/field.php'); ?>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <a href="#"
                   class="js-add-field-button">
                    <?= __('Add field', 'lms-plugin'); ?>
                </a>

                <div class="lms-delete-confirmation hidden">
                    <p><?= __('Are you sure you want to delete this profile field?', 'lms-plugin'); ?></p>
                    <button type="button" class="js-delete-confirmation__yes"><?= __('Yes', 'lms-plugin'); ?></button>
                    <button type="button" class="js-delete-confirmation__no"><?= __('No', 'lms-plugin'); ?></button>
                </div>
            </div>
        </div>

    </div>
</div>

