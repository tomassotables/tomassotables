<?php

namespace App\Hooks\Plugins;

/**
 * Class WooCommerce
 *
 * Makes WooCommerce work within the theme
 *
 * @since      3.0
 *
 * @package    WordPress
 * @subpackage App\Hooks\Plugins
 */
class WooCommerce extends \App\Provider {
	/**
	 * Initialize hooks
	 *
	 * @return void
	 */
	public function initialize() {
		// Actions
		add_action( 'after_setup_theme', [ $this, 'wc_support' ] );
		add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );
		add_action( 'woocommerce_after_shop_loop_item_title', [ $this, 'wc_product_loop_brand' ], 15 );
		add_action( 'woocommerce_archive_description', 'woocommerce_output_all_notices', 10 );
		add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 40 );
		add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 5 );
		add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 25 );
		add_action( 'woocommerce_single_product_summary', [ $this, 'wc_product_detail_brand' ], 1 );
		add_action( 'woocommerce_single_product_summary', [ $this, 'wc_product_detail_description' ], 6 );
		add_action( 'woocommerce_single_product_summary', [ $this, 'wc_product_detail_usps' ], 45 );
		add_action( 'woocommerce_before_add_to_cart_button', [ $this, 'wc_product_detail_delivery_time' ], 5 );
		add_action( 'wp_enqueue_scripts', [ $this, 'wc_dequeue_styles_and_scripts' ], 100 );
		add_action( 'woocommerce_after_add_to_cart_button', [ $this, 'wc_product_wishlist_code' ], 5 );
		add_action( 'woocommerce_sort_by_filter', 'woocommerce_catalog_ordering', 5 );
		add_action( 'woocommerce_cart_collaterals', [ $this, 'wc_product_detail_usps' ], 15 );
		add_action( 'woocommerce_checkout_order_review', [ $this, 'wc_checkout_order_summery_start' ], 15 );
		add_action( 'woocommerce_checkout_order_review', [ $this, 'wc_checkout_order_summery_end' ], 25 );
		add_action( 'woocommerce_checkout_order_review', [ $this, 'wc_checkout_payment_method_end' ], 35 );
		add_action( 'woocommerce_checkout_order_review', [ $this, 'wc_checkout_payment_method_start' ], 5 );
		add_action( 'woocommerce_checkout_order_review', [ $this, 'wc_checkout_payment_method_end' ], 14 );
		add_action( 'woocommerce_checkout_order_review', [ $this, 'wc_product_detail_usps' ], 30 );
		add_action( 'woocommerce_register_form', 'wc_registration_privacy_policy_text', 30 );
		add_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 20 );
		add_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 10 );
		add_action( 'woocommerce_after_cart_totals', [ $this, 'wc_cart_payment_info' ], 10 );

		// Filters
		add_filter( 'timber_context', [ $this, 'wc_add_to_context' ] );
		add_filter( 'woocommerce_total_products', 'woocommerce_result_count' );
		add_filter( 'woocommerce_products_ordering_select', 'woocommerce_catalog_ordering' );
		add_filter( 'gettext', [ $this, 'wc_translate_woocommerce_strings' ], 999, 3 );
		add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
		add_filter( 'woocommerce_catalog_orderby', [ $this, 'wc_custom_sorting_options' ] );
		add_filter( 'woocommerce_get_stock_html', '__return_empty_string' );
		add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );

		// Remove objects from layout
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		remove_action( 'woocommerce_register_form', 'wc_registration_privacy_policy_text', 20 );
		remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );
		remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
	}

	/**
	 * Add woocommerce support
	 */
	public function wc_support() {
		add_theme_support(
			'woocommerce',
			[
				'thumbnail_image_width'         => 330,
				'single_image_width'            => 1000,
				'gallery_thumbnail_image_width' => 1000,
			]
		);
		add_theme_support( 'wc-product-gallery-lightbox' );
	}

	/**
	 * Add content to context
	 */
	public function wc_add_to_context( $context ) {
		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			$context['wc_shop']          = get_option( 'woocommerce_shop_page_id' );
			$context['wc_cart']          = get_option( 'woocommerce_cart_page_id' );
			$context['wc_checkout']      = get_option( 'woocommerce_checkout_page_id' );
			$context['wc_pay_page']      = get_option( 'woocommerce_pay_page_id' );
			$context['wc_thanks']        = get_option( 'woocommerce_thanks_page_id' );
			$context['wc_account']       = get_option( 'woocommerce_myaccount_page_id' );
			$context['wc_edit_address']  = get_option( 'woocommerce_edit_address_page_id' );
			$context['wc_view_order']    = get_option( 'woocommerce_view_order_page_id' );
			$context['wc_terms']         = get_option( 'woocommerce_terms_page_id' );
			$context['wc_cart_count']    = WC()->cart->cart_contents_count;
			$context['wishlist_url']     = YITH_WCWL()->get_wishlist_url();
			$context['wc_categories']    = get_terms( 'product_cat' );
			$context['popular_products'] = get_posts( [
				'post_type'      => [ 'product' ],
				'meta_key'       => 'total_sales',
				'orderby'        => 'rand',
				'posts_per_page' => 3
			] );
		}

		return $context;
	}

	/**
	 * Translate a String in WooCommerce (English to English)
	 */
	public function wc_translate_woocommerce_strings( $translated, $untranslated, $domain ) {
		if ( ! is_admin() && 'woocommerce' === $domain ) {
			switch ( $translated ) {
				case 'Winkelmand bijwerken' :
					$translated = 'Bijwerken';
					break;
				case 'Waardebon toepassen' :
					$translated = 'Code Toepassen';
					break;
				case 'Couponcode' :
					$translated = 'Kortingscode';
					break;
				case 'Je bent misschien ook geïnteresseerd in&hellip;' :
					$translated = 'Gerelateerde producten';
					break;
				case 'Toevoegen aan winkelwagen' :
					$translated = 'Toevoegen aan winkelwagen';
					break;
				case 'Bekijken' :
					$translated = 'Bekijk bestelling';
					break;
				case 'Bestelgegevens' :
					$translated = 'Bestellingen';
					break;
				case 'Een account aanmaken?' :
					$translated = 'Account aanmaken';
					break;
				case 'Factuurgegevens' :
					$translated = 'Adres';
					break;
				case 'Bestelnotities' :
					$translated = 'Opmerkingen / Bezorgdatum';
					break;
				case 'Jouw bestelling' :
					$translated = 'Betaling';
					break;
				case 'Notities over je bestelling, bijvoorbeeld speciale notities voor aflevering.' :
					$translated = 'Bericht';
					break;
				case 'Zoek producten&hellip;' :
					$translated = 'Waar ben je naar op zoek?';
					break;
				case 'Andere suggesties&hellip;' :
					$translated = 'Heb je hier al aan gedacht?';
					break;
				case 'Totalen winkelwagen' :
					$translated = 'Samenvatting';
					break;
				case 'Je bestelling' :
					$translated = 'Samenvatting';
					break;
				case 'Bestelling plaatsen' :
					$translated = 'Afrekenen';
					break;
				case 'Billing details' :
					$translated = 'Bezorgadres';
					break;
				case 'Product succesvol toegevoegd aan je winkelwagen' :
					$translated = 'Het artikel is toegevoegd aan je winkelmandje';
					break;
				case 'Cart totals' :
					$translated = 'Mijn winkelwagen';
					break;
			}
		}

		return $translated;
	}

	/**
	 * WooCommerce Custom Product Sorting – Remove, Rename, Reorder
	 */
	public function wc_custom_sorting_options( $options ) {

		unset( $options['menu_order'] );
		unset( $options['rating'] );
		unset( $options['date'] );

		$options['popularity'] = 'Meest bekeken';
		$options['price']      = 'Laagste prijs';
		$options['price-desc'] = 'Hoogste prijs';

		return $options;
	}

	/**
	 * Product loop brand name
	 */
	public function wc_product_loop_brand() {
		$brands = get_the_terms( get_the_ID(), 'pa_brand' );

		if ( ! empty( $brands ) ) {
			echo '<div class="woocommerce-loop-product__brand">';
			echo '<span>' . $brands[0]->name . '</span>';
			echo '</div>';
		}
	}

	/**
	 * Product detail brand name
	 */
	public function wc_product_detail_brand() {
		$brands = get_the_terms( get_the_ID(), 'pa_brand' );

		if ( ! empty( $brands ) ) {
			echo '<div class="product_brand">';
			echo '<span>' . $brands[0]->name . '</span>';
			echo '</div>';
		}
	}

	/**
	 * Product detail description name
	 */
	public function wc_product_detail_description() {
		if ( '' !== get_post()->post_content ) {
			echo '<div class="product_description">';
			echo '<p>' . wp_trim_words( get_the_content(), 25, '...' ) . ' <a href="#description" class="js-scroll-down">Laat meer zien</a></p>';
			echo '</div>';
		}
	}

	/**
	 * Product detail Delivery Time
	 */
	public function wc_product_detail_delivery_time() {
		if ( ( $delivery = get_field( 'delivery_time' ) ) && ! empty( $delivery ) ) {
			echo '<div class="product_delivery"><strong>Delivary Time</strong>' . $delivery . '</div>';
		}
	}

	/**
	 * Product detail usps
	 */
	public function wc_product_detail_usps() {
		if ( have_rows( 'product_usps', 'option' ) || get_field( 'product_reviews', 'option' ) ) {
			echo '<div class="product_usps"><ul>';

			if ( is_cart() || is_checkout() ) {
				echo '<h3>' . __( 'Voordelen van Tomasso Tables' ) . '</h3>';
			}

			while ( have_rows( 'product_usps', 'option' ) ) {
				the_row();
				echo '<li>';
				echo get_sub_field( 'title' );
				echo '</li>';
			}

			if ( get_field( 'product_reviews', 'option' ) ) {
				echo '<li>';
				echo '<span><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></span>' . get_field( 'product_reviews', 'option' );
				echo '</li>';
			}
			echo '</ul></div>';
		}

		if ( ! is_cart() && ! is_checkout() ) {
			if ( ( $quote = get_field( 'request_quote', 'option' ) ) && ! empty( $quote ) ) {
				echo '<div class="product_usps">';
				echo 'Zakelijke bestelling? <a href="' . $quote['url'] . '" target="' . $quote['url'] . '">' . $quote['title'] . '</a>';
				echo '</div>';
			}
		}
	}

	public function wc_dequeue_styles_and_scripts() {
		if ( class_exists( 'woocommerce' ) ) {
			wp_dequeue_style( 'selectWoo' );
			wp_deregister_style( 'selectWoo' );

			wp_dequeue_script( 'selectWoo' );
			wp_deregister_script( 'selectWoo' );
		}
	}

	public function wc_product_wishlist_code() {
		echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
	}

	public function wc_checkout_order_summery_start() {
		echo '<div class="wc_order_holder">';
		echo '<div class="wc_order_summery">';
		echo '<h3>' . __( 'Samenvatting' ) . '</h3>';
	}

	public function wc_checkout_order_summery_end() {
		echo '<button type="button" class="button js-submit-order alt w-100 p-3">' . 'Bestelling Afrekenen en Betalen' . '</button>';

		wc_get_template( 'checkout/terms.php' );
		echo '</div>';
	}

	public function wc_checkout_payment_method_start() {
		echo '<div class="wc_payment_moment">';
		echo '<h3>' . __( 'Betaling' ) . '<span>Betaal veilig</span></h3>';
	}

	public function wc_checkout_payment_method_end() {
		echo '</div>';
	}

	public function wc_cart_payment_info() {
		echo '<div class="wc-payment-info-mode">';
		echo '<span><i class="icon-lock"></i> Betaal veilig</span>';
		if ( ( $payments = get_field( 'cart_payments', 'option' ) ) && ! empty( $payments ) ) {
			echo '<ul>';
			foreach ( $payments as $payment ) {
				echo '<li>' . wp_get_attachment_image( $payment['id'], 'medium' ) . '</li>';
			}
			echo '</ul>';
		}
		echo '</div>';
	}
}
