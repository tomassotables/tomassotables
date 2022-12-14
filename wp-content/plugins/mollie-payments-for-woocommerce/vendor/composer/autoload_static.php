<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit45584e3b66e1ee0947462ea27c0c0b23
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Container\\' => 14,
        ),
        'M' => 
        array (
            'Mollie\\WooCommerce\\' => 19,
            'Mollie\\Api\\' => 11,
        ),
        'I' => 
        array (
            'Inpsyde\\Modularity\\' => 19,
            'Inpsyde\\EnvironmentChecker\\' => 27,
        ),
        'C' => 
        array (
            'Composer\\CaBundle\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Mollie\\WooCommerce\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Mollie\\Api\\' => 
        array (
            0 => __DIR__ . '/..' . '/mollie/mollie-api-php/src',
        ),
        'Inpsyde\\Modularity\\' => 
        array (
            0 => __DIR__ . '/..' . '/inpsyde/modularity/src',
        ),
        'Inpsyde\\EnvironmentChecker\\' => 
        array (
            0 => __DIR__ . '/../..' . '/pluginEnvironmentChecker',
        ),
        'Composer\\CaBundle\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/ca-bundle/src',
        ),
    );

    public static $classMap = array (
        'Composer\\CaBundle\\CaBundle' => __DIR__ . '/..' . '/composer/ca-bundle/src/CaBundle.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Inpsyde\\EnvironmentChecker\\ConstraintsCollectionFactory' => __DIR__ . '/../..' . '/pluginEnvironmentChecker/ConstraintsCollectionFactory.php',
        'Inpsyde\\EnvironmentChecker\\ConstraintsCollectionFactoryInterface' => __DIR__ . '/../..' . '/pluginEnvironmentChecker/ConstraintsCollectionFactoryInterface.php',
        'Inpsyde\\EnvironmentChecker\\Constraints\\AbstractVersionConstraint' => __DIR__ . '/../..' . '/pluginEnvironmentChecker/Constraints/AbstractVersionConstraint.php',
        'Inpsyde\\EnvironmentChecker\\Constraints\\ConstraintInterface' => __DIR__ . '/../..' . '/pluginEnvironmentChecker/Constraints/ConstraintInterface.php',
        'Inpsyde\\EnvironmentChecker\\Constraints\\ConstraintsCollection' => __DIR__ . '/../..' . '/pluginEnvironmentChecker/Constraints/ConstraintsCollection.php',
        'Inpsyde\\EnvironmentChecker\\Constraints\\ExtensionConstraint' => __DIR__ . '/../..' . '/pluginEnvironmentChecker/Constraints/ExtensionConstraint.php',
        'Inpsyde\\EnvironmentChecker\\Constraints\\PhpConstraint' => __DIR__ . '/../..' . '/pluginEnvironmentChecker/Constraints/PhpConstraint.php',
        'Inpsyde\\EnvironmentChecker\\Constraints\\PluginConstraint' => __DIR__ . '/../..' . '/pluginEnvironmentChecker/Constraints/PluginConstraint.php',
        'Inpsyde\\EnvironmentChecker\\Constraints\\WordPressConstraint' => __DIR__ . '/../..' . '/pluginEnvironmentChecker/Constraints/WordPressConstraint.php',
        'Inpsyde\\EnvironmentChecker\\EnvironmentChecker' => __DIR__ . '/../..' . '/pluginEnvironmentChecker/EnvironmentChecker.php',
        'Inpsyde\\EnvironmentChecker\\Exception\\ConstraintFailedException' => __DIR__ . '/../..' . '/pluginEnvironmentChecker/Exception/ConstraintFailedException.php',
        'Inpsyde\\EnvironmentChecker\\Exception\\ConstraintFailedExceptionInterface' => __DIR__ . '/../..' . '/pluginEnvironmentChecker/Exception/ConstraintFailedExceptionInterface.php',
        'Inpsyde\\Modularity\\Container\\ContainerConfigurator' => __DIR__ . '/..' . '/inpsyde/modularity/src/Container/ContainerConfigurator.php',
        'Inpsyde\\Modularity\\Container\\PackageProxyContainer' => __DIR__ . '/..' . '/inpsyde/modularity/src/Container/PackageProxyContainer.php',
        'Inpsyde\\Modularity\\Container\\ReadOnlyContainer' => __DIR__ . '/..' . '/inpsyde/modularity/src/Container/ReadOnlyContainer.php',
        'Inpsyde\\Modularity\\Module\\ExecutableModule' => __DIR__ . '/..' . '/inpsyde/modularity/src/Module/ExecutableModule.php',
        'Inpsyde\\Modularity\\Module\\ExtendingModule' => __DIR__ . '/..' . '/inpsyde/modularity/src/Module/ExtendingModule.php',
        'Inpsyde\\Modularity\\Module\\FactoryModule' => __DIR__ . '/..' . '/inpsyde/modularity/src/Module/FactoryModule.php',
        'Inpsyde\\Modularity\\Module\\Module' => __DIR__ . '/..' . '/inpsyde/modularity/src/Module/Module.php',
        'Inpsyde\\Modularity\\Module\\ModuleClassNameIdTrait' => __DIR__ . '/..' . '/inpsyde/modularity/src/Module/ModuleClassNameIdTrait.php',
        'Inpsyde\\Modularity\\Module\\ServiceModule' => __DIR__ . '/..' . '/inpsyde/modularity/src/Module/ServiceModule.php',
        'Inpsyde\\Modularity\\Package' => __DIR__ . '/..' . '/inpsyde/modularity/src/Package.php',
        'Inpsyde\\Modularity\\Properties\\BaseProperties' => __DIR__ . '/..' . '/inpsyde/modularity/src/Properties/BaseProperties.php',
        'Inpsyde\\Modularity\\Properties\\LibraryProperties' => __DIR__ . '/..' . '/inpsyde/modularity/src/Properties/LibraryProperties.php',
        'Inpsyde\\Modularity\\Properties\\PluginProperties' => __DIR__ . '/..' . '/inpsyde/modularity/src/Properties/PluginProperties.php',
        'Inpsyde\\Modularity\\Properties\\Properties' => __DIR__ . '/..' . '/inpsyde/modularity/src/Properties/Properties.php',
        'Inpsyde\\Modularity\\Properties\\ThemeProperties' => __DIR__ . '/..' . '/inpsyde/modularity/src/Properties/ThemeProperties.php',
        'Mollie\\Api\\CompatibilityChecker' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/CompatibilityChecker.php',
        'Mollie\\Api\\Endpoints\\ChargebackEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/ChargebackEndpoint.php',
        'Mollie\\Api\\Endpoints\\ClientEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/ClientEndpoint.php',
        'Mollie\\Api\\Endpoints\\CollectionEndpointAbstract' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/CollectionEndpointAbstract.php',
        'Mollie\\Api\\Endpoints\\CustomerEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/CustomerEndpoint.php',
        'Mollie\\Api\\Endpoints\\CustomerPaymentsEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/CustomerPaymentsEndpoint.php',
        'Mollie\\Api\\Endpoints\\EndpointAbstract' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/EndpointAbstract.php',
        'Mollie\\Api\\Endpoints\\InvoiceEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/InvoiceEndpoint.php',
        'Mollie\\Api\\Endpoints\\MandateEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/MandateEndpoint.php',
        'Mollie\\Api\\Endpoints\\MethodEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/MethodEndpoint.php',
        'Mollie\\Api\\Endpoints\\OnboardingEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/OnboardingEndpoint.php',
        'Mollie\\Api\\Endpoints\\OrderEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/OrderEndpoint.php',
        'Mollie\\Api\\Endpoints\\OrderLineEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/OrderLineEndpoint.php',
        'Mollie\\Api\\Endpoints\\OrderPaymentEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/OrderPaymentEndpoint.php',
        'Mollie\\Api\\Endpoints\\OrderRefundEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/OrderRefundEndpoint.php',
        'Mollie\\Api\\Endpoints\\OrganizationEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/OrganizationEndpoint.php',
        'Mollie\\Api\\Endpoints\\OrganizationPartnerEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/OrganizationPartnerEndpoint.php',
        'Mollie\\Api\\Endpoints\\PaymentCaptureEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/PaymentCaptureEndpoint.php',
        'Mollie\\Api\\Endpoints\\PaymentChargebackEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/PaymentChargebackEndpoint.php',
        'Mollie\\Api\\Endpoints\\PaymentEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/PaymentEndpoint.php',
        'Mollie\\Api\\Endpoints\\PaymentLinkEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/PaymentLinkEndpoint.php',
        'Mollie\\Api\\Endpoints\\PaymentRefundEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/PaymentRefundEndpoint.php',
        'Mollie\\Api\\Endpoints\\PaymentRouteEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/PaymentRouteEndpoint.php',
        'Mollie\\Api\\Endpoints\\PermissionEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/PermissionEndpoint.php',
        'Mollie\\Api\\Endpoints\\ProfileEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/ProfileEndpoint.php',
        'Mollie\\Api\\Endpoints\\ProfileMethodEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/ProfileMethodEndpoint.php',
        'Mollie\\Api\\Endpoints\\RefundEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/RefundEndpoint.php',
        'Mollie\\Api\\Endpoints\\SettlementPaymentEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/SettlementPaymentEndpoint.php',
        'Mollie\\Api\\Endpoints\\SettlementsEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/SettlementsEndpoint.php',
        'Mollie\\Api\\Endpoints\\ShipmentEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/ShipmentEndpoint.php',
        'Mollie\\Api\\Endpoints\\SubscriptionEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/SubscriptionEndpoint.php',
        'Mollie\\Api\\Endpoints\\WalletEndpoint' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Endpoints/WalletEndpoint.php',
        'Mollie\\Api\\Exceptions\\ApiException' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Exceptions/ApiException.php',
        'Mollie\\Api\\Exceptions\\CurlConnectTimeoutException' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Exceptions/CurlConnectTimeoutException.php',
        'Mollie\\Api\\Exceptions\\HttpAdapterDoesNotSupportDebuggingException' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Exceptions/HttpAdapterDoesNotSupportDebuggingException.php',
        'Mollie\\Api\\Exceptions\\IncompatiblePlatform' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Exceptions/IncompatiblePlatform.php',
        'Mollie\\Api\\Exceptions\\UnrecognizedClientException' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Exceptions/UnrecognizedClientException.php',
        'Mollie\\Api\\HttpAdapter\\CurlMollieHttpAdapter' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/HttpAdapter/CurlMollieHttpAdapter.php',
        'Mollie\\Api\\HttpAdapter\\Guzzle6And7MollieHttpAdapter' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/HttpAdapter/Guzzle6And7MollieHttpAdapter.php',
        'Mollie\\Api\\HttpAdapter\\Guzzle6And7RetryMiddlewareFactory' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/HttpAdapter/Guzzle6And7RetryMiddlewareFactory.php',
        'Mollie\\Api\\HttpAdapter\\MollieHttpAdapterInterface' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/HttpAdapter/MollieHttpAdapterInterface.php',
        'Mollie\\Api\\HttpAdapter\\MollieHttpAdapterPicker' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/HttpAdapter/MollieHttpAdapterPicker.php',
        'Mollie\\Api\\HttpAdapter\\MollieHttpAdapterPickerInterface' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/HttpAdapter/MollieHttpAdapterPickerInterface.php',
        'Mollie\\Api\\MollieApiClient' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/MollieApiClient.php',
        'Mollie\\Api\\Resources\\BaseCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/BaseCollection.php',
        'Mollie\\Api\\Resources\\BaseResource' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/BaseResource.php',
        'Mollie\\Api\\Resources\\Capture' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Capture.php',
        'Mollie\\Api\\Resources\\CaptureCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/CaptureCollection.php',
        'Mollie\\Api\\Resources\\Chargeback' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Chargeback.php',
        'Mollie\\Api\\Resources\\ChargebackCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/ChargebackCollection.php',
        'Mollie\\Api\\Resources\\Client' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Client.php',
        'Mollie\\Api\\Resources\\ClientCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/ClientCollection.php',
        'Mollie\\Api\\Resources\\CurrentProfile' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/CurrentProfile.php',
        'Mollie\\Api\\Resources\\CursorCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/CursorCollection.php',
        'Mollie\\Api\\Resources\\Customer' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Customer.php',
        'Mollie\\Api\\Resources\\CustomerCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/CustomerCollection.php',
        'Mollie\\Api\\Resources\\Invoice' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Invoice.php',
        'Mollie\\Api\\Resources\\InvoiceCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/InvoiceCollection.php',
        'Mollie\\Api\\Resources\\Issuer' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Issuer.php',
        'Mollie\\Api\\Resources\\IssuerCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/IssuerCollection.php',
        'Mollie\\Api\\Resources\\Mandate' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Mandate.php',
        'Mollie\\Api\\Resources\\MandateCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/MandateCollection.php',
        'Mollie\\Api\\Resources\\Method' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Method.php',
        'Mollie\\Api\\Resources\\MethodCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/MethodCollection.php',
        'Mollie\\Api\\Resources\\MethodPrice' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/MethodPrice.php',
        'Mollie\\Api\\Resources\\MethodPriceCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/MethodPriceCollection.php',
        'Mollie\\Api\\Resources\\Onboarding' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Onboarding.php',
        'Mollie\\Api\\Resources\\Order' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Order.php',
        'Mollie\\Api\\Resources\\OrderCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/OrderCollection.php',
        'Mollie\\Api\\Resources\\OrderLine' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/OrderLine.php',
        'Mollie\\Api\\Resources\\OrderLineCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/OrderLineCollection.php',
        'Mollie\\Api\\Resources\\Organization' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Organization.php',
        'Mollie\\Api\\Resources\\OrganizationCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/OrganizationCollection.php',
        'Mollie\\Api\\Resources\\Partner' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Partner.php',
        'Mollie\\Api\\Resources\\Payment' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Payment.php',
        'Mollie\\Api\\Resources\\PaymentCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/PaymentCollection.php',
        'Mollie\\Api\\Resources\\PaymentLink' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/PaymentLink.php',
        'Mollie\\Api\\Resources\\PaymentLinkCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/PaymentLinkCollection.php',
        'Mollie\\Api\\Resources\\Permission' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Permission.php',
        'Mollie\\Api\\Resources\\PermissionCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/PermissionCollection.php',
        'Mollie\\Api\\Resources\\Profile' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Profile.php',
        'Mollie\\Api\\Resources\\ProfileCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/ProfileCollection.php',
        'Mollie\\Api\\Resources\\Refund' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Refund.php',
        'Mollie\\Api\\Resources\\RefundCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/RefundCollection.php',
        'Mollie\\Api\\Resources\\ResourceFactory' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/ResourceFactory.php',
        'Mollie\\Api\\Resources\\Route' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Route.php',
        'Mollie\\Api\\Resources\\RouteCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/RouteCollection.php',
        'Mollie\\Api\\Resources\\Settlement' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Settlement.php',
        'Mollie\\Api\\Resources\\SettlementCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/SettlementCollection.php',
        'Mollie\\Api\\Resources\\Shipment' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Shipment.php',
        'Mollie\\Api\\Resources\\ShipmentCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/ShipmentCollection.php',
        'Mollie\\Api\\Resources\\Subscription' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/Subscription.php',
        'Mollie\\Api\\Resources\\SubscriptionCollection' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Resources/SubscriptionCollection.php',
        'Mollie\\Api\\Types\\InvoiceStatus' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Types/InvoiceStatus.php',
        'Mollie\\Api\\Types\\MandateMethod' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Types/MandateMethod.php',
        'Mollie\\Api\\Types\\MandateStatus' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Types/MandateStatus.php',
        'Mollie\\Api\\Types\\OnboardingStatus' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Types/OnboardingStatus.php',
        'Mollie\\Api\\Types\\OrderLineStatus' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Types/OrderLineStatus.php',
        'Mollie\\Api\\Types\\OrderLineType' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Types/OrderLineType.php',
        'Mollie\\Api\\Types\\OrderStatus' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Types/OrderStatus.php',
        'Mollie\\Api\\Types\\PaymentMethod' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Types/PaymentMethod.php',
        'Mollie\\Api\\Types\\PaymentMethodStatus' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Types/PaymentMethodStatus.php',
        'Mollie\\Api\\Types\\PaymentStatus' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Types/PaymentStatus.php',
        'Mollie\\Api\\Types\\ProfileStatus' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Types/ProfileStatus.php',
        'Mollie\\Api\\Types\\RefundStatus' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Types/RefundStatus.php',
        'Mollie\\Api\\Types\\SequenceType' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Types/SequenceType.php',
        'Mollie\\Api\\Types\\SettlementStatus' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Types/SettlementStatus.php',
        'Mollie\\Api\\Types\\SubscriptionStatus' => __DIR__ . '/..' . '/mollie/mollie-api-php/src/Types/SubscriptionStatus.php',
        'Mollie\\WooCommerce\\Activation\\ActivationModule' => __DIR__ . '/../..' . '/src/Activation/ActivationModule.php',
        'Mollie\\WooCommerce\\Activation\\ConstraintsChecker' => __DIR__ . '/../..' . '/src/Activation/ConstraintsChecker.php',
        'Mollie\\WooCommerce\\Activation\\PluginDisabler' => __DIR__ . '/../..' . '/src/Activation/PluginDisabler.php',
        'Mollie\\WooCommerce\\Assets\\AssetsModule' => __DIR__ . '/../..' . '/src/Assets/AssetsModule.php',
        'Mollie\\WooCommerce\\BlockService\\CheckoutBlockService' => __DIR__ . '/../..' . '/src/BlockService/CheckoutBlockService.php',
        'Mollie\\WooCommerce\\Buttons\\ApplePayButton\\AppleAjaxRequests' => __DIR__ . '/../..' . '/src/Buttons/ApplePayButton/AppleAjaxRequests.php',
        'Mollie\\WooCommerce\\Buttons\\ApplePayButton\\ApplePayDataObjectHttp' => __DIR__ . '/../..' . '/src/Buttons/ApplePayButton/ApplePayDataObjectHttp.php',
        'Mollie\\WooCommerce\\Buttons\\ApplePayButton\\ApplePayDirectHandler' => __DIR__ . '/../..' . '/src/Buttons/ApplePayButton/ApplePayDirectHandler.php',
        'Mollie\\WooCommerce\\Buttons\\ApplePayButton\\DataToAppleButtonScripts' => __DIR__ . '/../..' . '/src/Buttons/ApplePayButton/DataToAppleButtonScripts.php',
        'Mollie\\WooCommerce\\Buttons\\ApplePayButton\\PropertiesDictionary' => __DIR__ . '/../..' . '/src/Buttons/ApplePayButton/PropertiesDictionary.php',
        'Mollie\\WooCommerce\\Buttons\\ApplePayButton\\ResponsesToApple' => __DIR__ . '/../..' . '/src/Buttons/ApplePayButton/ResponsesToApple.php',
        'Mollie\\WooCommerce\\Buttons\\PayPalButton\\DataToPayPal' => __DIR__ . '/../..' . '/src/Buttons/PayPalButton/DataToPayPal.php',
        'Mollie\\WooCommerce\\Buttons\\PayPalButton\\PayPalAjaxRequests' => __DIR__ . '/../..' . '/src/Buttons/PayPalButton/PayPalAjaxRequests.php',
        'Mollie\\WooCommerce\\Buttons\\PayPalButton\\PayPalButtonHandler' => __DIR__ . '/../..' . '/src/Buttons/PayPalButton/PayPalButtonHandler.php',
        'Mollie\\WooCommerce\\Buttons\\PayPalButton\\PayPalDataObjectHttp' => __DIR__ . '/../..' . '/src/Buttons/PayPalButton/PayPalDataObjectHttp.php',
        'Mollie\\WooCommerce\\Buttons\\PayPalButton\\PropertiesDictionary' => __DIR__ . '/../..' . '/src/Buttons/PayPalButton/PropertiesDictionary.php',
        'Mollie\\WooCommerce\\Buttons\\PayPalButton\\WCOrderCalculator' => __DIR__ . '/../..' . '/src/Buttons/PayPalButton/WCOrderCalculator.php',
        'Mollie\\WooCommerce\\Components\\AcceptedLocaleValuesDictionary' => __DIR__ . '/../..' . '/src/Components/AcceptedLocaleValuesDictionary.php',
        'Mollie\\WooCommerce\\Components\\ComponentsStyles' => __DIR__ . '/../..' . '/src/Components/ComponentsStyles.php',
        'Mollie\\WooCommerce\\Components\\StylesPropertiesDictionary' => __DIR__ . '/../..' . '/src/Components/StylesPropertiesDictionary.php',
        'Mollie\\WooCommerce\\Gateway\\GatewayModule' => __DIR__ . '/../..' . '/src/Gateway/GatewayModule.php',
        'Mollie\\WooCommerce\\Gateway\\MolliePaymentGateway' => __DIR__ . '/../..' . '/src/Gateway/MolliePaymentGateway.php',
        'Mollie\\WooCommerce\\Gateway\\OrderMandatoryGatewayDisabler' => __DIR__ . '/../..' . '/src/Gateway/OrderMandatoryGatewayDisabler.php',
        'Mollie\\WooCommerce\\Gateway\\Surcharge' => __DIR__ . '/../..' . '/src/Gateway/Surcharge.php',
        'Mollie\\WooCommerce\\Gateway\\Voucher\\MaybeDisableGateway' => __DIR__ . '/../..' . '/src/Gateway/Voucher/MaybeDisableGateway.php',
        'Mollie\\WooCommerce\\Gateway\\Voucher\\VoucherModule' => __DIR__ . '/../..' . '/src/Gateway/Voucher/VoucherModule.php',
        'Mollie\\WooCommerce\\Log\\LogModule' => __DIR__ . '/../..' . '/src/Log/LogModule.php',
        'Mollie\\WooCommerce\\Log\\WcPsrLoggerAdapter' => __DIR__ . '/../..' . '/src/Log/WcPsrLoggerAdapter.php',
        'Mollie\\WooCommerce\\Notice\\AdminNotice' => __DIR__ . '/../..' . '/src/Notice/AdminNotice.php',
        'Mollie\\WooCommerce\\Notice\\NoticeInterface' => __DIR__ . '/../..' . '/src/Notice/NoticeInterface.php',
        'Mollie\\WooCommerce\\Notice\\NoticeModule' => __DIR__ . '/../..' . '/src/Notice/NoticeModule.php',
        'Mollie\\WooCommerce\\PaymentMethods\\AbstractPaymentMethod' => __DIR__ . '/../..' . '/src/PaymentMethods/AbstractPaymentMethod.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Applepay' => __DIR__ . '/../..' . '/src/PaymentMethods/Applepay.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Bancontact' => __DIR__ . '/../..' . '/src/PaymentMethods/Bancontact.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Banktransfer' => __DIR__ . '/../..' . '/src/PaymentMethods/Banktransfer.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Belfius' => __DIR__ . '/../..' . '/src/PaymentMethods/Belfius.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Creditcard' => __DIR__ . '/../..' . '/src/PaymentMethods/Creditcard.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Directdebit' => __DIR__ . '/../..' . '/src/PaymentMethods/Directdebit.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Eps' => __DIR__ . '/../..' . '/src/PaymentMethods/Eps.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Giftcard' => __DIR__ . '/../..' . '/src/PaymentMethods/Giftcard.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Giropay' => __DIR__ . '/../..' . '/src/PaymentMethods/Giropay.php',
        'Mollie\\WooCommerce\\PaymentMethods\\IconFactory' => __DIR__ . '/../..' . '/src/PaymentMethods/IconFactory.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Ideal' => __DIR__ . '/../..' . '/src/PaymentMethods/Ideal.php',
        'Mollie\\WooCommerce\\PaymentMethods\\In3' => __DIR__ . '/../..' . '/src/PaymentMethods/In3.php',
        'Mollie\\WooCommerce\\PaymentMethods\\InstructionStrategies\\ApplepayInstructionStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/InstructionStrategies/ApplepayInstructionStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\InstructionStrategies\\BanktransferInstructionStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/InstructionStrategies/BanktransferInstructionStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\InstructionStrategies\\CreditcardInstructionStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/InstructionStrategies/CreditcardInstructionStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\InstructionStrategies\\DefaultInstructionStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/InstructionStrategies/DefaultInstructionStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\InstructionStrategies\\DirectdebitInstructionStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/InstructionStrategies/DirectdebitInstructionStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\InstructionStrategies\\IdealInstructionStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/InstructionStrategies/IdealInstructionStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\InstructionStrategies\\InstructionStrategyI' => __DIR__ . '/../..' . '/src/PaymentMethods/InstructionStrategies/InstructionStrategyI.php',
        'Mollie\\WooCommerce\\PaymentMethods\\InstructionStrategies\\MybankInstructionStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/InstructionStrategies/MybankInstructionStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\InstructionStrategies\\PaypalInstructionStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/InstructionStrategies/PaypalInstructionStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\InstructionStrategies\\Przelewy24InstructionStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/InstructionStrategies/Przelewy24InstructionStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\InstructionStrategies\\SofortInstructionStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/InstructionStrategies/SofortInstructionStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Kbc' => __DIR__ . '/../..' . '/src/PaymentMethods/Kbc.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Klarnapaylater' => __DIR__ . '/../..' . '/src/PaymentMethods/Klarnapaylater.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Klarnapaynow' => __DIR__ . '/../..' . '/src/PaymentMethods/Klarnapaynow.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Klarnasliceit' => __DIR__ . '/../..' . '/src/PaymentMethods/Klarnasliceit.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Mybank' => __DIR__ . '/../..' . '/src/PaymentMethods/Mybank.php',
        'Mollie\\WooCommerce\\PaymentMethods\\PaymentFieldsStrategies\\CreditcardFieldsStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/PaymentFieldsStrategies/CreditcardFieldsStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\PaymentFieldsStrategies\\DefaultFieldsStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/PaymentFieldsStrategies/DefaultFieldsStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\PaymentFieldsStrategies\\GiftcardFieldsStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/PaymentFieldsStrategies/GiftcardFieldsStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\PaymentFieldsStrategies\\IdealFieldsStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/PaymentFieldsStrategies/IdealFieldsStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\PaymentFieldsStrategies\\IssuersDropdownBehavior' => __DIR__ . '/../..' . '/src/PaymentMethods/PaymentFieldsStrategies/IssuersDropdownBehavior.php',
        'Mollie\\WooCommerce\\PaymentMethods\\PaymentFieldsStrategies\\KbcFieldsStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/PaymentFieldsStrategies/KbcFieldsStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\PaymentFieldsStrategies\\PaymentFieldsStrategyI' => __DIR__ . '/../..' . '/src/PaymentMethods/PaymentFieldsStrategies/PaymentFieldsStrategyI.php',
        'Mollie\\WooCommerce\\PaymentMethods\\PaymentMethodI' => __DIR__ . '/../..' . '/src/PaymentMethods/PaymentMethodI.php',
        'Mollie\\WooCommerce\\PaymentMethods\\PaymentMethodsIconUrl' => __DIR__ . '/../..' . '/src/PaymentMethods/PaymentMethodsIconUrl.php',
        'Mollie\\WooCommerce\\PaymentMethods\\PaymentRedirectStrategies\\BanktransferRedirectStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/PaymentRedirectStrategies/BanktransferRedirectStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\PaymentRedirectStrategies\\DefaultRedirectStrategy' => __DIR__ . '/../..' . '/src/PaymentMethods/PaymentRedirectStrategies/DefaultRedirectStrategy.php',
        'Mollie\\WooCommerce\\PaymentMethods\\PaymentRedirectStrategies\\PaymentRedirectStrategyI' => __DIR__ . '/../..' . '/src/PaymentMethods/PaymentRedirectStrategies/PaymentRedirectStrategyI.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Paypal' => __DIR__ . '/../..' . '/src/PaymentMethods/Paypal.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Paysafecard' => __DIR__ . '/../..' . '/src/PaymentMethods/Paysafecard.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Przelewy24' => __DIR__ . '/../..' . '/src/PaymentMethods/Przelewy24.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Sofort' => __DIR__ . '/../..' . '/src/PaymentMethods/Sofort.php',
        'Mollie\\WooCommerce\\PaymentMethods\\Voucher' => __DIR__ . '/../..' . '/src/PaymentMethods/Voucher.php',
        'Mollie\\WooCommerce\\Payment\\MollieObject' => __DIR__ . '/../..' . '/src/Payment/MollieObject.php',
        'Mollie\\WooCommerce\\Payment\\MollieOrder' => __DIR__ . '/../..' . '/src/Payment/MollieOrder.php',
        'Mollie\\WooCommerce\\Payment\\MollieOrderService' => __DIR__ . '/../..' . '/src/Payment/MollieOrderService.php',
        'Mollie\\WooCommerce\\Payment\\MolliePayment' => __DIR__ . '/../..' . '/src/Payment/MolliePayment.php',
        'Mollie\\WooCommerce\\Payment\\MollieSubscription' => __DIR__ . '/../..' . '/src/Payment/MollieSubscription.php',
        'Mollie\\WooCommerce\\Payment\\OrderInstructionsService' => __DIR__ . '/../..' . '/src/Payment/OrderInstructionsService.php',
        'Mollie\\WooCommerce\\Payment\\OrderItemsRefunder' => __DIR__ . '/../..' . '/src/Payment/OrderItemsRefunder.php',
        'Mollie\\WooCommerce\\Payment\\OrderLineStatus' => __DIR__ . '/../..' . '/src/Payment/OrderLineStatus.php',
        'Mollie\\WooCommerce\\Payment\\OrderLines' => __DIR__ . '/../..' . '/src/Payment/OrderLines.php',
        'Mollie\\WooCommerce\\Payment\\PartialRefundException' => __DIR__ . '/../..' . '/src/Payment/PartialRefundException.php',
        'Mollie\\WooCommerce\\Payment\\PaymentCheckoutRedirectService' => __DIR__ . '/../..' . '/src/Payment/PaymentCheckoutRedirectService.php',
        'Mollie\\WooCommerce\\Payment\\PaymentFactory' => __DIR__ . '/../..' . '/src/Payment/PaymentFactory.php',
        'Mollie\\WooCommerce\\Payment\\PaymentFieldsService' => __DIR__ . '/../..' . '/src/Payment/PaymentFieldsService.php',
        'Mollie\\WooCommerce\\Payment\\PaymentModule' => __DIR__ . '/../..' . '/src/Payment/PaymentModule.php',
        'Mollie\\WooCommerce\\Payment\\PaymentService' => __DIR__ . '/../..' . '/src/Payment/PaymentService.php',
        'Mollie\\WooCommerce\\Payment\\RefundLineItemsBuilder' => __DIR__ . '/../..' . '/src/Payment/RefundLineItemsBuilder.php',
        'Mollie\\WooCommerce\\SDK\\Api' => __DIR__ . '/../..' . '/src/SDK/Api.php',
        'Mollie\\WooCommerce\\SDK\\CouldNotConnectToMollie' => __DIR__ . '/../..' . '/src/SDK/CouldNotConnectToMollie.php',
        'Mollie\\WooCommerce\\SDK\\HttpResponse' => __DIR__ . '/../..' . '/src/SDK/HttpResponse.php',
        'Mollie\\WooCommerce\\SDK\\InvalidApiKey' => __DIR__ . '/../..' . '/src/SDK/InvalidApiKey.php',
        'Mollie\\WooCommerce\\SDK\\MollieWCIncompatiblePlatform' => __DIR__ . '/../..' . '/src/SDK/MollieWCIncompatiblePlatform.php',
        'Mollie\\WooCommerce\\SDK\\SDKModule' => __DIR__ . '/../..' . '/src/SDK/SDKModule.php',
        'Mollie\\WooCommerce\\SDK\\WordPressHttpAdapter' => __DIR__ . '/../..' . '/src/SDK/WordPressHttpAdapter.php',
        'Mollie\\WooCommerce\\SDK\\WordPressHttpAdapterPicker' => __DIR__ . '/../..' . '/src/SDK/WordPressHttpAdapterPicker.php',
        'Mollie\\WooCommerce\\Settings\\General\\MollieGeneralSettings' => __DIR__ . '/../..' . '/src/Settings/General/MollieGeneralSettings.php',
        'Mollie\\WooCommerce\\Settings\\Page\\Components' => __DIR__ . '/../..' . '/src/Settings/Page/Components.php',
        'Mollie\\WooCommerce\\Settings\\Page\\MollieSettingsPage' => __DIR__ . '/../..' . '/src/Settings/Page/MollieSettingsPage.php',
        'Mollie\\WooCommerce\\Settings\\Settings' => __DIR__ . '/../..' . '/src/Settings/Settings.php',
        'Mollie\\WooCommerce\\Settings\\SettingsComponents' => __DIR__ . '/../..' . '/src/Settings/SettingsComponents.php',
        'Mollie\\WooCommerce\\Settings\\SettingsModule' => __DIR__ . '/../..' . '/src/Settings/SettingsModule.php',
        'Mollie\\WooCommerce\\Shared\\Data' => __DIR__ . '/../..' . '/src/Shared/Data.php',
        'Mollie\\WooCommerce\\Shared\\GatewaySurchargeHandler' => __DIR__ . '/../..' . '/src/Shared/GatewaySurchargeHandler.php',
        'Mollie\\WooCommerce\\Shared\\MollieException' => __DIR__ . '/../..' . '/src/Shared/MollieException.php',
        'Mollie\\WooCommerce\\Shared\\SharedDataDictionary' => __DIR__ . '/../..' . '/src/Shared/SharedDataDictionary.php',
        'Mollie\\WooCommerce\\Shared\\SharedModule' => __DIR__ . '/../..' . '/src/Shared/SharedModule.php',
        'Mollie\\WooCommerce\\Shared\\Status' => __DIR__ . '/../..' . '/src/Shared/Status.php',
        'Mollie\\WooCommerce\\Subscription\\MaybeFixSubscription' => __DIR__ . '/../..' . '/src/Subscription/MaybeFixSubscription.php',
        'Mollie\\WooCommerce\\Subscription\\MollieSepaRecurringGateway' => __DIR__ . '/../..' . '/src/Subscription/MollieSepaRecurringGateway.php',
        'Mollie\\WooCommerce\\Subscription\\MollieSubscriptionGateway' => __DIR__ . '/../..' . '/src/Subscription/MollieSubscriptionGateway.php',
        'Mollie\\WooCommerce\\Subscription\\SubscriptionModule' => __DIR__ . '/../..' . '/src/Subscription/SubscriptionModule.php',
        'Mollie\\WooCommerce\\Uninstall\\CleanDb' => __DIR__ . '/../..' . '/src/Uninstall/CleanDb.php',
        'Mollie\\WooCommerce\\Uninstall\\UninstallModule' => __DIR__ . '/../..' . '/src/Uninstall/UninstallModule.php',
        'Psr\\Container\\ContainerExceptionInterface' => __DIR__ . '/..' . '/psr/container/src/ContainerExceptionInterface.php',
        'Psr\\Container\\ContainerInterface' => __DIR__ . '/..' . '/psr/container/src/ContainerInterface.php',
        'Psr\\Container\\NotFoundExceptionInterface' => __DIR__ . '/..' . '/psr/container/src/NotFoundExceptionInterface.php',
        'Psr\\Log\\AbstractLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/AbstractLogger.php',
        'Psr\\Log\\InvalidArgumentException' => __DIR__ . '/..' . '/psr/log/Psr/Log/InvalidArgumentException.php',
        'Psr\\Log\\LogLevel' => __DIR__ . '/..' . '/psr/log/Psr/Log/LogLevel.php',
        'Psr\\Log\\LoggerAwareInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareInterface.php',
        'Psr\\Log\\LoggerAwareTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareTrait.php',
        'Psr\\Log\\LoggerInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerInterface.php',
        'Psr\\Log\\LoggerTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerTrait.php',
        'Psr\\Log\\NullLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/NullLogger.php',
        'Psr\\Log\\Test\\DummyTest' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/DummyTest.php',
        'Psr\\Log\\Test\\LoggerInterfaceTest' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/LoggerInterfaceTest.php',
        'Psr\\Log\\Test\\TestLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/TestLogger.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit45584e3b66e1ee0947462ea27c0c0b23::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit45584e3b66e1ee0947462ea27c0c0b23::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit45584e3b66e1ee0947462ea27c0c0b23::$classMap;

        }, null, ClassLoader::class);
    }
}
