<?php

/**
* Class and Function List:
* Function list:
* - aistore2030_recharge_plugin_install()
* - aistore2030_createProduct()
* - aistore_get_wallet_rechargeable_product()
* Classes list:
*/
function aistore2030_recharge_plugin_install()

{

 global $wpdb;

 $table_name = $wpdb->prefix . 'recharge';

 if ($wpdb->get_var("show tables like '$table_name '") != $table_name)
 {

  $sql        = "CREATE TABLE " . $table_name . " (  
  `id` int(10) NOT NULL AUTO_INCREMENT, 
  `user_id` int(10) NOT NULL,
  `recharge_number` varchar(10) NOT NULL, 
  `recharge_operator` varchar(25) NOT NULL,
  `recharge_amount` int(5) NOT NULL, 
  `description` varchar(200) NOT NULL,
  `url_hit` varchar(250) NOT NULL, 
  `url_response` varchar(1000) NOT NULL,
  `message` varchar(250) NOT NULL,
  `api_resp_id` varchar(250) NOT NULL,
  `operator_transaction_id` varchar(250) NOT NULL,
  `status_url` varchar(500) NOT NULL, 
  `status_response` varchar(500) NOT NULL,
 `ip_address` varchar(20) NOT NULL,
 `status` varchar(10) NOT NULL DEFAULT 'Success', 
 `Error` varchar(10) NOT NULL, PRIMARY KEY (`id`) );";

  require_once (ABSPATH . 'wp-admin/includes/upgrade.php');

  dbDelta($sql);

 }

}

function aistore2030_cteate_product_if_not_exist()
{
 $option_name = '_aistore_rech_product';
	aistore2030_createProduct($option_name);
}

register_activation_hook(__FILE__, 'aistore2030_recharge_plugin_install');
register_activation_hook(__FILE__, 'aistore2030_cteate_product_if_not_exist');

function aistore2030_createProduct($option_name)
{

 $objProduct = new WC_Product();

 $objProduct->set_name('Recharge/Bill Pay Product'); //Set product name.
 $objProduct->set_status('publish'); //Set product status.
 

 $objProduct->set_catalog_visibility('hidden'); //Set catalog visibility.                   | string $visibility Options: 'hidden', 'visible', 'search' and 'catalog'.
 $objProduct->set_description('This used by Recharge/Bill Pay plugin '); //Set product description.
 $objProduct->set_short_description('This used by Recharge/Bill Pay plugin  '); //Set product short description.
 

 $objProduct->set_price(1.00); //Set the product's active price.
 $objProduct->set_regular_price(1.00); //Set the product's regular price.
 $objProduct->set_sale_price(1.00); //Set the product's sale price.
 

 $objProduct->set_manage_stock(false); //Set if product manage stock.                         | bool
 $objProduct->set_stock_quantity(100); //Set number of items available for sale.
 $objProduct->set_stock_status('instock'); //Set stock status.                               | string $status 'instock', 'outofstock' and 'onbackorder'
 

 $new_product_id = $objProduct->save(); //Saving the data to create new product, it will return product ID.
 

 add_option($option_name, $new_product_id);
 update_option($option_name, $new_product_id);

 return $new_product_id;

}

function aistore_get_wallet_rechargeable_product()

{

 $option_name = '_aistore_rech_product';

 if (get_option($option_name) !== false)
 {

  $pt          = get_post_type($id);

  if ($pt == 'product')
  {
   return wc_get_product($id);
  }
  else
  {

   return wc_get_product(aistore2030_createProduct($option_name));
  }

 }
 else
 {

  return wc_get_product(aistore2030_createProduct($option_name));

 }

}


function aistore2030_checkTable()
{
	aistore2030_recharge_plugin_install();
	
}

?>
