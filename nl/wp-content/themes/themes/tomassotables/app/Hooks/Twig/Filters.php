<?php

namespace App\Hooks\Twig;

/**
 * Class Functions
 *
 * Global helper functions
 *
 * @package App\Hooks\Twig
 */
class Filters extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		add_filter( 'timber/context', [ $this, 'defaultContext' ] );
		add_filter( 'timber/twig', [ $this, 'addCustomFilters' ] );
		add_filter( 'timber/twig', [ $this, 'addCustomFunctions' ] );
	}

	/**
	 * Add default context to timber views
	 *
	 * @param $context
	 *
	 * @return mixed
	 */
	public function defaultContext( $context ) {
		// Site info
		$context['site'] = new \Timber\Site();

		// ACF options
		$context['options'] = get_fields( 'options' );

		// Directories
		$context['uploads'] = wp_upload_dir()['basedir'];
		$context['theme_file_path'] = get_theme_file_path();

		// Menus
		foreach ( $this->config->menus as $key => $title ) {
			$context[ $key ] = new \Timber\Menu( $key );
		}

		//Latest News
		$context['latestNews'] = get_posts( [
			'posts_per_page' => 3,
			'post_type'      => 'post',
		] );
		
		// Pagination
		$context['paginateLinks'] = paginate_links( [
			'end_size'  => 1,
			'mid_size'  => 4,
			'prev_text' => __( 'Vorige' ),
			'next_text' => __( 'Volgende' ),
		] );

		if ( function_exists( 'yoast_breadcrumb' ) ) {
			$context['breadcrumbs'] = yoast_breadcrumb( null, null, false );
		}

		return $context;
	}

	/**
	 * Add custom filters to the Twig render engine
	 *
	 * @param $twig
	 *
	 * @return mixed
	 */
	public function addCustomFilters( $twig ) {
		$twig->addFilter( new \Timber\Twig_Filter( 'strip_phone_number', [ $this, 'stripPhoneNumber' ] ) );
		$twig->addFilter( new \Timber\Twig_Filter( 'format_price', [ $this, 'formatPrice' ] ) );

		return $twig;
	}

	/**
	 * Add custom functions to the Twig render engine
	 *
	 * @param $twig
	 *
	 * @return mixed
	 */
	public function addCustomFunctions( $twig ) {
		$twig->addFunction( new \Timber\Twig_Function( 'asset', [ $this, 'asset' ] ) );
		$twig->addFunction( new \Timber\Twig_Function( 'get_post', [ $this, 'get_post' ] ) );
		$twig->addFunction( new \Timber\Twig_Function( 'debug', [ $this, 'debug' ] ) );
		$twig->addFunction( new \Timber\Twig_Function( 'file_exists', [ $this, 'file_exists' ] ) );
		$twig->addFunction( new \Timber\Twig_Function( 'image', [ $this, 'image' ] ) );
		$twig->addFunction( new \Timber\Twig_Function( 'image_url', [ $this, 'image_url' ] ) );
		$twig->addFunction( new \Timber\Twig_Function( 'get_archive', [ $this, 'get_archive' ] ) );
		$twig->addFunction( new \Timber\Twig_Function( 'get_404', [ $this, 'get_404' ] ) );
		$twig->addFunction( new \Timber\Twig_Function( 'inline_svg', [ $this, 'inline_svg' ] ) );
		$twig->addFunction( new \Timber\Twig_Function( 'vc_param_group_parse_atts', [
			$this,
			'vc_param_group_parse_atts',
		] ) );

		return $twig;
	}

	/**
	 * Strip the input to a phone number which can be called.
	 * Can be used like {{ 'Phone Number'|strip_phone_number }}
	 *
	 * @since 2.0
	 *
	 * @param $phoneNumber
	 *
	 * @return string|string[]
	 */
	public function stripPhoneNumber( $phoneNumber ) {
		$phoneNumber = str_replace( ' ', '', $phoneNumber );
		$phoneNumber = str_replace( '-', '', $phoneNumber );
		$phoneNumber = str_replace( '.', '', $phoneNumber );
		$phoneNumber = str_replace( '(0)', '', $phoneNumber );
		$phoneNumber = str_replace( '(', '', $phoneNumber );
		$phoneNumber = str_replace( ')', '', $phoneNumber );
		$phoneNumber = str_replace( '+', '00', $phoneNumber );

		return $phoneNumber;
	}

	/**
	 * Easily format prices.
	 * For example {{ 'Price'|format_price }}
	 *
	 * @since 3.0
	 *
	 * @param      $price
	 * @param bool $zeros
	 *
	 * @return string|string[]
	 */
	public function formatPrice( $price ) {
		// Check if Woocommerce is active, if so use build in Woocommerce function
		if ( function_exists( 'wc_price' ) ) {
			return wc_price( $price );
		}

		$price = str_replace( '.', ',', $price );
		$price = '&euro; ' . $price;

		if ( substr( $price, - 3 ) == ',00' ) {
			$price = substr( $price, 0, - 3 ) . ',-';
		}

		return $price;
	}

	/**
	 * Get the asset path
	 * For example {{ asset('images/hamburger.svg') }}
	 *
	 * @param $path
	 *
	 * @return mixed
	 */
	public function asset( $path ) {
		return $this->assets->uri( $path );
	}

	/**
	 * Debug an object
	 * For example {{ debug({ hello: 'world' }) }}
	 *
	 * @param $object
	 *
	 * @return string
	 */
	public function debug( $object ) {
		return '<pre>' . print_r( $object, true ) . '</pre>';
	}

	/**
	 * Get a Timber Post object from an ID or WP_Post object
	 * For example {{ get_post(1) }}
	 *
	 * @param $object
	 *
	 * @return \Timber\Post
	 */
	public function get_post( $object ) {
		$postId = false;

		if ( is_int( $object ) ) {
			$postId = $object;
		}

		if ( isset( $object->ID ) ) {
			$postId = $object->ID;
		}

		return new \Timber\Post( $postId );
	}

	/**
	 * Check if a file exists
	 * For example {{ file_exists(uploads ~ '/test.jpg') }}
	 *
	 * @param $file
	 *
	 * @return bool
	 */
	public function file_exists( $file ) {
		if ( file_exists( $file ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Print just path to full image
	 */
	public function image_url( $image_id ) {
		$image = new \Timber\Image( $image_id );
		return $image->src( 'full' );
	}

	/**
	 * Print an image in the template
	 * For example {{ image(image.url, [500, 400]) }}
	 * {{ image(image.url, [375, 200, {
	 *  '960' => [1250, 350]
	 *  '700' => [960, 250]
	 * }) }}
	 *
	 * @param $file
	 *
	 * @return bool
	 */
	public function image( $image, $size ) {
		$image = new \Timber\Image( $image );
		$imageHelper = new \Timber\ImageHelper();

		if ( isset( $size[2] ) && is_array( $size[2] ) ) {
			$sources = [];

			foreach ( $size[2] as $screenWidth => $source ) {
				$sources[] = '<source media="(min-width: ' . $screenWidth . 'px)" srcset="' . $imageHelper->img_to_webp( $imageHelper->resize( $image->src( 'full' ), $source[0], $source[1] ) ) . ' 1x, ' . $imageHelper->img_to_webp( $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $source[0], $source[1] ), 2 ) ) . ' 2x, ' . $imageHelper->img_to_webp( $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $source[0], $source[1] ), 3 ) ) . ' 3x, ' . $imageHelper->img_to_webp( $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $source[0], $source[1] ), 4 ) ) . ' 4x" type="image/webp" />';
				$sources[] = '<source media="(min-width: ' . $screenWidth . 'px)" srcset="' . $imageHelper->resize( $image->src( 'full' ), $source[0], $source[1] ) . ' 1x, ' . $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $source[0], $source[1] ), 2 ) . ' 2x, ' . $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $source[0], $source[1] ), 3 ) . ' 3x, ' . $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $source[0], $source[1] ), 4 ) . ' 4x" />';
			}

			$image = '
				<picture>
					' . implode( '', $sources ) . '
					<source srcset="' . $imageHelper->img_to_webp( $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ) ) . ' 1x, ' . $imageHelper->img_to_webp( $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ), 2 ) ) . ' 2x, ' . $imageHelper->img_to_webp( $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ), 3 ) ) . ' 3x, ' . $imageHelper->img_to_webp( $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ), 4 ) ) . ' 4x" type="image/webp" />
					<img src="' . $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ) . '" alt="' . $image->alt() . '" srcset="' . $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ) . ' 1x, ' . $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ), 2 ) . ' 2x, ' . $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ), 3 ) . ' 3x, ' . $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ), 4 ) . ' 4x" />
				</picture>
			';
		} else {
			$image = '
				<picture>
					<source srcset="' . $imageHelper->img_to_webp( $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ) ) . ' 1x, ' . $imageHelper->img_to_webp( $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ), 2 ) ) . ' 2x, ' . $imageHelper->img_to_webp( $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ), 3 ) ) . ' 3x, ' . $imageHelper->img_to_webp( $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ), 4 ) ) . ' 4x" type="image/webp" />
					<img width="' . $size[0] . '" height="' . $size[1] . '" src="' . $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ) . '" alt="' . $image->alt() . '" srcset="' . $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ) . ' 1x, ' . $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ), 2 ) . ' 2x, ' . $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ), 3 ) . ' 3x, ' . $imageHelper->retina_resize( $imageHelper->resize( $image->src( 'full' ), $size[0], $size[1] ), 4 ) . ' 4x" />
				</picture>
			';
		}

		return trim( $image );
	}

	/**
	 * Find the placeholder page for a specific archive page.
	 *
	 * @since 3.0
	 *
	 * @param string|bool $post_type The post_type for the placeholder archive
	 *
	 * @return \WP_Post|false If a hit is found return the post object else return false
	 */
	public function get_archive( $post_type = false ) {
		// If no post type use the wp_query to find one
		if ( ! $post_type ) {
			global $wp_query;
			$post_type = $wp_query->query_vars['post_type'];
		}

		// Check is post type exist
		if ( post_type_exists( $post_type ) ) {
			$posts = get_posts( [
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'posts_per_page' => 1,
				'orderby'        => 'menu_order',
				'order'          => 'asc',
				'meta_query'     => [
					[
						'key'   => '_wp_page_template',
						'value' => 'archive_' . $post_type,
					],
				],
			] );

			if ( $posts ) {
				return new \Timber\Post( reset( $posts ) );
			}
		}

		return false;
	}

	/**
	 * Get the set 404 page for content
	 *
	 * @return bool|\Timber\Post
	 */
	public function get_404() {
		if ( is_404() ) {
			$posts = get_posts( [
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'posts_per_page' => 1,
				'orderby'        => 'menu_order',
				'order'          => 'asc',
				'meta_query'     => [
					[
						'key'   => '_wp_page_template',
						'value' => '404',
					],
				],
			] );

			if ( $posts ) {
				return new \Timber\Post( reset( $posts ) );
			}
		}

		return false;
	}

	/**
	 * Returns an inlined SVG
	 *
	 * @param $path
	 *
	 * @return false|string
	 */
	public function inline_svg( $path ) {
		return file_get_contents( $path );
	}

	/**
	 * Visual Composer param group parsing
	 *
	 * @param $args
	 *
	 * @return mixed
	 */
	public function vc_param_group_parse_atts( $args ) {
		return vc_param_group_parse_atts( $args );
	}
}
