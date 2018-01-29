<form action="" method="POST">
    <?php if (isset($errors) && count($errors->get_error_messages())): ?>
        <ul>
        <?php foreach ($errors->get_error_messages() as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <input type="text" name="email" placeholder="<?= __('Email Address', 'lms-plugin'); ?>">
    <p>
    <button><?= __('Sign Up', 'lms-plugin'); ?></button>
</form>

