<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $product;

the_title( '<h1 class="product_title entry-title">', '</h1>' );
?>

<div class="product_single_data">
    <span class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></span>
    <?php
    $prd_id=  get_the_id();
    $product = wc_get_product($prd_id);

    if ( $product->is_on_sale() ) {
        $percentage=0;
        if( $product->is_type('variable')){
            $percentages = $var_reg_price= $var_sale_price = array();

            // Get all variation prices
            $prices = $product->get_variation_prices();

            // Loop through variation prices
            foreach( $prices['price'] as $key => $price ){
                // Only on sale variations
                if( $prices['regular_price'][$key] !== $price ){
                    // Calculate and set in the array the percentage for each variation on sale
                    $percentages[] = round(100 - ($prices['sale_price'][$key] / $prices['regular_price'][$key] * 100));
                    $var_reg_price[]= $prices['regular_price'][$key];
                    $var_sale_price[]= $prices['sale_price'][$key];
                }
            }
            $percentage = max($percentages) . '%';
            $total_saving= max($var_reg_price)-max($var_sale_price);
            ?>
            <span class="discount_price">Je bespaart <?= $total_saving; ?>,-</span>

        <?php
        } else {
            $regular_price = (float) $product->get_regular_price();
            $sale_price    = (float) $product->get_sale_price();

            $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
            $total_saving= $regular_price-$sale_price;

            $stock_status= get_post_meta($prd_id, '_stock_status', true);
            $get_stock= get_post_meta($prd_id, '_stock', true);
            ?>
            <span class="discount_price">Je bespaart <?= $total_saving; ?>,-</span>
            <?php if($stock_status=="instock"){ ?>
                <span class="stock_in">Op Voorraad</span>
                <?php if($get_stock <= 15){ ?>
                    <span class="discount_price">Slechts <?= $get_stock; ?> op voorraad</span>
                <?php } else { ?>
                    <span class="discount_price">Op Voorraad</span>
                <?php } ?>
            <?php } 
        }
    } 
    ?>
</div>


