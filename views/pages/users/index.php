<div class="wrap">
    <h1 class="wp-heading-inline">
        <?= __('Registration - Waiting', 'lms-plugin'); ?>
    </h1>

<!--    <a href="http://fishy-minds.test/wp-admin/user-new.php" class="page-title-action">Add New</a>-->

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

<div class="lms-delete-confirmation lms-accept-popup hidden">
    <h1><?= __('Accept Registry / Registries', 'lms-plugin'); ?></h1>
    <div>
        <select name="role">
            <option><?= __('Select Role', 'lms-plugin'); ?></option>
            <?php wp_dropdown_roles(); ?>
        </select>
    </div>
    <div class="lms-accept-popup__error"></div>
    <button type="button" class="js-delete-confirmation__yes"><?= __('Cancel', 'lms-plugin'); ?></button>
    <button type="button" class="js-delete-confirmation__no"><?= __('Accept', 'lms-plugin'); ?></button>
</div>
