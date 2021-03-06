<?php

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

add_action('admin_init', 'blockusers_init');
function blockusers_init()
{
    if (is_admin() && !current_user_can('administrator') &&
        !(defined('DOING_AJAX') && DOING_AJAX)
    ) {
        wp_redirect(home_url());
        exit;
    }
}

add_action('wp_enqueue_scripts', 'my_scripts_method');


function my_scripts_method()
{
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', false, '2.1.4');
    wp_enqueue_script('parsleyjs', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js', array('jquery'), null);
    wp_enqueue_script('jquery');
    $alertMessages = lms_get_options('notifications');

    $variablesToFront = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'homeUrl' => get_bloginfo('url'),
        'userID' => get_current_user_id(),
        'timeFormat' => get_option('date_format'),
        'coursesLink' => get_post_type_archive_link('course'),
        'notificationMessages' => $alertMessages
    );
    if (is_page('lms-activity')) {
        wp_enqueue_script('lms-frontend-activity', plugin_dir_url(__FILE__) . '/assets/js/activity.min.js', array('jquery'), null, true);
        wp_localize_script('lms-frontend-activity', 'lmsAjax', $variablesToFront);
    } else {
        wp_enqueue_script('lms-frontend', plugin_dir_url(__FILE__) . '/assets/js/main.min.js', array('jquery'), null, true);
        wp_localize_script('lms-frontend', 'lmsAjax', $variablesToFront);
    }
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

if (!function_exists('lms_override_page_template')) {
    add_filter('template_include', 'lms_override_page_template', 99);

    function lms_override_page_template($template)
    {

        if (is_page('lms-activity')) {
            $new_template = lms_locate_template('activity.php');
            if ('' != $new_template) {
                return $new_template;
            }
        }
        if (is_singular('slide')) {
            $new_template = lms_locate_template('slide-single.php');
            if ('' != $new_template) {
                return $new_template;
            }
        }
        return $template;
    }
}
if (!function_exists('lms_page_template')) {
    function lms_page_template($single)
    {
        global $wp_query, $post;
        if (get_page_template_slug($post->ID) == 'activities') {

        }
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
if (!function_exists('lms_get_archive_template')) {
    function lms_get_archive_template($archive_template)
    {
        global $post;

        if (is_post_type_archive('course')) {
            if (file_exists(get_template_directory() . '/templates/archive-course.php')) {
                return get_template_directory() . '/templates/archive-course.php';
            } elseif (lms_plugin_dir() . '/templates/archive-course.php') {
                return lms_plugin_dir() . '/templates/archive-course.php';
            }
        }
        return $archive_template;
    }

    add_filter('archive_template', 'lms_get_archive_template');
}

add_action('customize_register', 'lms_customize_register');

function lms_customize_register($wp_customize)
{

    // Add: Drop Down Pages
    $wp_customize->add_setting('lms_courses_page_id', array(
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('lms_courses_page_id', array(
        'label' => esc_html__('Courses Page', 'lms-plugin'),
        'description' => esc_html__('You must have to define it if you want to set your Courses as your homepage.', 'lms-plugin'),
        'section' => 'title_tagline',
        'type' => 'dropdown-pages',
    ));
}

if (get_option('page_on_front') == get_theme_mod('lms_courses_page_id')) {

    add_action("pre_get_posts", "lms_assign_courses_page");

    function lms_assign_courses_page($wp_query)
    {
        //Ensure this filter isn't applied to the admin area
        if (is_admin()) {
            return;
        }

        if ($wp_query->get('page_id') == get_option('page_on_front')):

            $wp_query->set('post_type', 'course');
            $wp_query->set('page_id', ''); //Empty

            //Set properties that describe the page to reflect that
            //we aren't really displaying a static page
            $wp_query->is_page = 0;
            $wp_query->is_singular = 0;
            $wp_query->is_post_type_archive = 1;
            $wp_query->is_archive = 1;

        endif;
    }
}


require_once 'lmsMenuMetabox.php';