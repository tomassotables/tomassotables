<?php

namespace App\Hooks\Backend;

/**
 * Class Placeholders
 *
 * This class creates placeholder pages for archives this way we can enable
 * content on archive pages.
 *
 * @since      3.0
 *
 * @package    App\Hooks\Backend
 */
class Placeholders extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		add_filter( 'theme_page_templates', [ $this, 'addArchivePlaceholders' ], 10, 3 );
		add_action( 'template_redirect', [ $this, 'redirectToArchive' ] );
		add_filter( 'theme_page_templates', [ $this, 'addNotFoundPlaceholders' ], 10, 3 );
	}

	/**
	 * Add custom post types with archives to the page templates so we can create placeholders
	 *
	 * @since    3.0
	 *
	 * @param array     $pageTemplates Array of page templates. Keys are filenames, values are translated names
	 * @param \WP_Theme $instance      The theme object
	 * @param \WP_Post  $post          The post being edited, provided for context, or null
	 *
	 * @return array Array containing all $page_templates including new templates for archives
	 * @link     https://developer.wordpress.org/reference/hooks/theme_page_templates
	 *
	 * @internal This function uses the `theme_page_templates` filter
	 */
	public function addArchivePlaceholders( $pageTemplates, $instance, $post ) {
		if ( $post && $post->post_type != 'page' ) {
			return $pageTemplates;
		}

		$post_types = get_post_types( [ '_builtin' => false ] );

		foreach ( $post_types as $post_type ) {
			if ( ( $post_type_object = get_post_type_object( $post_type ) ) != null && $post_type_object->has_archive ) {
				$pageTemplates[ 'archive_' . $post_type ] = __( 'Archive - ' . $post_type_object->labels->singular_name );
			}
		}

		return $pageTemplates;
	}

	/**
	 * Redirect archive placeholder page to the actual archive
	 *
	 * @since    3.0
	 *
	 * @return void
	 * @internal This function uses the `template_redirect` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/template_redirect
	 */
	public function redirectToArchive() {
		if ( is_singular( 'page' ) ) {
			$template = str_replace( 'archive_', '', get_page_template_slug( get_queried_object_id() ) );
			$types = get_post_types( [ 'has_archive' => true ], 'names' );

			if ( in_array( $template, $types ) ) {
				wp_safe_redirect( get_post_type_archive_link( $template ) );
				exit();
			}
		}
	}

	/**
	 * Give users ability to customize the 404 page
	 *
	 * @since    3.0
	 *
	 * @param array     $pageTemplates Array of page templates. Keys are filenames, values are translated names
	 * @param \WP_Theme $instance      The theme object
	 * @param \WP_Post  $post          The post being edited, provided for context, or null
	 *
	 * @return array Array containing all $page_templates including the new 404 template
	 * @link     https://developer.wordpress.org/reference/hooks/theme_page_templates
	 *
	 * @internal This function uses the `theme_page_templates` filter
	 */
	public function addNotFoundPlaceholders( $pageTemplates, $instance, $post ) {
		if ( $post && $post->post_type != 'page' ) {
			return $pageTemplates;
		}

		$pageTemplates['404'] = __( '404 - Page not Found' );

		return $pageTemplates;
	}
}
