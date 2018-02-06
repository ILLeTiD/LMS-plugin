<?php

if (!function_exists('studly_case')) {
    /**
     * Convert a value to studly caps case.
     *
     * @param  string $value
     *
     * @return string
     */
    function studly_case($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));

        return str_replace(' ', '', $value);
    }
}

if (!function_exists('camel_case')) {
    /**
     * Convert a value to camel case.
     *
     * @param  string $value
     *
     * @return string
     */
    function camel_case($value)
    {
        return lcfirst(studly_case($value));
    }
}

if (!function_exists('snake_case')) {
    /**
     * Convert a string to snake case.
     *
     * @param  string $value
     * @param  string $delimiter
     * @return string
     */
    function snake_case($value, $delimiter = '_')
    {
        static $snakeCache = [];
        $key = $value . $delimiter;

        if (isset($snakeCache[$key])) {
            return $snakeCache[$key];
        }

        if (!ctype_lower($value)) {
            $value = strtolower(preg_replace('/(.)(?=[A-Z])/', '$1' . $delimiter, $value));
        }

        return $snakeCache[$key] = $value;
    }
}

if ( ! function_exists('metakey_case')) {
    /**
     * Convert a string to format which acceptable for meta key name.
     *
     * @param string $value
     *
     * @return string
     */
    function metakey_case($value) {
        return strtolower(str_replace(' ', '_', trim($value)));
    }
}

if ( ! function_exists('kebab_case')) {
    /**
     * Convert a string to kebab case.
     *
     * @param string $value
     *
     * @return string
     */
    function kebab_case($value) {
        return strtolower(str_replace(' ', '-', trim($value)));
    }
}

if ( ! function_exists('is_closure')) {
    /**
     * Determine whether the callback is a closure.
     *
     * @param $callback
     *
     * @return bool
     */
    function is_closure($callback)
    {
        return is_object($callback) && ($callback instanceof Closure);
    }
}

if (!function_exists('array_get')) {
    /**
     * Get an item from an array using "dot" notation.
     *
     * @param  array $array
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function array_get($array, $key, $default = null)
    {
        if (is_null($key)) return $array;

        if (isset($array[$key])) return $array[$key];

        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return value($default);
            }

            $array = $array[$segment];
        }

        return $array;
    }
}

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('d')) {
    /**
     * Dump the passed variables.
     *
     * @param  mixed $args
     * @return void
     */
    function d(...$args)
    {
        var_dump(...$args);
    }
}

if (!function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed $args
     * @return void
     */
    function dd(...$args)
    {
        d(...$args);
        exit();
    }
}

if (!function_exists('lms_invite')) {
    function lms_invite($user_id, $course_id)
    {
        return \LmsPlugin\Models\Enrollment::create($user_id, $course_id);
    }
}

if (!function_exists('set_enrollment_status')) {

    function set_enrollment_status($user_id, $course_id, $status = 'invited')
    {
        if ($status == 'uninvited') {
            delete_user_meta($user_id, 'status_' . $course_id);
            foreach (\LmsPlugin\Models\Course::statuses() as $name => $label) {
                delete_user_meta($user_id, $name . '_' . $course_id);
            }
        } else {
            update_user_meta($user_id, 'status_' . $course_id, $status);
            update_user_meta($user_id, $status . '_' . $course_id, time());
            update_user_meta($user_id, 'last_activity', time());
        }

        if ($status == 'invited') {
            lms_invite($user_id, $course_id);
        }
    }
}

if (!function_exists('page_url')) {

    function page_url($name, $parameters = [])
    {
        $parameters = http_build_query($parameters);

        switch ($name) {
            case 'course.participants':
                return 'edit.php?post_type=course&page=course_participants&' . $parameters;
            case 'course.edit':
                return admin_url("post.php?action=edit&" . $parameters);
        }
    }
}

if (!function_exists('edit_course_url')) {

    function edit_course_url($course)
    {
        if (!is_int($course)) {
            $course = $course->id;
        }

        return admin_url("post.php?post={$course}&action=edit");
    }
}

if (!function_exists('edit_slide_url')) {

    function edit_slide_url($slide)
    {
        if (!is_int($slide)) {
            $slide = $slide->id;
        }

        return admin_url("post.php?post={$slide}&action=edit");
    }
}

if (!function_exists('get_status_label')) {

    function get_status_label($name)
    {
        return \LmsPlugin\Models\Course::statuses()[$name];
    }
}

if (!function_exists('component')) {

    function component($file, $variables)
    {
        extract($variables);

        include __DIR__ . '/../views/' . str_replace('.', '/', $file) . '.php';
    }
}

if (!function_exists('lms_locate_template')) {

    function lms_locate_template($path, $var = NULL)
    {
        $lms_base = '/lms/';

        $template_lms_path = $lms_base . $path;
        $template_path = DIRECTORY_SEPARATOR . $path;
        //@TODO change to plugin path variable
        $plugin_path = plugin_dir_path(__FILE__) . '../templates' . DIRECTORY_SEPARATOR . $path;
        //    dd($plugin_path);
        // return $plugin_path;
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

    add_filter('single_template', 'lms_page_template');
}

if (!function_exists('lms_page_template')) {
    function lms_page_template($single)
    {
        global $wp_query, $post;
        //@TODO change to plugin path variable
        if ($post->post_type == 'course') {
            if (file_exists(get_template_directory() . '/templates/course-template.php')) {
                return get_template_directory() . '/templates/course-template.php';
            } elseif (__DIR__ . '/../templates/course-template.php') {
                return __DIR__ . '/../templates/course-template.php';
            }
        }
        if ($post->post_type == 'slide') {
            if (file_exists(get_template_directory() . '/templates/slide-template.php')) {
                return get_template_directory() . '/templates/course-template.php';
            } elseif (file_exists(plugin_dir_path(__FILE__) . '/templates/slide-template.php')) {
                return __DIR__ . '/../templates/course-template.php';
            }
        }
        return $single;
    }
}

if ( ! function_exists('old')) {

    function old($name, $default = null) {

        return array_get($_REQUEST, $name, $default);
    }
}



