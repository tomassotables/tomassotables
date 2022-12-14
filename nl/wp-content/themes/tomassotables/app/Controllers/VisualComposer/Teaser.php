<?php

namespace App\Controllers\VisualComposer;

/**
 * Class Teaser
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class Teaser extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Teaser' ),
			'description' => __( 'Add a teaser component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-arrow-circle-right',
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
					'param_name' => 'link',
					'type'       => 'vc_link',
					'heading'    => __( 'Link' ),
				],
			],
		];
	}
}
