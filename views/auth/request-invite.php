<?php
include 'header-auth.php';
?>
    <form action="" method="POST">

        <?php include('errors.php'); ?>
        <p>
            <input type="text" name="email" placeholder="<?= __('Email Address', 'lms-plugin'); ?>">
        <p>
            <button><?= __('Sign Up', 'lms-plugin'); ?></button>
    </form>

<?php
include 'footer-auth.php';
