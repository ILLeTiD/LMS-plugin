<?php


add_action('wp_enqueue_scripts', 'my_scripts_method');
function my_scripts_method()
{
    wp_enqueue_script('lms-frontend', plugin_dir_url(__FILE__) . '/assets/js/main.min.js', null, null, true);
    wp_localize_script('lms-frontend', 'lmsAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
    wp_enqueue_style('lms-css', plugin_dir_url(__FILE__) . '/assets/css/style.min.css', array(), '', 'all');

}

function replace_jquery()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', false, '2.1.4');
        wp_enqueue_script('jquery');
    }
}

add_action('init', 'replace_jquery');

function base_plugin_dir_url()
{
    $url = plugins_url() . '/lms-plugin';
    return $url;
}