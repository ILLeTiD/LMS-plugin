<?php

namespace LmsPlugin\Listeners;

use FishyMinds\WordPress\Plugin\HasPlugin;
use LmsPlugin\Shortcoder;

class SendPasswordResetEmail
{
    use HasPlugin;

    public function handle($email)
    {
        $user = get_user_by('email', $email);

        $subject = $this->plugin->getSettings('email_templates.reset_password.subject');
        $message = $this->plugin->getSettings('email_templates.reset_password.body');

        $shortcoder = new Shortcoder($this->plugin);
        $message = $shortcoder->replace($message, compact('user'));

        wp_mail($email, $subject, $message);
    }
}