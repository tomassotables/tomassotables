<?php

namespace App\Models\PostType;

/**
 * Class Base
 *
 * Handle the Post Type registration
 *
 * @package App\Models\PostType
 */
abstract class Base {
	public $id;
	public $name;
	public $plural;
	public $public;
	public $hasArchive;
	public $controller;
	public $slug;
	public $showUi;
	public $queryVar;
	public $withFront;
	public $capabilityType;
	public $hierarchical;
	public $menuPosition;
	public $menuIcon;
	public $supports;
	public $showInMenu;
	public $showInNavMenus;
	public $showInRest;
	public $excludeFromSearch;
	public $publiclyQueryable;

	/**
	 * Base constructor
	 */
	final public function __construct() {
		try {
			if ( ! isset( $this->id ) ) {
				throw new \Exception( get_class( $this ) . ' must have a $id' );
			}

			if ( ! isset( $this->name ) ) {
				throw new \Exception( get_class( $this ) . ' must have a $name' );
			}

			if ( ! isset( $this->plural ) ) {
				throw new \Exception( get_class( $this ) . ' must have a $plural' );
			}

			if ( ! isset( $this->public ) ) {
				throw new \Exception( get_class( $this ) . ' must have a $public' );
			}

			if ( ! isset( $this->hasArchive ) ) {
				throw new \Exception( get_class( $this ) . ' must have a $has_archive' );
			}

			if ( method_exists( $this, 'childConstruct' ) ) {
				$this->childConstruct();
			}

			if ( ! post_type_exists( $this->id ) ) {
				add_action( 'init', [ $this, 'init' ], 5 );
				if ( isset( $this->controller ) ) {
					add_action( 'template_redirect', [ $this, 'controllers' ], 1 );
				} else {
					add_action( 'wp', [ $this, 'fallbackTemplates' ] );
				}
			}
		} catch ( \Exception $error ) {
			die( $error );
		}
	}

	/**
	 * Init the Post Type
	 *
	 * @return void
	 */
	public function init() {
		register_post_type( $this->id, $this->args() );
	}

	/**
	 * Set up controllers
	 *
	 * @return bool
	 */
	public function controllers() {
		global $post;

		if ( ! $post || $post->post_type != $this->id || is_tax() || is_admin() ) {
			return false;
		}

		if ( $this->public && is_single() && ! is_admin() ) {
			$this->singleController();
		}

		if ( $this->hasArchive && is_archive() && ! is_tax() && ! is_admin() ) {
			$this->archiveController();
		}
	}

	/**
	 * Setup fallback templates
	 *
	 * @return bool
	 */
	public function fallbackTemplates() {
		global $post;

		if ( ! $post || $post->post_type != $this->id || is_tax() || is_admin() ) {
			return false;
		}

		if ( $this->public && is_single() && ! is_admin() ) {
			try {
				$class = 'App\\Controllers\\' . $this->classify( $this->id );
				( new $class() )->post();
			} catch ( \Exception $e ) {
				echo $e->getMessage();
			}

			exit;
		}

		if ( $this->hasArchive && is_archive() && ! is_tax() && ! is_admin() ) {
			try {
				$class = 'App\\Controllers\\' . $this->classify( $this->id );
				( new $class() )->archive();
			} catch ( \Exception $e ) {
				echo $e->getMessage();
			}

			exit;
		}
	}

	/**
	 * Classify a word
	 *
	 * @param $word
	 *
	 * @return string|string[]
	 */
	private function classify( $word ) {
		return str_replace( ' ', '', ucwords( strtr( $word, '_-', '  ' ) ) );
	}

	/**
	 * Setup single controller
	 *
	 * @return void
	 */
	public function singleController() {
		if ( isset( $this->controller ) ) {
			try {
				$class = 'App\\Controllers\\' . $this->controller;
				$single = new $class();
				$single->view();
			} catch ( \Exception $e ) {
				echo $e->getMessage();
			}

			exit;
		}
	}

	/**
	 * Setup archive controller
	 *
	 * @return void
	 */
	public function archiveController() {
		if ( isset( $this->controller ) ) {
			try {
				$class = 'App\\Controllers\\' . $this->controller;
				$archive = new $class();
				$archive->archive();
			} catch ( \Exception $e ) {
				echo $e->getMessage();
			}

			exit;
		}
	}

	/**
	 * Setup labels
	 *
	 * @return array
	 */
	protected function labels() {
		return [
			'name'               => _x( $this->plural, 'post type general name' ),
			'singular_name'      => _x( $this->name, 'post type singular name' ),
			'add_new'            => _x( 'Add New', $this->name ),
			'add_new_item'       => __( 'Add New ' . $this->name ),
			'edit_item'          => __( 'Edit ' . $this->name ),
			'new_item'           => __( 'New ' . $this->name ),
			'view_item'          => __( 'View ' . $this->name ),
			'search_items'       => __( 'Search ' . $this->plural ),
			'not_found'          => __( 'No ' . $this->plural . ' found' ),
			'not_found_in_trash' => __( 'No ' . $this->plural . ' found in Trash' ),
			'parent_item_colon'  => 'Parent:',
		];
	}

	/**
	 * Setup argument query
	 *
	 * @return array
	 */
	protected function args() {
		$args = [
			'labels'      => $this->labels(),
			'public'      => $this->public,
			'has_archive' => $this->hasArchive,
		];

		if ( isset( $this->showUi ) ) {
			$args['show_ui'] = $this->showUi;
		}

		if ( isset( $this->queryVar ) ) {
			$args['query_var'] = $this->queryVar;
		}

		if ( isset( $this->slug ) || isset( $this->withFront ) ) {
			$rewrite = [];

			if ( isset( $this->slug ) ) {
				$rewrite['slug'] = $this->slug;
			}

			if ( isset( $this->withFront ) ) {
				$rewrite['with_front'] = $this->withFront;
			}

			if ( isset( $this->hierarchical ) ) {
				$rewrite['hierarchical'] = $this->hierarchical;
			}

			$args['rewrite'] = $rewrite;
		}

		if ( isset( $this->capabilityType ) ) {
			$args['capability_type'] = $this->capabilityType;
		}

		if ( isset( $this->hierarchical ) ) {
			$args['hierarchical'] = $this->hierarchical;
		}

		if ( isset( $this->menuPosition ) ) {
			$args['menu_position'] = $this->menuPosition;
		}

		if ( isset( $this->supports ) && count( $this->supports ) > 0 ) {
			$args['supports'] = $this->supports;
		}

		if ( isset( $this->showInMenu ) ) {
			$args['show_in_menu'] = $this->showInMenu;
		}

		if ( isset( $this->showInNavMenus ) ) {
			$args['show_in_nav_menus'] = $this->showInNavMenus;
		}

		if ( isset( $this->showInRest ) ) {
			$args['show_in_rest'] = $this->showInRest;
		}

		if ( isset( $this->excludeFromSearch ) ) {
			$args['exclude_from_search'] = $this->excludeFromSearch;
		}

		if ( isset( $this->publiclyQueryable ) ) {
			$args['publicly_queryable'] = $this->publiclyQueryable;
		}

		if ( isset( $this->menuIcon ) ) {
			$args['menu_icon'] = $this->menuIcon;
		}

		return $args;
	}
}
