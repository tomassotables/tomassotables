<?php

namespace App\Hooks\Frontend;

/**
 * Class Search
 *
 * Enables a nice search URL
 *
 * @since      3.4.6
 *
 * @package    WordPress
 * @subpackage App\Hooks\Frontend
 */
class Search extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		if ( $this->config->search->niceUrl ) {
			add_action( 'template_redirect', [ $this, 'redirect' ] );
			add_filter( 'wpseo_json_ld_search_url', [ $this, 'rewrite' ] );
		}
	}

	/**
	 * Redirects search results from /?s=query to /search/query/, converts %20 to +
	 *
	 * @since    3.4.6
	 *
	 * @return void
	 * @internal This function uses the `template_redirect` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/template_redirect
	 *
	 */
	public function redirect() {
		global $wp_rewrite;

		if ( ! isset( $wp_rewrite ) || ! is_object( $wp_rewrite ) || ! $wp_rewrite->get_search_permastruct() ) {
			return;
		}

		$search_base = $wp_rewrite->search_base;

		if ( is_search() && ! is_admin() && strpos( $_SERVER['REQUEST_URI'], "/{$search_base}/" ) === false && strpos( $_SERVER['REQUEST_URI'], '&' ) === false ) {
			wp_redirect( get_search_link() );
			exit();
		}
	}

	/**
	 * Rewrites search URL
	 *
	 * @since    3.4.6
	 *
	 * @param string $url The old search URL
	 *
	 * @return string The new search URL
	 * @link     http://hookr.io/filters/wpseo_json_ld_search_url
	 *
	 * @internal This function uses the `wpseo_json_ld_search_url` filter
	 */
	public function rewrite( $url ) {
		return str_replace( '/?s=', '/' . $this->config->search->urlBase . '/', $url );
	}
}
