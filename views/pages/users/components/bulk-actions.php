<div class="alignleft actions bulkactions">
    <label for="bulk-action-selector-top" class="screen-reader-text"><?= __('Select bulk action', 'lms-plugin'); ?></label>
    <select name="bulk_action">
        <option value=""><?= __('Bulk Actions', 'lms-plugin'); ?></option>

        <?php if ($current_view == 'waiting'): ?>
            <option value="accept"
                    data-url="<?= admin_url('/admin-ajax.php?action=accept_user'); ?>"
                    data-confirm-message="<?= __('Are you sure you want to accept registration for %d users?', 'lms-plugin'); ?>"
            ><?= __('Accept', 'lms-plugin'); ?></option>
            <option value="deny"
                    data-url="<?= admin_url('/admin-ajax.php?action=deny_user'); ?>"
                    data-confirm-message="<?= __('Are you sure you want to deny registration for %d users?', 'lms-plugin'); ?>"
            ><?= __('Deny', 'lms-plugin'); ?></option>
        <?php endif; ?>

        <?php if ($current_view == 'invited'): ?>
            <option value="resendInvite"
                    data-url="<?= admin_url('/admin-ajax.php?action=resend_user_invite'); ?>"
                    data-confirm-message="<?= __('Are you sure you want to resend invite for %d users?', 'lms-plugin'); ?>"
            ><?= __('Resend invite', 'lms-plugin'); ?></option>
            <option value="uninvite"
                    data-url="<?= admin_url('/admin-ajax.php?action=uninvite_user'); ?>"
                    data-confirm-message="<?= __('Are you sure you want to uninvite %d users?', 'lms-plugin'); ?>"
            ><?= __('Uninvite', 'lms-plugin'); ?></option>
        <?php endif; ?>

        <?php if ($current_view == 'suspended'): ?>
            <option value="invite"
                    data-url="<?= admin_url('/admin-ajax.php?action=resend_user_invite'); ?>"
                    data-confirm-message="<?= __('Are you sure you want to invite %d users?', 'lms-plugin'); ?>"
            ><?= __('Invite', 'lms-plugin'); ?></option>
            <option value="delete"
                    data-url="<?= admin_url('/admin-ajax.php?action=delete_user'); ?>"
                    data-confirm-message="<?= __('Are you sure you want to delete %d users?', 'lms-plugin'); ?>"
            ><?= __('Delete', 'lms-plugin'); ?></option>
        <?php endif; ?>

    </select>
    <button class="button js-bulk-action"
            data-url="<?= admin_url('/admin-ajax.php?action=users_bulk_action'); ?>"
    ><?= __('Apply', 'lms-plugin'); ?></button>
</div>

