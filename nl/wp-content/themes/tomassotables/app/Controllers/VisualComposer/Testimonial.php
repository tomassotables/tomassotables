<?php

namespace App\Controllers\VisualComposer;

/**
 * Class Testimonial
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class Testimonial extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Testimonial' ),
			'description' => __( 'Add a testimonial component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-quote-right',
			'params'      => [
				[
					'param_name' => 'photo',
					'type'       => 'attach_image',
					'heading'    => __( 'Photo' ),
				],
				[
					'param_name'  => 'name',
					'type'        => 'textfield',
					'heading'     => __( 'Name' ),
					'admin_label' => true,
				],
				[
					'param_name' => 'city',
					'type'       => 'textfield',
					'heading'    => __( 'City' ),
				],
				[
					'param_name' => 'content',
					'type'       => 'textarea',
					'heading'    => __( 'Content' ),
				],
			],
		];
	}
}
