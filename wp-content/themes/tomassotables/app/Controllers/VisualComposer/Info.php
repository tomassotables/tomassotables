<?php

namespace App\Controllers\VisualComposer;

/**
 * Class Info
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class Info extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Info' ),
			'description' => __( 'Add an info component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-info-circle',
			'params'      => [
				[
					'param_name'  => 'title',
					'type'        => 'textfield',
					'heading'     => __( 'Title' ),
					'admin_label' => true,
				],
				[
					'param_name' => 'image',
					'type'       => 'attach_image',
					'heading'    => __( 'Image' ),
				],
				[
					'param_name' => 'button_label',
					'type'       => 'textfield',
					'heading'    => __( 'Button label' ),
				],
				[
					'param_name' => 'button_link',
					'type'       => 'vc_link',
					'heading'    => __( 'Button link' ),
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
