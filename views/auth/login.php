<?php
include 'header-auth.php';
?>
    <form action="" method="POST">


        <p>
            <input type="email"
                   name="email"
                   placeholder="<?= __('Email Address', 'lms-plugin'); ?>"
                   required
                   value="<?= array_get($_POST, 'email'); ?>"
            >
        <p>
            <input type="password" name="password" placeholder="<?= __('Password', 'lms-plugin'); ?>" required>
        <p>
            <button><?= __('Login', 'lms-plugin'); ?></button>
            <?php include('errors.php'); ?>
    </form>

<?php
include 'footer-auth.php';
