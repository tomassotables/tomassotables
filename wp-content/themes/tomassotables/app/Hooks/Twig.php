<?php

namespace App\Hooks;

/**
 * Class Twig
 *
 * Handles the twig logic
 *
 * @package App\Hooks
 */
class Twig extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		add_filter( 'timber/loader/loader', [ $this, 'addLoaders' ] );
		add_filter( 'timber/loader/paths', [ $this, 'addLoaderPaths' ] );
	}

	/**
	 * Add custom Twig loaders
	 *
	 * @param $loader
	 *
	 * @return \Twig\Loader\ChainLoader
	 */
	public function addLoaders( $loader ) {
		$componentLoader = new \App\Hooks\Twig\ComponentLoader();
		$chainLoader = new \Twig\Loader\ChainLoader( [ $componentLoader, $loader ] );

		return $chainLoader;
	}

	/**
	 * Add the Twig loader paths
	 *
	 * @param $paths
	 *
	 * @return array
	 */
	public function addLoaderPaths( $paths ) {
		$paths[] = get_template_directory() . '/views';
		$paths[] = get_template_directory() . '/components';

		return $paths;
	}
}
