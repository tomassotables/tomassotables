<?php

namespace TidioLiveChat\Sdk\Api\Client;

if (!defined('WPINC')) {
    die('File loaded directly. Exiting.');
}

use TidioLiveChat\Sdk\Api\TidioApiClient;

class TidioApiClientFactory
{
    /**
     * @return TidioApiClient
     */
    public function create()
    {
        if (function_exists('curl_version')) {
            return new CurlTidioApiClient();
        }

        return new FileGetContentsTidioApiClient();
    }

    /**
     * @param string $token
     * @return TidioApiClient
     */
    public function createAuthenticated($token)
    {
        $authorizationHeader = ['Authorization: Bearer ' . $token];
        if (function_exists('curl_version')) {
            return new CurlTidioApiClient($authorizationHeader);
        }

        return new FileGetContentsTidioApiClient($authorizationHeader);
    }
}
