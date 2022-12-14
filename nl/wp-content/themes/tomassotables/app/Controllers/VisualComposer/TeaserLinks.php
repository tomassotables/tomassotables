<?php

namespace App\Controllers\VisualComposer;

/**
 * Class TeaserLinks
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class TeaserLinks extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Teaser links' ),
			'description' => __( 'Add teaser links component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-windows',
			'params'      => [
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
				],
				[
					'param_name' => 'component_style',
					'type'       => 'dropdown',
					'heading'    => __( 'Style' ),
					'value'      => [
						__( 'Default' ) => '',
						__( 'Miele' )   => 'vc_teaser_links--miele',
					],
					'std'        => '',
				],
				[
					'param_name' => 'link',
					'type'       => 'vc_link',
					'heading'    => __( 'Link' ),
				],
				[
					'param_name' => 'links',
					'type'       => 'param_group',
					'heading'    => __( 'Links' ),
					'params'     => [
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
				],
			],
		];
	}
}
