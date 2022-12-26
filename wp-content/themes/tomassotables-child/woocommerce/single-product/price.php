<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$prd_id=  get_the_id();

$stock_status= get_post_meta( $prd_id, '_stock_status', true );
$delivery_time= get_post_meta( $prd_id, 'delivery_time', true );

?>

<div class="delivery_information desktop_screen">
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