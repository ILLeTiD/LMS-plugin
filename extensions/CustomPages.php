<?php

namespace LmsPlugin;

use FishyMinds\WordPress\Plugin\HasPlugin;

class CustomPages
{
    use HasPlugin;


    public function addActivity()
    {
        global $wpdb;

        if (null === $wpdb->get_row("SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'new-page-slug'", 'ARRAY_A')) {

            $current_user = wp_get_current_user();

            // create post object
            $page = array(
                'post_title' => __('Lms Activity'),
                'post_status' => 'publish',
                'post_author' => $current_user->ID,
                'post_type' => 'page',
            );

            // insert the post into the database
            wp_insert_post($page);
        }
    }

    public function removeActivity()
    {
        $page = get_page_by_path('lms-activity');
        if ($page) {
            wp_delete_post($page->ID);
        }
    }
}