<?php

namespace LmsPlugin\Slide;

class Saver
{
    /**
     * @var array Slide meta fields which need to be saved.
     */
    private $fields = [
        'course',
        'slide_template',
        'slide_content_display',
        'slide_section_display',
        'slide_format',
        'slide_content',
        'slide_custom_css',
        'slide_weight',
        'quiz_type',
        'quiz_tolerance',
        'quiz_hint',
        'forms_type',
        'forms_answers',
        'drag_and_drop_layout',
        'drag_and_drop_images',
        'drag_and_drop_zones',
        'puzzle'
    ];

    /**
     * Save slide meta fields.
     *
     * @param $slide_id
     *
     * @return void
     */
    public function save($slide_id)
    {
        if (get_post_type($slide_id) != 'slide') {
            return;
        }

        foreach ($this->fields as $name) {
            if (empty($_POST[$name])) continue;

            $this->saveMetaField($slide_id, $name, $_POST[$name]);
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
    private function saveMetaField($slide_id, $name, $value)
    {
        $value = $this->filterMetaField($name, $value);

        return update_post_meta($slide_id, $name, $value);
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

    /**
     * Filter slide content meta field.
     *
     * @param array $slide_content
     *
     * @return array
     */
    private function slideContentFilter($slide_content)
    {
        return array_values($slide_content);
    }
}