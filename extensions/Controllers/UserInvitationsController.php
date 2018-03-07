<?php

namespace LmsPlugin\Controllers;

use FishyMinds\Request;
use LmsPlugin\Misc\InviteesParser;
use LmsPlugin\Misc\InviteesValidator;
use LmsPlugin\Misc\UserInviter;

class UserInvitationsController extends Controller
{
    public function invite()
    {
        $request = new Request($_REQUEST);
        $parser = new InviteesParser();

        $this->validate($request);

        $invitees = $parser->parse($request->get('emails'));

        if ( ! $invitees) {
            wp_send_json_error([
                'message' => __('Email(s) not valid.', 'lms-plugin')
            ]);
        }

        $validator = new InviteesValidator();
        $validator->validate($invitees);

        $inviter = new UserInviter();

        foreach ($invitees as &$invitee) {
            $invitee['role'] = $request->get('role');
            $user = call_user_func_array([$inviter, 'invite'], $invitee);
            do_action('lms_event_user_invited', $user);
        }

        wp_send_json_success([
            'message' => __('User(s) invited.', 'lms-plugin')
        ]);
    }

    private function validate($request)
    {
        if (empty($request->get('role'))) {
            wp_send_json_error([
                'message' => __('Role needs to be selected.', 'lms-plugin')
            ]);
        }

        if (empty($request->get('emails'))) {
            wp_send_json_error([
                'message' => __('Email(s) required.', 'lms-plugin')
            ]);
        }
    }
}