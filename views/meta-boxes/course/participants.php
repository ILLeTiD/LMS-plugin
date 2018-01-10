<div>
    <?= __('Invited', 'lms-plugin'); ?>: <span><?= $course->participants()->count(); ?></span>
    <a href="<?= page_url('course.participants', ['cid' => $course->id]); ?>">
        <?= __('View', 'lms-plugin'); ?>
    </a>
</div>
<div>
    <?= __('Enrolled', 'lms-plugin'); ?>: <span><?= $course->getNumberOfEnrolledParticipants(); ?></span>
    <a href="<?= page_url('course.participants', ['cid' => $course->id, 'status' => 'enrolled']); ?>">
        <?= __('View', 'lms-plugin'); ?>
    </a>
</div>
<div>
    <?= __('Pending', 'lms-plugin'); ?>: <span><?= $course->getNumberOfInvitedParticipants(); ?></span>
    <a href="<?= page_url('course.participants', ['cid' => $course->id, 'status' => 'invited']); ?>">
        <?= __('View', 'lms-plugin'); ?>
    </a>
</div>

<br>

<a href="<?= admin_url('edit.php?post_type=course&page=course_participants&cid=' . $course->ID . '&invite'); ?>">
    + <?= __('Invite User(s)', 'lms-plugin'); ?>
</a>