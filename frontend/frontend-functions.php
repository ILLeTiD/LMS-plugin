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


function custom_add_menu_meta_box($object)
{
    add_meta_box('custom-menu-metabox', __('Lms login buttons'), 'custom_menu_meta_box', 'nav-menus', 'side', 'default');
    return $object;
}

add_filter('nav_menu_meta_box_object', 'custom_add_menu_meta_box', 10, 1);
/**
 * Displays a metabox for authors menu item.
 *
 * @global int|string $nav_menu_selected_id (id, name or slug) of the currently-selected menu
 *
 * @link https://core.trac.wordpress.org/browser/tags/4.5/src/wp-admin/includes/nav-menu.php
 * @link https://core.trac.wordpress.org/browser/tags/4.5/src/wp-admin/includes/class-walker-nav-menu-edit.php
 * @link https://core.trac.wordpress.org/browser/tags/4.5/src/wp-admin/includes/class-walker-nav-menu-checklist.php
 */


function custom_menu_meta_box()
{
    global $nav_menu_selected_id;
    $walker = new Walker_Nav_Menu_Checklist();

    $current_tab = 'all';
    $login = new stdClass();
    $signIn = new stdClass();
    $logout = new stdClass();

    $logout->url = wp_logout_url();
    $logout->title = 'Logout';
    $logout->post_title = 'lms-logout-button';
    $logout->type = 'custom';
    $logout->object = 'lmsNavCustom';
    $logout->classes = array('lms-menu-item-logout-button');

    $login->url = get_bloginfo('url') . '/login';
    $login->title = 'Login';
    $login->post_title = 'lms-login-button';
    $login->type = 'custom';
    $login->object = 'lmsNavCustom';
    $login->classes = array('lms-menu-item-login-button');

    $signIn->url = get_bloginfo('url') . '/register';
    $signIn->title = 'Sign In';
    $signIn->post_title = 'lms-signin-button';
    $signIn->type = 'custom';
    $signIn->object = 'lmsNavCustom';
    $signIn->classes = array('lms-menu-item-signin-button');

    $buttons = [$login, $signIn, $logout];
    foreach ($buttons as &$button) {
        //   $button->classes = array('lms-login-button');
        $button->object_id = uniqid();
        $button->object = 'lmsNavButton';
        $button->attr_title = 'button';
    }
    $removed_args = array('action', 'customlink-tab', 'edit-menu-item', 'menu-item', 'page-tab', '_wpnonce');
    ?>
    <div id="authorarchive" class="categorydiv">
        <ul id="authorarchive-tabs" class="authorarchive-tabs add-menu-item-tabs">
            <li <?php echo('all' == $current_tab ? ' class="tabs"' : ''); ?>>
                <a class="nav-tab-link" data-type="tabs-panel-authorarchive-all"
                   href="<?php if ($nav_menu_selected_id) echo esc_url(add_query_arg('authorarchive-tab', 'all', remove_query_arg($removed_args))); ?>#tabs-panel-authorarchive-all">
                    <?php _e('View All'); ?>
                </a>
            </li><!-- /.tabs -->
        </ul>

        <div id="tabs-panel-authorarchive-all"
             class="tabs-panel tabs-panel-view-all <?php echo('all' == $current_tab ? 'tabs-panel-active' : 'tabs-panel-inactive'); ?>">
            <ul id="authorarchive-checklist-all" class="categorychecklist form-no-clear">
                <li> <?php _e('Lms login buttons. Login/Signin appeared only for non-logged users. Logout only for logged-in users.', 'lms-plugin'); ?></li>
                <?php
                echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $buttons), 0, (object)array('walker' => $walker));
                ?>
            </ul>
        </div><!-- /.tabs-panel -->


        <p class="button-controls wp-clearfix">
			<span class="list-controls">
				<a href="<?php echo esc_url(add_query_arg(array('authorarchive-tab' => 'all', 'selectall' => 1,), remove_query_arg($removed_args))); ?>#authorarchive"
                   class="select-all"><?php _e('Select All'); ?></a>
			</span>
            <span class="add-to-menu">
				<input type="submit"<?php wp_nav_menu_disabled_check($nav_menu_selected_id); ?>
                       class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e('Add to Menu'); ?>"
                       name="add-authorarchive-menu-item" id="submit-authorarchive"/>
				<span class="spinner"></span>
			</span>
        </p>

    </div><!-- /.categorydiv -->
    <?php
}

add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects($items, $args)
{
    foreach ($items as $key => &$item) {

        if (in_array('lms-menu-item-login-button', array_values($item->classes)) || in_array('lms-menu-item-signin-button', array_values($item->classes))) {

            if (is_user_logged_in()) {
                unset($items[$key]);
            }
        }

        if (in_array('lms-menu-item-logout-button', array_values($item->classes))) {
            if (!is_user_logged_in()) {
                unset($items[$key]);
            }
        }
    }
    return $items;
}


