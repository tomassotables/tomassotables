<?php

namespace App\Controllers\VisualComposer;

/**
 * Class Intro
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class Intro extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Intro' ),
			'description' => __( 'Add an intro component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-font',
			'params'      => [
				[
					'param_name' => 'content',
					'type'       => 'textarea',
					'holder'     => 'p',
					'heading'    => __( 'Intro' ),
				],
			],
		];
	}
}
