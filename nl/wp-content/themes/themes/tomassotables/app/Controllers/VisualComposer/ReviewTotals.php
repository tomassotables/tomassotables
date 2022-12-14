<?php

namespace App\Controllers\VisualComposer;

/**
 * Class ReviewTotals
 *
 * @since      3.4.5
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class ReviewTotals extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Review totals' ),
			'description' => __( 'Add a review totals component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-star-half-o',
			'params'      => [
				[
					'param_name'  => 'title',
					'type'        => 'textfield',
					'heading'     => __( 'Title' ),
					'admin_label' => true,
				],
				[
					'param_name' => 'websites',
					'type'       => 'param_group',
					'heading'    => __( 'Website' ),
					'params'     => [
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
							'param_name' => 'score',
							'type'       => 'textfield',
							'heading'    => __( 'Score' ),
						],
					],
				],
			],
		];
	}
}
