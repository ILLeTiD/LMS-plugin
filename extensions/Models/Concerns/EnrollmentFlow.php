<?php

namespace LmsPlugin\Models\Concerns;

trait EnrollmentFlow
{
    public function resendInvite()
    {
        do_action('lms_event_participant_invited', $enrollment);
    }

    public function uninvite()
    {
        $enrollment->delete();
    }

    public function reset()
    {
        global $wpdb;

        $wpdb->delete(
            $wpdb->prefix . 'lms_progress',
            [
                'user_id' => $enrollment->user_id,
                'course_id' => $enrollment->course_id
            ],
            ['%d', '%d']
        );

        $enrollment->status = 'enrolled';
        $enrollment->save();
    }

    public function fail()
    {
        $enrollment->status = 'failed';
        $enrollment->save();
    }
}