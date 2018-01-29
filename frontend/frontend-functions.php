<?php


add_action('wp_enqueue_scripts', 'my_scripts_method');
function my_scripts_method()
{
    wp_enqueue_script('lms-frontend', plugin_dir_url(__FILE__) . '/assets/js/main.min.js', null, null, true);
    wp_enqueue_style('lms-css', plugin_dir_url(__FILE__) . '/assets/css/style.min.css', array(), '', 'all');

}