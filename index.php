<?php
/**
 * Plugin Name: AIStore Recharge
 * Plugin URI:  http://www.aistore2030.com
 * Description: AIStore Recharge Plugins using this you can provide rechagre services from your website and you can make profit from this.
 * Version:     1.3
 * Author:      susheelhbti
 * Author URI:  http://www.aistore2030.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */



add_action('admin_menu', 'aistore2030_register_my_custom_menu_page');

function aistore2030_register_my_custom_menu_page()
{
    
	
    add_menu_page('Recharge', 'Recharge ', 'read', 'aistore2030_recharge', 'aistore2030_complete_recharge_report_admin', '', 51);
    

	 add_submenu_page('aistore2030_recharge', 'Aistore Recharge', 'Settings', 'administrator', 'aistore_recharge_settings_page', 'aistore_recharge_settings_page');
    
    
    add_action('admin_init', 'aistore_recharge_settings_group');
    
    
}




function aistore2030_complete_recharge_report_admin()
{
   
   

 
     
     ob_start(); 
include "template/report.php";
     echo  ob_get_clean();
    
    
}

function aistore2030_complete_recharge_report()
{
   
   
     
     ob_start(); 
include "template/report.php";
     return ob_get_clean();
    
    
}





 


function aistore2030_prepaid_recharge_form()
{
     
    
	
    	global $wp;
 $current_url = home_url( add_query_arg( array(), $wp->request )	 );

 $url2 =	  esc_url( add_query_arg( 'step', 'two', $current_url ) ); 
 
     ob_start(); 
include "template/prepaid.php";
     return ob_get_clean();
    
}



function aistore2030_dth_recharge_form()
{
 
    
	
    
    	global $wp;
 $current_url = home_url( add_query_arg( array(), $wp->request )	 );

 $url2 =	  esc_url( add_query_arg( 'step', 'two', $current_url ) ); 
	
ob_start();  
include "template/dth.php";
return ob_get_clean();   
}






function aistore2030_postpaid_recharge_form()
{
 
 
    
	
   
	global $wp;
 $current_url = home_url( add_query_arg( array(), $wp->request )	 );

 $url2 =	  esc_url( add_query_arg( 'step', 'two', $current_url ) ); 
	
ob_start();
include "template/postpaid.php";
return ob_get_clean();
    
}





function processRechargeStep2()
{
    
    if (!isset($_POST['process_recharge']) || !wp_verify_nonce($_POST['process_recharge'], 'process_recharge')) {
        
        exit();
        
    }
	   $recharge_number = sanitize_text_field($_REQUEST['recharge_number']);
    
    
    $recharge_operator = sanitize_text_field($_REQUEST['recharge_operator']);
	   
    $recharge_amount   = sanitize_text_field($_REQUEST['recharge_amount']);
	
		 $product = aistore_get_wallet_rechargeable_product();
	 
	 
 
	  WC()->cart->empty_cart();
	  
	  $cart_item_data = array('price' => $recharge_amount,'recharge_number' => $recharge_number,'recharge_operator' => $recharge_operator);
	 
	  
	  
	WC()->cart->add_to_cart( $product->get_id() , 1, '', array(), $cart_item_data);
	 
	  
  
	
ob_start(); 
include  "template/step2.php";
return ob_get_clean();
 
 
 
 
    
     
    
}











 











function aistore2030_manage_forms_step($type )
{  $step = "one";
    
    
    if (isset($_REQUEST['step'])) {
        $step = $_REQUEST['step'];
    }
    
    $step = sanitize_text_field($step);
    
    
    if ($step == "one") {
        
		if ($type == "prepaid") {
       return  aistore2030_prepaid_recharge_form();
    } else if ($type == "dth") {
             return    aistore2030_dth_recharge_form();
         
    } else if ($type == "postpaid") {
            return    aistore2030_postpaid_recharge_form() ;
    }
	
	
    } else if ($step == "two") {
        
        
    return    processRechargeStep2();
		 
    }  
    
    
}

 // type prepaid , postpaid , dth 
function aistore2030_recharge_form($atts)
{
	 
	
	 return aistore2030_manage_forms_step($atts['type'] );
 
}
 
 
add_shortcode( 'AISTORERECHARGEFORM', 'aistore2030_recharge_form' );

add_shortcode( 'AistoreRechargeReport', 'aistore2030_complete_recharge_report' );









function iconic_display_engraving_text_cart( $item_data, $cart_item ) {
	if ( empty( $cart_item['recharge_operator'] ) ) {
	return $item_data;
	}


	if ( empty( $cart_item['recharge_number'] ) ) {
	return $item_data;
	}
	
	$item_data[] = array(
		'key'     => __( 'Number', 'aistore' ),
		'value'   => wc_clean( $cart_item['recharge_number'] ),
		'display' => '',
	);

	
		$item_data[] = array(
		'key'     => __( 'Operator', 'aistore' ),
		'value'   => wc_clean( $cart_item['recharge_operator'] ),
		'display' => '',
	);
	
	return $item_data;
}

 add_filter( 'woocommerce_get_item_data', 'iconic_display_engraving_text_cart', 10, 2 );



function aistore2030_add_text_to_order_items( $item, $cart_item_key, $values, $order ) {
	if ( empty( $values['recharge_number'] ) ) {
		return;
	}
	
	if ( empty( $values['recharge_operator'] ) ) {
		return;
	}
	
	
$item->add_meta_data( __( 'recharge_number', 'aistore' ), $values['recharge_number'] );
	$item->add_meta_data( __( 'recharge_operator', 'aistore' ), $values['recharge_operator'] );
}

add_action( 'woocommerce_checkout_create_order_line_item', 'aistore2030_add_text_to_order_items', 10, 4 );



add_action( 'woocommerce_before_calculate_totals', 'aistore2030_add_custom_price' );
function aistore2030_add_custom_price( $cart ) {
    foreach ( $cart->cart_contents as $key => $value ) {
      if( isset( $value["price"] ) ) {
		      $value['data']->set_price($value['price']);
	  } 
    }
}











 





 function processRechargeStep3($order_id){

     
    $order = wc_get_order( $order_id );

	
	
 foreach ( $order->get_items() as $key => $item ) {
    $recharge_operator = wc_get_order_item_meta( $key, 'recharge_operator' );
   $recharge_number = wc_get_order_item_meta( $key, 'recharge_number' );
   $recharge_amount = $item->get_total();
}  


    $user = wp_get_current_user();
    
    $id = $user->ID;
    

$url = "http://api.sakshamapp.com/MobileRech?username=" . esc_attr(get_option('aistore_username')) . "&password=" . esc_attr(get_option('aistore_password')) . "&recharge_circle=0&recharge_operator=$recharge_operator&recharge_number=$recharge_number&amount=$recharge_amount&format=json&requestID=";
        
        
        $wpdb->query($wpdb->prepare("INSERT INTO $table_name (user_id,recharge_number,
recharge_amount,recharge_operator, description,url_hit,ip_address ) VALUES (%d, %s,%s,%s,%s, %s ,%s ,%s)", array(
            $id,
            $recharge_number,
            $recharge_amount,
            $recharge_operator,
           
            $details,
            $url,
            aistore_recharge_getRealIpAddr()
        )));
        
        
        
        
        
        $insert_id = $wpdb->insert_id;
        
        $url = $url . $insert_id;
        
        
         
        
        $response = wp_remote_get($url);
        
        $wpdb->query($wpdb->prepare("update $table_name 
 set 
  url_response  = %s
 where
  id  = %d   
  ", array(
            print_r($response['body'], true),
            $insert_id
        )));
        
        
        
        
        $ar = json_decode($response['body']);
        
        if ($ar->error) {
            
    $wallet = new Woo_Wallet_Wallet();
          $wallet->credit(1, $recharge_amount, $details = 'Recharge refund ' . $_REQUEST['recharge_number']);
              
            
			
            $wpdb->query($wpdb->prepare("update $table_name 
 set 
  status  = 'Failure',
    message  = %s,
	Error  = %s,
    end_balance  = %d
 where
  id  = %d   
  ", array(
                "Recharge is failure",
                $ar->error,
                $balance,
                $insert_id
            )));
            
        }
        
        else {
             
            
            
            $wpdb->query($wpdb->prepare("update $table_name 
 set 
  status  =%s,
    message  = %s,
	Error  = %s 
 where
  id  = %d   
  ", array(
                $ar->Status,
                "Recharge is success",
                $ar->error,
                
                $insert_id
            )));
            
            
        }
		
		
		
		
  $call_url=  $recharge_operator ."--". $recharge_number ."--".  $recharge_amount  ;
 return  $call_url;
}

function mysite_completed($order_id) {
    // Create post object
$my_post = array(
  'post_title'    =>$order_id."ssssss",
  'post_content'  => processRechargeStep3($order_id),
  'post_status'   => 'publish',
  'post_author'   => 1,
  'post_category' => array( 8,39 )
);
 
// Insert the post into the database
wp_insert_post( $my_post );
} 

add_action( 'woocommerce_order_status_pending', 'mysite_completed', 10, 1);
add_action( 'woocommerce_order_status_failed', 'mysite_completed', 10, 1);
add_action( 'woocommerce_order_status_on-hold', 'mysite_completed', 10, 1);
// Note that it's woocommerce_order_status_on-hold, and NOT on_hold.
add_action( 'woocommerce_order_status_processing', 'mysite_completed', 10, 1);
add_action( 'woocommerce_order_status_completed', 'mysite_completed', 10, 1);
add_action( 'woocommerce_order_status_refunded', 'mysite_completed', 10, 1);
add_action( 'woocommerce_order_status_cancelled', 'mysite_completed', 10, 1);



 
 include "util.php";
 
 include "activate.php";
 
  include "settings.php";