<?php

namespace TidioLiveChat\Admin;

if (!defined('WPINC')) {
    die('File loaded directly. Exiting.');
}

use Exception;
use TidioLiveChat\IntegrationState;
use TidioLiveChat\Config;

class IframeSetup
{
    /**
     * @var IntegrationState
     */
    private $integrationState;

    /**
     * @param IntegrationState $integrationState
     */
    public function __construct($integrationState)
    {
        $this->integrationState = $integrationState;
    }

    /**
     * @return string
     */
    public function prepareAuthenticationIframeUrl()
    {
        $userId = get_current_user_id();
        $userName = get_user_meta($userId, 'first_name', true);

        $queryParams = array_merge(
            [
                'pluginUrl' => AdminRouting::getEndpointForIntegrateProjectAction(),
                'name' => $userName,
                'refId' => $this->readRefIdFromFile()
            ],
            $this->getDefaultIframeQueryParams()
        );

        $iframeBaseUrl = Config::getPanelUrl() . '/register-platforms';
        return sprintf('%s?%s', $iframeBaseUrl, http_build_query($queryParams));
    }

    /**
     * @return string
     */
    public function prepareIntegrationSuccessIframeUrl()
    {
        $queryParams = array_merge(
            [
                'panelUrl' => $this->getPanelRedirectUrl()
            ],
            $this->getDefaultIframeQueryParams()
        );

        $iframeBaseUrl = Config::getPanelUrl() . '/integration-success';
        return sprintf('%s?%s', $iframeBaseUrl, http_build_query($queryParams));
    }

    /**
     * @return array<string, string>
     */
    private function getDefaultIframeQueryParams()
    {
        $userId = get_current_user_id();
        $localeCode = get_user_locale($userId);

        return [
            'siteUrl' => get_home_url(),
            'localeCode' => $localeCode,
            'utm_source' => 'platform',
            'utm_medium' => 'wordpress',
        ];
    }

    /**
     * @return string|null
     */
    private function readRefIdFromFile() {
        try {
            $loadedRefIdFromFile = @file_get_contents(AFFILIATE_CONFIG_FILE_PATH);
            return trim($loadedRefIdFromFile);
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * @return string
     */
    private function getPanelRedirectUrl()
    {
        $queryParams = [
            'utm_source' => 'platform',
            'utm_medium' => 'wordpress'
        ];
        if ($this->integrationState->hasProjectPrivateKey()) {
            $queryParams['privateKey'] = $this->integrationState->getProjectPrivateKey();
            return sprintf('%s/external-access?%s', Config::getPanelUrl(), http_build_query($queryParams));
        }

        return sprintf('%s?%s', Config::getPanelUrl(), http_build_query($queryParams));
    }
}
