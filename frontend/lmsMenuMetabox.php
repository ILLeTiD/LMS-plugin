<?php
function custom_add_menu_meta_box($object)
{
    add_meta_box('custom-menu-metabox', __('Lms plugin buttons'), 'custom_menu_meta_box', 'nav-menus', 'side', 'default');
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

    $current_tab = 'all';
    $login = new stdClass();
    $signIn = new stdClass();
    $logout = new stdClass();
    $profile = new stdClass();
    $activity = new stdClass();

    $logout->url = wp_logout_url();
    $logout->title = 'Logout';
    $logout->post_title = 'lms-logout-button';
    $logout->type = 'custom';
    $logout->object = 'lmsNavCustom';
    $logout->classes = array('lms-menu-item-logout-button', 'lms-button-show-when-logged');


    $profile->url = get_permalink(get_page_by_title('Edit user profile'));
    $profile->title = 'My Account';
    $profile->post_title = 'lms-profile-button';
    $profile->type = 'custom';
    $profile->object = 'lmsNavCustom';
    $profile->classes = array('lms-menu-item-profile-button', 'lms-button-show-when-logged');


    $activity->url = get_permalink(get_page_by_title('Activity'));
    $activity->title = 'Activity';
    $activity->post_title = 'lms-activity-button';
    $activity->type = 'custom';
    $activity->object = 'lmsNavCustom';
    $activity->classes = array('lms-menu-item-activity-button', 'lms-button-show-when-logged');

    $login->url = get_bloginfo('url') . '/login';
    $login->title = 'Login';
    $login->post_title = 'lms-login-button';
    $login->type = 'custom';
    $login->object = 'lmsNavCustom';
    $login->classes = array('lms-menu-item-login-button', 'lms-button-show-when-unlogged');

    $signIn->url = get_bloginfo('url') . '/register';
    $signIn->title = 'Sign In';
    $signIn->post_title = 'lms-signin-button';
    $signIn->type = 'custom';
    $signIn->object = 'lmsNavCustom';
    $signIn->classes = array('lms-menu-item-signin-button', 'lms-button-show-when-unlogged');

    $buttons = [$login, $signIn, $logout, $profile, $activity];
    foreach ($buttons as &$button) {
        $button->object_id = uniqid();
        $button->db_id = 0;
        $button->menu_item_parent = 0;
        $button->target = '';
        $button->xfn = '';
        $button->object = 'lmsNavButton';
        $button->attr_title = 'button';
        $button->type_label = 'Lms Plugin';
    }
    $db_fields = false;
// If your links will be hieararchical, adjust the $db_fields array bellow
    if (false) {
        $db_fields = array('parent' => 'parent', 'id' => 'post_parent');
    }
    $walker = new Walker_Nav_Menu_Checklist($db_fields);

    $removed_args = array(
        'action',
        'customlink-tab',
        'edit-menu-item',
        'menu-item',
        'page-tab',
        '_wpnonce',
    );
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

        if (in_array('lms-button-show-when-unlogged', array_values($item->classes))) {

            if (is_user_logged_in()) {
                unset($items[$key]);
            }
        }

        if (in_array('lms-button-show-when-logged', array_values($item->classes))) {
            if (!is_user_logged_in()) {
                unset($items[$key]);
            }
        }
    }
    return $items;
}
