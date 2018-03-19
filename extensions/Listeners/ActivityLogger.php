<?php

namespace LmsPlugin\Listeners;

use FishyMinds\WordPress\Plugin\HasPlugin;
use LmsPlugin\Models\Activity;

class ActivityLogger
{
    public function handle($user_id, $type, $name, $course_id = '')
    {

        $activityNew = new Activity([
            'user_id' => $user_id,
            'type' => $type,
            'name' => $name,
            'course_id' => $course_id,
        ]);

        $activityNew->save();
    }
}
