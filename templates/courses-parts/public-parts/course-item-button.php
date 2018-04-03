<?php
$buttonClass = '';
switch ('invited') {
    case 'in_progress':
        $buttonClass = "lms-course-continue-button";
        $buttonText = __("Continue", "lms-plugin");
        break;
    case 'completed':
        $buttonClass = "lms-course-redo-button lms-courses-course__button--hollow";
        $buttonText = __('Redo course', "lms-plugin");
        break;
    case 'enrolled':
        $buttonClass = "lms-course-start-button";
        $buttonText = __("Start course", "lms-plugin");;
        break;
    case 'invited':
        $buttonClass = 'lms-course-begin-button-public';
        $buttonText = __('Enroll to course', "lms-plugin");
        break;
}
?>
<div class="lms-courses-course__button-wrapper">
    <a class="lms-courses-course__button-link" href='<?php echo get_the_permalink() ?>'>

        <button type="button" class="lms-courses-course__button <?= $buttonClass; ?>"
                data-course-id="<?= get_the_ID(); ?>"
                data-user-id="<?= get_current_user_id() ?>"
        >
            <?php
            echo $buttonText;
            ?>
        </button>
    </a>
</div>