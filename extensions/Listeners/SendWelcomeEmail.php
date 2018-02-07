<?php

namespace LmsPlugin\Listeners;

use FishyMinds\WordPress\Plugin\HasPlugin;
use LmsPlugin\Shortcoder;

class SendWelcomeEmail
{
    use HasPlugin;

    public function handle($user)
    {
        $to = $user->email;
        $subject = $this->plugin->getSettings('email_templates.welcome.subject');
        $message = $this->plugin->getSettings('email_templates.welcome.body');

        $shortcoder = new Shortcoder($this->plugin);
        $message = $shortcoder->replace($message, compact('user'));

        wp_mail($to, $subject, $message);
    }
}