<?php

namespace FishyMinds\WordPress\Plugin\Updater;

class Repository
{
    const BASE_URL = 'https://api.bitbucket.org/2.0/repositories/fishyminds/wordpress-lms-plugin';
    const AUTH_KEY = 'pyTmUCg79EQ7Q53J4y';
    const AUTH_SECRET = 'zMtu7pTfru2n5QCH9qqxMvYuXEPtnaGq';

    private $lastRelease;
    private $accessToken;

    private function getAccessToken()
    {
        if (! empty($this->accessToken)) {
            return $this->accessToken;
        }

        $url = 'https://bitbucket.org/site/oauth2/access_token';

        $response = wp_remote_post($url, [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode(self::AUTH_KEY . ':' . self::AUTH_SECRET)
            ],
            'body' => [
                'grant_type' => 'client_credentials'
            ]
        ]);

        $json = wp_remote_retrieve_body($response);

        $accessToken = json_decode($json, true);

        return $this->accessToken = array_get($accessToken, 'access_token');
    }

    public function getLastRelease()
    {
        if (! empty($this->lastRelease)) {
            return $this->lastRelease;
        }

        $url = self::BASE_URL . '/refs/tags';

        $url = add_query_arg([
            'sort' => '-target.date',
            // 'access_token' => $this->getAccessToken()
        ], $url);

        $response = wp_remote_get($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAccessToken()
            ]
        ]);

        if (wp_remote_retrieve_response_code($response) == 403) {
            return null;
        }

        $json = wp_remote_retrieve_body($response);

        if (empty($json) || isset($json['message'])) {
            return null;
        }

        $releases = json_decode($json);

        return $this->lastRelease = $releases->values[0];
    }

    public function getDownloadUrl()
    {
        $url = 'https://bitbucket.org/fishyminds/wordpress-lms-plugin/get/' . $this->lastRelease->name . '.zip';

        return add_query_arg([
            'access_token' => $this->getAccessToken()
        ]);
    }
}