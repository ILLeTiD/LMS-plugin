<?php if (isset($errors) && count($errors->get_error_messages())): ?>
    <ul>
    <?php foreach ($errors->get_error_messages() as $error): ?>
        <li><?= $error; ?></li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>

