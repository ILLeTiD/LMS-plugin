<?php


add_action('wp_enqueue_scripts', 'my_scripts_method');
function my_scripts_method()
{
//    wp_deregister_script('jquery');
//    wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', false, '2.1.4');
//    wp_enqueue_script('jquery');
    $alertMessages = lms_get_options('notifications');
    wp_enqueue_script('lms-frontend', plugin_dir_url(__FILE__) . '/assets/js/main.min.js', array('jquery'), null, true);
    wp_localize_script('lms-frontend', 'lmsAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'coursesLink' => get_post_type_archive_link( 'course' ),
        'notificationMessages' => $alertMessages
));
    wp_enqueue_style('lms-css', plugin_dir_url(__FILE__) . '/assets/css/style.min.css', array(), '', 'all');

}


function base_plugin_dir_url()
{
    $url = plugins_url() . '/lms-plugin';
    return $url;
}


if (!function_exists('lms_locate_template')) {

    function lms_locate_template($path, $var = NULL)
    {
        $lms_base = '/lms/';

        $template_lms_path = $lms_base . $path;
        $template_path = DIRECTORY_SEPARATOR . $path;

        $plugin_path = lms_plugin_dir() . '/templates' . DIRECTORY_SEPARATOR . $path;

        $located = locate_template(array(
            $template_lms_path, // Search in <theme>/lms/
            $template_path,             // Search in <theme>/
        ));

        if (!$located && file_exists($plugin_path)) {
            return apply_filters('lms_locate_template', $plugin_path, $path);
        }

        return apply_filters('lms_locate_template', $located, $path);
    }
}

if (!function_exists('lms_get_template')) {
    function lms_get_template($path, $var = null, $return = false)
    {
        $located = lms_locate_template($path, $var);

        //   return $located;
        if ($var && is_array($var)) {
            extract($var);
        }

        if ($return) {
            ob_start();
        }

        // include file located
        include($located);

        if ($return) {
            return ob_get_clean();
        }
    }
}

if (!function_exists('lms_page_template')) {
    function lms_page_template($single)
    {
        global $wp_query, $post;
        //@TODO change to plugin path variable
        if ($post->post_type == 'course') {
            if (file_exists(get_template_directory() . '/templates/course-template.php')) {
                return get_template_directory() . '/templates/course-template.php';
            } elseif (lms_plugin_dir() . '/templates/course-template.php') {
                return lms_plugin_dir() . '/templates/course-template.php';
            }
        }

        if ($post->post_type == 'slide') {
            if (file_exists(get_template_directory() . '/templates/slide-template.php')) {
                return get_template_directory() . '/templates/course-template.php';
            } elseif (file_exists(plugin_dir_path(__FILE__) . '/templates/slide-template.php')) {
                return lms_plugin_dir() . '/templates/course-template.php';
            }
        }
        return $single;
    }

    add_filter('single_template', 'lms_page_template');
}