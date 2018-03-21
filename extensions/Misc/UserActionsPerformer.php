<?php

namespace LmsPlugin\Misc;

use LmsPlugin\Models\User;

class UserActionsPerformer
{
    public function accept(int $user_id, string $role)
    {
        $user = new \WP_User($user_id);

        $user->add_role($role);
        update_user_meta($user_id, 'lms_status', 'accepted');
        update_user_meta($user_id, 'lms_last_activity', time());
    }

    public function deny(int $user_id)
    {
        update_user_meta($user_id, 'lms_status', 'denied');
    }

    public function resendInvite(int $user_id)
    {
        $user = User::find($user_id);

        update_user_meta($user_id, 'lms_status', 'invited');
        update_user_meta($user_id, 'lms_last_activity', time());
        update_user_meta($user_id, 'lms_invite_token', lms_invite_token());

        do_action('lms_event_user_invited', $user);
    }

    public function uninvite(int $user_id)
    {
        $user = User::find($user_id);

        delete_user_meta($user_id, 'lms_invite_token');
        update_user_meta($user_id, 'lms_status', 'uninvited');
    }

    public function delete(int $user_id)
    {
        global $wpdb;

        wp_delete_user($user_id);

        $wpdb->delete($wpdb->usermeta, ['user_id' => $user_id], ['%d']);
    }
}
