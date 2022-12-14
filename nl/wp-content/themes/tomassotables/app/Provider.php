<?php

namespace App;

/**
 * Class Provider
 *
 * Provides all configs etc to other classes
 *
 * @package App
 */
class Provider {
	/**
	 * @var object
	 */
	protected $config;

	/**
	 * @var object
	 */
	protected $editor;

	/**
	 * @var object
	 */
	protected $visualComposer;

	/**
	 * @var object
	 */
	protected $assets;

	/**
	 * Provider constructor
	 *
	 * @param $config
	 */
	public function __construct() {
		$this->config = new \App\Config\App;
		$this->editor = new \App\Config\Editor;
		$this->visualComposer = new \App\Config\VisualComposer;
		$this->assets = new \App\Assets( $this->config );

		if ( method_exists( $this, 'initialize' ) && is_callable( [ $this, 'initialize' ] ) ) {
			$this->initialize();
		}
	}

	/**
	 * Load additional classes
	 *
	 * @param $file
	 * @param $namespace
	 *
	 * @return void
	 */
	public function load( $file, $namespace ) {
		$className = basename( $file, '.php' );
		$class = $namespace . '\\' . $className;
		$exclude = [ '.DS_Store' ];

		if ( ! in_array( $class, $exclude ) ) {
			new $class();
		}
	}

	/**
	 * Check if this is a REST API call
	 *
	 * @return bool
	 */
	public function isRest() {
		return ( defined( 'REST_REQUEST' ) && REST_REQUEST );
	}
}
