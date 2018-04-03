<div class="lms-courses-course__stats">
    <div class="lms-courses-course__activity">

    </div>
    <div class="lms-courses-course__participants">
        <!-- Display the number of participants -->
        <p><?php _e('Participants:', 'lms-plugin') ?> <span class="lms-courses-course__participants-num"><?php
                echo \LmsPlugin\Models\Enrollment::where(['course_id' => get_the_id()])->get()->count();
                ?></span></p>
    </div>
</div>