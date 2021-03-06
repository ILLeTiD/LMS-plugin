<?php

$filter->add('custom_menu_order', '__return_true');
$filter->add('menu_order', 'DashboardMenu@changeOrder');

$filter->add('manage_course_posts_columns', function ($defaults) {
    unset($defaults['date']);
    unset($defaults['taxonomy-course_category']);
    $defaults['author'] = 'Author';
    $defaults['taxonomy-course_category'] = 'Categories';
    $defaults['participants'] = 'Participants';
    $defaults['overall_progress'] = 'Overall progress';
    $defaults['date'] = 'Date';

    return $defaults;
});

$filter->add('wp_prepare_attachment_for_js', function ($response, $attachment, $meta) {
    $size = 'slide_thumbnail';

    if (isset($meta['sizes'][$size])) {
        $attachment_url = wp_get_attachment_url($attachment->ID);
        $base_url = str_replace(wp_basename($attachment_url), '', $attachment_url);
        $size_meta = $meta['sizes'][$size];

        $response['sizes'][$size] = array(
            'height'        => $size_meta['height'],
            'width'         => $size_meta['width'],
            'url'           => $base_url . $size_meta['file'],
            'orientation'   => $size_meta['height'] > $size_meta['width'] ? 'portrait' : 'landscape',
        );
    }

    return $response;
});

$filter->add('mce_external_plugins', function ($plugins) {
    $plugins['wplms'] = $this->plugin->getUrl() . '/assets/js/shortcodes.js';

    return $plugins;
});

$filter->add('mce_buttons', function ($buttons) {
    global $post;

    if ($post && $post->post_type == 'slide') {
        array_push($buttons, 'previous_slide', 'next_slide', 'courses', 'restart');
    }

    if ($post && $post->post_type == 'course') {
        array_push($buttons, 'courses', 'restart');
    }

    return $buttons;
});

$filter->add('wp_mail_from', function ($default_email) {
    $email = $this->plugin->getSettings('register.sender.email');

    return $email ?: $default_email;
});

$filter->add('wp_mail_from_name', function ($default_name) {
    $name = $this->plugin->getSettings('register.sender.name');

    return $name ?: $default_name;
});


