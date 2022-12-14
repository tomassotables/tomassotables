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
		if(count(explode(',',$terms_string)) > 0){
			$term = get_term_by( 'slug', explode(',',$terms_string)[0], 'product_cat');
			$parent = get_term_by( 'id', $term->parent, 'product_cat' );
			if($parent):
			    $terms_name =  $parent->name;
			endif;
		}
		


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
					'terms'    => explode(',',$terms_string),
					'operator' => 'IN',
				]
			],
            'meta_query' => [
            	'relation' => 'AND',
            	[
                	'key' => '_stock_status',
                    'value' => 'outofstock',
                    'compare' => '!='
                ],
            	[
                	'key' => '_stock',
                    'value' => '0',
                    'compare' => '!='
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