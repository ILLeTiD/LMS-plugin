<?php
include 'header-auth.php';
?>
    <div class="auth-content">
        <div class="auth-content__intro">
            <h2 class="auth-content__title">
                <?php _e('Forgot password?', 'lms-plugin') ?>
            </h2>
            <p class="auth-content__text">
                <?php _e('No worries. We got you covered. Type your email address below and we send you a reset link.', 'lms-plugin') ?>
            </p>
        </div>
        <form action="" method="POST">

            <?php include('errors.php'); ?>
            <p>
                <input type="text"
                       name="email"
                       placeholder="<?= __('Email Address', 'lms-plugin'); ?>"
                       value="<?= old('email'); ?>"
                >
            <p>
                <button><?= __('Reset password', 'lms-plugin'); ?></button>
        </form>

    </div><!-- #content -->
<?php
include 'footer-auth.php';
