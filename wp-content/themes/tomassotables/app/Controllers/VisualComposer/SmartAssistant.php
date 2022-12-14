<?php

namespace App\Controllers\VisualComposer;

/**
 * Class SmartAssistant
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class SmartAssistant extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Smart Assistant' ),
			'description' => __( 'Add a smart assistant component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-cart-plus',
			'params'      => [
				[
					'param_name'  => 'title',
					'type'        => 'textfield',
					'heading'     => __( 'Title' ),
					'admin_label' => true,
				],
				[
					'param_name' => 'advisor_code',
					'type'       => 'textfield',
					'heading'    => __( 'Advisor code' ),
				],
				[
					'param_name'  => 'preselection',
					'type'        => 'textfield',
					'heading'     => __( 'Preselection' ),
					'description' => __( 'See page 33 of the Smart Assitant Manual' ),
				],
			],
		];
	}
}
