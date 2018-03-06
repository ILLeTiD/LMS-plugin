<?php

namespace LmsPlugin\Controllers;

use FishyMinds\Request;

class UserInvitationsController extends Controller
{
    public function invite()
    {
        $request = new Request($_REQUEST);

        $this->validate($request);

        $invitees = lms_parse_invitees($request->get('emails'));

        if ( ! $invitees) {
            wp_send_json([
                'status' => 'error',
                'message' => __('Email(s) not valid.', 'lms-plugin')
            ]);
        }

        // wp_send_json($invitees);

        wp_send_json([
            'status' => 'success',
            'message' => __('User(s) invited.', 'lms-plugin')
        ]);
    }

    private function validate($request)
    {
        if (empty($request->get('role'))) {
            wp_send_json([
                'status' => 'error',
                'message' => __('Role needs to be selected.', 'lms-plugin')
            ]);
        }

        if (empty($request->get('emails'))) {
            wp_send_json([
                'status' => 'error',
                'message' => __('Email(s) required.', 'lms-plugin')
            ]);
        }
    }
}