<div>
    Invited: <span><?= $course->getNumberOfParticipants(); ?></span> <a href=""><?= __('View', 'lms-plugin'); ?></a>
</div>
<div>
    Enrolled: <span><?= $course->getNumberOfEnrolledParticipants(); ?></span> <a href=""><?= __('View', 'lms-plugin'); ?></a>
</div>
<div>
    Pending: <span><?= $course->getNumberOfInvitedParticipants(); ?></span> <a href=""><?= __('View', 'lms-plugin'); ?></a>
</div>

<br>

<a href="<?= admin_url('edit.php?post_type=course&page=participants&cid=' . $course->ID . '&invite'); ?>">
    + <?= __('Invite User(s)', 'lms-plugin'); ?>
</a>