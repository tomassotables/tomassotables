<?php

namespace App\Hooks\Backend;

/**
 * Class Trackbacks
 *
 * Handles all trackbacks related hooks
 *
 * @since      3.4.6
 *
 * @package    App\Hooks\Backend
 */
class Trackbacks extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		if ( $this->config->disableTrackbacks ) {
			add_filter( 'xmlrpc_methods', [ $this, 'filterXmlrpcMethod' ], 10, 1 );
			add_filter( 'wp_headers', [ $this, 'filterHeaders' ], 10, 1 );
			add_filter( 'rewrite_rules_array', [ $this, 'filterRewrites' ] );
			add_filter( 'bloginfo_url', [ $this, 'killPingbackUrl' ], 10, 2 );
			add_action( 'xmlrpc_call', [ $this, 'killXmlrpc' ] );
		}
	}

	/**
	 * Disable pingback XMLRPC method
	 *
	 * @since    3.4.6
	 *
	 * @param array $methods Available methods
	 *
	 * @return array Array without the pingback.ping method
	 * @link     https://codex.wordpress.org/XML-RPC_Extending
	 *
	 * @internal This function uses the `xmlrpc_methods` filter
	 */
	public function filterXmlrpcMethod( $methods ) {
		unset( $methods['pingback.ping'] );

		return $methods;
	}

	/**
	 * Remove pingback header
	 *
	 * @since    3.4.6
	 *
	 * @param array $headers Array containing headers
	 *
	 * @return array Array without pingback headers
	 * @link     https://developer.wordpress.org/reference/hooks/wp_headers
	 *
	 * @internal This function uses the `wp_headers` filter
	 */
	public function filterHeaders( $headers ) {
		if ( isset( $headers['X-Pingback'] ) ) {
			unset( $headers['X-Pingback'] );
		}

		return $headers;
	}

	/**
	 * Kill trackback rewrite rule
	 *
	 * @since    3.4.6
	 *
	 * @param array $rules Array containing rewrite rules
	 *
	 * @return array Array without trackback rewrite rules
	 * @link     https://codex.wordpress.org/Plugin_API/Filter_Reference/rewrite_rules_array
	 *
	 * @internal This function uses the `rewrite_rules_array` filter
	 */
	public function filterRewrites( $rules ) {
		foreach ( $rules as $rule => $rewrite ) {
			if ( preg_match( '/trackback\/\?\$$/i', $rule ) ) {
				unset( $rules[ $rule ] );
			}
		}

		return $rules;
	}

	/**
	 * Kill bloginfo('pingback_url')
	 *
	 * @since    3.4.6
	 *
	 * @param string $output The output of the requested option
	 * @param string $show   The name of the option to show
	 *
	 * @return string Empty string when pingback_url is requested
	 * @internal This function uses the `bloginfo_url` filter
	 * @link     https://developer.wordpress.org/reference/hooks/bloginfo_url
	 *
	 */
	public function killPingbackUrl( $output, $show ) {
		if ( $show === 'pingback_url' ) {
			$output = '';
		}

		return $output;
	}

	/**
	 * Disable XMLRPC call
	 *
	 * @since    3.4.6
	 *
	 * @param string $action The XMLRPC action call
	 *
	 * @return void
	 * @link     https://developer.wordpress.org/reference/hooks/xmlrpc_call
	 *
	 * @internal This function uses the `xmlrpc_call` action
	 */
	public function killXmlrpc( $action ) {
		if ( $action === 'pingback.ping' ) {
			wp_die( 'Pingbacks are not supported', 'Not Allowed!', [ 'response' => 403 ] );
		}
	}
}
