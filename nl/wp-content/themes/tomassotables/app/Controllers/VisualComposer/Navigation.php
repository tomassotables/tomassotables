<?php

namespace App\Controllers\VisualComposer;

/**
 * Class Navigation
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class Navigation extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Navigation' ),
			'description' => __( 'Add a navigation component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-bars',
			'params'      => [
				[
					'param_name'  => 'title',
					'type'        => 'textfield',
					'heading'     => __( 'Title' ),
					'admin_label' => true,
				],
				[
					'param_name' => 'expandable',
					'type'       => 'dropdown',
					'heading'    => __( 'Expandable' ),
					'value'      => [
						__( 'Yes' ) => 'yes',
						__( 'No' )  => 'no',
					],
					'std'        => 'yes',
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
				],
			],
		];
	}
}
