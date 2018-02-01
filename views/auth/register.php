<form action="" method="POST">

    <?php include('errors.php'); ?>

    <input type="text" name="name" placeholder="<?= __('Full Name', 'lms-plugin'); ?>" required>
    <p>
    <input type="email" name="email" placeholder="<?= __('Email Address', 'lms-plugin'); ?>" required>
    <p>
    <input type="password" name="password" placeholder="<?= __('Password', 'lms-plugin'); ?>" required>
    <p>
    <button><?= __('Sign Up', 'lms-plugin'); ?></button>

</form>

