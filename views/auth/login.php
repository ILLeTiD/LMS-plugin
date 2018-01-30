<form action="" method="POST">

    <?php include('errors.php'); ?>

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

</form>

