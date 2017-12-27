<div>
    Invited: <span>0</span> <a href=""><?= __('View', 'lms-plugin'); ?></a>
</div>
<div>
    Enrolled: <span>0</span> <a href=""><?= __('View', 'lms-plugin'); ?></a>
</div>
<div>
    Pending: <span>0</span> <a href=""><?= __('View', 'lms-plugin'); ?></a>
</div>

<br>

<a href="<?= admin_url('edit.php#invite?post_type=course&page=participants&cid=' . $course->ID); ?>">
    + <?= __('Invite User(s)', 'lms-plugin'); ?>
</a>