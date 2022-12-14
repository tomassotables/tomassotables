<?php

namespace App\Controllers\VisualComposer;

/**
 * Class Column
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @since      3.0
 *
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class Column {
	/**
	 * Column constructor
	 *
	 * @since 3.0
	 */
	public function __construct() {
		try {
			// Set add-on name
			$reflectionClass = new \ReflectionClass( $this );
			$base = strtolower( preg_replace( '/(?<!^)[A-Z]/', '_$0', $reflectionClass->getShortName() ) );
			$this->slug = 'vc_' . strtolower( $base );

			vc_remove_param( $this->slug, 'css' );
		} catch ( \ReflectionException $error ) {
			die( $error );
		}
	}
}
