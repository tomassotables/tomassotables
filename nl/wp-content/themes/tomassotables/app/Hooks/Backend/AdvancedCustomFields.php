<?php

namespace App\Hooks\Backend;

/**
 * Class AdvancedCustomFields
 *
 * Handles all base ACF related hooks
 *
 * @since      3.0
 *
 * @package    App\Hooks\Backend
 */
class AdvancedCustomFields extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		add_filter( 'acf/settings/remove_wp_meta_box', '__return_false' );
		add_filter( 'acf/settings/save_json', [ $this, 'acfJsonSavePoint' ] );
		add_filter( 'acf/settings/load_json', [ $this, 'acfJsonLoadPoint' ] );
		add_action( 'acf/init', [ $this, 'googleApiKey' ] );
	}

	/**
	 * Update the ACF json saving path
	 *
	 * @since    3.0
	 *
	 * @param string $path The path to the JSON save point
	 *
	 * @return string The adjusted path
	 * @link     https://www.advancedcustomfields.com/resources/local-json
	 *
	 * @internal This function uses the `acf/settings/save_json` filter
	 */
	public function acfJsonSavePoint( $path ) {
		$path = get_template_directory() . '/app/Config/fields';

		return $path;
	}

	/**
	 * Update the ACF json loading path
	 *
	 * @since    3.0
	 *
	 * @param array $paths Array containing JSON paths
	 *
	 * @return array Adjusted array including custom path
	 * @link     https://www.advancedcustomfields.com/resources/local-json
	 *
	 * @internal This function uses the `acf/settings/load_json` filter
	 */
	public function acfJsonLoadPoint( $paths ) {
		// Add custom path
		$paths[] = get_template_directory() . '/app/Config/fields';

		return $paths;
	}

	/**
	 * It may be necessary to register a Google API key in order to allow the Google API to load correctly.
	 * The API key can be set in the Theme options
	 *
	 * @since    3.0
	 *
	 * @return void
	 * @internal This function uses the `acf/init` action
	 * @link     https://www.advancedcustomfields.com/resources/acfinit
	 *
	 */
	public function googleApiKey() {
		acf_update_setting( 'google_api_key', get_field( 'google_api_key', 'option' ) );
	}
}
