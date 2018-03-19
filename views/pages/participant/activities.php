<div class="wrap">
    <h1 class="wp-heading-inline">
        <?= $user->name . __('\'s', 'lms-plugin'); ?>
        <?= __('Courses', 'lms-plugin'); ?>:
    </h1>

    <a href="<?= admin_url('user-edit.php?user_id=' . $user->ID); ?>"
       class="page-title-action"
    >
        <?= __('Edit User', 'lms-plugin'); ?>
    </a>

    <hr class="wp-header-end">

    <?php component('components.activities-table', [
        'activities' => $user->activities,
    ]); ?>

</div>
