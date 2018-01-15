<?php

namespace LmsPlugin\Models;

class Activity extends Model
{
    const TABLE = 'lms_activities';

    /**
     * Activity constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes)
    {
        $this->attributes = $attributes;

        if (array_key_exists('user_id', $this->attributes)) {
            $this->attributes['user'] = User::find($this->attributes['user_id']);
        }

        if (array_key_exists('course_id', $this->attributes)) {
            $this->attributes['course'] = Course::find($this->attributes['course_id']);
        }

        if (array_key_exists('slide_id', $this->attributes)) {
            $this->attributes['slide'] = ! is_null($this->attributes['slide_id']) ? Slide::find($this->attributes['slide_id']) : null;
        }
    }

    public function __get($property)
    {
        switch ($property) {
            case 'date':
                return date(
                    get_option('date_format'),
                    strtotime($this->attributes['date'])
                );
            case 'time':
                return date(
                    get_option('time_format'),
                    strtotime($this->attributes['date'])
                );
            default:
                return parent::__get($property);
        }
    }

}