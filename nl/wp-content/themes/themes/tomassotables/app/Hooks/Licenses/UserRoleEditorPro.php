<?php

namespace App\Hooks\Licenses;

/**
 * Class User_Role_Editor_Pro
 *
 * Installs the license for User Role Editor Pro
 *
 * @since      1.0
 *
 * @package    App\Hooks\Licenses
 */
class UserRoleEditorPro extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		add_action( 'admin_init', [ $this, 'activateLicense' ] );
	}

	/**
	 * Activate the User Role Editor license when needed
	 *
	 * @return void
	 */
	public function activateLicense() {
		if ( is_plugin_active( 'user-role-editor-pro/user-role-editor-pro.php' ) ) {
			$this->_ure_activate();
		}
	}

	/**
	 * Check for the activation option and if it's
	 * not already activated let's active it.
	 *
	 * @since 1.0
	 *
	 * @return void
	 */
	private function _ure_activate() {
		$ure_settings = get_option( 'user_role_editor' );
		$license_key = '33a54d448d855e298c9cfdc30e139ff23949169ec73891a867d64daa1d1f3f18';

		if ( $ure_settings !== false && ( ! isset( $ure_settings['license_key'] ) || empty( $ure_settings['license_key'] ) ) ) {
			$license_settings = [
				'license_key'  => $license_key,
				'install_hash' => $this->_calc_install_hash( $license_key ),
			];

			$update_settings = array_merge( $ure_settings, $license_settings );

			update_option( 'user_role_editor', $update_settings );
		}
	}

	/**
	 * Calculate the install hash based on the license key
	 *
	 * @since 1.0
	 *
	 * @param string $license_key The license key
	 *
	 * @return string The calculated install hash
	 */
	private function _calc_install_hash( $license_key ) {
		$value = md5( $license_key . '-' . ABSPATH . '-' . DB_HOST . '-' . DB_NAME );

		return $value;
	}
}
