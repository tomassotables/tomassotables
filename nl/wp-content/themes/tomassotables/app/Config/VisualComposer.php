<?php

namespace App\Config;

/**
 * Class VisualComposer
 *
 * The Visual Composer config
 *
 * @since      5.0
 *
 * @package    App\Config
 */
class VisualComposer {
	public $postTypes;
	public $pageTemplates;

	/**
	 * VisualComposer constructor
	 */
	public function __construct() {
		/**
		 * Post types where Visual Composer is activated
		 *
		 * @since 2.0
		 */
		$this->postTypes = [ 'page', 'post' ];

		/**
		 * Page templates where Visual Composer is activated
		 *
		 * @since 2.0
		 */
		$this->pageTemplates = [ 'default' ];

		/**
		 * List of components which need content fixing.
		 * Sometimes WordPress adds empty paragraphs inside a component,
		 * define them here and they will be removed.
		 *
		 * @since 2.0
		 *
		 * @var array VC_SHORTCODE_FIXES {
		 * @type string $name The slug of the shortcode (or Visual Composer component)
		 * }
		 */
		$this->shortcodeFixes = [ 'vc_shortcode_slug' ];
	}
}
