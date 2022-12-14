<?php

namespace App\Controllers;

/**
 * Class Post
 *
 * Controls the post logic
 *
 * @package App\Controllers
 */
class Post extends Base {
	/**
	 * The post detail view
	 *
	 * @return void
	 */
	public function post() {
		$custom_taxterms = wp_get_object_terms( get_the_ID(), 'project_category', [ 'fields' => 'ids' ] );
        $args            = [
            'post_type'      => 'post',
            'posts_per_page' => 2,
            'orderby'        => 'rand',
            'tax_query'      => [
                [
                    'taxonomy' => 'category',
                    'field'    => 'id',
                    'terms'    => $custom_taxterms
                ]
            ],
            'post__not_in'   => [ get_the_ID() ],
        ];
		$args1            = [
            'post_type'      => 'post',
            'posts_per_page' => -1,
            'orderby'        => 'rand',
            'tax_query'      => [
                [
                    'taxonomy' => 'category',
                    'field'    => 'id',
                    'terms'    => $custom_taxterms
                ]
            ],
            'post__not_in'   => [ get_the_ID() ],
        ];
		$this->addContext( 'related_posts', get_posts( $args1 ) );
        $this->addContext( 'related_articles', get_posts( $args ) );
		$this->addContext( 'post', $this->getPost() );

		$this->view( 'post/post' );
	}

	/**
	 * The post archive view
	 *
	 * @return void
	 */
	public function archive() {
		$blog = get_option( 'page_for_posts' );
        $this->addContext( 'blog_title', get_field('banner_title', $blog) );
        $this->addContext( 'blog_image',get_the_post_thumbnail($blog, 'size: blog_archive') );
		$this->addContext( 'content_section', get_field('content_section', $blog) );

		$this->view( 'post/archive' );
	}
}
