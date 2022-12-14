<?php

namespace App\Controllers\VisualComposer;

/**
 * Class LinkList
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class LinkList extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Link list' ),
			'description' => __( 'Add a link list component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-list-ul',
			'params'      => [
				[
					'param_name'  => 'title',
					'type'        => 'textfield',
					'heading'     => __( 'Title' ),
					'admin_label' => true,
				],
				[
					'param_name' => 'title_style',
					'type'       => 'dropdown',
					'heading'    => __( 'Title style' ),
					'value'      => [
						__( 'Default' ) => '',
						__( 'Bold' )    => 'vc_link_list__itle--bold',
					],
					'std'        => '',
				],
				[
					'param_name' => 'buttons',
					'type'       => 'param_group',
					'heading'    => __( 'Buttons' ),
					'params'     => [
						[
							'param_name'  => 'title',
							'type'        => 'textfield',
							'heading'     => __( 'Title' ),
							'admin_label' => true,
						],
						[
							'param_name' => 'button',
							'type'       => 'vc_link',
							'heading'    => __( 'Button' ),
						],
					],
				],
				[
					'param_name' => 'button_style',
					'type'       => 'dropdown',
					'heading'    => __( 'Button style' ),
					'value'      => [
						__( 'Default' ) => '',
						__( 'Miele' )   => 'vc_link_list__link--miele',
					],
					'std'        => '',
				],
			],
		];
	}
}
