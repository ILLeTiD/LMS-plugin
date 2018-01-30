<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

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

<?php wp_footer(); ?>

</body>
</html>
