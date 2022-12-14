<?php

namespace App\Hooks\Backend;

/**
 * Class Options
 *
 * This class registers the ACF option pages
 *
 * @since      2.0
 *
 * @package    App\Hooks\Backend
 */
class Options extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		add_action( 'init', [ $this, 'themeOptionPages' ] );
	}

	/**
	 * Defines the additional ACF option pages
	 *
	 * @since    2.0
	 *
	 * @return void
	 * @internal This function uses the `init` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/init
	 *
	 */
	public function themeOptionPages() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page( [
				'page_title' => __( 'Theme options' ),
				'menu_title' => __( 'Theme options' ),
				'menu_slug'  => 'options-theme',
				'capability' => 'edit_posts',
			] );
		}

		if ( function_exists( 'acf_add_options_sub_page' ) ) {
			acf_add_options_sub_page( [
				'page_title' => __( 'General' ),
				'menu_title' => __( 'General' ),
				'menu_slug'  => 'options-theme-general',
				'parent'     => 'options-theme',
				'capability' => 'edit_posts',
			] );
		}
	}
}
