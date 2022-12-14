<?php

namespace App\Hooks\Plugins;

/**
 * Class VisualComposer
 *
 * Does some adjustments to make it look good in the backend
 *
 * @since      3.0
 *
 * @package    WordPress
 * @subpackage App\Hooks\Plugins
 */
class VisualComposer extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		add_action( 'admin_init', [ $this, 'activateHooks' ] );
		add_action( 'vc_before_init', [ $this, 'vc_as_theme_init' ] );
		add_filter( 'vc_shortcodes_css_class', [ $this, 'vc_element_class_names' ], 10, 3 );
		add_action( 'vc_before_init', [ $this, 'activateBlocks' ] );
		add_action( 'vc_before_init', [ $this, 'vc_remove_unused_elements' ] );
		add_filter( 'vc_load_default_templates', [ $this, 'remove_default_layouts' ] );
	}

	/**
	 * Activate the hooks
	 *
	 * @return void
	 */
	public function activateHooks() {
		if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
			add_action( 'admin_enqueue_scripts', [ $this, 'vc_admin_stylesheets' ] );
			add_action( 'admin_print_footer_scripts', [ $this, 'vc_admin_composer' ] );
			add_action( 'admin_head', [ $this, 'remove_visual_composer_blocks' ] );
			add_filter( 'the_content', [ $this, 'shortcode_fixes' ] );
			add_action( 'init', [ $this, 'vc_debrand' ], 100 );
		}
	}

	/**
	 * Activate custom blocks
	 *
	 * @return void
	 */
	public function activateBlocks() {
		$blocks = scandir( get_template_directory() . '/app/Controllers/VisualComposer' );

		foreach ( $blocks as $block ) {
			if ( ! in_array( $block, [ '.', '..', 'Base.php' ] ) ) {
				$this->load( $block, 'App\Controllers\VisualComposer' );
			}
		}
	}

	/**
	 * Enqueues the admin stylesheets
	 *
	 * @since    3.0
	 *        add_action( 'admin_init', [ $this, 'activateLicense' ] );
	 * @return void
	 * @internal This function uses the `admin_enqueue_scripts` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	 *
	 */
	public function vc_admin_stylesheets() {
		wp_enqueue_style( 'visualComposer', $this->assets->uri( 'visualComposer.css' ), [], null );
	}

	/**
	 * Removes the `switch to classic mode` buttons
	 *
	 * @since    3.0
	 *
	 * @return void
	 * @internal This function uses the `admin_print_footer_scripts` action
	 * @link     https://developer.wordpress.org/reference/hooks/admin_print_footer_scripts
	 *
	 */
	public function vc_admin_composer() {
		$vc_post_types = json_encode( $this->visualComposer->postTypes );
		$vc_page_templates = json_encode( $this->visualComposer->pageTemplates );

		$this->vc_update_wpb_js_content_types();

		echo '<script type="text/javascript">';
		echo 'var vc_post_types = ' . $vc_post_types . ';';
		echo 'var vc_page_templates = ' . $vc_page_templates . ';';
		echo '</script>';
		echo '<script type="text/javascript" src="' . $this->assets->uri( 'visualComposer.js' ) . '"></script>';
	}

	/**
	 * Removes Visual Composer meta boxes
	 *
	 * @since    3.0
	 *
	 * @return void
	 * @internal This function uses the `admin_head` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	 *
	 */
	public function remove_visual_composer_blocks() {
		remove_meta_box( 'vc_teaser', 'page', 'side' );
	}

	/**
	 * Remove default layouts
	 *
	 * @since    3.0
	 *
	 * @param $data
	 *
	 * @return array
	 * @link     https://wpbakery.atlassian.net/wiki/display/VC/vc_load_default_templates
	 *
	 * @internal This function uses the `vc_load_default_templates` filter
	 */
	public function remove_default_layouts( $data ) {
		return [];
	}

	/**
	 * Fixes the <p></p> malfunction for specified shortcodes
	 *
	 * @since    3.0
	 *
	 * @param $content
	 *
	 * @return mixed
	 * @link     https://codex.wordpress.org/Plugin_API/Filter_Reference/the_content
	 *
	 * @internal This function uses the `the_content` filter
	 */
	public function shortcode_fixes( $content ) {
		$block = join( '|', $this->visualComposer->shortcodeFixes );
		$rep = preg_replace( '/(<p>)?\[(' . $block . ')(\s[^\]]+)?\](<\/p>|<br \/>)?/', '[$2$3]', $content );
		$rep = preg_replace( '/(<p>)?\[\/(' . $block . ')](<\/p>|<br \/>)?/', '[/$2]', $rep );

		return $rep;
	}

	/**
	 * Sync Visual Composer settings with theme settings
	 *
	 * @since 3.0
	 *
	 * @return void
	 */
	private function vc_update_wpb_js_content_types() {
		$vc_wpb_js_content_types = get_option( 'wpb_js_content_types' );

		if ( ! is_array( $vc_wpb_js_content_types ) ) {
			update_option( 'wpb_js_content_types', $this->visualComposer->postTypes );
		} else {
			$compare_to_admin = array_diff( $this->visualComposer->postTypes, $vc_wpb_js_content_types );
			$compare_to_string = array_diff( $vc_wpb_js_content_types, $this->visualComposer->postTypes );

			if ( count( $compare_to_admin ) > 0 || count( $compare_to_string ) > 0 ) {
				update_option( 'wpb_js_content_types', $this->visualComposer->postTypes );
			}
		}
	}

	/**
	 * Remove generator code
	 *
	 * @since    3.0
	 *
	 * @return void
	 * @internal This function uses the `init` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/init
	 *
	 */
	public function vc_debrand() {
		if ( function_exists( 'visual_composer' ) ) {
			remove_action( 'wp_head', [ visual_composer(), 'addMetaData' ] );
		}
	}

	/**
	 * Put Visual Composer in `in-theme` mode and specify shortcode folder
	 *
	 * @since    3.0
	 *
	 * @return void
	 * @internal This function uses the `vc_before_init` action
	 * @link     https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
	 *
	 */
	public function vc_as_theme_init() {
		// Updates are disabled (true) use composer instead
		vc_set_as_theme( true );

		// Set template folder
		$dir = get_template_directory() . '/components/';
		vc_set_shortcodes_templates_dir( $dir );
	}

	/**
	 * Add additional css classes to specific elements
	 *
	 * @since    3.0
	 *
	 * @param string $class_string String containing all classes
	 * @param string $element      The rendering component
	 * @param array  $params       The parameter array of the rendering component
	 *
	 * @return string Adjusted class string
	 * @link     https://wpbakery.atlassian.net/wiki/display/VC/vc_shortcodes_css_class
	 *
	 * @internal This function uses the `vc_shortcodes_css_class` filter
	 */
	public function vc_element_class_names( $class_string, $element, $params ) {
		if ( $element == 'vc_row' ) {
			if ( isset( $params['row_class'] ) && $params['row_class'] != '' ) {
				$class_string .= ' ' . $params['row_class'];
			}
		}

		if ( $element == 'vc_column_text' ) {
			$class_string .= ' vc_column_text';
		}

		return $class_string;
	}

	/**
	 * Remove un-used components
	 *
	 * @since    3.0
	 *
	 * @return void
	 * @internal This function uses the `vc_before_init` action
	 * @link     https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
	 *
	 */
	public function vc_remove_unused_elements() {
		// Remove elements
		vc_remove_element( 'vc_facebook' );
		vc_remove_element( 'vc_tweetmeme' );
		vc_remove_element( 'vc_googleplus' );
		vc_remove_element( 'vc_pinterest' );
		vc_remove_element( 'vc_toggle' );
		vc_remove_element( 'vc_images_carousel' );
		vc_remove_element( 'vc_tour' );
		vc_remove_element( 'vc_posts_grid' );
		vc_remove_element( 'vc_carousel' );
		vc_remove_element( 'vc_posts_slider' );
		vc_remove_element( 'vc_widget_sidebar' );
		vc_remove_element( 'vc_button' );
		vc_remove_element( 'vc_button2' );
		vc_remove_element( 'vc_cta_button' );
		vc_remove_element( 'vc_cta_button2' );
		vc_remove_element( 'vc_raw_js' );
		vc_remove_element( 'vc_flickr' );
		vc_remove_element( 'vc_progress_bar' );
		vc_remove_element( 'vc_pie' );
		vc_remove_element( 'vc_custom_heading' );
		vc_remove_element( 'vc_wp_search' );
		vc_remove_element( 'vc_wp_meta' );
		vc_remove_element( 'vc_wp_recentcomments' );
		vc_remove_element( 'vc_wp_calendar' );
		vc_remove_element( 'vc_wp_pages' );
		vc_remove_element( 'vc_wp_tagcloud' );
		vc_remove_element( 'vc_wp_custommenu' );
		vc_remove_element( 'vc_wp_text' );
		vc_remove_element( 'vc_wp_posts' );
		vc_remove_element( 'vc_wp_categories' );
		vc_remove_element( 'vc_wp_archives' );
		vc_remove_element( 'vc_wp_rss' );
		vc_remove_element( 'vc_basic_grid' );
		vc_remove_element( 'vc_media_grid' );
		vc_remove_element( 'vc_masonry_grid' );
		vc_remove_element( 'vc_masonry_media_grid' );
		vc_remove_element( 'vc_tta_tour' );
		vc_remove_element( 'vc_tta_pageable' );
		vc_remove_element( 'vc_tabs' );
		vc_remove_element( 'vc_accordion' );
		vc_remove_element( 'vc_acf' );
		vc_remove_element( 'vc_shortcode' );
	}
}
