<?php

namespace LmsPlugin\Models;

class Enrollment extends Model
{
    const TABLE = 'lms_enrollments';

    public function __construct($attributes)
    {
        $this->attributes = $attributes;

        if (array_key_exists('user_id', $this->attributes)) {
            $this->attributes['user'] = User::find($this->attributes['user_id']);
        }

        if (array_key_exists('course_id', $this->attributes)) {
            $this->attributes['course'] = Course::find($this->attributes['course_id']);
        }
    }

    public static function create($attributes = [])
    {
        $instance = new self($attributes);

        return $instance->save();
    }

    public function __get($property)
    {
        switch ($property) {
            case 'created_at':
                return date(
                    get_option('date_format'),
                    strtotime($this->attributes['created_at'])
                );
            case 'updated_at':
                return date(
                    get_option('date_format'),
                    strtotime($this->attributes['updated_at'])
                );
            case 'progress':
                return $this->computeProgress();
        }

        return parent::__get($property);
    }

    public function computeProgress()
    {
        $total = $this->course->slides()->count();

        if ( ! $total) {
            return 0;
        }

        $finished = Progress::where('user_id', $this->user->id)
                            ->where('course_id', $this->course_id)
                            ->where('name', 'finished')
                            ->count();

        return round(100 * $finished / $total);
    }

    protected function insert()
    {
        global $wpdb;

        $wpdb->insert($wpdb->prefix . self::TABLE, [
            'user_id' => $this->user->id,
            'course_id' => $this->course->id
        ]);

        $this->id = $wpdb->insert_id;

        return $this;
    }

    protected function update()
    {
        global $wpdb;

        $data = [];

        foreach ($this->attributes as $name => $value) {
            if (in_array($name, ['id', 'user', 'course', 'created_at', 'updated_at'])) continue;
            $data[$name] = $value;
        }

        $wpdb->update($wpdb->prefix . self::TABLE, $data, ['id' => $this->id]);
    }
}