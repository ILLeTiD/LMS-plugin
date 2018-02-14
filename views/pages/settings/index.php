<div class="wrap">
    <h1 class="wp-heading-inline">
        <?= __('Settings', 'lms-plugin'); ?>
    </h1>

    <?php if (isset($messages['success'])): ?>
        <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible">
            <p><strong><?= $messages['success']; ?></strong></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this notice.</span>
            </button>
        </div>
    <?php endif; ?>

    <form action="<?= admin_url('admin-ajax.php?action=save_settings'); ?>" method="POST" class="lms-form">

        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-2">
                <div id="postbox-container-2" class="postbox-container">
                    <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                        <?php include('styling.php'); ?>

                        <?php include('registration.php'); ?>

                        <?php include('profile-fields.php'); ?>

                        <?php include('email-templates.php'); ?>
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
