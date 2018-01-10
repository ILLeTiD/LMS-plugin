<?php

namespace LmsPlugin\Models\DataSuppliers;

use LmsPlugin\Models\Course;
use LmsPlugin\Models\User;

class ParticipantProgressDataSupplier
{
    private $user;

    public function __construct($user_id)
    {
        $this->user = User::find($user_id);
    }

    public function getData()
    {
        $result = [];

        $statuses = array_keys(Course::statuses());

        foreach ($statuses as $status) {
            $result[$status]['number'] = count($this->user->status($status));
        }

        $all_courses = count($this->user->courses());

        foreach ($result as &$item) {
            if ($item['number'] > 0) {
                $item['percent'] = round(100 / $all_courses * $item['number']);
            } else {
                $item['percent'] = 0;
            }
        }

        return $result;
    }
}