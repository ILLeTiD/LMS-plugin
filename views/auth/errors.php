<?php if (isset($errors) && count($errors->get_error_messages())): ?>
    <div class="alert alert-danger" role="alert">
        <ul class="auth-error">
        <?php foreach ($errors->get_error_messages() as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

