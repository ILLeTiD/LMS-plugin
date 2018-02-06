<div id="lms_settings_styling_meta_box" class="postbox">

    <button type="button" class="handlediv" aria-expanded="true">
        <span class="screen-reader-text">
            <?= __('Toggle panel', 'lms-plugin'); ?>: <?= __('Profile fields', 'lms-plugin'); ?></span>
        <span class="toggle-indicator" aria-hidden="true"></span>
    </button>

    <h2 class="hndle ui-sortable-handle">
        <span><?= __('Profile fields', 'lms-plugin'); ?></span>
    </h2>

    <div class="inside lms-profile-fields__container">
        <table class="wp-list-table widefat striped lms-profile-fields__table">
            <thead>
                <tr>
                    <th><?= __('Title', 'lms-plugin'); ?></th>
                    <th><?= __('Slug', 'lms-plugin'); ?></th>
                    <th><?= __('Type', 'lms-plugin'); ?></th>
                    <th><?= __('Mandatory', 'lms-plugin'); ?></th>
                    <th></th>
                    <th><?= __('Sort', 'lms-plugin'); ?></th>
                </tr>
            </thead>
            <tbody class="lms-profile-fields">
                <?php if (count($fields)): ?>
                    <?php $i = 0; ?>
                    <?php foreach($fields as $field): ?>
                        <?php include('components/field.php'); ?>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="no-items">
                        <td class="colspanchange" colspan="6">
                            <?= __('No profile fields yet.', 'lms-plugin'); ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="#"
           class="lms-profile-fields__add-button js-add-field-button">
            <?= __('+ Add field', 'lms-plugin'); ?>
        </a>

        <div class="lms-delete-confirmation hidden">
            <p><?= __('Are you sure you want to delete this profile field?', 'lms-plugin'); ?></p>
            <button type="button" class="js-delete-confirmation__yes"><?= __('Yes', 'lms-plugin'); ?></button>
            <button type="button" class="js-delete-confirmation__no"><?= __('No', 'lms-plugin'); ?></button>
        </div>

    </div>
</div>

