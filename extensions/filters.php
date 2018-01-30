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

// $filter->add('query_vars', function ($query_vars) {
//     $query_vars[] = 'route';
//
//     return $query_vars;
// });

