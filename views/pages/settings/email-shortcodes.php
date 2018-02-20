<div id="lms_settings_course_shortcodes_meta_box" class="postbox">
    <button type="button" class="handlediv" aria-expanded="true">
        <span class="screen-reader-text">Toggle panel: Email Shortcodes</span>
        <span class="toggle-indicator" aria-hidden="true"></span>
    </button>
    <h2 class="hndle ui-sortable-handle">
        <span><?= __('Email Shortcodes', 'lms-plugin'); ?></span>
    </h2>
    <div class="inside">
        <p>
            You are able to use shortcodes inside of the email templates.
            You are also able to use the profile fields as shortcodes.
            Use the profile slugs inside of brackets to create a shortcode,
            example: [full-name]
        </p>

        <h4>Course</h4>
        [course]

        <h4>First name of the user</h4>
        [first name]

        <h4>Last name of the user</h4>
        [last name]

        <h4>Role of the user</h4>
        [role]
    </div>
</div>

