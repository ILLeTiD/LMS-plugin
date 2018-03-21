<?php

namespace LmsPlugin\Listeners;

use FishyMinds\WordPress\Plugin\HasPlugin;
use LmsPlugin\Shortcoder;

class SendInvitationEmail
{
    use HasPlugin;

    public function handle($user)
    {
        $to = $user->email;
        $subject = $this->plugin->getSettings('email_templates.lms_invitations.subject');
        $message = $this->plugin->getSettings('email_templates.lms_invitations.body');

        $shortcoder = new Shortcoder($this->plugin);
        $message = $shortcoder->replace($message, compact('user'));

        $link = get_bloginfo('url') . '/accept_invitation?token=' . $user->lms_invite_token;

        $message .= ' ' . $link;

        wp_mail($to, $subject, $message);
    }
}