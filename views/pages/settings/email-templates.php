<h2 class="lms-settings-section__title">
    <?= __('Email Templates', 'lms-plugin'); ?>
</h2>

<div id="lms_settings_email_templates_meta_box" class="postbox lms-settings-email-templates">
    <div class="accordion-container">
        <div class="accordion-section open">
            <h4 class="accordion-section-title"><?= __('Registration successful', 'lms-plugin'); ?></h4>
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
