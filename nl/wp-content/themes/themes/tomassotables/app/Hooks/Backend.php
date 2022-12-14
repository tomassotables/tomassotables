<?php

namespace App\Hooks;

/**
 * Class Backend
 *
 * This class contains all setup data for the backend
 *
 * @since      1.0
 *
 * @package    App\Hooks
 */
class Backend extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		add_filter( 'theme_page_templates', [ $this, 'pageTemplates' ], 10, 3 );
		add_filter( 'theme_post_templates', [ $this, 'postTemplates' ], 10, 3 );
		add_action( 'after_setup_theme', [ $this, 'themeSetup' ] );
		add_action( 'after_switch_theme', [ $this, 'themeFlushRewrites' ] );
		add_filter( 'wp_terms_checklist_args', [ $this, 'wpTermsChecklistArgs' ] );
		add_action( 'edit_form_after_title', [ $this, 'contentEditorOnPageForPostsPage' ], 0 );
		add_action( 'admin_init', [ $this, 'hideEditor' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'wpLink' ], 999 );
		add_action( 'widgets_init', [ $this, 'removeWidgets' ] );
		add_filter( 'http_request_args', [ $this, 'disableThemeUpdates' ], 5, 2 );
		add_action( 'admin_init', [ $this, 'removeDashboardWidgets' ] );
	}

	/**
	 * Get the page templates from the views/page directory
	 *
	 * @param $pageTemplates
	 *
	 * @return mixed
	 */
	public function pageTemplates( $pageTemplates, $instance, $post ) {
		if ( $post && $post->post_type != 'page' ) {
			return $pageTemplates;
		}

		$ignored = [ '.', '..', 'home.twig', 'page.twig' ];
		$templates = scandir( get_template_directory() . '/views/page' );

		foreach ( $templates as $template ) {
			if ( ! in_array( $template, $ignored ) ) {
				$name = str_replace( '.twig', '', $template );
				$niceName = preg_split( '/(?=[A-Z])/', $name );
				$pageTemplates[ $name ] = ucfirst( implode( ' ', $niceName ) );
			}
		}

		return $pageTemplates;
	}

	/**
	 * Get the post templates from the views/post directory
	 *
	 * @param $postTemplates
	 *
	 * @return mixed
	 */
	public function postTemplates( $postTemplates, $instance, $post ) {
		if ( $post && $post->post_type != 'post' ) {
			return $postTemplates;
		}

		$ignored = [ '.', '..', 'post.twig' ];
		$templates = scandir( get_template_directory() . '/views/post' );

		foreach ( $templates as $template ) {
			if ( ! in_array( $template, $ignored ) ) {
				$name = str_replace( '.twig', '', $template );
				$niceName = preg_split( '/(?=[A-Z])/', $name );
				$postTemplates[ $name ] = ucfirst( implode( ' ', $niceName ) );
			}
		}

		return $postTemplates;
	}

	/**
	 * General theme set-up
	 *
	 * @since    1.0
	 *
	 * @return void
	 * @internal This function uses the `after_setup_theme` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
	 *
	 */
	public function themeSetup() {
		// Render shortcodes in text widgets
		add_filter( 'widget_text', 'do_shortcode' );

		// Add menus
		register_nav_menus( $this->config->menus );

		// Register language files
		load_theme_textdomain( $this->config->themeName, get_template_directory() . '/languages' );

		// Set custom content width
		global $content_width;

		$content_width = apply_filters( 'custom_content_width', $this->config->contentWidth );

		// Sidebars
		if ( $this->config->sidebars ) {
			foreach ( $this->config->sidebars as $sidebar ) {
				register_sidebar( $sidebar );
			}
		}

		// Theme support
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );

		if ( $this->config->featuredImage === true ) {
			add_theme_support( 'post-thumbnails' );
		}

		// Turn default components into HTML5
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		] );

		update_option( 'uploads_use_yearmonth_folders', 0 );
		update_option( 'timezone_string', $this->config->timezone );

		$GLOBALS['wp_rewrite']->search_base = $this->config->search->urlBase;
	}

	/**
	 * Flush the rewrites after switching themes
	 *
	 * @since    1.0
	 *
	 * @return void
	 * @internal This function uses the `after_switch_theme` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/after_switch_theme
	 *
	 */
	public function themeFlushRewrites() {
		flush_rewrite_rules();
	}

	/**
	 * Give taxonomies a nice tree structure when checked
	 *
	 * @since    2.0
	 *
	 * @param array $args Taxonomy arguments
	 *
	 * @return array Adjusted taxonomy arguments
	 * @link     https://developer.wordpress.org/reference/hooks/wp_terms_checklist_args
	 *
	 * @internal This function uses the `wp_terms_checklist_args` filter
	 */
	public function wpTermsChecklistArgs( $args ) {
		$args['checked_ontop'] = false;

		return $args;
	}

	/**
	 * Activate the default editor on the posts page
	 * Can be changed in functions.php
	 *
	 * @since    2.0
	 *
	 * @param \WP_Post $post The global post object
	 *
	 * @return void
	 * @link     https://developer.wordpress.org/reference/hooks/edit_form_after_title
	 *
	 * @internal This function uses the `edit_form_after_title` action
	 */
	public function contentEditorOnPageForPostsPage( $post ) {
		if ( $this->config->editorBlogPage ) {

			if ( $post->ID != get_option( 'page_for_posts' ) || post_type_supports( 'page', 'editor' ) ) {
				return;
			}

			remove_action( 'edit_form_after_title', '_wp_posts_page_notice' );
			add_post_type_support( 'page', 'editor' );
		}
	}

	/**
	 * Hide default editor from posts or pages
	 * Can be changed in functions.php
	 *
	 * @since    2.0
	 *
	 * @return void
	 * @internal This function uses the `admin_init` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/admin_init
	 *
	 */
	public function hideEditor() {
		if ( is_admin() && count( $this->config->hideDefaultEditor ) > 0 ) {
			if ( ! isset( $_GET['post'] ) && ! isset( $_POST['post_ID'] ) ) {
				return;
			}

			$post_id = ( isset( $_GET['post'] ) && ! empty( $_GET['post'] ) ) ? esc_attr( $_GET['post'] ) : null;

			if ( ! isset( $post_id ) ) {
				return;
			}

			$template_file = get_post_meta( $post_id, '_wp_page_template', true );

			if ( in_array( $template_file, $this->config->hideDefaultEditor ) ) {
				remove_post_type_support( 'page', 'editor' );
			}
		}
	}

	/**
	 * Overwrite the wplink javascript to add an additional checkbox `Make button`
	 * This will create <a class="button" href="#"></a>
	 *
	 * @since    2.0
	 *
	 * @param string $admin_page The admin page URL
	 *
	 * @return void
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	 *
	 * @internal This function uses the `admin_enqueue_scripts` action
	 */
	public function wpLink( $admin_page ) {
		// Only load on post edit pages.
		if ( 'post.php' !== $admin_page && 'post-new.php' !== $admin_page ) {
			return;
		}

		wp_enqueue_script( 'wplinkAdditions', $this->assets->uri( 'wpLink.js' ), [], false, true );
		wp_localize_script( 'wplinkAdditions', 'objectL10n', [
			'make_button' => __( 'Make this link a button' ),
		] );
	}

	/**
	 * Remove unused widgets
	 * The removed widgets are set in functions.php
	 *
	 * @since    2.0
	 *
	 * @return void
	 * @internal This function uses the `widgets_init` action
	 * @link     https://developer.wordpress.org/reference/hooks/widgets_init
	 *
	 */
	public function removeWidgets() {
		if ( $this->config->removedWidgets ) {
			foreach ( $this->config->removedWidgets as $widget ) {
				unregister_widget( $widget );
			}
		}
	}

	/**
	 * Disable theme updates to make sure hacks can not be applied through theme updates
	 *
	 * @since    2.0
	 *
	 * @param array  $request An array of HTTP request arguments
	 * @param string $url     The request URL
	 *
	 * @return array Filtered HTTP request.
	 * @internal This function uses the `http_request_args` filter
	 * @link     https://developer.wordpress.org/reference/hooks/http_request_args
	 *
	 */
	public function disableThemeUpdates( $request, $url ) {
		if ( strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) !== 0 ) {
			return $request;
		}

		$themes = json_decode( $request['body']['themes'] );
		$parent = get_option( 'template' );
		$child = get_option( 'stylesheet' );

		unset( $themes->themes->$parent );
		unset( $themes->themes->$child );

		$request['body']['themes'] = json_encode( $themes );

		return $request;
	}

	/**
	 * Removes unnecessary dashboard widgets
	 *
	 * @since    3.4.6
	 *
	 * @return void
	 * @internal This function uses the `admin_init` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/admin_init
	 *
	 */
	public function removeDashboardWidgets() {
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	}
}
