<?php

namespace App\Hooks\Twig;

use Twig\Error\LoaderError;
use Twig\Source;

/**
 * Class ComponentLoader
 *
 * The component loader class for twig
 *
 * @package App\Hooks\Twig
 */
class ComponentLoader implements \Twig\Loader\LoaderInterface {
	/**
	 * @var array
	 */
	private $components = [];

	/**
	 * ComponentLoader constructor
	 *
	 */
	public function __construct() {
		$components = scandir( get_template_directory() . '/components' );

		foreach ( $components as $component ) {
			if ( $component !== '.' && $component !== '..' ) {
				$this->components[ 'components/' . $component ] = get_template_directory() . '/components/' . $component . '/' . $component . '.twig';
			}
		}
	}

	/**
	 * Get the template source context
	 *
	 * @param string $name
	 *
	 * @return \Twig\Source
	 * @throws \Twig\Error\LoaderError
	 */
	public function getSourceContext( $name ) {
		$name = (string) $name;

		if ( ! isset( $this->components[ $name ] ) ) {
			throw new LoaderError( sprintf( 'Template "%s" is not defined.', $name ) );
		}

		return new Source( file_get_contents( $this->components[ $name ] ), $name, $this->components[ $name ] );
	}

	/**
	 * Check if template exists
	 *
	 * @param string $name
	 *
	 * @return bool
	 */
	public function exists( $name ) {
		return isset( $this->components[ $name ] );
	}

	/**
	 * Fetch the cache key
	 *
	 * @param string $name
	 *
	 * @return string
	 * @throws \Twig\Error\LoaderError
	 */
	public function getCacheKey( $name ) {
		if ( ! isset( $this->components[ $name ] ) ) {
			throw new LoaderError( sprintf( 'Template "%s" is not defined.', $name ) );
		}

		return $name . ':' . $this->components[ $name ];
	}

	/**
	 * Check if cache for template is fresh
	 *
	 * @param string $name
	 * @param int    $time
	 *
	 * @return bool
	 * @throws \Twig\Error\LoaderError
	 */
	public function isFresh( $name, $time ) {
		if ( ! isset( $this->components[ $name ] ) ) {
			throw new LoaderError( sprintf( 'Template "%s" is not defined.', $name ) );
		}

		return true;
	}
}
