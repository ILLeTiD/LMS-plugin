<h2 class="lms-settings-section__title">
    <?= __('Notifications', 'lms-plugin'); ?>
</h2>

<div id="lms_settings_email_templates_meta_box" class="postbox lms-settings-email-templates">
    <div class="accordion-container">
        <div class="accordion-section open">
            <h4 class="accordion-section-title">
                <?= __('Quiz - Success', 'lms-plugin'); ?>
            </h4>
            <div class="accordion-section-content">
                <input type="text" name="settings[notifications][quiz_success][title]" class="lms-settings-notification__title" value="<?= array_get($settings, 'notifications.quiz_success.title'); ?>"
                    placeholder="<?= __('Title', 'lms-plugin'); ?>">
                <input type="text" name="settings[notifications][quiz_success][message]" value="<?= array_get($settings, 'notifications.quiz_success.message'); ?>"
                    placeholder="<?= __('Message', 'lms-plugin'); ?>">
            </div>
        </div>

        <div class="accordion-section">
            <h4 class="accordion-section-title">
                <?= __('Form Quiz - Fail', 'lms-plugin'); ?>
            </h4>
            <div class="accordion-section-content">
                <input type="text" name="settings[notifications][forms_quiz_fail][title]" class="lms-settings-notification__title" 
                value="<?= array_get($settings, 'notifications.forms_quiz_fail.title'); ?>"
                    placeholder="<?= __('Title', 'lms-plugin'); ?>">
                <input type="text" name="settings[notifications][forms_quiz_fail][message]" 
                value="<?= array_get($settings, 'notifications.forms_quiz_fail.message'); ?>"
                    placeholder="<?= __('Message', 'lms-plugin'); ?>">
            </div>
        </div>
        <div class="accordion-section">
            <h4 class="accordion-section-title">
                <?= __('Form Quiz - Unanswered', 'lms-plugin'); ?>
            </h4>
            <div class="accordion-section-content">
                <input type="text" name="settings[notifications][forms_quiz_unanswered][title]" 
                class="lms-settings-notification__title" 
                value="<?= array_get($settings, 'notifications.forms_quiz_unanswered.title'); ?>"
                    placeholder="<?= __('Title', 'lms-plugin'); ?>">
                <input type="text" name="settings[notifications][forms_quiz_unanswered][message]" 
                value="<?= array_get($settings, 'notifications.forms_quiz_unanswered.message'); ?>"
                    placeholder="<?= __('Message', 'lms-plugin'); ?>">
            </div>
        </div>

        <div class="accordion-section">
            <h4 class="accordion-section-title">
                <?= __('Puzzle Quiz - Fail', 'lms-plugin'); ?>
            </h4>
            <div class="accordion-section-content">
                <input type="text" name="settings[notifications][puzzle_quiz_fail][title]" class="lms-settings-notification__title" 
                value="<?= array_get($settings, 'notifications.puzzle_quiz_fail.title'); ?>"
                    placeholder="<?= __('Title', 'lms-plugin'); ?>">
                <input type="text" name="settings[notifications][puzzle_quiz_fail][message]" 
                value="<?= array_get($settings, 'notifications.puzzle_quiz_fail.message'); ?>"
                    placeholder="<?= __('Message', 'lms-plugin'); ?>">
            </div>
        </div>
        <div class="accordion-section">
            <h4 class="accordion-section-title">
                <?= __('Puzzle Quiz - Unanswered', 'lms-plugin'); ?>
            </h4>
            <div class="accordion-section-content">
                <input type="text" name="settings[notifications][puzzle_quiz_unanswered][title]" 
                class="lms-settings-notification__title" 
                value="<?= array_get($settings, 'notifications.puzzle_quiz_unanswered.title'); ?>"
                    placeholder="<?= __('Title', 'lms-plugin'); ?>">
                <input type="text" name="settings[notifications][puzzle_quiz_unanswered][message]" 
                value="<?= array_get($settings, 'notifications.puzzle_quiz_unanswered.message'); ?>"
                    placeholder="<?= __('Message', 'lms-plugin'); ?>">
            </div>
        </div>

        <div class="accordion-section">
            <h4 class="accordion-section-title">
                <?= __('DRAG-AND-DROP Quiz - Fail', 'lms-plugin'); ?>
            </h4>
            <div class="accordion-section-content">
                <input type="text" name="settings[notifications][drag_and_drop_quiz_fail][title]" class="lms-settings-notification__title" 
                value="<?= array_get($settings, 'notifications.drag_and_drop_quiz_fail.title'); ?>"
                    placeholder="<?= __('Title', 'lms-plugin'); ?>">
                <input type="text" name="settings[notifications][drag_and_drop_quiz_fail][message]" 
                value="<?= array_get($settings, 'notifications.drag_and_drop_quiz_fail.message'); ?>"
                    placeholder="<?= __('Message', 'lms-plugin'); ?>">
            </div>
        </div>
        <div class="accordion-section">
            <h4 class="accordion-section-title">
                <?= __('DRAG-AND-DROP Quiz - Unanswered', 'lms-plugin'); ?>
            </h4>
            <div class="accordion-section-content">
                <input type="text" name="settings[notifications][drag_and_drop_quiz_unanswered][title]" 
                class="lms-settings-notification__title" 
                value="<?= array_get($settings, 'notifications.drag_and_drop_quiz_unanswered.title'); ?>"
                    placeholder="<?= __('Title', 'lms-plugin'); ?>">
                <input type="text" name="settings[notifications][drag_and_drop_quiz_unanswered][message]" 
                value="<?= array_get($settings, 'notifications.drag_and_drop_quiz_unanswered.message'); ?>"
                    placeholder="<?= __('Message', 'lms-plugin'); ?>">
            </div>
        </div>





        <div class="accordion-section">
            <h4 class="accordion-section-title">
                <?= __('Quiz - Fail', 'lms-plugin'); ?>
            </h4>
            <div class="accordion-section-content">
                <input type="text" name="settings[notifications][quiz_fail][title]" class="lms-settings-notification__title" value="<?= array_get($settings, 'notifications.quiz_fail.title'); ?>"
                    placeholder="<?= __('Title', 'lms-plugin'); ?>">
                <input type="text" name="settings[notifications][quiz_fail][message]" value="<?= array_get($settings, 'notifications.quiz_fail.message'); ?>"
                    placeholder="<?= __('Message', 'lms-plugin'); ?>">
            </div>
        </div>
        <div class="accordion-section">
            <h4 class="accordion-section-title">
                <?= __('Quiz - Unanswered', 'lms-plugin'); ?>
            </h4>
            <div class="accordion-section-content">
                <input type="text" name="settings[notifications][quiz_unanswered][title]" class="lms-settings-notification__title" value="<?= array_get($settings, 'notifications.quiz_unanswered.title'); ?>"
                    placeholder="<?= __('Title', 'lms-plugin'); ?>">
                <input type="text" name="settings[notifications][quiz_unanswered][message]" value="<?= array_get($settings, 'notifications.quiz_unanswered.message'); ?>"
                    placeholder="<?= __('Message', 'lms-plugin'); ?>">
            </div>
        </div>
        <div class="accordion-section">
            <h4 class="accordion-section-title">
                <?= __('Error', 'lms-plugin'); ?>
            </h4>
            <div class="accordion-section-content">
                <input type="text" name="settings[notifications][error][title]" class="lms-settings-notification__title" value="<?= array_get($settings, 'notifications.error.title'); ?>"
                    placeholder="<?= __('Title', 'lms-plugin'); ?>">
                <input type="text" name="settings[notifications][error][message]" value="<?= array_get($settings, 'notifications.error.message'); ?>"
                    placeholder="<?= __('Message', 'lms-plugin'); ?>">
            </div>
        </div>
    </div>
</div>