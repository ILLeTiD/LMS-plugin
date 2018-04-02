<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg auth-html">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>

    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body <?php body_class('auth-template auth'); ?>>
<header id="masthead" class="auth-header" role="banner">
    <div class="wrap">
        <?php if (has_custom_logo()) : ?>
            <a class="auth__logo" href="<?= get_site_url() ?>">
                <?php the_custom_logo(); ?>
            </a>
        <?php else: ?>
            <a class="lms-auth__logo" href="<?= get_site_url() ?>">
                <?= get_bloginfo('name') ?>
            </a>
        <?php endif; ?>
    </div>
</header><!-- #masthead -->

   
