<?php

namespace LmsPlugin\Course;

class Saver
{
    private $fields = [
      'course_custom_css'
    ];
    public function save($courseID)
    {
        if (get_post_type($courseID) != 'course') {
            return;
        }

        if ( ! array_key_exists('slide_weight', $_POST)) {
            return;
        }

        foreach ($_POST['slide_weight'] as $weight => $slideID) {
            update_post_meta($slideID, 'slide_weight', $weight);
        }

        foreach ($_POST['slide_index'] as $index => $slideID) {
            update_post_meta($slideID, 'slide_index', $index + 1);
        }

        foreach ($this->fields as $name) {
            //@TODO Check and made work solution for save empty
           // if (empty($_POST[$name])) continue;

            $this->saveMetaField($courseID, $name, $_POST[$name]);
        }
    }

        /**
     * Save meta field.
     *
     * @param int $slide_id
     * @param string $name
     * @param mixed $value
     *
     * @return mixed
     */
    private function saveMetaField($courseID, $name, $value)
    {
        $value = $this->filterMetaField($name, $value);

        return update_post_meta($courseID, $name, $value);
    }

    /**
     * Apply filter if exists.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    private function filterMetaField($key, $value)
    {
        $method = camel_case($key) . 'Filter';

        return method_exists($this, $method) ? $this->$method($value) : $value;
    }

    public function delete($course_id)
    {
        global $post_type, $wpdb;

        if ($post_type != 'course') return;

        $wpdb->delete(
            $wpdb->prefix . 'lms_enrollments', 
            ['course_id' => $course_id], 
            ['%d']
        );
    }
}