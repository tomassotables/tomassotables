<?php

namespace App\Controllers;

/**
 * Class Product
 *
 * Controls the product logic
 *
 * @package App\Controllers
 */
class Product extends Base {
	/**
	 * The product detail view
	 *
	 * @return void
	 */
	public function product() {
		$brands       = get_the_terms( get_the_ID(), 'product_cat' );
		$terms_string = join( ', ', wp_list_pluck( $brands, 'slug' ) );
		$terms_name   = join( ', ', wp_list_pluck( $brands, 'name' ) );

		$this->addContext( 'post', $this->getPost() );
		$this->addContext( 'product', $this->getProduct() );
		$this->addContext( 'similar_title', 'Bekijk meer ' . $terms_name );
		$this->addContext( 'similar_posts', get_posts( [
			'post_type'      => 'product',
			'posts_per_page' => 4,
			'orderby'        => 'rand',
			'post__not_in'   => [ get_the_ID() ],
			'tax_query'      => [
				[
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => $terms_string
				]
			]
		] ) );

		$this->view( 'product/post' );
	}

	/**
	 * The product category view
	 *
	 * @return void
	 */
	public function category() {
		$this->addContext( 'view_mode', @$_GET['mode'] );
		$this->addContext( 'queried_object', get_queried_object() );

		$this->view( 'product/archive' );
	}

	/**
	 * The product archive view
	 *
	 * @return void
	 */
	public function archive() {
		$this->addContext( 'view_mode', @$_GET['mode'] );
		$this->addContext( 'queried_object', get_queried_object() );

		$this->view( 'product/archive' );
	}
}