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
$prd_id=  get_the_id();
$product = wc_get_product($prd_id);

$stock_status= get_post_meta( $prd_id, '_stock_status', true );
$delivery_time= get_post_meta( $prd_id, 'delivery_time', true );
?>



<div class="delivery_information mobile_screen">
    <div class="delivery_time">
        <span class="icon">
            <img src="<?php echo site_url() ?>/wp-content/uploads/delivery.png"/>
        </span>
        <span class="icon_text"><?= $delivery_time ?></span>
    </div>
    <?php if($stock_status=="instock"){ ?>
    <div class="stock_status">
        <span class="icon">
            <img src="<?php echo site_url() ?>/wp-content/uploads/instock.png"/>
        </span>
        <span class="icon_text">Op Voorraad</span>
    </div>
    <?php } ?>
</div>

<?php 
the_title( '<h1 class="product_title entry-title">', '</h1>' );
?>

<div class="product_single_data">
    <span class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></span>
    <?php
    
    global  $woocommerce; 
    
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

    <?php
    } else {
        $regular_price = (float) $product->get_regular_price();
        $sale_price    = (float) $product->get_sale_price();

        $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
        $total_saving= $regular_price-$sale_price;
        $string = wc_price( $total_saving, array() );

        $stock_status= get_post_meta($prd_id, '_stock_status', true);
        $get_stock= get_post_meta($prd_id, '_stock', true);
        $currency_symbol= get_option('woocommerce_currency');
        
        $symbols = apply_filters( 'woocommerce_currency_symbols', array($currency_symbol=>'€'));
        
        ?>
        <?php if ( $product->is_on_sale() ) { ?>
            <span class="discount_price">Je bespaart <?= $symbols[$currency_symbol].$string; ?></span>
        <?php } ?>

        <?php if($stock_status=="instock"){ ?>
            
            <?php if($get_stock <= 15){ ?>
                <span class="discount_price slechts_price">Slechts <strong><?=  $get_stock; ?></strong> op voorraad</span>
            <?php } else {?>
                <span class="discount_price slechts_price">Slechts <strong>15</strong> op voorraad</span>
            <?php } ?>
        <?php } 
    }
    
    ?>
</div>


