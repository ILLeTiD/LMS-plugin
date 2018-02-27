<div class="lms-popup lms-accept-popup hidden">
    <h1><?= __('Accept Registry / Registries', 'lms-plugin'); ?></h1>
    <div class="lms-accept-popup__body">
        <select name="role">
            <option><?= __('Select Role', 'lms-plugin'); ?></option>
            <?php wp_dropdown_roles(); ?>
        </select>
        <div class="lms-accept-popup__error"></div>
    </div>
    <button type="button" class="js-cancel"><?= __('Cancel', 'lms-plugin'); ?></button>
    <button type="button" class="js-accept"><?= __('Accept', 'lms-plugin'); ?></button>
</div>

<div class="lms-popup lms-deny-popup hidden">
    <h1><?= __('Deny Registry / Registries', 'lms-plugin'); ?></h1>
    <button type="button" class="js-cancel"><?= __('Cancel', 'lms-plugin'); ?></button>
    <button type="button" class="js-deny"><?= __('Deny', 'lms-plugin'); ?></button>
</div>

<div class="lms-popup lms-success-popup hidden">
    <h1 class="lms-success-popup__title"></h1>
    <button type="button" class="js-close"><?= __('Ok', 'lms-plugin'); ?></button>
</div>

<div class="lms-popup lms-invite-popup hidden">
    <h1 class="lms-invite-popup__title"><?= __('Invite users', 'lms-plugin'); ?></h1>

    <div class="lms-invite-popup__body">
        <select name="role">
            <option><?= __('Select Role', 'lms-plugin'); ?></option>
            <?php wp_dropdown_roles(); ?>
        </select>
        <div class="lms-invite-popup__help">
            <h3><?= __('Enter user email', 'lms-plugin'); ?></h3>
            <p><?= __(esc_html('Separate the invitations with comma, e.g. johndoe@email.com, janedoe@email.com. You are able to add the name of the invitee by using this format: John Doe <johndoe@email.com>. The name will appear in the invitation and prepopulate the fields for the user in the registration form', 'lms-plugin')); ?></p>
        </div>
        <textarea name="emails" rows="5"></textarea>
    </div>

    <span class="lms-invite-popup__error"></span>
    <button type="button" class="js-invite"><?= __('Invite', 'lms-plugin'); ?></button>
</div>

