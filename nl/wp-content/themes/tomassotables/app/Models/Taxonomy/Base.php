<?php

namespace App\Models\Taxonomy;

/**
 * Class Taxonomy
 *
 * Handles the Taxonomy registration
 *
 * @package App\Models\Taxonomy
 */
abstract class Base {
	public $id;
	public $name;
	public $plural;
	public $public;
	public $connection;
	public $controller;
	public $slug;
	public $showUi;
	public $withFront;
	public $hierarchical;
	public $showInRest;
	public $showInMenu;
	public $showInNavMenus;
	public $publiclyQueryable;

	/**
	 * Taxonomy constructor
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

			if ( ! isset( $this->connection ) ) {
				throw new \Exception( get_class( $this ) . ' must have a $connection' );
			}

			if ( method_exists( $this, 'childConstruct' ) ) {
				$this->childConstruct();
			}

			if ( ! taxonomy_exists( $this->id ) ) {
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
	 * Initialize the Taxonomy
	 *
	 * @return void
	 */
	public function init() {
		register_taxonomy( $this->id, $this->connection, $this->args() );
	}

	/**
	 * Setup controllers
	 *
	 * @return bool
	 */
	public function controllers() {
		$object = get_queried_object();

		if ( ! $object || ( isset( $object->taxonomy ) && $object->taxonomy != $this->id ) || is_admin() ) {
			return false;
		}

		if ( $this->public && ( isset( $object->term_id ) && term_exists( $object->term_id ) ) && ! is_admin() ) {
			$this->taxonomyController();
		}
	}

	/**
	 * Setup fallback templates
	 *
	 * @return bool
	 */
	public function fallbackTemplates() {
		$object = get_queried_object();

		if ( ! $object || ( isset( $object->taxonomy ) && $object->taxonomy != $this->id ) || is_admin() ) {
			return false;
		}

		if ( $this->public && ( isset( $object->term_id ) && term_exists( $object->term_id ) ) && ! is_admin() ) {
			try {
				$class = 'App\\Controllers\\' . $this->classify( $this->id );
				$single = new $class();
				$single->taxonomy();
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
	 * Setup the Taxonomy controller
	 *
	 * @return void
	 */
	public function taxonomyController() {
		if ( isset( $this->controller ) ) {
			try {
				$class = 'App\\Controllers\\' . $this->controller;
				$single = new $class();
				$single->taxonomy();
			} catch ( \Exception $e ) {
				echo $e->getMessage();
			}

			exit;
		}
	}

	/**
	 * Setup the labels
	 *
	 * @return array
	 */
	protected function labels() {
		return [
			'name'              => _x( $this->plural, 'taxonomy general name' ),
			'singular_name'     => _x( $this->name, 'taxonomy singular name' ),
			'search_items'      => __( 'Search ' . $this->plural ),
			'all_items'         => __( 'All ' . $this->plural ),
			'parent_item'       => __( 'Parent ' . $this->name ),
			'parent_item_colon' => __( 'Parent ' . $this->name ),
			'edit_item'         => __( 'Edit ' . $this->name ),
			'update_item'       => __( 'Update ' . $this->name ),
			'add_new_item'      => __( 'Add New ' . $this->name ),
			'new_item_name'     => __( 'New ' . $this->name ),
			'menu_name'         => __( $this->plural ),
		];
	}

	/**
	 * Setup the argument array
	 *
	 * @return array
	 */
	protected function args() {
		$args = [
			'labels' => $this->labels(),
			'public' => $this->public,
		];

		if ( isset( $this->showUi ) ) {
			$args['show_ui'] = $this->showUi;
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

		if ( isset( $this->hierarchical ) ) {
			$args['hierarchical'] = $this->hierarchical;
		}

		if ( isset( $this->showInMenu ) ) {
			$args['show_in_menu'] = $this->showInMenu;
		}

		if ( isset( $this->showInRest ) ) {
			$args['show_in_rest'] = $this->showInRest;
		}

		if ( isset( $this->showInNavMenus ) ) {
			$args['show_in_nav_menus'] = $this->showInNavMenus;
		}

		if ( isset( $this->publiclyQueryable ) ) {
			$args['publicly_queryable'] = $this->publiclyQueryable;
		}

		return $args;
	}
}
