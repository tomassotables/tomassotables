<?php

namespace App\Hooks;

/**
 * Class App
 *
 * Handles all the App hooks
 *
 * @package App\Hooks
 */
class App extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		$this->activateModels();

		add_filter( 'archive_template', [ $this, 'overrideArchiveTemplates' ] );
		add_filter( 'page_template', [ $this, 'overridePageTemplates' ] );
		add_filter( 'single_template', [ $this, 'overridePostTemplates' ] );
		add_filter( 'template_include', [ $this, 'overrideSearchTemplates' ] );
		add_filter( 'template_include', [ $this, 'overridePostsTemplates' ] );
		add_action( 'template_redirect', [ $this, 'customRedirects' ], 11 );
	}

	/**
	 * Activate models
	 *
	 * @return void
	 */
	public function activateModels() {
		$postTypes = scandir( get_template_directory() . '/app/Models/PostType' );
		$this->loadModels( $postTypes, 'App\Models\PostType' );

		$taxonomies = scandir( get_template_directory() . '/app/Models/Taxonomy' );
		$this->loadModels( $taxonomies, 'App\Models\Taxonomy' );

		$widgets = scandir( get_template_directory() . '/app/Models/Widget' );
		$this->loadModels( $widgets, 'App\Models\Widget' );
	}

	/**
	 * Load the models
	 *
	 * @param $models
	 * @param $namespace
	 *
	 * @return void
	 */
	public function loadModels( $models, $namespace ) {
		foreach ( $models as $model ) {
			if ( ! in_array( $model, [ '.', '..', 'Base.php', '.DS_Store' ] ) ) {
				$this->load( $model, $namespace );
			}
		}
	}

	/**
	 * Override the posts template
	 *
	 * @return void
	 */
	public function overridePostsTemplates() {
		( new \App\Controllers\Post() )->post();
		exit;
	}

	/**
	 * Override the search template
	 *
	 * @return void
	 */
	public function overrideSearchTemplates() {
		( new \App\Controllers\Search() )->view();
		exit;
	}

	/**
	 * Override the post template
	 *
	 * @param $template
	 *
	 * @return mixed
	 */
	public function overridePostTemplates( $template ) {
		if ( $template === '' || basename( $template ) == 'single.php' ) {
			( new \App\Controllers\Post() )->post();
			exit;
		}

		return $template;
	}

	/**
	 * Override the archive template
	 *
	 * @param $template
	 *
	 * @return mixed
	 */
	public function overrideArchiveTemplates( $template ) {
		if ( $template === '' || basename( $template ) == 'archive.php' ) {
			( new \App\Controllers\Post() )->archive();
			exit;
		}

		return $template;
	}

	/**
	 * Override the page template
	 *
	 * @param $template
	 *
	 * @return mixed
	 */
	public function overridePageTemplates( $template ) {
		if ( $template === '' || basename( $template ) == 'page.php' ) {
			( new \App\Controllers\Page() )->page();
			exit;
		}

		return $template;
	}

	/**
	 * Get the current URL
	 *
	 * @return string
	 */
	private function _current_url() {
		if ( isset( $_SERVER['REQUEST_URI'] ) ) {
			$protocol = ( ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) || $_SERVER['SERVER_PORT'] == 443 ) ? "https://" : "http://";

			return rtrim( $protocol . $_SERVER['HTTP_HOST'] . strtok( $_SERVER['REQUEST_URI'], '?' ), '/' );
		}
	}

	/**
	 * Get the home URL
	 *
	 * @return string
	 */
	private function _home_url() {
		if ( home_url() != $this->_current_url() ) {
			if ( class_exists( 'Polylang' ) ) {
				return rtrim( pll_home_url(), '/' );
			} else {
				return rtrim( home_url(), '/' );
			}
		} else {
			return rtrim( home_url(), '/' );
		}
	}

	/**
	 * Handle the custom redirects
	 *
	 * @return void
	 */
	public function customRedirects() {
		global $post;

		if ( is_404() ) {
			( new \App\Controllers\NotFound() )->view();
			exit;
		} else if ( is_front_page() && $this->_home_url() == $this->_current_url() ) {
			( new \App\Controllers\Page() )->home();
			exit;
		} else if ( is_home() ) {
			( new \App\Controllers\Post() )->archive();
			exit;
		} else if ( is_product() ) {
			( new \App\Controllers\Product() )->product();
			exit;
		} else if ( is_product_category() ) {
			( new \App\Controllers\Product() )->category();
			exit;
		} else if ( is_shop() ) {
			( new \App\Controllers\Product() )->archive();
			exit;
		} else if ( is_search() ) {
			( new \App\Controllers\Search() )->view();
			exit;
		} else if ( isset( $post ) && $post->post_type === 'page' ) {
			$template = get_page_template_slug( $post );

			if ( $template ) {
				$page = new \App\Controllers\Page;

				if ( method_exists( $page, $template ) ) {
					$page->$template();
					exit;
				}
			}
		} else if ( is_front_page() || is_page_template( '404' ) ) {
			global $wp_query;

			$wp_query->set_404();

			( new \App\Controllers\NotFound() )->view();
			exit;
		}
	}
}
