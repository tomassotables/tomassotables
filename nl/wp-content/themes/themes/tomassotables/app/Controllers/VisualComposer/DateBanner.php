<?php

namespace App\Controllers\VisualComposer;

/**
 * Class DateBanner
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class DateBanner extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Date banner' ),
			'description' => __( 'Add a date banner with expiration date to your content' ),
			'icon'        => 'vc_admin_icon fa fa-calendar-check-o',
			'params'      => [
				[
					'param_name'  => 'title',
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => __( 'Title' ),
				],
				[
					'param_name' => 'banner',
					'type'       => 'attach_image',
					'heading'    => __( 'Banner' ),
				],
				[
					'param_name' => 'date_from',
					'type'       => 'textfield',
					'heading'    => __( 'Date (from)' ),
					'std'        => date( 'Y-m-d' ),
				],
				[
					'param_name' => 'date_to',
					'type'       => 'textfield',
					'heading'    => __( 'Date (to)' ),
					'std'        => date( 'Y-m-d' ),
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
