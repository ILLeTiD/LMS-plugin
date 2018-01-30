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
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class('auth-template'); ?>>
<header id="masthead" class="auth-header" role="banner">
    <div class="wrap">
        <?php if (has_custom_logo()) : ?>
            <a href="<?= get_site_url() ?>">
                <?php the_custom_logo(); ?>
            </a>
        <?php else: ?>
            <a href="<?= get_site_url() ?>">
                <?= get_bloginfo('name') ?>
            </a>
        <?php endif; ?>
    </div>
</header><!-- #masthead -->

<div class="auth-content">
    <div class="auth-content__intro">
        <h2 class="auth-content__title">
            <?php _e('Learn something new?', 'lms-plugin') ?>
        </h2>
        <p class="auth-content__text">
            <?php _e('Register your account to access online course today', 'lms-plugin') ?>
        </p>
    </div>

