<?php

namespace App\Controllers\VisualComposer;

/**
 * Class Brands
 *
 * @since      3.4.5
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class Brands extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Brands' ),
			'description' => __( 'Add a brands component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-wordpress',
			'params'      => [
				[
					'param_name' => 'brands',
					'type'       => 'param_group',
					'heading'    => __( 'Brands' ),
					'params'     => [
						[
							'param_name' => 'logo',
							'type'       => 'attach_image',
							'heading'    => __( 'Logo' ),
						],
						[
							'param_name' => 'link',
							'type'       => 'vc_link',
							'heading'    => __( 'Link' ),
						],
					],
				],
			],
		];
	}
}
