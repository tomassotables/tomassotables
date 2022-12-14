<?php

namespace App\Controllers\VisualComposer;

/**
 * Class Price
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class Price extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Price' ),
			'description' => __( 'Add a price component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-eur',
			'params'      => [
				[
					'param_name'  => 'prices',
					'type'        => 'textfield',
					'heading'     => __( 'Title' ),
					'admin_label' => true,
				],
				[
					'param_name' => 'discount',
					'type'       => 'textfield',
					'heading'    => __( 'Discount' ),
				],
			],
		];
	}
}
