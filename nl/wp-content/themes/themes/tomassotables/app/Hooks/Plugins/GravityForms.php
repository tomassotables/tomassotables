<?php

namespace App\Hooks\Plugins;

/**
 * Class Gravity_Forms
 *
 * Handles all Gravity Forms related hooks
 *
 * @since      2.0
 *
 * @package    App\Hooks\Plugins
 */
class GravityForms extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		add_action( 'wp_print_styles', [ $this, 'removeGformStylesheets' ] );
		add_action( 'wp_footer', [ $this, 'removeGformStylesheets' ] );
		add_filter( 'gform_init_scripts_footer', '__return_true' );
		add_filter( 'gform_get_form_filter', [ $this, 'customFormComponent' ], 10, 2 );
		add_filter( 'gform_disable_post_creation', [ $this, 'disablePostCreation' ] );
		add_filter( 'gform_submit_button', [ $this, 'formSubmitButton' ], 10, 2 );
	}

	/**
	 * Hook to make styling possible using the custom theme component loader
	 *
	 * @param $formString
	 * @param $form
	 *
	 * @return string|string[]
	 */
	public function customFormComponent( $formString, $form ) {
		$formString = str_replace( 'id=\'gform_wrapper_', 'data-component="gform" id=\'gform_wrapper_', $formString );

		return $formString;
	}

	/**
	 * Removes the default Gravity Forms stylesheets
	 * so we can write our own styling for fields
	 *
	 * @since    2.0
	 *
	 * @return void
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/wp_footer
	 *
	 * @internal This function is hooked on the `wp_print_styles` and the `wp_footer` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/wp_print_styles
	 */
	public function removeGformStylesheets() {
		wp_dequeue_style( 'gforms_reset_css' );
		wp_dequeue_style( 'gforms_formsmain_css' );
		wp_dequeue_style( 'gforms_browsers_css' );
	}

	/**
	 * Disable the temp post creation in Gravity Forms
	 *
	 * @since    2.0
	 *
	 * @return bool Always return true so this is disabled by default
	 * @internal This function is hooked on the `gform_disable_post_creation` filter
	 * @link     https://www.gravityhelp.com/documentation/article/gform_disable_post_creation
	 *
	 */
	public function disablePostCreation() {
		return true;
	}

	/**
	 * Convert the Gravity Forms input submit to a button submit
	 *
	 * @since    4.0.1
	 *
	 * @param string $button HTML string with the input submit
	 * @param array  $form   Array containing all form elements
	 *
	 * @return string HTML string with the formatted button submit
	 * @internal This function is hooked on the `gform_submit_button` filter
	 * @link     https://www.gravityhelp.com/documentation/article/gform_submit_button/
	 *
	 */
	public function formSubmitButton( $button, $form ) {
		$button = str_replace( '<input', '<button', $button );
		$button = $button . $form['button']['text'] . '</button>';

		return $button;
	}
}
