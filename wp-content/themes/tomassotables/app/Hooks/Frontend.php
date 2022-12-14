<?php

namespace App\Hooks;

/**
 * Class Frontend
 *
 * This class contains all setup data for the frontend
 *
 * @since      1.0
 *
 * @package    App\Hooks
 */
class Frontend extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		if ( ! is_admin() ) {
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueueStylesheets' ] );
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueueJavascripts' ] );
			add_filter( 'style_loader_tag', [ $this, 'cleanStyleTag' ] );
			add_filter( 'script_loader_tag', [ $this, 'cleanScriptTag' ] );
			add_filter( 'body_class', [ $this, 'cleanBodyClass' ] );
			add_filter( 'get_bloginfo_rss', [ $this, 'removeDefaultDescription' ] );
			add_filter( 'wpcf7_load_css', '__return_false' );
			remove_action( 'wp_head', 'wp_generator' );
			remove_action( 'wp_head', 'rel_canonical' );
			remove_action( 'wp_head', 'feed_links_extra', 3 );
			remove_action( 'wp_head', 'feed_links', 2 );
			remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
			remove_action( 'wp_head', 'index_rel_link' );
			remove_action( 'wp_head', 'rest_output_link_wp_head' );
			remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
			remove_action( 'wp_head', 'wp_shortlink_wp_head' );
			remove_action( 'wp_head', 'rsd_link' );
			remove_action( 'wp_head', 'wlwmanifest_link' );
			remove_action( 'admin_print_styles', 'print_emoji_styles' );
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
			remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
			remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
			remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
			add_filter( 'emoji_svg_url', '__return_false' );
			remove_action( 'template_redirect', 'redirect_canonical' );
			add_shortcode( 'wp_action_block', [ $this, 'wp_custom_action_block' ] );
		}

		/**
		 * Disable wp rocket caching when caching variable is set in URL
		 */
		if ( isset( $_GET['caching'] ) && $_GET['caching'] === 'false' ) {
			add_filter( 'do_rocket_generate_caching_files', '__return_false' );
		}
	}

	/**
	 * Loads the theme stylesheets
	 * Additional stylesheets can be added in functions.php
	 *
	 * @return void
	 * @since    1.0
	 *
	 * @internal This function uses the `wp_enqueue_scripts` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
	 *
	 */
	public function enqueueStylesheets() {
		wp_enqueue_style( 'app', $this->assets->uri( 'app.css' ), [], null );
	}

	/**
	 * Loads the theme javascripts
	 * Additional javascripts can be added in functions.php
	 *
	 * @return void
	 * @since    1.0
	 *
	 * @internal This function uses the `get_footer` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/get_footer
	 *
	 */
	public function enqueueJavascripts() {
		// Include the app.js
		wp_enqueue_script( 'app.js', $this->assets->uri( 'app.js' ), [ 'jquery' ], null, true );

		if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Clean up the output of the <style> tags
	 *
	 * @param string $input The stylesheet line
	 *
	 * @return string The cleaned stylesheet line
	 * @since    3.4.6
	 *
	 * @link     https://developer.wordpress.org/reference/hooks/style_loader_tag
	 *
	 * @internal This function uses the `style_loader_tag` filter
	 */
	public function cleanStyleTag( $input ) {
		preg_match_all( "!<link rel=\"stylesheet\"\s?(id=\"[^']+\")?\s+href=\"(.*)\" type=\"text/css\" media=\"(.*)\" />!", $input, $matches );

		if ( empty( $matches[2] ) ) {
			return $input;
		}

		// Only display media if it is meaningful
		$media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';

		return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
	}

	/**
	 * Clean up the output of the <script> tags
	 *
	 * @param string $input The javascript line
	 *
	 * @return mixed
	 * @since    3.4.6
	 *
	 * @link     https://developer.wordpress.org/reference/hooks/script_loader_tag/
	 *
	 * @internal This function uses the `script_loader_tag` filter
	 */
	public function cleanScriptTag( $input ) {
		$input = str_replace( "type='text/javascript' ", '', $input );

		return str_replace( "'", '"', $input );
	}

	/**
	 * Cleans body classes
	 *
	 * @param array $classes Array containing all classes
	 *
	 * @return array Cleaned array containing the body classes
	 * @since    3.4.6
	 *
	 * @link     https://codex.wordpress.org/Plugin_API/Filter_Reference/body_class
	 *
	 * @internal This function uses the `body_class` filter
	 */
	public function cleanBodyClass( $classes ) {
		if ( is_single() || is_page() && ! is_front_page() ) {
			if ( ! in_array( basename( get_permalink() ), $classes ) ) {
				$classes[] = basename( get_permalink() );
			}
		}

		$home_id_class  = 'page-id-' . get_option( 'page_on_front' );
		$remove_classes = [
			'page-template-default',
			$home_id_class,
		];
		$classes        = array_diff( $classes, $remove_classes );

		return $classes;
	}

	/**
	 * Don't return the default description in the RSS feed if it has not been changed
	 *
	 * @param string $bloginfo The RSS tagline
	 *
	 * @return string The cleaned RSS tagline
	 * @since    3.4.6
	 *
	 * @link     https://developer.wordpress.org/reference/hooks/get_bloginfo_rss
	 *
	 * @internal This function uses the `get_bloginfo_rss` filter
	 */
	public function removeDefaultDescription( $bloginfo ) {
		$default_tagline = 'Just another WordPress site';

		return ( $bloginfo === $default_tagline ) ? '' : $bloginfo;
	}

	/**
	 * Action Shortcode
	 */
	public function wp_custom_action_block() {
		$app_img   = get_field( 'advisor_image', 'option' );
		$app_title = get_field( 'advisor_title', 'option' );
		$app_btn   = get_field( 'advisor_button', 'option' );
		$app_text  = get_field( 'advisor_content', 'option' );

		if ( ! empty( $app_img ) || ! empty( $app_title ) || ! empty( $app_btn ) || ! empty( $app_text ) ) {
			$message = '<section data-component="appointment" class="appointment d-flex justify-content-between align-items-center">';

			if ( ! empty( $app_img ) ) {
				$message .= '<div class="appointment__image">';
				$message .= '<picture>';
				$message .= wp_get_attachment_image( $app_img['id'], 'large' );
				$message .= '</picture>';
				$message .= '</div>';
			}

			$message .= '<div class="appointment__text">';

			if ( ! empty( $app_title ) ) {
				$message .= '<h3>' . get_field( 'advisor_title', 'option' ) . '</h3>';
			}

			if ( ! empty( $app_img ) ) {
				$message .= '<div class="appointment__image appointment__image--mobile">';
				$message .= '<picture>';
				$message .= wp_get_attachment_image( $app_img['id'], 'large' );
				$message .= '</picture>';
				$message .= '</div>';
			}

			$message .= $app_text;

			if ( ! empty( $app_btn ) ) {
				$message .= '<a href="' . $app_btn['url'] . '" class="btn secondary" target="' . $app_btn['target'] . '">' . $app_btn['title'] . '</a>';
			}

			$message .= '</div>';
			$message .= '</section>';
		}

		return $message;
	}
}
