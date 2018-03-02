
<div class="lms-courses-course__stats">
    <div class="lms-courses-course__activity">
        <!-- Display the last activity -->
        <p><?php _e('Last activity:', 'lms-plugin') ?> <span data-timestamp="<?= $enrollment->raw_updated_at ?>" class="lms-date"><?php
                echo $enrollment->updated_at;
                ?></span></p>
    </div>
    <div class="lms-courses-course__participants">
        <!-- Display the number of participants -->
        <p><?php _e('Participants:', 'lms-plugin') ?> <span class="lms-courses-course__participants-num"><?php
                echo $theCourse->enrollments()->count();
                ?></span></p>
    </div>
</div>