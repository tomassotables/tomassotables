<?php

namespace App\Controllers\VisualComposer;

/**
 * Class ZoomImage
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class ZoomImage extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Zoom image' ),
			'description' => __( 'Add a zoom image component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-search-plus',
			'params'      => [
				[
					'param_name' => 'images',
					'type'       => 'attach_image',
					'heading'    => __( 'Image' ),
				],
				[
					'param_name' => 'link',
					'type'       => 'vc_link',
					'heading'    => __( 'Link' ),
				],
			],
		];
	}
}
