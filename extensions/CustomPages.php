<?php

namespace LmsPlugin;

use FishyMinds\WordPress\Plugin\HasPlugin;

class CustomPages
{
    use HasPlugin;

    public function addPage($slug, $title)
    {
        global $wpdb;

        if (null === $wpdb->get_row("SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = {$slug}", 'ARRAY_A')) {

            $current_user = wp_get_current_user();

            // create post object
            $page = array(
                'post_title' => __($title),
                'post_status' => 'publish',
                'post_name' => $slug,
                'post_author' => $current_user->ID,
                'post_type' => 'page',
            );

            // insert the post into the database
            wp_insert_post($page);
        }
    }

    public function addLmsPages()
    {

        //@TODO save id of custom pages to wp options to get id easy
        $this->addPage('lms-activity', 'Activity');
        $this->addPage('lms-terms', 'Terms of Service');
        $this->addPage('lms-courses', 'Courses');
        $this->addPage('lms-profile', 'Edit user profile');

    }

    public function removeLmsPages()
    {
        $activity = get_page_by_path('lms-activity');
        $terms = get_page_by_path('lms-terms');
        $courses = get_page_by_path('lms-courses');
        $profile = get_page_by_path('lms-profile');
        if ($activity) {
            wp_delete_post($activity->ID, true);
        }
        if ($terms) {
            wp_delete_post($terms->ID, true);
        }
        if ($courses) {
            wp_delete_post($courses->ID, true);
        }
        if ($profile) {
            wp_delete_post($profile->ID, true);
        }
    }
}