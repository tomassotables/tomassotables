<?php
   /*
   Plugin Name: Vince Manager Sync
   Plugin URI: https://web1experts.com
   description: A plugin that used for syncing stocks from vince manager
   Version: 1.0
   Author: Web1
   Author URI: https://web1experts.com
   License: GPL2
   */
define( 'woo_builder_path', plugin_dir_path( __FILE__ ) );
if( function_exists('acf_add_options_page') ) {
    
            acf_add_options_page(array(
                'page_title'    => 'Stock Sync Settings',
                'menu_title'    => 'Stock Sync Settings',
                'menu_slug'     => 'stock-sync-settings',
                'capability'    => 'edit_posts',
                'redirect'      => false
            ));
            
}  

class CustomApiSettings {
    public $plugin_name = 'Vince Manager Sync';
    public function __construct() {
        add_action('admin_enqueue_scripts', array($this,'loadassets'));
        add_action( 'wp_ajax_import_data_status', array( $this, 'import_product_list'));
        add_action( 'wp_ajax_nopriv_import_data_status', array( $this,'import_product_list'));
        add_action('admin_menu', array( $this, 'customapisettingsmenu' ), 9);
        add_action('setup_product_list_hook', array($this, 'setup_product_list')); //Hook to run product download cron
        add_action('setup_cron_sku', array( $this, 'listing_product_sku'),10,2 );
        add_action('setup_view_product_hook', array($this, 'setup_view_product'));//Hook to run stock sync cron
        add_action( 'setup_cron_product', array( $this, 'do_this_hourly'),10,2 );// This will update stocks in chunks
        add_action('setup_price_product_hook', array($this, 'setup_price_product'));
        add_action( 'setup_cron_price', array( $this, 'listing_product_price'),10,2 );
    }

    function create_global_attribute($name, $slug)
{

    $taxonomy_name = wc_attribute_taxonomy_name( $slug );

    if (taxonomy_exists($taxonomy_name))
    {
        return wc_attribute_taxonomy_id_by_name($slug);
    }
    $attribute_id = wc_create_attribute( array(
        'name'         => $name,
        'slug'         => $slug,
        'type'         => 'select',
        'order_by'     => 'menu_order',
        'has_archives' => false,
    ) );

    //Register it as a wordpress taxonomy for just this session. Later on this will be loaded from the woocommerce taxonomy table.
    register_taxonomy(
        $taxonomy_name,
        apply_filters( 'woocommerce_taxonomy_objects_' . $taxonomy_name, array( 'product' ) ),
        apply_filters( 'woocommerce_taxonomy_args_' . $taxonomy_name, array(
            'labels'       => array(
                'name' => $name,
            ),
            'hierarchical' => true,
            'show_ui'      => false,
            'query_var'    => true,
            'rewrite'      => false,
        ) )
    );

    //Clear caches
    delete_transient( 'wc_attribute_taxonomies' );

    return $attribute_id;
}

//$rawDataAttributes must be in the form of array("Color"=>array("blue", "red"), "Size"=>array(12,13,14),... etc.)
function generate_attributes_list_for_product($rawDataAttributes)
{
    $attributes = array();

    $pos = 0;

    foreach ($rawDataAttributes as $name => $values)
    {
        if (empty($name) || $values == "") continue;

        if (!is_array($values)) $values = array($values);

        $attribute = new WC_Product_Attribute();
        $attribute->set_id( 0 );
        $attribute->set_position($pos);
        $attribute->set_visible( true );
        //$attribute->set_variation( true );

        $pos++;

        //Look for existing attribute:
        $existingTaxes = wc_get_attribute_taxonomies();

        //attribute_labels is in the format: array("slug" => "label / name")
        $attribute_labels = wp_list_pluck( $existingTaxes, 'attribute_label', 'attribute_name' );
        $slug = array_search( $name, $attribute_labels, true );

        if (!$slug)
        {
            //Not found, so create it:
            $slug = wc_sanitize_taxonomy_name($name);
            $attribute_id = $this->create_global_attribute($name, $slug);
        }
        else
        {
            //Otherwise find it's ID
            //Taxonomies are in the format: array("slug" => 12, "slug" => 14)
            $taxonomies = wp_list_pluck($existingTaxes, 'attribute_id', 'attribute_name');

            if (!isset($taxonomies[$slug]))
            {
                //logg("Could not get wc attribute ID for attribute ".$name. " (slug: ".$slug.") which should have existed!");
                continue;
            }

            $attribute_id = (int)$taxonomies[$slug];
        }

        $taxonomy_name = wc_attribute_taxonomy_name($slug);

        $attribute->set_id( $attribute_id );
        $attribute->set_name( $taxonomy_name );
        $attribute->set_options($values);

        $attributes[] = $attribute;
    }


    return $attributes;
}

function get_attribute_term($value, $taxonomy)
{
    //Look if there is already a term for this attribute?
    $term = get_term_by('name', $value, $taxonomy);

    if (!$term)
    {
        //No, create new term.
        $term = wp_insert_term($value, $taxonomy);
        if (is_wp_error($term))
        {
            //logg("Unable to create new attribute term for ".$value." in tax ".$taxonomy."! ".$term->get_error_message());
            return array('id'=>false, 'slug'=>false);
        }
        $termId = $term['term_id'];
        $term_slug = get_term($termId, $taxonomy)->slug; // Get the term slug
    }
    else
    {
        //Yes, grab it's id and slug
        $termId = $term->term_id;
        $term_slug = $term->slug;
    }

    return array('id'=>$termId, 'slug'=>$term_slug);
}




    public function attrfun(){
        global $woocommerce;


 // Get an array of product attribute taxonomies slugs
 $attributes_tax_slugs =  wc_get_attribute_taxonomy_labels();

//$product_id = '32104';
         //$p = new WC_Product_Simple($product_id);
         echo "<pre>";print_r(array_fill_keys(array_values($attributes_tax_slugs),''));die;

        $yourRawAttributeList = array("Gender" => "");
        $attribs = $this->generate_attributes_list_for_product($yourRawAttributeList);
$postID = '32104';
        $p = new WC_Product_Simple($postID);

        $p->set_props(array(
            'attributes'        => $attribs,
            //Set any other properties of the product here you want - price, name, etc.
        ));

        $postID = $p->save();

        if ($postID <= 0) return "Unable to create / update product!";

        //Attribute Terms: These need to be set otherwise the attributes dont show on the admin backend:
        foreach ($attribs as $attrib)
        {
            /** @var WC_Product_Attribute $attrib */
            $tax = $attrib->get_name();
            $vals = $attrib->get_options();

            $termsToAdd = array();

            if (is_array($vals) && count($vals) > 0)
            {
                foreach ($vals as $val)
                {
                    //Get or create the term if it doesnt exist:
                    $term = $this->get_attribute_term($val, $tax);

                    if ($term['id']) $termsToAdd[] = $term['id'];
                }
            }

            if (count($termsToAdd) > 0)
            {
                wp_set_object_terms($postID, $termsToAdd, $tax, true);
            }
        }
    }

    public function rounder($number){
        $inumber = ceil($number);
        $mod_10 = $inumber % 10;
        $mod_5 = $inumber % 5;
        return $inumber + 10 - $mod_10 - 1;
    }


    public function loadassets(){
      
     wp_enqueue_script('script-js', plugins_url('vince-manager/assets/js/apisetting.js?v=' . time()), array('jquery'), '', true);
     wp_localize_script('script-js', 'vince_manager', array('ajax_url' => admin_url('admin-ajax.php')));
    }

    public function customapisettingsmenu() {
      add_menu_page(  $this->plugin_name, 'Vince Manager Settings', 'administrator', $this->plugin_name, array( $this, 'displayipbDashboard' ), 'dashicons-chart-area', 26 );
    }


    public function import_product_list(){


       if($_POST['action'] == "import_data_status"){

             $this->setup_view_product(); 
             $result=array(
                    "code"=> 200,
                    "message"=> "Products stock sync is under process and this will take few minutes"

                );
                echo json_encode($result);
                die();
            
       }else{
        $result=array(
                    "code"=> 500,
                    "message"=> "Missing Parameters"

                );
                echo json_encode($result);
                die();
       }

    }


    public function displayipbDashboard() {
      
        require_once 'includes/settings.php';
    }


    public function setup_price_product()
    {
        $grant_type = get_field('grant_type', 'option');
        $username = get_field('username', 'option');
        $password = get_field('user_password', 'option');
        $curl_post = "grant_type=$grant_type&username=$username&password=$password";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.vincemanager.nl/token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $curl_post,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $token_res = curl_exec($curl);
        $res = json_decode($token_res);
        curl_close($curl);
        $token = $res->access_token;
        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
          CURLOPT_URL => 'https://www.vincemanager.nl/api/lists/products',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token
          ),
        ));

        $response = curl_exec($curl1);
        $result = json_decode($response);
        //$abc = $result->Code;
        curl_close($curl1);
        foreach ($result as $value) {
            $sku_code_value = $value->Code;
            $sku_code[] = $sku_code_value;
        }
        
        
        $arrays_product_sku = array_chunk($sku_code, 20);
        $sku_count = count($arrays_product_sku);

        for($x = 0; $x < $sku_count; $x++) {
          $time = time() + ($x * 60);
          wp_schedule_single_event($time,'setup_cron_price',[$arrays_product_sku[$x],$token]);
          
        }
              
        
    }
    
    public function listing_product_price($arrays_product_sku,$token)
    {
        foreach($arrays_product_sku as $data_sku){
            
            $curl2 = curl_init();
            curl_setopt_array($curl2, array(
                  CURLOPT_URL => 'https://www.vincemanager.nl/api/customerproduct/getproductbysku?sku='.$data_sku,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'GET',
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.$token
                  ),
            ));

            $response1 = curl_exec($curl2);
            curl_close($curl2);
            $result = json_decode($response1);
    
            if(!isset( $result->Name)){
                continue;
            }
               
            $product_id = '';
            global $wpdb;
            $results = $wpdb->get_results( "SELECT * FROM wp_postmeta WHERE meta_key = '_sku' AND meta_value = '$data_sku' ");
            if(!empty($results)):
                foreach ($results as  $value_res) {
                    $product_id = $value_res->post_id;
                }
            endif;
            if($product_id  != ''):
                $product_ex_vatprice = $this->rounder($result->PriceExVAT);
                update_post_meta($product_id, '_price', $product_ex_vatprice);
            endif;
        }
    }

    public function setup_view_product()
    {
        $grant_type = get_field('grant_type', 'option');
        $username = get_field('username', 'option');
        $password = get_field('user_password', 'option');
        $curl_post = "grant_type=$grant_type&username=$username&password=$password";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.vincemanager.nl/token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $curl_post,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $token_res = curl_exec($curl);
        $res = json_decode($token_res);
        curl_close($curl);
        $token = $res->access_token;
        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
          CURLOPT_URL => 'https://www.vincemanager.nl/api/lists/products',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token
          ),
        ));

        $response = curl_exec($curl1);
        $result = json_decode($response);
        //$abc = $result->Code;
        curl_close($curl1);
        foreach ($result as $value) {
            $sku_code_value = $value->Code;
            $sku_code[] = $sku_code_value;
        }
        
        
        $arrays_product_sku = array_chunk($sku_code, 20);
        $sku_count = count($arrays_product_sku);

        for($x = 0; $x < $sku_count; $x++) {
          $time = time() + ($x * 60);
          wp_schedule_single_event($time,'setup_cron_product',[$arrays_product_sku[$x],$token]);
          
        }      

    }
    
    public function do_this_hourly($arrays_product_sku,$token)
    {
        
        foreach($arrays_product_sku as $data_sku){
            
            $curl2 = curl_init();
            curl_setopt_array($curl2, array(
                  CURLOPT_URL => 'https://www.vincemanager.nl/api/customerproduct/getproductbysku?sku='.$data_sku,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'GET',
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.$token
                  ),
            ));

            $response1 = curl_exec($curl2);
            curl_close($curl2);
            $result = json_decode($response1);
    
            if(!isset( $result->Name)){
                continue;
            }
               
            $product_id = '';
            global $wpdb;
            $results = $wpdb->get_results( "SELECT * FROM wp_postmeta WHERE meta_key = '_sku' AND meta_value = '$data_sku' ");
            if(!empty($results)):
                foreach ($results as  $value_res) {
                    $product_id = $value_res->post_id;
                }
            endif;
            if($product_id  != ''):
                $res_stock = $result->Stock;
				update_post_meta($product_id,'_manage_stock','yes');
                update_post_meta($product_id, '_stock', $res_stock);
            endif;
            
        }
    }


    public function setup_product_list()
    {
        $grant_type = get_field('grant_type', 'option');
        $username = get_field('username', 'option');
        $password = get_field('user_password', 'option');
        $curl_post = "grant_type=$grant_type&username=$username&password=$password";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.vincemanager.nl/token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $curl_post,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $token_res = curl_exec($curl);
        $res = json_decode($token_res);
        curl_close($curl);
        $token = $res->access_token;
        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
          CURLOPT_URL => 'https://www.vincemanager.nl/api/lists/products',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token
          ),
        ));

        $response = curl_exec($curl1);
        $result = json_decode($response);
        //$abc = $result->Code;
        curl_close($curl1);
        foreach ($result as $value) {
            $sku_code_value = $value->Code;
            $sku_code[] = $sku_code_value;
        }
        
        
        $arrays_product_sku = array_chunk($sku_code, 20);
        $sku_count = count($arrays_product_sku);

        for($x = 0; $x < $sku_count; $x++) {
          $time = time() + ($x * 60);
          wp_schedule_single_event($time,'setup_cron_sku',[$arrays_product_sku[$x],$token]);
        }

    }

    public function listing_product_sku($arrays_product_sku,$token)
    {
        $attributes_arr = [];
        $attributes_tax_slugs =  wc_get_attribute_taxonomy_labels();
        $attributes_tax_ar =  array_fill_keys(array_values($attributes_tax_slugs),'No Value');
        foreach($arrays_product_sku as $data_sku){
            //echo $data;
              $attributes_arr = $attributes_tax_ar;
            $curl2 = curl_init();

                curl_setopt_array($curl2, array(
                  CURLOPT_URL => 'https://www.vincemanager.nl/api/customerproduct/getproductbysku?sku='.$data_sku,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'GET',
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.$token
                  ),
                ));


                $response1 = curl_exec($curl2);

                curl_close($curl2);
                $result = json_decode($response1);
                //print_r($result);

                if(!isset( $result->Name)){
                    continue;
                }

                $product_name = $result->Name;
                $product_supplier_id = $result->Id;
                $product_sku = $result->Code;
                $product_country_code = $result->CountryCodeOfOrigin;
                $product_vatprice = $result->PriceExVAT;
                $product_quantity = $result->Stock;
                $product_description = $result->Description;
                
                if(isset($result->ProductSpecifications) && !empty($result->ProductSpecifications)){
                    // $product_specification = '<table class="table table-striped">';
                    // $product_specification .= '<tbody>';
                   
                    foreach($result->ProductSpecifications as $p => $sp){

                        $attributes_arr[trim($sp->Name)] = trim($sp->Value.' '.$sp->Unit);

                        // $product_specification .= '<tr>';
                        // $product_specification .= '<td>'.$sp->Name.'</td>';
                        // $product_specification .= '<td>'.$sp->Value.' '.$sp->Unit.'</td>';
                    }
                    //$product_specification .= '</tbody></table>';
                }else{
                    $product_specification = '';
                }
                
                $product_IsDiscontinued = $result->IsDiscontinued;
                $product_ImageUrls = $result->ImageUrls;
                $imgurls = (!empty($product_ImageUrls))?explode(',', $product_ImageUrls):'';
               
                $product_id = '';
                global $wpdb;
                $results = $wpdb->get_results( "SELECT * FROM wp_postmeta WHERE meta_key = '_sku' AND meta_value = '$product_sku' ");
                if(!empty($results)):
                    foreach ($results as  $value_res) {
                        $product_id = $value_res->post_id;
                     }
             endif;

                if($product_id == ''){
                    $product = new WC_Product_Simple();
                }else{
                    $product = wc_get_product($product_id);  
                }
                
                
                //$specs = $product_description .'<br> <h2>Specifications</h2>'.$product_specification;
                $product->set_name($product_name); 
                $product->set_regular_price($this->rounder($product_vatprice)); 
                $product->set_description($product_description);
                $product->set_sku($product_sku);
                $product->set_stock_quantity($product_quantity);



                // Attribute code

                    $attribs = $this->generate_attributes_list_for_product($attributes_arr);
            

                    $product->set_props(array(
                        'attributes'        => $attribs,
                        //Set any other properties of the product here you want - price, name, etc.
                    ));

                    $product->save();
                    $product_id = $product->get_id();
					update_post_meta($product_id,'_manage_stock','yes');
                    if ($product_id <= 0){
                        continue;
                    }

                    //Attribute Terms: These need to be set otherwise the attributes dont show on the admin backend:
                    foreach ($attribs as $attrib)
                    {
                        /** @var WC_Product_Attribute $attrib */
                        $tax = $attrib->get_name();
                        $vals = $attrib->get_options();

                        $termsToAdd = array();

                        if (is_array($vals) && count($vals) > 0)
                        {
                            foreach ($vals as $val)
                            {
                                //Get or create the term if it doesnt exist:
                                $term = $this->get_attribute_term($val, $tax);

                                if ($term['id']) $termsToAdd[] = $term['id'];
                            }
                        }

                        if (count($termsToAdd) > 0)
                        {
                            wp_set_object_terms($product_id, $termsToAdd, $tax, true);
                        }
                    }

                //end here

                //$product->save();

                
                //$specification = update_post_meta($product_id,'product_specification',$product_specification);
                $attach_ids = [];
                if(!empty($imgurls)):
                    foreach($imgurls as $img_value)
                    {

                       // image api


                        $curl7 = curl_init();

                        curl_setopt_array($curl7, array(
                          CURLOPT_URL => 'https://www.vincemanager.nl/api/customerproduct/image/'.$product_supplier_id.'?imageName='.$img_value,
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'GET',
                          CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json',
                            'Authorization: Bearer '.$token
                          ),
                        ));

                        $response_img = curl_exec($curl7);

                        curl_close($curl7);
                        file_put_contents(woo_builder_path.'img/'.str_replace('/','-',$img_value), $response_img); 




                        $image_url        = plugin_dir_url(__FILE__).'img/'.str_replace('/','-',$img_value);
                        $image_name       = 'img_'.$product_id.'_'.time().'.jpg';
                        $upload_dir       = wp_upload_dir(); 
                        $image_data       = file_get_contents($image_url);
                        $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
                        $filename         = basename( $unique_file_name ); 

                        if( wp_mkdir_p( $upload_dir['path'] ) ) {
                          $file = $upload_dir['path'] . '/' . $filename;
                        } else {
                          $file = $upload_dir['basedir'] . '/' . $filename;
                        }

                        file_put_contents( $file, $image_data );
                        $wp_filetype = wp_check_filetype( $filename, null );
                        $attachment = array(
                            'post_mime_type' => $wp_filetype['type'],
                            'post_title'     => sanitize_file_name( $filename ),
                            'post_content'   => '',
                            'post_status'    => 'inherit'
                        );  
                        $attach_id = wp_insert_attachment( $attachment, $file, $product_id );
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
                        wp_update_attachment_metadata( $attach_id, $attach_data );
                        $attach_ids[] = $attach_id;

                    }
                endif;
                if(!empty($attach_ids)):

                    $img_gallery = get_post_meta($product_id,'_product_image_gallery',true);
                    if($img_gallery != ''):
                        $img_exp = explode(',',$img_gallery);
                        foreach($img_exp as $img_value)
                        {
                          
                           wp_delete_attachment($img_value);

                        }
                    endif;
                    set_post_thumbnail($product_id,$attach_ids[0]);
                    unset($attach_ids[0]);
                    update_post_meta($product_id,'_product_image_gallery',implode(',', $attach_ids));
                    
                endif;


                 // if(isset($imgurls) && !empty($imgurls)){
                 //   for ($m=0; $m < count($imgurls); $m++) { 
                 //      unlink(builder_path.'img/'.$imgurls[$m]);
                 //   }
                 // }   

           }
           
           return true;
           //$offset=$offset++;
           //if($offset>=$sku_count){
               //$this->listing_product_sku($arrays_product_sku,0,$sku_count,$token);
           //}


    }

    public function view_product()
    {

        $grant_type = get_field('grant_type', 'option');
        $username = get_field('username', 'option');
        $password = get_field('user_password', 'option');
        $curl_post = "grant_type=$grant_type&username=$username&password=$password";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.vincemanager.nl/token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $curl_post,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $token_res = curl_exec($curl);
        $res = json_decode($token_res);
        curl_close($curl);
        $token = $res->access_token;
        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
          CURLOPT_URL => 'https://www.vincemanager.nl/api/lists/products',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer '.$token
          ),
        ));

        $response = curl_exec($curl1);
        $result = json_decode($response);
        //$abc = $result->Code;
        //echo $abc;
        curl_close($curl1);
        foreach ($result as $value) {
            $sku_code_value = $value->Code;
            $sku_code[] = $sku_code_value;
        }
        
        $arrays_product_sku = array_chunk($sku_code, 10);
        $sku_count = count($arrays_product_sku);
       // echo $sku_count;
        $this->abc($arrays_product_sku,0,$sku_count,$token); 


          

    }

    public function abc($arrays_product_sku,$offset,$sku_count,$token)
    {

        $args = array( 'post_type' => 'product',
                       'post_status' => 'publish'
                       ); 
        $the_query = new WP_Query( $args );



        foreach($arrays_product_sku[$offset] as $data){
            //echo $data;
              
            $curl2 = curl_init();

                curl_setopt_array($curl2, array(
                  CURLOPT_URL => 'https://www.vincemanager.nl/api/customerproduct/getproductbysku?sku='.$data,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'GET',
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.$token
                  ),
                ));

                $response1 = curl_exec($curl2);
                curl_close($curl2);
                $result = json_decode($response1);
                //echo "<pre>";
                //print_r($result);
                //echo "</pre>";
                $product_name = $result->Name;
                $product_id = $result->Id;
                $product_sku = $result->Code;
                $product_country_code = $result->CountryCodeOfOrigin;
                $product_ex_vatprice = $result->PriceExVAT;
                $product_quantity = $result->Stock;
                $product_description = $result->Description;
                $product_specification = $result->Specifications;
                $product_IsDiscontinued = $result->IsDiscontinued;
                $product_thumburl = $result->ThumbUrl;
                $product_ImageUrls = $result->ImageUrls;
                $imgurls = explode(',', $product_ImageUrls);
                //print_r($imgurls);
                //foreach($imgurls as $img_value)
                //{
                  //  print_r($img_value);
                //}
                global $wpdb;
                $results = $wpdb->get_results( "SELECT * FROM wp_postmeta WHERE meta_key = '_sku' AND meta_value = '$product_sku' ");
                print_r($results);
                foreach ($results as  $value_res) {
                    // code...
                
                $product_id = $value_res->post_id;
                
                }
                echo "<pre>";
                print_r($product_id);
                echo "</pre>";


           }
           $offset=$offset++;
            if($offset>=$sku_count){
               $this->abc($arrays_product_sku,0,$sku_count,$token);
            }


            $imgurls = "3972_VD-DC59NC_20200204042926608.jpg,3972_VD-DC59NC_20200204042927552.jpg,3972_VD-DC59NC_20200204042928207.jpg,3972_VD-DC59NC_20200204042928911.jpg,3972_VD-DC59NC_20200204042930239.jpg,3972_VD-DC59NC_20200528045641706.jpg";
$imgurls1 = explode(',', $imgurls);
$abc = implode(",", $imgurls1);
echo $abc;
//print_r($imgurls);

     // foreach ($imgurls as $img_value) {
         
     // //print_r($img_value);
     //        $productid = 40;
     //        $image_url        = 'https://vmgrprd.blob.core.windows.net/resizedimages/'.$img_value; // Define the image URL here
     //       // echo $image_url;
     //        $image_name       = 'img_'.$productid.'_'.time().'.jpg';
     //       // echo $image_name;
     //        $upload_dir       = wp_upload_dir(); // Set upload folder
     //        $image_data       = file_get_contents($image_url); // Get image data
     //        $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
     //        $filename         = basename( $unique_file_name ); // Create image file name

     //        // Check folder permission and define file location
     //        if( wp_mkdir_p( $upload_dir['path'] ) ) {
     //          $file = $upload_dir['path'] . '/' . $filename;
     //        } else {
     //          $file = $upload_dir['basedir'] . '/' . $filename;
     //        }

     //        // Create the image  file on the server
     //        file_put_contents( $file, $image_data );

     //        // Check image file type
     //        $wp_filetype = wp_check_filetype( $filename, null );

     //        // Set attachment data
     //        $attachment = array(
     //            'post_mime_type' => $wp_filetype['type'],
     //            'post_title'     => sanitize_file_name( $filename ),
     //            'post_content'   => '',
     //            'post_status'    => 'inherit'
     //        );

     //        // Create the attachment   
     //        $attach_id = wp_insert_attachment( $attachment, $file, $productid );
     //        //print_r($attach_id);
     //        // Include image.php
     //        require_once(ABSPATH . 'wp-admin/includes/image.php');

     //        // Define attachment metadata
     //        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

     //        // Assign metadata to attachment
     //        wp_update_attachment_metadata( $attach_id, $attach_data );


     //        $ids[] = $attach_id;

     //        print_r($ids);



     //        //after loop
     //        // And finally assign featured image to post

     //        //set_post_thumbnail( $productid, $ids[0] );

     //   }



    }




function test(){

    

    $grant_type = get_field('grant_type', 'option');
        $username = get_field('username', 'option');
        $password = get_field('user_password', 'option');
        $curl_post = "grant_type=$grant_type&username=$username&password=$password";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://www.vincemanager.nl/token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $curl_post,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $token_res = curl_exec($curl);
        $res = json_decode($token_res);
        curl_close($curl);
        $token = $res->access_token;

    $sku  = 'VD-DT64';
	$curl2 = curl_init();

                curl_setopt_array($curl2, array(
                  CURLOPT_URL => 'https://www.vincemanager.nl/api/customerproduct/getproductbysku?sku='.$sku,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'GET',
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.$token
                  ),
                ));

                $response1 = curl_exec($curl2);
                curl_close($curl2);
                $result = json_decode($response1);
               // echo "<pre>";
               // print_r($result);
               // echo "</pre>";



                if(isset($result->ProductSpecifications) && !empty($result->ProductSpecifications)){
                    $sp_html = '<table class="table table-striped">';
                    $sp_html .= '<tbody>';
                   
                    foreach($result->ProductSpecifications as $p => $sp){
                        $sp_html .= '<tr>';
                        $sp_html .= '<td>'.$sp->Name.'</td>';
                        $sp_html .= '<td>'.$sp->Value.' '.$sp->Unit.'</td>';
                    }
                    $sp_html .= '</tbody></table>';
                }
                

                $product_name = $result->Name;
                $product_supplier_id = $result->Id;
                $product_sku = $result->Code;
                $product_country_code = $result->CountryCodeOfOrigin;
                $product_vatprice = $result->PriceExVAT;
                $product_quantity = $result->Stock;
                $product_description = $result->Description;
                $product_specification = $result->Specifications;
                $product_IsDiscontinued = $result->IsDiscontinued;
                $product_thumburl = $result->ThumbUrl;
                $product_ImageUrls = $result->ImageUrls;
$imgurls = (!empty($product_ImageUrls))?explode(',', $product_ImageUrls):'';
print_r($imgurls);die;
                $imgurls = explode(',', $product_ImageUrls);
                echo $product_specification;
                //echo $product_id;


                                $product_id = '';
                global $wpdb;
                $results = $wpdb->get_results( "SELECT * FROM wp_postmeta WHERE meta_key = '_sku' AND meta_value = '$product_sku' ");
                if(!empty($results)):
                    foreach ($results as  $value_res) {
                        $product_id = $value_res->post_id;
                     }
             endif;

                if($product_id == ''){
                    $product = new WC_Product_Simple();
                }else{
                    $product = wc_get_product($product_id);  
                }
                $specification = update_post_meta($product_id,'product_specification',$product_specification);
                //`$specs = $product_description .'<br> <h2>Specifications</h2>'.$product_specification;
                $product->set_name($product_name); 
                $product->set_regular_price($this->rounder($product_vatprice)); 
                $product->set_description($product_description);
                $product->set_sku($product_sku);
                $product->set_stock_quantity($product_quantity);
                $product->save();

                $product_id = $product->get_id();

                $attach_ids = [];
                if(!empty($imgurls)):
                    foreach($imgurls as $img_value)
                    {

                       // image api


                        $curl7 = curl_init();

                        curl_setopt_array($curl7, array(
                          CURLOPT_URL => 'https://www.vincemanager.nl/api/customerproduct/image/'.$product_supplier_id.'?imageName='.$img_value,
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'GET',
                          CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json',
                            'Authorization: Bearer '.$token
                          ),
                        ));

                        $response_img = curl_exec($curl7);

                        curl_close($curl7);
                        file_put_contents(woo_builder_path.'img/'.$img_value, $response_img); 




                        $image_url        = plugin_dir_url(__FILE__).'img/'.$img_value;
                        $image_name       = 'img_'.$product_id.'_'.time().'.jpg';
                        $upload_dir       = wp_upload_dir(); 
                        $image_data       = file_get_contents($image_url);
                        $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
                        $filename         = basename( $unique_file_name ); 

                        if( wp_mkdir_p( $upload_dir['path'] ) ) {
                          $file = $upload_dir['path'] . '/' . $filename;
                        } else {
                          $file = $upload_dir['basedir'] . '/' . $filename;
                        }

                        file_put_contents( $file, $image_data );
                        $wp_filetype = wp_check_filetype( $filename, null );
                        $attachment = array(
                            'post_mime_type' => $wp_filetype['type'],
                            'post_title'     => sanitize_file_name( $filename ),
                            'post_content'   => '',
                            'post_status'    => 'inherit'
                        );  
                        $attach_id = wp_insert_attachment( $attachment, $file, $product_id );
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
                        wp_update_attachment_metadata( $attach_id, $attach_data );
                        $attach_ids[] = $attach_id;

                    }
                endif;
                if(!empty($attach_ids)):

                    $img_gallery = get_post_meta($product_id,'_product_image_gallery',true);
                    if($img_gallery != ''):
                        $img_exp = explode(',',$img_gallery);
                        foreach($img_exp as $img_value)
                        {
                          
                           wp_delete_attachment($img_value);

                        }
                    endif;
                    update_post_meta($product_id,'_product_image_gallery',implode(',', $attach_ids));
                    set_post_thumbnail($product_id,$attach_ids[0]);
                endif;


                    

           
           
           return true;





     }







   
}

    


// TODO: Replace these with a variable named appropriately and the class name above
// If you need this available beyond our initial creation, you can create it as a global
global $custom_api_settings;

// Create an instance of our class to kick off the whole thing
$custom_api_settings = new CustomApiSettings();


?>