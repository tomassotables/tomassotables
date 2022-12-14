<?php

namespace App\Hooks\Frontend;

/**
 * Class NavMenu
 *
 * Cleans the wp_nav_menu() function
 *
 * @since      3.4.6
 *
 * @package    WordPress
 * @subpackage App\Hooks\Frontend
 */
class NavMenu extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		add_filter( 'nav_menu_css_class', [ $this, 'cleanupNavWalker' ], 10, 2 );
		add_filter( 'nav_menu_item_id', '__return_null' );
	}

	/**
	 * Cleans the menu and fixes active state for custom post type archives
	 *
	 * @since    3.4.6
	 *
	 * @param array    $classes Array containing classes
	 * @param \WP_Post $item    Object containing all menu item options
	 *
	 * @return array Cleaned array with classes
	 * @internal This function uses the `nav_menu_css_class` filter
	 * @link     https://codex.wordpress.org/Plugin_API/Filter_Reference/nav_menu_css_class
	 *
	 */
	public function cleanupNavWalker( $classes, $item ) {
		$slug = sanitize_title( $item->title );

		// Fix core `active` behavior for custom post types
		if ( in_array( get_post_type(), get_post_types( [ '_builtin' => false ] ) ) ) {
			$classes = str_replace( 'current_page_parent', '', $classes );
			if ( get_post_type_archive_link( get_post_type() ) == strtolower( trim( $item->url ) ) ) {
				$classes[] = 'is-active';
			}
		}

		// Remove most core classes
		$classes = preg_replace( '/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'is-active', $classes );
		$classes = preg_replace( '/^((menu|page)[-_\w+]+)+/', '', $classes );

		// Add parent class
		if ( $item->is_subitem ) {
			$classes[] = 'has-children';
		}

		// Add `menu-<slug>` class
		$classes[] = 'menu-' . $slug;
		$classes = array_unique( $classes );
		$classes = array_map( 'trim', $classes );

		return array_filter( $classes );
	}
}
