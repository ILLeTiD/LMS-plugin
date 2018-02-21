<div class="wrap">
    <h1 class="wp-heading-inline">
        <?= __('Settings', 'lms-plugin'); ?>
    </h1>

    <?php component('components.messages'); ?>

    <form action="<?= admin_url('admin-ajax.php?action=save_settings'); ?>" method="POST" class="lms-form">

        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-2">
                <div id="postbox-container-1" class="postbox-container">
                    <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                        <?php include('course-shortcodes.php'); ?>

                        <?php include('email-shortcodes.php'); ?>
                    </div>
                </div>

                <div id="postbox-container-2" class="postbox-container">
                    <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                        <?php include('styling.php'); ?>

                        <?php include('registration.php'); ?>

                        <?php include('profile-fields.php'); ?>

                        <?php include('email-templates.php'); ?>

                        <?php include('notifications.php'); ?>
                    </div>
                </div>

            </div>
        </div>

        <div class="clear"></div>

        <div class="lms-align-right">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="<?= __('Save', 'lms-plugin'); ?>">
        </div>

    </form>

</div>
