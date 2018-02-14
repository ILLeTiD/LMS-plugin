<div class="wrap">
    <h1 class="wp-heading-inline">
        <?= __('Edit Field', 'lms-plugin'); ?>
    </h1>
    <hr class="wp-header-end">

    <?php component('components.messages'); ?>

    <form action="<?= admin_url('admin-ajax.php?action=update_profile_field'); ?>" method="POST">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-2">
                <div id="post-body-content">
                    <div id="titlediv">
                        <div id="titlewrap">
                            <input type="text"
                                   name="name"
                                   id="title"
                                   size="30"
                                   value="<?= array_get($field, 'name'); ?>"
                                   spellcheck="true"
                                   placeholder="<?= __('Enter name here', 'lms-plugin'); ?>"
                                   required
                            >
                        </div>
                    </div>
                </div>
                <div id="postbox-container-1" class="postbox-container">
                    <div class="lms-profile-field-actions">
                        <a href="<?= admin_url('admin-ajax.php?action=delete_profile_field&id=' . $id); ?>"
                           class="lms-profile-field-actions__delete"
                        ><?= __('Delete', 'lms-plugin'); ?></a>
                        <a href="<?= admin_url('edit.php?post_type=course&page=settings'); ?>"
                           class="lms-profile-field-actions__cancel"
                        ><?= __('Cancel', 'lms-plugin'); ?></a>
                        <button class="button button-primary"><?= __('Save', 'lms-plugin'); ?></button>
                    </div>

                    <div id="lms_profile_field_required_meta_box" class="postbox">
                        <h2 class="hndle ui-sortable-handle">
                            <span><?= __('Mandatory', 'lms-plugin'); ?></span>
                        </h2>
                        <div class="inside">
                            <select name="required">
                                <option value="0"
                                        <?= selected(array_get($field, 'required'), 0); ?>
                                >
                                    <?= __('No', 'lms-plugin'); ?>
                                </option>
                                <option value="1"
                                        <?= selected(array_get($field, 'required'), 1); ?>
                                >
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
                            <textarea name="description"
                                      class="lms-profile-field__textarea"
                                      rows="5"
                            ><?= array_get($field, 'description'); ?></textarea>
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
                                <option value="text"
                                        <?= selected(array_get($field, 'type'), 'text'); ?>
                                >
                                    <?= __('Text', 'lms-plugin'); ?>
                                </option>
                                <option value="mail"
                                        <?= selected(array_get($field, 'type'), 'mail'); ?>
                                >
                                    <?= __('Mail', 'lms-plugin'); ?>
                                </option>
                                <option value="password"
                                        <?= selected(array_get($field, 'type'), 'password'); ?>
                                >
                                    <?= __('Password', 'lms-plugin'); ?>
                                </option>
                                <option value="checkbox"
                                        <?= selected(array_get($field, 'type'), 'checkbox'); ?>
                                >
                                    <?= __('Checkbox', 'lms-plugin'); ?>
                                </option>
                                <option value="select"
                                        <?= selected(array_get($field, 'type'), 'select'); ?>
                                >
                                    <?= __('Select', 'lms-plugin'); ?>
                                </option>
                                <option value="radio"
                                        <?= selected(array_get($field, 'type'), 'radio'); ?>
                                >
                                    <?= __('Radio', 'lms-plugin'); ?>
                                </option>
                            </select>

                            <?php include('components/options.php'); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

