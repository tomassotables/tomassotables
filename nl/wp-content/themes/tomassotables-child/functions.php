<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css?v='.time() );
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
			echo @$sb_cont[$i].' ';
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
            $price = '<del class="strike">' .  wc_price($variation_min_reg_price) . '</del>' .' Vanaf '.  wc_price($variation_min_sale_price);
    } else {
        if(!empty($variation_min_reg_price))
            $price = 'Vanaf '. wc_price($variation_min_reg_price) ;
        else
            $price = 'Vanaf '. wc_price($product->regular_price) ;
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

/**
 *  Custom Added to your Cart Message 
 */
 
add_filter( 'wc_add_to_cart_message_html', 'njengah_custom_added_to_cart_message' );
 
function njengah_custom_added_to_cart_message() {
	
	$message = 'Product toegevoegd aan je winkelwagen' ;
	
	return $message;
	
}

function footer_script(){
	if ( is_product() ){
	?>
		<script>
			jQuery(function($){
				$( ".single_variation_wrap" ).on( "show_variation", function ( event, variation ) {
				//$( ".variations_form" ).on( "woocommerce_variation_select_change", function () {	
					$(".tomassotables_price").hide();
					//change_priceformatt();
					//change_priceformatt();
					// if($(".woocommerce-Price-amount.amount").length > 0){
					// 	jQuery(".woocommerce-Price-amount.amount").each(function(){
					// 		var get_text= jQuery(this).children("bdi").text();

					// 		if (get_text.indexOf(',') > -1 || total_cart_text.indexOf('.') > -1) {
			        //             var subtext = get_text.substring(get_text.indexOf(',') + 1);
			        //             if(subtext == '00'){
			        //                 var new_price = get_text.substring(0 ,get_text.indexOf(','))+",-"
			        //                 jQuery(this).children("bdi").html('<span class="woocommerce-Price-currencySymbol"></span>&nbsp;'+new_price);
			        //             }
			        //         } 
					// 		else {
			        //             var new_price=get_text+",-"
			        //             jQuery(this).children("bdi").html('<span class="woocommerce-Price-currencySymbol"></span>&nbsp;'+new_price);
			        //         }
					// 	});
						
					// }
					// if(jQuery(".woocommerce-Price-amount").length > 0){
                    // 	jQuery(".woocommerce-Price-amount").each(function(){
                    // 		var total_cart_text= jQuery(this).text(); 
                    // 		var new_total_price = total_cart_text+",-"
                    //         if (total_cart_text.indexOf(',') > -1 || total_cart_text.indexOf('.') > -1) {
                    //             var laststr = total_cart_text.substring(total_cart_text.lastIndexOf(',') + 1);
                    //             if(laststr == '00'){
                    //                 jQuery(this).text(total_cart_text.replace(','+laststr,',-'));
                    //             }else{
					// 		    	jQuery(this).text(total_cart_text.replace(','+laststr,',-'));
					// 		    }
                    //         } 
					// 		else {
		            //             	jQuery(this).text(new_total_price);
		            //         }
					//     });
					// }
				});
			});

			jQuery(function($){
				$( ".single_variation_wrap" ).on( "hide_variation", function ( event, variation ) {	
					$(".tomassotables_price").show();
					//change_priceformatt();
				});
			});
		</script>

	<?php }  ?>

	<?php if ( is_checkout() ) { ?>
		<script>
			jQuery(function($){
				setTimeout(function(){
					//change_priceformat();
				}, 2000);

				/*function change_priceformat(){
					// var get_text= $(".cart-subtotal .woocommerce-Price-amount bdi").text();

					// var total_cart_text= $(".order-total .woocommerce-Price-amount bdi").text();

					// if (get_text.indexOf(',') > -1 || total_cart_text.indexOf('.') > -1) {} 
					// else {
                    //     var new_price=get_text+",-"
                    //     $(".cart-subtotal .woocommerce-Price-amount bdi").html('<span class="woocommerce-Price-currencySymbol"></span>&nbsp;'+new_price);
                    // }

                    // if (total_cart_text.indexOf(',') > -1 || total_cart_text.indexOf('.') > -1) {} 
					// else {
                    //     var new_total_price=total_cart_text+",-"
                    //     $(".order-total .woocommerce-Price-amount bdi").html('<span class="woocommerce-Price-currencySymbol"></span>&nbsp;'+new_total_price);
                    // }

                    // if($(".woocommerce-Price-amount").length > 0){
                    // 	$(".woocommerce-Price-amount bdi").each(function(){
                    // 		var total_cart_text= $(this).text();
                    // 		var new_total_price = total_cart_text+",-"
                    //     	$(".order-total .woocommerce-Price-amount bdi").text(new_total_price);
                    // 	});
                    // }

                    if(jQuery(".woocommerce-Price-amount").length > 0){
                    	jQuery(".woocommerce-Price-amount").each(function(){
                    		var total_cart_text= jQuery(this).text(); 
                    		var new_total_price = total_cart_text+",-"
                            if (total_cart_text.indexOf(',') > -1 || total_cart_text.indexOf('.') > -1) {
                                var laststr = total_cart_text.substring(total_cart_text.lastIndexOf(',') + 1);
                                if(laststr == '00'){
                                    jQuery(this).text(total_cart_text.replace(','+laststr,',-'));
                                }else{
							    	jQuery(this).text(total_cart_text.replace(','+laststr,',-'));
							    }
                            } 
							else {
		                        	jQuery(this).text(new_total_price);
		                    }
					    });
					}
					if(jQuery(".includes_tax").length > 0){
						var total_cart_text= jQuery(".includes_tax").text().replace('(inclusief','').replace(' BTW)','').trim();
						var new_total_price = total_cart_text+",-"
						if (total_cart_text.indexOf(',') > -1 || total_cart_text.indexOf('.') > -1) {
						    var laststr = total_cart_text.substring(total_cart_text.lastIndexOf(',') + 1);
						    
						    if(laststr == '00'){
						        jQuery(".includes_tax").text(total_cart_text.replace(','+laststr,',-'));
						    }else{
						    	jQuery(".includes_tax").text(total_cart_text.replace(','+laststr,',-'));
						    }
						} 
						else {
						        jQuery(".includes_tax").text(new_total_price);
						}
					}

				}*/


				$("body").on("change", "#billing_country", function(){
					setTimeout(function(){
						//change_priceformat();
					}, 2000);
				});
			});
		</script>
	<?php
	}else{ ?>

	<?php }
}

add_action('wp_footer', 'footer_script');
add_filter( 'upload_dir', 'wpse_261931_upload_dir', 15, 1 );
function wpse_261931_upload_dir( array $uploads ) {
 	if(isset($uploads['path'])){
 		$uploads['path'] = str_replace('/nl', '', $uploads['path']);
 	}
 	if(isset($uploads['basedir'])){
 		$uploads['basedir'] = str_replace('/nl', '', $uploads['basedir']);
 	}
 	return $uploads;
 	//echo "<pre>";print_r($uploads);die;
}


add_filter( 'wc_price', 'woo_format_decimal_value', 20, 4 ); 
function woo_format_decimal_value( $return, $price, $args, $unformatted_price ) { 
	if(substr($price, strrpos($price, ',' )+1) == '00'){
		return substr($price, 0, strripos($price, ',')).',-';
	}else if(strpos($price, ',') === false){
		return $price.',-';
	}else if(substr($price, strrpos($price, ',' )+1) != '00'){
		return $price.',-';
	}
	return $price;
}
add_action( 'template_redirect','custom_redirect_to_mapped_domain');

function custom_redirect_to_mapped_domain(){
	global $wp;
	if(!is_admin() && !empty($wp->request) && substr($wp->request, 0,2) !== 'nl'){
		$status   = get_site_option( 'dm_301_redirect' ) ? '301' : '302'; // Honor status redirect option
		wp_safe_redirect(home_url('/nl/'.$wp->request),$status);
		exit;
	}
	
}

?>