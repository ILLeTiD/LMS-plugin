<div class="wrap">
    <h1 class="wp-heading-inline">
        <?= __('Add New Field', 'lms-plugin'); ?>
    </h1>
    <hr class="wp-header-end">

    <form action="<?= admin_url('edit.php?post_type=course&page=profile_field.edit'); ?>" method="POST">
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-2">
                <div id="post-body-content">
                    <div id="titlediv">
                        <div id="titlewrap">
                            <input type="text"
                                   name="name"
                                   id="title"
                                   size="30"
                                   value=""
                                   spellcheck="true"
                                   placeholder="<?= __('Enter name here', 'lms-plugin'); ?>"
                            >
                        </div>
                    </div>
                </div>
                <div id="postbox-container-1" class="postbox-container">
                    <div class="lms-profile-field-actions">
                        <a href="#" class="lms-profile-field-actions__delete"><?= __('Delete', 'lms-plugin'); ?></a>
                        <a href="#" class="lms-profile-field-actions__cancel"><?= __('Cancel', 'lms-plugin'); ?></a>
                        <button class="button button-primary"><?= __('Save', 'lms-plugin'); ?></button>
                    </div>

                    <div id="lms_profile_field_required_meta_box" class="postbox">
                        <h2 class="hndle ui-sortable-handle">
                            <span><?= __('Mandatory', 'lms-plugin'); ?></span>
                        </h2>
                        <div class="inside">
                            <select name="required">
                                <option value="0">
                                    <?= __('No', 'lms-plugin'); ?>
                                </option>
                                <option value="1">
                                    <?= __('Yes', 'lms-plugin'); ?>
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="postbox-container-2" class="postbox-container">
                    <div id="lms_profile_field_description_meta_box" class="postbox">
                        <h2 class="hndle ui-sortable-handle">
                            <span><?= __('Description', 'lms-plugin'); ?></span>
                        </h2>
                        <div class="inside">
                            <textarea name="description" class="lms-profile-field__textarea" rows="5"></textarea>
                        </div>
                    </div>

                    <div id="lms_profile_field_type_meta_box" class="postbox">
                        <h2 class="hndle ui-sortable-handle">
                            <span><?= __('Type', 'lms-plugin'); ?></span>
                        </h2>
                        <div class="inside">
                            <select name="type"
                                    class="js-change-field-type"
                            >
                                <option value="text" >
                                    <?= __('Text', 'lms-plugin'); ?>
                                </option>
                                <option value="mail">
                                    <?= __('Mail', 'lms-plugin'); ?>
                                </option>
                                <option value="password">
                                    <?= __('Password', 'lms-plugin'); ?>
                                </option>
                                <option value="checkbox">
                                    <?= __('Checkbox', 'lms-plugin'); ?>
                                </option>
                                <option value="select">
                                    <?= __('Select', 'lms-plugin'); ?>
                                </option>
                                <option value="radio">
                                    <?= __('Radio', 'lms-plugin'); ?>
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

