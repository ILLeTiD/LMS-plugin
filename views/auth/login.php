<?php
include 'header-auth.php';
?>
    <div class="auth-content">
        <div class="auth-content__intro">
            <h2 class="auth-content__title">
                <?php _e('Welcome back!', 'lms-plugin') ?>
            </h2>
            <p class="auth-content__text">
                <?php _e('Want to learn something new today?', 'lms-plugin') ?>
            </p>
        </div>

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
            <p class="auth-footer__restore-pass">
                <?php
                $url = get_site_url() . '/wp-login.php?action=lostpassword';
                $link = sprintf(wp_kses(__('<a href="%s">Forgott your password?</a>', 'lms-plugin'), array('a' => array('href' => array()))), esc_url($url));
                echo $link;
                ?>
            </p>
                <button><?= __('Login', 'lms-plugin'); ?></button>
                <?php include('errors.php'); ?>
        </form>
    </div><!-- #content -->

    <footer class="auth-footer" role="contentinfo">
        <div class="wrap">
            <div class="auth-footer__signup">
                <?php
                $url = get_site_url() . '/register';
                $link = sprintf(wp_kses(__('Don`t have an account? <a href="%s">Sign up</a>.', 'lms-plugin'), array('a' => array('href' => array()))), esc_url($url));
                echo $link;
                ?>
            </div>
        </div><!-- .wrap -->
    </footer><!-- #colophon -->
<?php
include 'footer-auth.php';
