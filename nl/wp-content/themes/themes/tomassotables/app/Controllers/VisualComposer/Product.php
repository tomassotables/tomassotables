<?php

namespace App\Controllers\VisualComposer;

/**
 * Class Product
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class Product extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Product' ),
			'description' => __( 'Add a product component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-cart-plus',
			'params'      => [
				[
					'param_name' => 'thumbnail',
					'type'       => 'attach_image',
					'heading'    => __( 'Thumbnail' ),
				],
				[
					'param_name'  => 'title',
					'type'        => 'textfield',
					'heading'     => __( 'Title' ),
					'admin_label' => true,
				],
				[
					'param_name' => 'button',
					'type'       => 'vc_link',
					'heading'    => __( 'Button' ),
				],
			],
		];
	}
}
