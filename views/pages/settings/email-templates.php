<h2 class="lms-settings-section__title">
    <?= __('Email Templates', 'lms-plugin'); ?>
</h2>

<p class="lms-settings-section__help">
    <?= __('You are able to use shortcodes inside of the email templates. Available shortcodes are'); ?>:
    <br>
    [course] [first name] [last name] [role]
</p>

<p class="lms-settings-section__help">
    <?= __('You are also able to use the profile fields as shortcodes. Use the profile slugs inside of brackets to create a shortcode, example: [full-name]'); ?>
</p>

<div id="lms_settings_email_templates_meta_box" class="postbox lms-settings-email-templates">
    <div class="accordion-container">
        <div class="accordion-section open">
            <h4 class="accordion-section-title"><?= __('Welcome', 'lms-plugin'); ?></h4>
            <div class="accordion-section-content">
                <?php component('components.email-template', ['settings' => $settings, 'name' => 'welcome']); ?>
            </div>
        </div>
        <div class="accordion-section">
            <h4 class="accordion-section-title"><?= __('LMS Invitation', 'lms-plugin'); ?></h4>
            <div class="accordion-section-content">
                <?php component('components.email-template', ['settings' => $settings, 'name' => 'lms_invitations']); ?>
            </div>
        </div>
        <div class="accordion-section">
            <h4 class="accordion-section-title"><?= __('Course Invitation', 'lms-plugin'); ?></h4>
            <div class="accordion-section-content">
                <?php component('components.email-template', ['settings' => $settings, 'name' => 'course_invitations']); ?>
            </div>
        </div>
        <div class="accordion-section">
            <h4 class="accordion-section-title"><?= __('Forgot Password', 'lms-plugin'); ?></h4>
            <div class="accordion-section-content">
                <?php component('components.email-template', ['settings' => $settings, 'name' => 'reset_password']); ?>
            </div>
        </div>
    </div>
</div>
