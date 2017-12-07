<?php

if ( ! function_exists('studly_case'))
{
    /**
     * Convert a value to studly caps case.
     *
     * @param  string  $value
     *
     * @return string
     */
    function studly_case($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));

        return str_replace(' ', '', $value);
    }
}

if ( ! function_exists('camel_case'))
{
    /**
     * Convert a value to camel case.
     *
     * @param  string  $value
     *
     * @return string
     */
    function camel_case($value)
    {
        return lcfirst(studly_case($value));
    }
}

if ( ! function_exists('is_closure'))
{
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
