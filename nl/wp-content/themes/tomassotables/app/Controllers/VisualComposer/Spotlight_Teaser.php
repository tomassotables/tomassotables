<?php

namespace App\Controllers\VisualComposer;

/**
 * Class Spotlight_Teaser
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class Spotlight_Teaser extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Spotlight teaser' ),
			'description' => __( 'Add a spotlight teaser component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-bolt',
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
				[
					'param_name' => 'content',
					'type'       => 'textarea_html',
					'heading'    => __( 'Content (hover)' ),
				],
			],
		];
	}
}
