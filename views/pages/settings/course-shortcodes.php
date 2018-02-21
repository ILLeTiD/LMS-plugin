<h2 class="lms-settings-section__title">
    <?= __('Reference', 'lms-plugin'); ?>
    <input type="submit" name="submit" id="submit" class="button button-primary" value="<?= __('Save', 'lms-plugin'); ?>">
</h2>

<div id="lms_settings_course_shortcodes_meta_box" class="postbox">
    <button type="button" class="handlediv" aria-expanded="true">
        <span class="screen-reader-text">Toggle panel: Course Shortcodes</span>
        <span class="toggle-indicator" aria-hidden="true"></span>
    </button>
    <h2 class="hndle ui-sortable-handle">
        <span><?= __('Course Shortcodes', 'lms-plugin'); ?></span>
    </h2>
    <div class="inside">
        <div class="lms-settings__shortcode">
            <p>
                These shortcodes are available inside of Courses. You may add them
                to the content of the Courses, in the content of the Slides (both
                regular slides and quiz), and in the content of the Sections.
            </p>

            <h4>Next Slide</h4>
            <p>
                [button action="next" value="Next Slide"]
            </p>

            <h4>Previous Slide</h4>
            <p>
                [button action="previous" value="Previous Slide"]
            </p>

            <h4>Restart Course</h4>
            <p>
                [button action="restart" value="Restart the Course"]
            </p>

            <h4>Back to Courses</h4>
            <p>
                [button action="courses" value="Back to Courses"]
            </p>
        </div>
    </div>
</div>

