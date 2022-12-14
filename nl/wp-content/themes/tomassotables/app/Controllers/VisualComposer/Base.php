<?php

namespace App\Controllers\VisualComposer;

/**
 * Class Base
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @since      3.0
 *
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class Base {
	/**
	 * @since 3.0
	 *
	 * @var string The slug of the component
	 */
	protected $slug;

	/**
	 * @var string
	 */
	protected $component;

	/**
	 * @since 4.0
	 *
	 * @var array Array containing all the shortcode attributes
	 */
	protected $shortcode_definition;

	/**
	 * Shortcode constructor
	 *
	 * @since 3.0
	 */
	public function __construct() {
		try {
			// Set add-on name
			$reflectionClass = new \ReflectionClass( $this );
			$base = strtolower( preg_replace( '/(?<!^)[A-Z]/', '_$0', $reflectionClass->getShortName() ) );

			// Setup the addon
			$this->component = lcfirst( $reflectionClass->getShortName() );
			$this->slug = 'vc_' . strtolower( $base );
			$this->shortcode_definition = array_merge( $this->get_vc_map_defaults(), $this->setup() );

			// Lazy map
			vc_lean_map( $this->slug, function () {
				return $this->shortcode_definition;
			} );

			if ( ! is_admin() ) {
				add_shortcode( $this->slug, [ $this, 'output' ] );
			} else {
				$this->set_autocomplete_filters( $this->shortcode_definition['params'] );
			}
		} catch ( \ReflectionException $error ) {
			die( $error );
		}
	}

	/**
	 * Setup the shortcode
	 *
	 * @since    3.0
	 *
	 * @return array
	 * @internal This function uses the `vc_before_init` action
	 * @link     https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
	 *
	 */
	protected function setup() {
		return [];
	}

	/**
	 * Handle the shortcode output
	 *
	 * @since 3.0
	 *
	 * @param      $attributes
	 * @param null $content
	 *
	 * @return bool|string
	 * @throws \Exception
	 */
	public function output( $attributes, $content = null ) {
		$attributes = vc_map_get_attributes( $this->slug, $attributes );
		extract( $attributes );

		if ( isset( $content ) ) {
			$attributes['content'] = $this->clean_content( $content );
		}

		$output = '';
		$context = \Timber\Timber::get_context();
		$context = array_merge( $context, $attributes );

		if ( ! $this->isRest() ) {
			$output = \Timber\Timber::compile( 'components/' . $this->component, $context );
		}

		return $output;
	}

	/**
	 * Check if this is a REST API call
	 *
	 * @return bool
	 */
	public function isRest() {
		return ( defined( 'REST_REQUEST' ) && REST_REQUEST );
	}

	/**
	 * Default vc_map attributes are listed here
	 *
	 * @since 3.0
	 *
	 * @return array Array with default attributes for components
	 */
	protected function get_vc_map_defaults() {
		return [
			'base'     => $this->slug,
			'controls' => 'full',
			'icon'     => 'vc_admin_icon fa fa-plus-square',
			'category' => __( 'Content', 'js_composer' ),
		];
	}

	/**
	 * Remove stray <p> tags, which are left by wpautop
	 * Known issue with shortcodes in WP
	 *
	 * https://core.trac.wordpress.org/ticket/12061
	 */
	private function clean_content( &$content ) {
		// Opening tag
		$content = preg_replace( "/(<p>)?\[($this->slug)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]", $content );

		// closing tag
		$content = preg_replace( "/(<p>)?\[\/($this->slug)](<\/p>|<br \/>)?/", "[/$2]", $content );

		$content = shortcode_unautop( $content );

		return '<p>' . $content . '</p>';
	}

	/**
	 * Sets the autocomplete filter callbacks
	 *
	 * @param array  $params
	 * @param string $prefix
	 */
	private function set_autocomplete_filters( &$params, $prefix = '' ) {
		if ( $params ) {
			foreach ( $params as $param ) {
				if ( $param['type'] === 'param_group' ) {
					$this->set_autocomplete_filters( $param['params'], $param['param_name'] . '_' );
				}

				if ( $param['type'] === 'autocomplete' ) {
					$param_name = ( $prefix === '' ? $param['param_name'] : $prefix . $param['param_name'] );

					add_filter( 'vc_autocomplete_' . $this->slug . '_' . $param_name . '_callback', [
						$this,
						'get_' . $param['param_name'] . '_suggester',
					], 10, 1 );
					add_filter( 'vc_autocomplete_' . $this->slug . '_' . $param_name . '_render', [
						$this,
						'get_' . $param['param_name'] . '_render',
					], 10, 1 );
				}
			}
		}
	}
}
