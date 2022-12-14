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

add_action( 'woocommerce_before_add_to_cart_button', 'misha_before_add_to_cart_btn' );
 
function misha_before_add_to_cart_btn(){
	if ( is_product() ){
		global $product;
	    echo '<p class="price tomassotables_price">'. $product->get_price_html().'</p>';
	}
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
//add_filter( 'single_product_archive_thumbnail_size', 'rf_product_thumbnail_size' );
//add_filter( 'subcategory_archive_thumbnail_size', 'rf_product_thumbnail_size' );
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
//add_filter( 'woocommerce_price_trim_zeros', '__return_true' );

// add_filter('wc_price',function($price){
// 	if(substr($price, -3) == ',00'){
// 		return str_replace(',00',',-', $price);
// 	}
// 	return $price;
// },99);


function isfloat($num) {
    return is_float($num) || is_numeric($num) && ((float) $num != (int) $num);
}



//add_filter('formatted_woocommerce_price', 'format_price', 10, 4);

function format_price($formatted_price, $price, $decimals, $decimal_separator) {
    // Need to trim 0s only if we have the decimal separator present.

    if (strpos($formatted_price, $decimal_separator) !== false) {
        $formatted_price = rtrim($formatted_price, '0');
		$formatted_price = rtrim($formatted_price, $decimal_separator);

		if(!isfloat($formatted_price)){
			$formatted_price = $formatted_price.$decimal_separator;
        }
    }
    return $formatted_price;
}


//add_filter( 'woocommerce_get_price_html', 'wpa83367_price_html', 100, 2 );
function wpa83367_price_html( $price, $product ){
    return 'Was:' . str_replace( '<ins>', ' Now:<ins>', $price );
}

function footer_script(){
	?>

	<script>
		jQuery(function($){
			$(window).load(function () {
				$(".category-section #sb_desktop_top").css("visibility", "visible");
				$(".sidebar #sb_mobile_top").css("visibility", "visible");
			});
		});
	</script>

	<?php
	if ( is_product() ){
	?>
		<script>
			jQuery(function($){
				
				$( ".single_variation_wrap" ).on( "show_variation", function ( event, variation ) {
					$(".tomassotables_price").hide();
					if($(".woocommerce-variation-price").html() == ''){
						$(".woocommerce-variation-price").html('<span class="price">'+ $("p.tomassotables_price").text().replace('Vanaf ','')+'</span>');
					}
				});
			});
			jQuery(function($){
				$( ".single_variation_wrap" ).on( "hide_variation", function ( event, variation ) {	
					$(".tomassotables_price").show();
				});
			});
		</script>
	<?php }  ?>
	<?php if ( is_checkout() ) { ?>
		<script>
			jQuery(function($){
				
			});
		</script>
	<?php
	}else{ ?>

	<?php }
}
add_action('wp_footer', 'footer_script');
add_filter( 'wc_price', 'woo_format_decimal_value', 20, 4 ); 
function woo_format_decimal_value( $return, $price, $args, $unformatted_price ) { 
	if(strpos($price, ',') !== false && substr($price, strrpos($price, ',' )+1) == '00'){
		return substr($price, 0, strripos($price, ',')).',-';
	}else if(strpos($price, ',') === false){
		return $price.',-';
	}else if(substr($price, strrpos($price, ',' )+1) != '00'){
		return $price.',-';
	}
	return $price;
}


function header_script(){
	?>
	<style>
		.category-section #sb_desktop_top, .sidebar #sb_mobile_top {
		    visibility: hidden;
		}
	</style>
<?php

}
add_action('wp_head', 'header_script');




add_filter('wp_unique_term_slug', 'prevent_cat_suffix', 10, 3);
function prevent_cat_suffix($slug, $term, $original_slug)
{
    if ($term->post_type == 'product' && $term->parent !== 0) {
        return $original_slug;
    }

    return $slug;
}



// Automatically Delete Woocommerce Images After Deleting a Product
add_action( 'before_delete_post', 'delete_product_images', 10, 1 );

function delete_product_images( $post_id )
{
    $product = wc_get_product( $post_id );

    if ( !$product ) {
        return;
    }

    $featured_image_id = $product->get_image_id();
    $image_galleries_id = $product->get_gallery_image_ids();

    if( !empty( $featured_image_id ) ) {
        wp_delete_post( $featured_image_id );
    }

    if( !empty( $image_galleries_id ) ) {
        foreach( $image_galleries_id as $single_image_id ) {
            wp_delete_post( $single_image_id );
        }
    }
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



//Label 51 csv Product Syncing

function product_sync_label51(){
    global $wpdb;
    $csv_url=get_field('label51_products', 'option');
    //$csv_url= "https://files.channable.com/CajUa9zezz46vWbriwJZVw==.csv";
    // $source = file_get_contents($csv_url);
    
    // $label51_nm= get_template_directory()."/import_csv/label51.csv";
    // file_put_contents($label51_nm, $source);

    $data = file_get_contents($csv_url);
    $rows = explode("\n",$data);
    
    unset($rows[0]);
    

    
    $s = array();
    foreach($rows as $row) {
        if(isset($row) && !empty($row)){
            $s[] = str_getcsv($row);
        }
    }
    

    $stock_data=array();
    $i=1;
    $prdID=array();

    foreach($s as $stocks){
        if(!empty($stocks[1])) {
            $sku= $stocks[1];
            $stock= $stocks[30];
            $productId = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $sku ) );
            if($productId){
                $prdID[]=$productId;
                if($stock==1){
                    $productValue= 50;
                    update_post_meta($productId, '_stock_status', "instock");
                    update_post_meta($productId, '_stock', $productValue);
                } else {
                    update_post_meta($productId, '_stock', NULL);
                    update_post_meta($productId, '_stock_status', "outofstock");
                }
            }
        }
        $i++;
    }

    $count= count($prdID);
    $import_ids=implode(", ", $prdID);
    
    $result=array(
        "code" => 200,
        "count_products" => $count,
        "message" => "Import successful and its affected on $import_ids",
        "product_match_id" => $import_ids, 
    );

    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";

    return $result;
}

add_action('sync_label51', 'product_sync_label51');
//End Label 51 csv Product Syncing




//Living Fun csv Product Syncing
function livingfun_downloadcsv(){
	global $wpdb;
	// API token:
	$authentication = "0zU9Z7YqBvmZ7wrUZ3uFj6Xj8nRnZujoXhje9AKb9WeBYUYnCgZ9EH9Y9oZ9";

	if ( ! is_dir( get_stylesheet_directory()  . '/livingfurn/' ) ) {
	    mkdir( get_stylesheet_directory()  . '/livingfurn/', 0700 );
	}

	$curl = curl_init();
	curl_setopt_array($curl, array(
	    CURLOPT_URL => "https://feed.livingfurn.nl/api/feed",
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_MAXREDIRS => 10,
	    CURLOPT_TIMEOUT => 30,
	    CURLOPT_FOLLOWLOCATION => true,
	    CURLOPT_CUSTOMREQUEST => "GET",
	    CURLOPT_HTTPHEADER => array(
	        "Authorization: Bearer $authentication",
	        "Cache-Control: no-cache",
	        "Connection: keep-alive",
	    ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

	if ($err) {
	    echo "cURL Error #:" . $err;
	} else {
	    file_put_contents( get_stylesheet_directory() . '/livingfurn/feed.csv', $response );
	    $feed_url=get_stylesheet_directory_uri().'/livingfurn/feed.csv';
	    update_option('options_livingfurn_products', $feed_url);



	    $data = file_get_contents($feed_url);
	    $rows = explode("\n",$data);
	    
	    unset($rows[0]);
	    
	    $s = array();
	    foreach($rows as $row) {
	        if(isset($row) && !empty($row)){
	            $s[] = str_getcsv($row);
	        }
	    }



	    $stock_data=array();
	    $i=1;
	    $prdID=array();


	    foreach($s as $stocks){
	        if(!empty($stocks[0])) {
	            $sku= $stocks[0];
	            $stock= $stocks[73];

	            $productId = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $sku ) );
	            if($productId){
	            	$prdID[]=$productId;
	                if($stock != "-"){
	                    update_post_meta($productId, '_stock_status', "instock");
	                    update_post_meta($productId, '_stock', $stock);
	                } else {
	                    update_post_meta($productId, '_stock', NULL);
	                    update_post_meta($productId, '_stock_status', "outofstock");
	                }
	            }
	        }
	        $i++;
	    }

	    $count= count($prdID);
	    $import_ids=implode(", ", $prdID);
	    
	    $result=array(
	        "code" => 200,
	        "count_products" => $count,
	        "message" => "Import successful and its affected on $import_ids",
	        "product_match_id" => $import_ids, 
	    );

	    return $result;

	}
}
add_shortcode('livingfun_csv', 'livingfun_downloadcsv');
add_action('livingfun_csv', 'livingfun_downloadcsv');

//End Living Fun csv Product Syncing



//Drop Ship Scheduler
// function bf_add_custom_schedule( $schedules ) {
//     $schedules[ 'once_per_day' ] = array(
//         'interval' => 86400,
//         'display'  => 'Drop Shipping Once Daily',
//     );

//     return $schedules;
// }


function product_sync_dropshipping(){
    global $wpdb;
    $csv_url=get_field('dropshipping_europe_products', 'option');

    if ( ! is_dir( get_stylesheet_directory()  . '/dropship/' ) ) {
	    mkdir( get_stylesheet_directory()  . '/dropship/', 0700 );
	}

    $outputFile = get_stylesheet_directory()  . '/dropship/dropship-part-';
	$splitSize = 5000; // 10k records in a one file
	$in = fopen($csv_url, 'r');

	$rows = 0;
	$fileCount = 0;
	$out = null;

	$prdID=array();

	while (!feof($in)) {
	    if (($rows % $splitSize) == 0) {
	        if ($rows > 0) {
	            fclose($out);
	        }

	        $fileCount++;

	        // for filenames like indiacountry-part-0001.csv, indiacountry-part-0002.csv etc
	        $fileCounterDisplay = $fileCount;

	        $fileName = "$outputFile$fileCounterDisplay.csv";
	        $out = fopen($fileName, 'w');
	    }

	    $data = fgetcsv($in);

	    if ($data)
	        fputcsv($out, $data);

	    $rows++;
	}

	fclose($out);

	update_option('dropshipCount', $fileCount);

	//add_filter( 'cron_schedules', 'bf_add_custom_schedule' );

	for($k=1; $k <= $fileCount; $k++){
		if( !wp_next_scheduled( $dynamic_schedular ) ) {
			$time = time() + ($k * 600);
			$filename= "dropship-part-".$k.".csv";
	        wp_schedule_single_event($time, 'dropship_call_schedullar', [$filename]);
	    }
	}
}

add_action( 'dropship_csv', 'product_sync_dropshipping');




function dropship_call_schedullar($filename) {
	global $wpdb;
	//$filename= "dropship-part-9.csv";
	$outputFile = get_stylesheet_directory_uri()  . '/dropship/'.$filename;
	$data = file_get_contents($outputFile);
	$rows = explode("\n",$data);
	unset($rows[0]);
	unset($rows[0]);
	$prdID=array();

	// echo "<pre>";
	// print_r($rows);
	// die();

	foreach($rows as $stocks){
    	$explode= explode(";", $stocks);
    	

    	$prd_sku= $explode[0];
    	$prd_stock= $explode[1];

    	//echo $prd_sku." - ". $prd_stock. "<br/>";


    	$productId = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $prd_sku ) );
    	if($productId){
    		$prdID[]=$productId;
    		if($prd_stock==0){
                update_post_meta($productId, '_stock', NULL);
                update_post_meta($productId, '_stock_status', "outofstock");
            } else {
            	//echo "Product ID: ".$productId." SKU: ".$prd_sku." - ". $prd_stock. "<br/>";
                update_post_meta($productId, '_stock_status', "instock");
                update_post_meta($productId, '_stock', $prd_stock);
            }
    	}
	}


    $count= count($prdID);
    $import_ids=implode(", ", $prdID);
    
    $result=array(
        "code" => 200,
        "count_products" => $count,
        "message" => "Import successful and its affected on $import_ids",
        "product_match_id" => $import_ids, 
    );
    return $result;
}

//add_shortcode('sync_dropship', 'dropship_call_schedullar');
	

//End Drop Ship Scheduler

?>

