<?php

namespace App\Controllers;

/**
 * Class Controller
 *
 * Default Controller logic for pages and posts
 *
 * @package App\Controllers
 */
class Base {
	/**
	 * @var array
	 */
	public $context;

	/**
	 * @var mixed
	 */
	public $view = false;

	/**
	 * @var string
	 */
	private $className;

	/**
	 * Controller constructor
	 */
	public function __construct() {
		$this->context = \Timber\Timber::get_context();
		$this->className = get_class( $this );

		$this->_setDefaultView();
	}

	public function addContext( $key, $value ) {
		$this->context[ $key ] = $value;
	}

	/**
	 * Render the correct twig template
	 *
	 * @param $templateName
	 *
	 * @return void
	 */
	public function render( $templateName ) {
		$template = 'views/' . $templateName . '.twig';

		\Timber\Timber::render( $template, $this->context );
	}

	/**
	 * Render the Twig view
	 *
	 * @param bool $view
	 *
	 * @return void
	 */
	public function view( $view = false ) {
		if ( $view ) {
			$this->setView( $view );
		}

		if ( $this->view ) {
			$this->render( $this->view );
		}
	}

	/**
	 * Set the view
	 *
	 * @param $view
	 *
	 * @return mixed
	 */
	public function setView( $view ) {
		$this->view = $view;

		return $this->view;
	}

	/**
	 * Set the default view
	 *
	 * @return void
	 */
	private function _setDefaultView() {
		$template = false;

		if ( $this->className === 'App\Controllers\NotFound' ) {
			$this->setView( 'layout/error' );
		} else if ( $this->className === 'App\Controllers\Page' ) {
			if ( is_front_page() ) {
				$template = 'home';
			} else {
				$template = $this->getPost()->_wp_page_template;
			}

			if ( ! $template || $template === 'default' ) {
				$template = 'page';
			}

			$this->setView( 'page/' . $template );
		} else if ( $this->className === 'App\Controllers\Post' ) {
			$template = $this->getPost()->_wp_page_template;

			if ( ! $template || $template === 'default' ) {
				$template = 'post';
			}

			$this->setView( 'post/' . $template );
		} else if ( $this->className === 'App\Controllers\Search' ) {
			$this->setView( 'layout/search' );
		}
	}

	/**
	 * Get a specific post
	 *
	 * @param null $arg
	 *
	 * @return bool|\Timber\Post
	 */
	public function getPost( $arg = null ) {
		if ( is_null( $arg ) ) {
			return new \Timber\Post();
		}

		if ( is_array( $arg ) ) {
			return \Timber\Timber::get_post( $arg );
		}

		return new \Timber\Post( $arg );
	}

	/**
	 * Get posts by arguments
	 *
	 * @param $args
	 *
	 * @return array|bool|null
	 */
	public function getPosts( $args ) {
		return \Timber\Timber::get_posts( $args );
	}

	/**
	 * Get a menu from Timber
	 *
	 * @param $id
	 *
	 * @return \Timber\Menu
	 */
	public function getMenu( $id ) {
		return new \Timber\Menu( $id );
	}

	/**
	 * Get a specific product
	 *
	 * @param null $arg
	 *
	 * @return bool|\Timber\Post
	 */
	public function getProduct( $arg = null ) {
		$product = null;

		if ( is_null( $arg ) ) {
			$product = new \Timber\Post();
		} else if ( is_array( $arg ) ) {
			$product = \Timber\Timber::get_post( $arg );
		} else {
			$product = new \Timber\Post( $arg );
		}

		if ( $product ) {
			return wc_get_product( $product->ID );
		}
	}
}
