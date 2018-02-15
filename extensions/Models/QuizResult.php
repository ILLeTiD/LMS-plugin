<?php

namespace LmsPlugin\Models;

class QuizResult extends Model
{
    const TABLE = 'lms_quiz_results';

    private $fillable = ['user_id', 'course_id', 'slide_id', 'results'];

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
            $this->attributes['slide'] =  Slide::find($this->attributes['slide_id']);
        }
    }

    public function update()
    {
        global $wpdb;

        $values = [];
        $formats = [];

        foreach ($this->fillable as $name) {
            if ($value = array_get($this->attributes, $name)) {
                $values[$name] = is_array($value) ? serialize($value) : $value;
                $formats[] = is_int($value) ? '%d' : '%s';
            }
        }

        $wpdb->update($wpdb->prefix . self::TABLE, $values, ['id' => $this->id], $formats, ['%d']);
    }

    public function insert()
    {
        global $wpdb;

        $values = [];
        $formats = [];

        foreach ($this->fillable as $name) {
            if ($value = array_get($this->attributes, $name)) {
                $values[$name] = is_array($value) ? serialize($value) : $value;
                $formats[] = is_int($value) ? '%d' : '%s';
            }
        }

        $wpdb->insert($wpdb->prefix . self::TABLE, $values, $formats);

        $this->id = $wpdb->insert_id;

        return $this;
    }
}