<?php

namespace App\Controllers\VisualComposer;

/**
 * Class ShoppingSundays
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class ShoppingSundays extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Shopping sundays' ),
			'description' => __( 'Add a shopping sundays component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-calendar-minus-o',
			'params'      => [
				[
					'param_name'  => 'title',
					'type'        => 'textfield',
					'heading'     => __( 'Title' ),
					'admin_label' => true,
				],
			],
		];
	}
}
