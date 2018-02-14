<?php
$messages = array_pull($_SESSION, 'messages');
?>

<?php if (isset($messages['success'])): ?>
    <div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible">
        <p><strong><?= $messages['success']; ?></strong></p>
        <button type="button" class="notice-dismiss">
            <span class="screen-reader-text"><?= __('Dismiss this notice.', 'lms-plugin'); ?></span>
        </button>
    </div>
<?php endif; ?>
