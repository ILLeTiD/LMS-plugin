<?php

namespace LmsPlugin\Misc;

class InviteesParser
{
    public function parse($input)
    {
        $result = [];
        $invitees = preg_split('/, ?/', $input);

        foreach ($invitees as $invitee) {
            $data = $this->parseInvitee($invitee);
            if ( ! $data) {
                return false;
            }

            $result[] = [
                'name' => array_get($data, 'name'),
                'email' => array_get($data, 'email')
            ];
        }

        return $result;
    }

    private function parseInvitee($input)
    {
        $email = '(?<email>[\-0-9a-zA-Z\.\+_]+@[\-0-9a-zA-Z\.\+_]+\.[a-zA-Z]{2,4})';
        $email_with_name = "((?<name>\w+ \w+) ?<{$email}>)";

        $found = preg_match("/^{$email_with_name}$/", $input, $matches);

        if ($found) {
            return $matches;
        }

        $found = preg_match("/^{$email}$/", $input, $matches);

        return $found ? $matches : false;
    }
}