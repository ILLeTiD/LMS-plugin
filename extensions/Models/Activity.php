<?php

namespace LmsPlugin\Models;

class Activity
{
    private $id;
    private $user;
    private $course;
    private $slide;
    private $name;
    private $description;
    private $date;

    /**
     * Activity constructor.
     * @param $id
     * @param $user
     * @param $course
     * @param $slide
     * @param $name
     * @param $description
     * @param $date
     */
    public function __construct($id, $user, $course, $slide, $name, $description, $date)
    {
        $this->id = $id;
        $this->user = $user;
        $this->course = is_numeric($course) ? Course::find($course) : $course;
        $this->slide = is_numeric($slide) ? Slide::find($slide) : $slide;
        $this->name = $name;
        $this->description = $description;
        $this->date = $date;
    }

    public function __get($property)
    {
        switch ($property) {
            case 'date':
                return date(
                    get_option('date_format'),
                    strtotime($this->date)
                );
            case 'time':
                return date(
                    get_option('time_format'),
                    strtotime($this->date)
                );
            default:
                return $this->$property;
        }
    }

}