<?php

namespace TidioLiveChat;

if (!defined('WPINC')) {
    die('File loaded directly. Exiting.');
}

use TidioLiveChat\Admin\AdminActionLink;
use TidioLiveChat\Admin\AdminController;
use TidioLiveChat\Admin\AdminDashboard;
use TidioLiveChat\Admin\AdminNotice;
use TidioLiveChat\Admin\AdminRouting;
use TidioLiveChat\Admin\IframeSetup;
use TidioLiveChat\Sdk\Api\Client\TidioApiClientFactory;
use TidioLiveChat\Sdk\Encryption\Service\EncryptionServiceFactory;
use TidioLiveChat\Sdk\IntegrationFacade;
use TidioLiveChat\Translation\ErrorTranslator;
use TidioLiveChat\Translation\TranslationLoader;
use TidioLiveChat\Widget\WidgetLoader;

class TidioLiveChat
{
    const TIDIO_PLUGIN_NAME = 'tidio-live-chat';

    public static function load()
    {
        $encryptionService = (new EncryptionServiceFactory())->create();
        $integrationState = new IntegrationState($encryptionService);
        if (!is_admin()) {
            new WidgetLoader($integrationState);
            return;
        }

        if (current_user_can('activate_plugins')) {
            new TranslationLoader();
            $apiClientFactory = new TidioApiClientFactory();
            $integrationFacade = new IntegrationFacade($apiClientFactory);
            $adminController = new AdminController($integrationFacade, $integrationState);
            $iframeSetup = new IframeSetup($integrationState);
            $errorTranslator = new ErrorTranslator();

            new AdminRouting($adminController);
            new AdminActionLink($integrationState);
            new AdminDashboard($integrationState, $iframeSetup);
            new AdminNotice($errorTranslator);
        }
    }
}
