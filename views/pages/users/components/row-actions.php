<div class="row-actions">
    <span class="view">
        <a href="<?= $edit_link; ?>">
            <?= __('View', 'lms-plugin'); ?>
        </a> |
    </span>

    <?php if ($current_view == 'waiting'): ?>
        <span class="accept">
            <a href="#" class="js-accept-user">
                <?= __('Accept', 'lms-plugin'); ?>
            </a> |
        <span class="delete">
            <a href="#" class="js-deny-user">
                <?= __('Deny', 'lms-plugin'); ?>
            </a>
        </span>
    </span>
    <?php endif; ?>
</div>

