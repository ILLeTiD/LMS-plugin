<?php

use LmsPlugin\Models\User;

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

if (!function_exists('metakey_case')) {
    /**
     * Convert a string to format which acceptable for meta key name.
     *
     * @param string $value
     *
     * @return string
     */
    function metakey_case($value)
    {
        return strtolower(str_replace(' ', '_', trim($value)));
    }
}

if (!function_exists('kebab_case')) {
    /**
     * Convert a string to kebab case.
     *
     * @param string $value
     *
     * @return string
     */
    function kebab_case($value)
    {
        return strtolower(str_replace(' ', '-', trim($value)));
    }
}

if (!function_exists('is_closure')) {
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

if ( ! function_exists('array_only')) {
    /**
     * Get a subset of the items from the given array.
     *
     * @param  array $array
     * @param  array|string $keys
     * @return array
     */
    function array_only($array, $keys)
    {
        return array_intersect_key($array, array_flip((array) $keys));
    }
}

if ( ! function_exists('array_pull')) {
    /**
     * Get a value from the array, and remove it.
     *
     * @param  array   $array
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function array_pull(&$array, $key, $default = null)
    {
        $value = get($array, $key, $default);
        forget($array, $key);
        return $value;
    }
}

if ( ! function_exists('get')) {
    /**
     * Get an item from an array using "dot" notation.
     *
     * @param  array   $array
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function get($array, $key, $default = null)
    {
        if (is_null($key)) return $array;
        if (isset($array[$key])) return $array[$key];
        foreach (explode('.', $key) as $segment)
        {
            if ( ! is_array($array) || ! array_key_exists($segment, $array))
            {
                return value($default);
            }
            $array = $array[$segment];
        }
        return $array;
    }
}

if ( ! function_exists('forget')) {
    /**
     * Remove one or many array items from a given array using "dot" notation.
     *
     * @param  array  $array
     * @param  array|string  $keys
     * @return void
     */
    function forget(&$array, $keys)
    {
        $original =& $array;
        foreach ((array) $keys as $key)
        {
            $parts = explode('.', $key);
            while (count($parts) > 1)
            {
                $part = array_shift($parts);
                if (isset($array[$part]) && is_array($array[$part]))
                {
                    $array =& $array[$part];
                }
            }
            unset($array[array_shift($parts)]);
            // clean up after each pass
            $array =& $original;
        }
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

    function component($file, $variables = [])
    {
        extract($variables);

        include __DIR__ . '/../views/' . str_replace('.', '/', $file) . '.php';
    }
}

if (!function_exists('old')) {

    function old($name, $default = null)
    {

        return array_get($_REQUEST, $name, $default);
    }
}

if (!function_exists('lms_plugin_url')) {
    /**
     * Return absolute URL to the plugin directory.
     *
     * @return string
     */
    function lms_plugin_url()
    {
        return plugin_dir_url(
            realpath(__DIR__ . '/../lms-plugin.php')
        );
    }
}

if (!function_exists('lms_plugin_dir')) {
    /**
     * Return absolute path to the plugin directory.
     *
     * @return string
     */
    function lms_plugin_dir()
    {
        return realpath(__DIR__ . '/..');
    }
}

if (!function_exists('lms_get_options')) {
    /**
     * Return option value from lms options.
     *
     * @return mixed
     */
    function lms_get_options($option)
    {
        $lms_options = get_option('lms-plugin');
        return $lms_options[$option] ? $lms_options[$option] : null;
    }
}

if ( ! function_exists('lms_user')) {
    /**
     * Return currently logged in user.
     *
     * @return \LmsPlugin\Models\User
     */
    function lms_user() {
       return new User(wp_get_current_user());
    }
}

if ( ! function_exists('lms_restart_course')) {
    /**
     * Restart a course for a specific user.
     *
     * @param $user_id
     * @param $course_id
     */
    function lms_restart_course($user_id, $course_id)
    {
        global $wpdb;

        $wpdb->delete(
            $wpdb->prefix . 'lms_activities',
            [
                'user_id' => $user_id,
                'course_id' => $course_id
            ],
            ['%d', '%d']
        );

        $wpdb->delete(
            $wpdb->prefix . 'lms_quiz_results',
            [
                'user_id' => $user_id,
                'course_id' => $course_id
            ],
            ['%d', '%d']
        );

        $wpdb->update(
            $wpdb->prefix . 'lms_enrollments',
            ['status' => 'in_progress'],
            [
                'user_id' => $user_id,
                'course_id' => $course_id
            ],
            ['%s'],
            ['%d', '%d']
        );
    }
}

if ( ! function_exists('lms_role_list')) {
    function lms_role_list($user)
    {
        $roles = wp_roles();

        $role_list = [];

        foreach ($user->roles as $role) {
            if (array_key_exists($role, $roles->role_names)) {
                $role_list[$role] = translate_user_role($roles->role_names[$role]);
            }
        }

        if (empty($role_list)) {
            $role_list['none'] = '-';
        }

        return $role_list;
    }
}
