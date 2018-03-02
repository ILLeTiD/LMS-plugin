<?php
$buttonClass = '';
switch ($enrollment->status) {
    case 'in_progress':
        $buttonClass = "lms-course-continue-button";
        break;
    case 'completed':
        $buttonClass = "lms-course-redo-button";
        break;
    case 'invited':
        $buttonClass = 'lms-course-begin-button';
        break;
}
?>
<div class="lms-courses-course__button-wrapper">
    <a class="lms-courses-course__button-link" href='<?php echo get_the_permalink($theCourse->id) ?>'>

        <button type="button" class="lms-courses-course__button <?= $buttonClass; ?>"
                data-course-id="<?= $theCourse->id; ?>"
                data-user-id="<?= get_current_user_id() ?>"
        >
            <?php
            if ($enrollment->status == 'completed') {
                _e('Redo course', "lms-plugin");
            } else if ($enrollment->status == 'invited') {
                _e("Start course", "lms-plugin");
            } else {
                _e("Continue", "lms-plugin");
            }
            ?>
        </button>
    </a>
</div>