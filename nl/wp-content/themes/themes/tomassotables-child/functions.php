<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
   wp_enqueue_script(
        'custom-script',
        get_stylesheet_directory_uri().'/custom_cart.js?v='.time(),
        array( 'jquery' ),
        '1.0',
        true
    );
}
add_filter('woof_get_more_less_button_label', 'woof_get_more_less_button');

    function woof_get_more_less_button($args)
    {
    	echo "string";die;
        $args['type'] = 'text';
        $args['closed'] = 'Open me';
        $args['opened'] = 'Close me';

        return $args;
    }

function rf_product_thumbnail_size( $size ) {
    global $product;

    $size = 'full';
    return $size;
}
add_filter( 'single_product_archive_thumbnail_size', 'rf_product_thumbnail_size' );
add_filter( 'subcategory_archive_thumbnail_size', 'rf_product_thumbnail_size' );
add_filter( 'woocommerce_gallery_thumbnail_size', 'rf_product_thumbnail_size' );
add_filter( 'woocommerce_gallery_image_size', 'rf_product_thumbnail_size' );

function discript_short($zin){
	if($zin){
	$sb_cont = explode(" ",$zin);
		for($i=0;$i<20;$i++){
			echo $sb_cont[$i].' ';
			}
		echo '... <a id="to_product_detail">- Lees meer</a>';
		}
	}

function wc_heart_count(){
	$count = yith_wcwl_count_products();
	echo $count;
	}


if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_get_items_count' ) ) {
  function yith_wcwl_get_items_count() {
    ob_start();
    ?>
    <?php echo esc_html( yith_wcwl_count_all_products() ); ?></i>
    <?php
    return ob_get_clean();
  }

  add_shortcode( 'yith_wcwl_items_count', 'yith_wcwl_get_items_count' );
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ) {
  function yith_wcwl_ajax_update_count() {
    wp_send_json( array(
      'count' => yith_wcwl_count_all_products()
    ) );
  }

  add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
  add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_enqueue_custom_script' ) ) {
  function yith_wcwl_enqueue_custom_script() {
    wp_add_inline_script(
      'jquery-yith-wcwl',
      "
        jQuery( function( $ ) {
          $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
            $.get( yith_wcwl_l10n.ajax_url, {
              action: 'yith_wcwl_update_wishlist_count'
            }, function( data ) {
              $('#heart_count').html( data.count );
            } );
          } );
        } );
      "
    );
  }

  add_action( 'wp_enqueue_scripts', 'yith_wcwl_enqueue_custom_script', 20 );
}


function your_function() {
	$usps = get_field('usps','option');
	$snel_in_huis_icon = get_field('snel_in_huis_icon','option');
	$usps_row = "";
	if($usps){
		foreach($usps as $usp){
			$usps_row .= '<div class="usp_producten_row_item">'.$usp['usp'].'</div>';
			}
		}
    ?>
    <script>
	jQuery(window).resize(function(){
		jQuery('#usp_producten_row_mobile').find('.usp_producten_row_item').css('width',jQuery('#usp_producten_row_mobile').width()+'px');    
	    });	
	jQuery(document).ready(function(){
		
		
		jQuery('html').on('click','.variation_kleur_thumb',function(){
			jQuery('.variation_kleur_thumb').removeClass('picked');
			waarde = jQuery(this).attr('data-kleur');
			jQuery('#pa_kleur').val(waarde);
			jQuery('#pa_kleur').trigger('change');
			jQuery(this).addClass('picked');
			});
		
		
		
		
		
		
		
		
		/*
		jQuery('html').on('click','.open_chat',function(e){
			e.preventDefault();
			alert('hey');
			var iframe = jQuery("#tidio-chat-iframe").contents();
			jQuery("#button", iframe).trigger("click");
			
			
			});
		*/
		
		if(jQuery('.woocommerce-product-gallery').length > 0){
			jQuery('.woocommerce-product-gallery').append('<div class="snel_in_huis_label single_snel_in_huis"><img class="snel_in_huis_img" src="<?php echo $snel_in_huis_icon; ?>" alt=""> Snel in huis</div>');
			}
		
		
		
		if(jQuery('#producten_rij').length > 0){
				if(jQuery('#producten_rij>div').length < 2){
					jQuery('#producten_rij>div:eq(0)').after('<div id="usp_producten_row_desktop"><div id="usp_producten_row_inner"><?php echo $usps_row; ?></div></div>');
				}else if(jQuery('#producten_rij>div').length < 3){
					jQuery('#producten_rij>div:eq(1)').after('<div id="usp_producten_row_desktop"><div id="usp_producten_row_inner"><?php echo $usps_row; ?></div></div>');
				}else{
					jQuery('#producten_rij>div:eq(2)').after('<div id="usp_producten_row_desktop"><div id="usp_producten_row_inner"><?php echo $usps_row; ?></div></div>');
				}
				
				if(jQuery('#producten_rij>div').length < 2){
					jQuery('#producten_rij>div:eq(0)').after('<div id="usp_producten_row_mobile"><div id="usp_producten_row_inner"><?php echo $usps_row; ?></div></div>');
				}else{
					jQuery('#producten_rij>div:eq(1)').after('<div id="usp_producten_row_mobile"><div id="usp_producten_row_inner"><?php echo $usps_row; ?></div></div>');
				}
			jQuery('#usp_producten_row_mobile').find('.usp_producten_row_item').css('width',jQuery('#usp_producten_row_mobile').width()+'px');
			
			if(jQuery(window).width() < 768){
				var intrslide = setInterval(begin_maar, 3000);
				}
			function begin_maar(){
				jQuery('#usp_producten_row_inner').animate({
					'marginLeft': '-'+jQuery('#usp_producten_row_mobile').width()+'px'
					},function(){
						jQuery('#usp_producten_row_inner').append(jQuery('#usp_producten_row_inner').find('.usp_producten_row_item').first());
						jQuery('#usp_producten_row_inner').css('marginLeft','0px')
						});
				}
			
			}
		
		
		
		
		
		jQuery('html').on('click','.woocommerce-loop-product__link',function(){
			window.location.href = jQuery(this).find('.add_to_cart_button').attr('href');
			});
		
		jQuery('html').on('click','#to_product_detail',function(){
			var aTag = jQuery("a[name='product-detail']");
			jQuery('html,body').animate({scrollTop: aTag.offset().top-260},'slow');
			});
		
		
		
	
		
		if(jQuery(".employee__btn").length > 0){
		jQuery(".employee__btn").removeAttr('href');
		(function() {
			  document.querySelector(".employee__btn").addEventListener("click", function() {
			    window.tidioChatApi.show();
			    window.tidioChatApi.open();
			  });
			})();
			}
		
		if(jQuery(".open_chat").length > 0){
		jQuery(".open_chat").removeAttr('href');
		(function() {
			 document.querySelector(".open_chat").addEventListener("click", function() {
			    window.tidioChatApi.show();
			    window.tidioChatApi.open();
			  });
			})();
			}
		
		if(jQuery(".open_chat10").length > 0){
		jQuery(".open_chat10").removeAttr('href');
		(function() {
			 document.querySelector(".open_chat10").addEventListener("click", function() {
			    window.tidioChatApi.show();
			    window.tidioChatApi.open();
			  });
			})();
			}
			
		if(jQuery(".open_chat2").length > 0){
		jQuery(".open_chat2").removeAttr('href');
		(function() {
			document.querySelector(".open_chat2").addEventListener("click", function() {
			    window.tidioChatApi.show();
			    window.tidioChatApi.open();
			  });
			})();
			}	
			
		if(jQuery(".open_chat3").length > 0){
		jQuery(".open_chat3").removeAttr('href');
		(function() {
			  document.querySelector(".open_chat3").addEventListener("click", function() {
			    window.tidioChatApi.show();
			    window.tidioChatApi.open();
			  });
			})();
			}
		
		if(jQuery(".appointment__text .secondary").length > 0){
		jQuery(".appointment__text .secondary").removeAttr('href');
		(function() {
			  document.querySelector(".appointment__text .secondary").addEventListener("click", function() {
			    window.tidioChatApi.show();
			    window.tidioChatApi.open();
			  });
			})();
			}	
			
				
		});	
	</script>
    <?php
}
add_action( 'wp_footer', 'your_function' );


add_filter( 'woocommerce_get_related_product_cat_terms', function( $terms, $product_id ) {
	
	if ( function_exists( 'yoast_get_primary_term_id' ) ) {
		$primary_term_product_id = yoast_get_primary_term_id( 'product_cat', $product_id );
		if ( $primary_term_product_id ) {
			return array( $primary_term_product_id );
		}
	}
	return $terms;
}, 10, 2 );


//add_action('wp_footer','shopping_fun',10);

function shopping_fun(){
	if(is_cart() || is_checkout()){
		?>
		<script>
			jQuery(document).ready(function($){
				if($("section.processing")){
					$("section.processing").attr('data-component','shopping');
					$("section.processing").removeClass('processing');
				}
			});
		</script>
		<?php
	}
}

add_filter('woocommerce_variable_sale_price_html', 'shop_variable_product_price', 10, 2);
add_filter('woocommerce_variable_price_html','shop_variable_product_price', 10, 2 );
function shop_variable_product_price( $price, $product ){
    $variation_min_reg_price = $product->get_variation_regular_price('min', true);
    $variation_min_sale_price = $product->get_variation_sale_price('min', true);
    if ( $product->is_on_sale() && !empty($variation_min_sale_price)){
        if ( !empty($variation_min_sale_price) )
            $price = '<del class="strike">' .  wc_price($variation_min_reg_price) . '</del>' .' Vanaf'.  wc_price($variation_min_sale_price);
    } else {
        if(!empty($variation_min_reg_price))
            $price = 'Vanaf'. wc_price($variation_min_reg_price) ;
        else
            $price = 'Vanaf'. wc_price($product->regular_price) ;
    }
    return $price;
}

// Remove all currency symbols
function sww_remove_wc_currency_symbols( $currency_symbol, $currency ) {
     $currency_symbol = '';
     return $currency_symbol;
}
add_filter('woocommerce_currency_symbol', 'sww_remove_wc_currency_symbols', 10, 2);

/**
 * Trim zeros in price decimals
 **/
 add_filter( 'woocommerce_price_trim_zeros', '__return_true' );

// add_filter('wc_price',function($price){
// 	if(substr($price, -3) == ',00'){
// 		return str_replace(',00',',-', $price);
// 	}
// 	return $price;
// },99);

?>

