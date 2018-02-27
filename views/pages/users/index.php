<div class="wrap">
    <h1 class="wp-heading-inline">
        <?= __('Registration - Waiting', 'lms-plugin'); ?>
    </h1>

    <?php if ($current_view == 'invited'): ?>
        <a href="#"
           class="page-title-action js-invite-user"
        ><?= __('Invite User(s)', 'lms-plugin'); ?></a>
    <?php endif; ?>

    <hr class="wp-header-end">

    <?php include ('components/views.php'); ?>

    <form method="GET">

<!--        <input type="hidden" id="_wpnonce" name="_wpnonce" value="4fd804b008">-->
<!--        <input type="hidden" name="_wp_http_referer" value="/wp-admin/users.php">-->
        <input type="hidden" name="page" value="users">
        <input type="hidden" name="view" value="<?= $current_view; ?>">

        <?php include ('components/search.php'); ?>

        <div class="tablenav top">
            <?php include ('components/bulk-actions.php'); ?>
            <?php include ('components/filter.php'); ?>

            <?php $pagination->display(); ?>

            <br class="clear">
        </div>

        <h2 class="screen-reader-text"><?= __('Users list', 'lms-plugin'); ?></h2>

        <?php include('components/table.php'); ?>

        <div class="tablenav bottom">
            <?php include ('components/bulk-actions.php'); ?>
            <?php include ('components/filter.php'); ?>

            <?php $pagination->display('bottom'); ?>

            <br class="clear">
        </div>
    </form>

    <br class="clear">

</div>

<?php include ('components/popups.php'); ?>

