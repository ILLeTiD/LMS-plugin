<?php
/*
Plugin Name: LMS Plugin
Plugin URI: https://bitbucket.org/fishyminds/wordpress-lms-plugin
Description: The plugin activates an area in the dashboard where you are able to create and edit online courses. The courses contains of a various numbers of slides. The slides contain a custom structure where you are able to add extra several rows of text and images. The plugin will also be able to handle users invites and tracking the users participating in courses.
Version: 0.36.5
Author: Fishy Minds AB
Author URI: http://fishyminds.com/
Text Domain: lms-plugin
Domain Path: /languages
*/

require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/libraries/helpers.php';
require_once __DIR__ . '/extensions/helpers.php';
require_once __DIR__ . '/frontend/frontend-functions.php';

call_user_func(function () {
    $plugin = new \FishyMinds\WordPress\Plugin\Plugin(__FILE__);
    $plugin->init();
});

