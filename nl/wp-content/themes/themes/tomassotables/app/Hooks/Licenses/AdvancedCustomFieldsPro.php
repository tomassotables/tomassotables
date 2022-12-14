<?php

namespace App\Hooks\Licenses;

/**
 * Class AdvancedCustomFieldsPro
 *
 * Installs the license for Advanced Custom Fields Pro
 *
 * @since      1.0
 *
 * @package    App\Hooks\Licenses
 */
class AdvancedCustomFieldsPro extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		add_action( 'admin_init', [ $this, 'activateLicense' ] );
	}

	/**
	 * Activate the ACF license when needed
	 *
	 * @return bool
	 */
	public function activateLicense() {
		if ( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
			$data = $this->_acf_get_license( true );
			$url = get_bloginfo( 'url' );

			if ( ! empty( $data['url'] ) && ! empty( $data['key'] ) && $data['url'] == $url ) {
				return true;
			}

			$this->_activate();
		}
	}

	/**
	 * Get the current license
	 *
	 * @since 1.0
	 *
	 * @param bool $all Fetch all licenses
	 *
	 * @return bool|array Either an array containing license variables or false
	 */
	private function _acf_get_license( $all = false ) {
		$data = get_option( 'acf_pro_license' );
		$data = base64_decode( $data );

		if ( is_serialized( $data ) ) {
			$data = maybe_unserialize( $data );

			if ( ! $all ) {
				$data = $data['key'];
			}

			return $data;
		}

		return false;
	}

	/**
	 * Activate ACF using their own server
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	private function _activate() {
		$args = [
			'_nonce'      => wp_create_nonce( 'activate_pro_licence' ),
			'acf_license' => 'b3JkZXJfaWQ9MzYzNDJ8dHlwZT1kZXZlbG9wZXJ8ZGF0ZT0yMDE0LTA4LTAxIDA2OjQ1OjQy',
			'acf_version' => acf_get_setting( 'version' ),
			'wp_name'     => get_bloginfo( 'name' ),
			'wp_url'      => get_bloginfo( 'url' ),
			'wp_version'  => get_bloginfo( 'version' ),
			'wp_language' => get_bloginfo( 'language' ),
			'wp_timezone' => get_option( 'timezone_string' ),
		];

		if ( function_exists( 'acf_pro_get_remote_response' ) ) {
			$response = acf_pro_get_remote_response( 'activate-license', $args );

			if ( empty( $response ) ) {
				acf_add_admin_notice( __( '<b>Connection Error</b>. Sorry, please try again', 'acf' ), 'error' );

				return;
			}

			// Variables
			$response = json_decode( $response, true );

			if ( $response['status'] == 1 ) {
				acf_pro_update_license( $response['license'] );
			}
		}
	}
}
