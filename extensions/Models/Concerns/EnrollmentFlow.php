<?php

namespace LmsPlugin\Models\Concerns;

trait EnrollmentFlow
{
    public function resendInvite()
    {
        do_action('lms_event_participant_invited', $this);
    }

    public function uninvite()
    {
        $this->delete();
    }

    public function reset()
    {
        global $wpdb;

        $wpdb->delete(
            $wpdb->prefix . 'lms_progress',
            [
                'user_id' => $this->user_id,
                'course_id' => $this->course_id
            ],
            ['%d', '%d']
        );

        $this->status = 'enrolled';
        $this->save();
    }

    public function fail()
    {
        $this->status = 'failed';
        $this->save();
    }
}