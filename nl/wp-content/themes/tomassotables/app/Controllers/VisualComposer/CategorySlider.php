<?php

namespace App\Controllers\VisualComposer;

/**
 * Class CategorySlider
 *
 * @since      3.0
 *
 * @link       https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 *
 * @see        \App\Controllers\VisualComposer\Base
 * @package    WordPress
 * @subpackage App\Controllers\VisualComposer
 */
class CategorySlider extends Base {
	/**
	 * Component setup
	 *
	 * @since 3.0
	 *
	 * @return array
	 */
	protected function setup() {
		return [
			'name'        => __( 'Category slider' ),
			'description' => __( 'Add an intro component to your content' ),
			'icon'        => 'vc_admin_icon fa fa-file-image-o',
			'params'      => [
				[
					'param_name'  => 'title',
					'type'        => 'textfield',
					'heading'     => __( 'Title' ),
					'admin_label' => true,
				],
				[
					'param_name' => 'categories',
					'type'       => 'autocomplete',
					'heading'    => __( 'Categories' ),
					'settings'   => [
						'multiple'       => true,
						'sortable'       => true,
						'min_length'     => 1,
						'no_hide'        => false,
						'groups'         => false,
						'unique_values'  => true,
						'display_inline' => false,
						'delay'          => 500,
						'auto_focus'     => true,
					],
				],
			],
		];
	}

	/**
	 * Give suggestions for `categories` param.
	 *
	 * @since    3.4.5
	 *
	 * @param string $query The input query from Visual Composer.
	 *
	 * @return array Array containing values for the autocomplete field.
	 * @internal This function is hooked on the `vc_autocomplete_{shortcode_tag}_{param_name}_render` filter
	 *
	 */
	public function get_categories_suggester( $query ) {
		$values = [];
		$terms = get_terms( [ 'taxonomy' => 'kitchen_cat', 'hide_empty' => false ] );

		foreach ( $terms as $term ) {
			if ( stripos( $term->name, $query ) !== false ) {
				$values[] = [
					'label' => $term->name,
					'value' => $term->term_id,
				];
			}
		}

		return $values;
	}

	/**
	 * Give exact values for `categories` param (used on rendering)
	 *
	 * @since 3.4.5
	 *
	 * @param string $query The query string
	 *
	 * @return array Array containing the value label
	 */
	public function get_categories_render( $query ) {
		$value = trim( $query['value'] );

		$term = get_term( $value, 'kitchen_cat' );

		return [
			'label' => $term->name,
			'value' => $term->term_id,
		];
	}
}
