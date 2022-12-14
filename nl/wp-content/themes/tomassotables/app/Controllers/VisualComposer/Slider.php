<?php

namespace App\Controllers\VisualComposer;

/**
 * Class Slider
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class Slider extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Slider' ),
			'description' => __( 'Add a slider component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-sliders',
			'params'      => [
				[
					'param_name' => 'images',
					'type'       => 'attach_images',
					'heading'    => __( 'Images' ),
				],
				[
					'param_name' => 'timeout',
					'type'       => 'textfield',
					'heading'    => __( 'Timeout' ),
					'std'        => '5000',
				],
				[
					'param_name' => 'speed',
					'type'       => 'textfield',
					'heading'    => __( 'Speed' ),
					'std'        => '1000',
				],
				[
					'param_name' => 'pager',
					'type'       => 'dropdown',
					'heading'    => __( 'Pager' ),
					'value'      => [
						__( 'Yes' ) => '1',
						__( 'No' )  => '0',
					],
					'std'        => '1',
				],
				[
					'param_name' => 'prev_next',
					'type'       => 'dropdown',
					'heading'    => __( 'Arrows' ),
					'value'      => [
						__( 'Yes' ) => '1',
						__( 'No' )  => '0',
					],
					'std'        => '1',
				],
			],
		];
	}
}
