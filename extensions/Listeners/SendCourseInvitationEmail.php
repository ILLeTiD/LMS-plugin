<?php

namespace LmsPlugin\Listeners;

use FishyMinds\WordPress\Plugin\HasPlugin;
use LmsPlugin\Shortcoder;

class SendCourseInvitationEmail
{
    use HasPlugin;

    public function handle($enrollment)
    {
        $user = $enrollment->user;
        $course = $enrollment->course;
        $to = $user->email;
        $subject = $this->plugin->getSettings('email_templates.course_invitations.subject');
        $message = $this->plugin->getSettings('email_templates.course_invitations.body');

        $shortcoder = new Shortcoder($this->plugin);
        $message = $shortcoder->replace($message, compact('user', 'course'));

        wp_mail($to, $subject, $message);
    }
}