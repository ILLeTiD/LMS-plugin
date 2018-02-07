<?php

namespace LmsPlugin;

use FishyMinds\WordPress\Plugin\HasPlugin;

class Shortcoder
{
    use HasPlugin;

    private $data;

    public function replace($text, $data)
    {
        $this->data = $data;

        $shortcodes  = $this->findShortcodes($text);

        foreach ($shortcodes as $shortcode) {
            $text = str_replace("[{$shortcode}]", $this->getShortcodeValue($shortcode), $text);
        }

        return $text;
    }

    private function findShortcodes($text)
    {
        return preg_match_all('|\[([a-z\- ]+)\]|', $text, $matches) ? $matches[1] : [];
    }

    private function getShortcodeValue($shortcode)
    {
        switch ($shortcode) {
            case 'full-name':
                $user = array_get($this->data, 'user');

                return (isset($user->first_name) and isset($user->last_name)) ?
                       $user->first_name . ' ' . $user->last_name :
                       $user->name;
            case 'first name':
                $user = array_get($this->data, 'user');

                return isset($user->first_name) ? $user->first_name : '';
            case 'last name':
                $user = array_get($this->data, 'user');

                return isset($user->last_name) ? $user->last_name : '';
            case 'role':
                $user = array_get($this->data, 'user');

                return isset($user->role) ? $user->role : '';
            case 'course':
                $course = array_get($this->data, 'course');

                return isset($course->name) ? $course->name : '';
            default:
                $user = array_get($this->data, 'user');

                return isset($user->$shortcode) ? $user->$shortcode : '';
        }
    }
}