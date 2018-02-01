<?php
include 'header-auth.php';
?>
    <div class="auth-content">
        <div class="auth-content__intro">
            <h2 class="auth-content__title">
                <?php _e('Learn something new?', 'lms-plugin') ?>
            </h2>
            <p class="auth-content__text">
                <?php _e('Register your account to access online course today', 'lms-plugin') ?>
            </p>
        </div>

        <form action="" method="POST">
            <p>
                <input type="text" name="name" placeholder="<?= __('Full Name', 'lms-plugin'); ?>" required>
            <p>
                <input type="email" name="email" placeholder="<?= __('Email Address', 'lms-plugin'); ?>" required>
            <p>
                <input type="password" name="password" placeholder="<?= __('Password', 'lms-plugin'); ?>" required>
            <p>
                <button><?= __('Sign Up', 'lms-plugin'); ?></button>

        </form>
    </div><!-- #content -->

    <footer class="auth-footer" role="contentinfo">
        <div class="wrap">
            <p class="auth-footer__terms">
                <?php
                $url = get_site_url() . '/terms';
                $link = sprintf(wp_kses(__('By creating account, your agree to our <a href="%s">Terms</a>.', 'lms-plugin'), array('a' => array('href' => array()))), esc_url($url));
                echo $link;
                ?>
            </p>
            <div class="auth-footer__signin">
                <?php
                $url = get_site_url() . '/login';
                $link = sprintf(wp_kses(__('Already have an account? <a href="%s">Sign in</a>.', 'lms-plugin'), array('a' => array('href' => array()))), esc_url($url));
                echo $link;
                ?>
            </div>
        </div><!-- .wrap -->
    </footer><!-- #colophon -->
<?php
include 'footer-auth.php';
