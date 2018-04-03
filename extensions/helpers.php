<?php

if (!function_exists('lms_course_edit_link')) {

    /**
     * Returns link to a course edit page.
     * 
     * @param \LmsPlugin\Models\Course $course
     * 
     * @return string
     */
    function lms_course_edit_link($course)
    {
        return '<a href="' . lms_course_edit_url($course) . '">' . $course->name . '</a>';
    }
}

if (!function_exists('lms_course_edit_url')) {

    /**
     * Returns URL to a course edit page.
     * 
     * @param int|\LmsPlugin\Models\Course $course
     * 
     * @return string
     */
    function lms_course_edit_url($course)
    {
        if (!is_int($course)) {
            $course = $course->id;
        }

        return admin_url("post.php?post={$course}&action=edit");
    }
}

if (!function_exists('lms_sender_email')) {
    function lms_sender_email()
    {
        // Get the site domain and get rid of www.
        $sitename = strtolower( $_SERVER['SERVER_NAME'] );
        if ( substr( $sitename, 0, 4 ) == 'www.' ) {
            $sitename = substr( $sitename, 4 );
        }
 
        return 'wordpress@' . $sitename;
    }
}

if (!function_exists('lms_sender_name')) {
    function lms_sender_name()
    {
        return 'WordPress';
    }
}