<div class="lms-courses-list__item lms-list-course lms-courses-course"
     data-course-id="<?= $theCourse->id; ?>">

    <?php lms_get_template('courses-parts/course-item-thumbnail.php', ['theCourse' => $theCourse]); ?>
    <div class="lms-courses-course__wrapper ">
        <div class="lms-courses-course__content">
            <?php lms_get_template('courses-parts/course-item-title.php', ['theCourse' => $theCourse]); ?>
            <?php lms_get_template('courses-parts/course-item-button.php', ['theCourse' => $theCourse, 'enrollment' => $enrollment]); ?>
            <?php lms_get_template('courses-parts/course-item-description.php', ['theCourse' => $theCourse, 'courseIndex' => $courseIndex]); ?>
        </div>
        <div class="lms-courses-course__info">
            <?php lms_get_template('courses-parts/course-item-stats.php', ['theCourse' => $theCourse, 'enrollment' => $enrollment]); ?>
            <?php lms_get_template('courses-parts/course-item-progress.php', ['theCourse' => $theCourse, 'enrollment' => $enrollment, 'currentCourseNo' => $currentCourseNo, 'courseIndex' => $courseIndex]); ?>
        </div>
    </div>
</div>
