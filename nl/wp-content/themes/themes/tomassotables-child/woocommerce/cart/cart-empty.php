<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */

?>

<div class="woocommerce-cart-form">
	<ul class="shop_table cart woocommerce-cart-form__contents">
		<li class="woocommerce-cart-form__cart-empty cart_item">
			<?php do_action( 'woocommerce_cart_is_empty' );

			if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
				<p class="return-to-shop">
					<a class="btn btn-outline-primary wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
						<?php
						/**
						 * Filter "Return To Shop" text.
						 *
						 * @param string $default_text Default text.
						 *
						 * @since 4.6.0
						 */
						echo esc_html( apply_filters( 'woocommerce_return_to_shop_text', __( 'Keer terug naar de winkel', 'woocommerce' ) ) );
						?>
					</a>
				</p>
			<?php endif; ?>
		</li>
	</ul>
</div>

<div class="cart-collaterals">
	<?php
	/**
	 * Cart collaterals hook.
	 *
	 * @hooked woocommerce_cross_sell_display
	 * @hooked woocommerce_cart_totals - 10
	 */
	do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

