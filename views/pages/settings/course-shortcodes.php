<div id="lms_settings_course_shortcodes_meta_box" class="postbox">
    <button type="button" class="handlediv" aria-expanded="true">
        <span class="screen-reader-text">Toggle panel: Course Shortcodes</span>
        <span class="toggle-indicator" aria-hidden="true"></span>
    </button>
    <h2 class="hndle ui-sortable-handle">
        <span><?= __('Course Shortcodes', 'lms-plugin'); ?></span>
    </h2>
    <div class="inside">
        <p>
            These shortcodes are available inside of Courses. You may add them
            to the content of the Courses, in the content of the Slides (both
            regular slides and quiz), and in the content of the Sections.
        </p>

        <h4>Next Slide</h4>
        [button action="next" value="Next Slide"]

        <h4>Previous Slide</h4>
        [button action="previous" value="Previous Slide"]

        <h4>Restart Course</h4>
        [button action="restart" value="Restart the Course"]

        <h4>Back to Courses</h4>
        [button action="courses" value="Back to Courses"]
    </div>
</div>

