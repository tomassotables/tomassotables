<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Elex_Add_Custom_Fields {

	public function __construct() {
		add_action( 'woocommerce_product_options_general_product_data', array( $this, 'elex_gpf_custom_meta_fields' ) );
		add_action( 'woocommerce_process_product_meta', array( $this, 'elex_gpf_save_metas' ) );
		add_action( 'woocommerce_product_after_variable_attributes', array( $this, 'elex_gpf_variable_custom_meta_fields' ), 10, 3 );
		add_action( 'woocommerce_save_product_variation', array( $this, 'elex_gpf_save_variable_metas' ), 10, 1 );
	}

	public function elex_gpf_custom_meta_fields() {
		global $post;
		echo '<div id="elex_custom_metas" class="show_if_simple">';
		echo '<h4 style="text-align: left;">Google Product Feed</h4>';
		woocommerce_wp_text_input(
			array(
				'id' => '_elex_gpf_gtin',
				'label' => __( 'GTIN', 'elex-product-feed' ),
				'desc_tip' => 'true',
				'description' => __( 'The Global Trade Item Number (GTIN) is an identifier for trade items', 'woocommerce' ),
			)
		);
		woocommerce_wp_text_input(
			array(
				'id' => '_elex_gpf_mpn',
				'label' => __( 'MPN', 'woocommerce' ),
				'desc_tip' => 'true',
				'description' => __( 'A manufacturer part number (MPN) is a series of numbers and/or letters given to a part by its manufacturer', 'woocommerce' ),
			)
		);
		woocommerce_wp_text_input(
			array(
				'id' => '_elex_gpf_brand',
				'label' => __( 'Brand', 'woocommerce' ),
				'desc_tip' => 'true',
				'description' => __( 'Required for each product with a clearly associated brand or manufacturer', 'woocommerce' ),
			)
		);
		echo '</div>';
	}

	public function elex_gpf_save_metas( $post_id ) {
		if ( ! ( isset( $_POST['woocommerce_meta_nonce'] ) || wp_verify_nonce( sanitize_key( $_POST['woocommerce_meta_nonce'] ), 'woocommerce_save_data' ) ) ) { // Input var okay.
			return false;
		}
		$elex_gpf_brand = isset( $_POST['_elex_gpf_brand'] ) ? sanitize_text_field( $_POST['_elex_gpf_brand'] ) : '';
		$elex_gpf_gtin  = isset( $_POST['_elex_gpf_gtin'] ) ? sanitize_text_field( $_POST['_elex_gpf_gtin'] ) : '';
		$elex_gpf_mpn   = isset( $_POST['_elex_gpf_mpn'] ) ? sanitize_text_field( $_POST['_elex_gpf_mpn'] ) : '';
		if ( isset( $elex_gpf_brand ) ) {
			update_post_meta( $post_id, '_elex_gpf_brand', $elex_gpf_brand );
		}
		if ( isset( $elex_gpf_mpn ) ) {
			update_post_meta( $post_id, '_elex_gpf_mpn', esc_attr( $elex_gpf_mpn ) );
		}
		if ( isset( $elex_gpf_gtin ) ) {
			update_post_meta( $post_id, '_elex_gpf_gtin', esc_attr( $elex_gpf_gtin ) );
		}
	}

	public function elex_gpf_variable_custom_meta_fields( $variation_count, $variation_id, $variation_prod ) {
		echo '<div id="elex_custom_metas">';
		echo '<h4 style="text-align: left;">Google Product Feed</h4>';
		woocommerce_wp_text_input(
			array(
				'id' => '_elex_gpf_variable_gtin[' . $variation_count . ']',
				'label' => __( '<br>GTIN', 'woocommerce' ),
				'desc_tip' => 'true',
				'description' => __( 'The Global Trade Item Number (GTIN) is an identifier for trade items', 'woocommerce' ),
				'value' => get_post_meta( $variation_prod->ID, '_elex_gpf_gtin', true ),
				'wrapper_class' => 'form-row-full',
			)
		);
		woocommerce_wp_text_input(
			array(
				'id' => '_elex_gpf_variable_mpn[' . $variation_count . ']',
				'label' => __( 'MPN', 'woocommerce' ),
				'desc_tip' => 'true',
				'description' => __( 'A manufacturer part number (MPN) is a series of numbers and/or letters given to a part by its manufacturer', 'woocommerce' ),
				'value' => get_post_meta( $variation_prod->ID, '_elex_gpf_mpn', true ),
				'wrapper_class' => 'form-row-full',
			)
		);
		woocommerce_wp_text_input(
			array(
				'id' => '_elex_gpf_variable_brand[' . $variation_count . ']',
				'label' => __( 'Brand', 'woocommerce' ),
				'desc_tip' => 'true',
				'description' => __( 'Required for each product with a clearly associated brand or manufacturer.', 'woocommerce' ),
				'value' => get_post_meta( $variation_prod->ID, '_elex_gpf_brand', true ),
				'wrapper_class' => 'form-row-full',
			)
		);
		echo '</div>';
	}

	public function elex_gpf_save_variable_metas( $id ) {
		if ( ! ( isset( $_POST['woocommerce_meta_nonce'] ) || wp_verify_nonce( sanitize_key( $_POST['woocommerce_meta_nonce'] ), 'woocommerce_save_data' ) ) ) { // Input var okay.
			return false;
		}
		$variable_post_id = isset( $_POST['variable_post_id'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['variable_post_id'] ) ) : array();
		$count = ! empty( $variable_post_id ) ? max( array_keys( $variable_post_id ) ) : 0;
		for ( $i = 0; $i <= $count; $i++ ) {
			if ( isset( $_POST['variable_post_id'][ $i ] ) ) {
				if ( isset( $_POST['_elex_gpf_variable_gtin'][ $i ] ) ) {
					update_post_meta( sanitize_text_field( $_POST['variable_post_id'][ $i ] ), '_elex_gpf_gtin', stripslashes( sanitize_text_field( $_POST['_elex_gpf_variable_gtin'][ $i ] ) ) );
				}
				if ( isset( $_POST['_elex_gpf_variable_mpn'][ $i ] ) ) {
					update_post_meta( sanitize_text_field( $_POST['variable_post_id'][ $i ] ), '_elex_gpf_mpn', stripslashes( sanitize_text_field( $_POST['_elex_gpf_variable_mpn'][ $i ] ) ) );
				}
				if ( isset( $_POST['_elex_gpf_variable_brand'][ $i ] ) ) {
					update_post_meta( sanitize_text_field( $_POST['variable_post_id'][ $i ] ), '_elex_gpf_brand', stripslashes( sanitize_text_field( $_POST['_elex_gpf_variable_brand'][ $i ] ) ) );
				}
			}
		}
	}

}

new Elex_Add_Custom_Fields();
