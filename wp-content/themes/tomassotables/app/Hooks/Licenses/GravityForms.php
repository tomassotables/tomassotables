<?php

namespace App\Hooks\Licenses;

/**
 * Class Gravity_Forms
 *
 * Installs the license for Gravity Forms
 *
 * @since      1.0
 *
 * @package    App\Hooks\Licenses
 */
class GravityForms extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		add_action( 'admin_init', [ $this, 'activateLicense' ] );
	}

	/**
	 * Activate the Gravity Forms license when needed
	 *
	 * @return void
	 */
	public function activateLicense() {
		if ( is_plugin_active( 'gravityforms/gravityforms.php' ) ) {
			// Gravity Forms uses the `GF_LICENSE_KEY` constant to check the license
			define( 'GF_LICENSE_KEY', 'b8059c0be8cffefbab0d4c9e5bd38533' );
		}
	}
}
