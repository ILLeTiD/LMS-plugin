<div class="row-actions">
    <span class="view">
        <a href="<?= $edit_link; ?>">
            <?= __('View', 'lms-plugin'); ?>
        </a> |
    </span>

    <?php if ($current_view == 'waiting'): ?>
        <span class="accept">
            <a href="#" class="js-accept-user" data-user="<?= $user->ID; ?>">
                <?= __('Accept', 'lms-plugin'); ?>
            </a> |
        <span class="delete">
            <a href="#" class="js-deny-user" data-user="<?= $user->ID; ?>">
                <?= __('Deny', 'lms-plugin'); ?>
            </a>
        </span>
    </span>
    <?php endif; ?>

    <?php if ($current_view == 'invited'): ?>
        <span class="accept">
            <a href="#" class="js-resend-invite" data-user="<?= $user->ID; ?>">
                <?= __('Resend invite', 'lms-plugin'); ?>
            </a> |
        <span class="delete">
            <a href="#" class="js-uninvite" data-user="<?= $user->ID; ?>">
                <?= __('Uninvite', 'lms-plugin'); ?>
            </a>
        </span>
    </span>
    <?php endif; ?>
</div>

