<?php

namespace App\Hooks\Frontend;

/**
 * Class Images
 *
 * Handles all image related hooks
 *
 * @since      2.0
 *
 * @package    App\Hooks\Frontend
 */
class Images extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		add_action( 'init', [ $this, 'setImageSizes' ] );
		add_filter( 'image_resize_dimensions', [ $this, 'imageCropDimensions' ], 10, 6 );
	}

	/**
	 * Registers the differtent image sizes which are used
	 * all over the template. Makes use of the `IMAGE_SIZES`
	 * constant in the `functions.php`
	 *
	 * @since    3.0
	 *
	 * @return void
	 * @internal This function is hooked on the `init` action
	 * @link     https://codex.wordpress.org/Plugin_API/Action_Reference/init
	 *
	 */
	public function setImageSizes() {
		$imageSizes = $this->config->imageSizes;

		foreach ( $imageSizes as $name => $preset ) {
			if ( isset( $preset[2] ) ) {
				add_image_size( $name, $preset[0], $preset[1], $preset[2] );
			} else {
				add_image_size( $name, $preset[0], $preset[1] );
			}
		}
	}

	/**
	 * Improved image resize dimensions for cropping an image
	 *
	 * This hook makes upscaling images possible for resize.
	 *
	 * @since    3.4
	 *
	 * @param null $default Variable to be filtered.
	 * @param int  $orig_w  Original image width in pixels.
	 * @param int  $orig_h  Original image height in pixels.
	 * @param int  $new_w   Destination image width in pixels.
	 * @param int  $new_h   Destination image height in pixels.
	 * @param bool $crop    Flag to enable image croping.
	 *
	 * @return array|null Array containing cropped/upscaled with and height
	 * @internal This function is hooked on the `image_resize_dimensions` filter
	 * @link     https://codex.wordpress.org/Plugin_API/Filter_Reference/image_resize_dimensions
	 *
	 */
	public function imageCropDimensions( $default = null, $orig_w, $orig_h, $new_w, $new_h, $crop ) {
		if ( ! $crop ) {
			// If no cropping required let WordPress handle it
			return null;
		}

		$size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );
		$crop_w = round( $new_w / $size_ratio );
		$crop_h = round( $new_h / $size_ratio );
		$s_x = floor( ( $orig_w - $crop_w ) / 2 );
		$s_y = floor( ( $orig_h - $crop_h ) / 2 );

		return [ 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h ];
	}
}
