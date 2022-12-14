<?php

namespace App\Controllers\VisualComposer;

/**
 * Class TextSlider
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class TextSlider extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Text slider' ),
			'description' => __( 'Add a text slider component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-text-width',
			'params'      => [
				[
					'param_name' => 'component_style',
					'type'       => 'dropdown',
					'heading'    => __( 'Style' ),
					'value'      => [
						__( 'Default' ) => '',
						__( 'Miele' )   => 'vc_text_slider--miele',
					],
					'std'        => '',
				],
				[
					'param_name' => 'slides',
					'type'       => 'param_group',
					'heading'    => __( 'Slides' ),
					'params'     => [
						[
							'param_name' => 'image',
							'type'       => 'attach_image',
							'heading'    => __( 'Image' ),
						],
						[
							'param_name'  => 'title',
							'type'        => 'textfield',
							'heading'     => __( 'Title' ),
							'admin_label' => true,
							'description' => __( 'For you own reference and alt text of image' ),
						],
						[
							'param_name' => 'content',
							'type'       => 'textarea',
							'heading'    => __( 'Content' ),
						],
						[
							'param_name' => 'button',
							'type'       => 'vc_link',
							'heading'    => __( 'Button' ),
						],
					],
				],
			],
		];
	}
}
