<?php
/**
 * Plugin Name: AIStore Recharge
 * Plugin URI:  https://example.com/plugins/the-basics/
 * Description: AIStore Recharge Plugins using this you can provide rechagre services from your website and you can make profit from this.
 * Version:     1.0
 * Author:      susheelhbti
 * Author URI:  http://www.aistore2030.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

function aistore2030_recharge_plugin_install()
{
    global $wpdb;
    
    
    $table_name       = $wpdb->prefix . 'recharge';
	
	
	if ($wpdb->get_var("show tables like '$table_name '") != $table_name) {
        $sql = "CREATE TABLE " . $table_name . " (
 `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `recharge_number` varchar(10) NOT NULL,
  `recharge_operator` varchar(25) NOT NULL,
  `recharge_amount` int(5) NOT NULL,
  `start_balance` int(10) NOT NULL,
  `end_balance` int(10) NOT NULL,
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
  `Error` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)  	 
		);";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
}
// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'aistore2030_recharge_plugin_install');

add_action('admin_menu', 'aistore2030_register_my_custom_menu_page');

function aistore2030_register_my_custom_menu_page()
{
    
	
    add_menu_page('Recharge', 'Recharge ', 'read', 'aistore2030_recharge', 'aistore2030_complete_recharge_report', '', 51);
    
	add_submenu_page('aistore2030_recharge', 'Prepaid', 'Prepaid', 'read', 'aistore2030_manage_forms_step', 'aistore2030_manage_forms_step');
   
   add_submenu_page('aistore2030_recharge', 'DTH ', 'DTH', 'read', 'aistore2030_dth_recharge_form', 'aistore2030_dth_recharge_form');
    
    
    
    add_submenu_page('aistore2030_recharge', 'Aistore Recharge', 'Settings', 'administrator', 'aistore_recharge_settings_page', 'aistore_recharge_settings_page');
    
    
    add_action('admin_init', 'aistore_recharge_settings_group');
    
    
}



function aistore2030_complete_recharge_report()
{
    echo "<div class='wrap'>";
   


if (!class_exists('Woo_Wallet_Wallet')) {
    echo "In order to use this recharge plugin you need to install two following plugins
<br />
1 Woocommerce<br />
2 WooCommerce Wallet – credit, cashback, refund system (https://wordpress.org/plugins/woo-wallet/)

";
exit();
}



   $user = wp_get_current_user();
    
    
    $id = $user->ID;
    
    global $wpdb;
    $user_id = $id;
    
    $table_name = $wpdb->prefix . 'recharge';
    if (current_user_can('administrator')) {
        
        $qr = "SELECT *   FROM $table_name    order by id desc  limit 50";
        
    } else {
        $qr = "SELECT *   FROM $table_name where user_id=$id   order by id desc   limit 50";
    }
    
    
    echo "<h2>Your recent recharge (Recent 50 Records )</h2>";
    
    
    
    $result = $wpdb->get_results($qr);
?>
<p>Admin can see all users report and user will see his own recharge report </p>
 <table class="widefat"> 
 

 <thead>
    <tr>
        <th>Recharge ID</th>
		 <th>User ID</th>       
        <th>Number / Connection ID</th>       
        <th>Operator </th>
        <th>Amount</th>
        <th>Start Balance </th>
        <th>End Balance </th>
		
        
         <th>Operator ID</th>       
         
         <th>Status</th>
    </tr>
</thead> 

<?php
    
    foreach ($result as $wp_formmaker_submits) {
        
        
        echo "<tr>";
        echo "<td>" . $wp_formmaker_submits->id . "</td>";
        echo "<td>" . $wp_formmaker_submits->user_id . "</td>";
        echo "<td>" . $wp_formmaker_submits->recharge_number . "</td>";
        echo "<td>" . $wp_formmaker_submits->recharge_operator . "</td>";
        
        echo "<td>" . $wp_formmaker_submits->recharge_amount . "</td>";
        
        echo "<td>" . $wp_formmaker_submits->start_balance . "</td>";
        echo "<td>" . $wp_formmaker_submits->end_balance . "</td>";
        
        
        
		
        
        
        echo "<td>" . $wp_formmaker_submits->operator_transaction_id . "</td>";
        echo "<td>" . $wp_formmaker_submits->status_response . "</td>";
        
        
        
        
        
        echo "</tr>";
    }
    
    
    echo "</table>";
    
    
    
    
}








function aistore2030_manage_forms_step()
{
	




    $step = "one";
    
    
    if (isset($_REQUEST['step'])) {
        $step = $_REQUEST['step'];
    }
    
    $step = sanitize_text_field($step);
    
    
    if ($step == "one") {
        aistore2030_prepaid_recharge_form();
    } else if ($step == "two") {
        
        
        processRechargeStep2();
    } else if ($step == "three") {
        processRechargeStep3();
    }
    
    
}


function aistore2030_prepaid_recharge_form()
{
    
    
    echo "<div class='wrap'>";
    
    
    $url2 = admin_url('admin.php?page=aistore2030_manage_forms_step&step=two');
    
    
?>


 
 <h2>Prepaid Recharge Form  </h2> 

 <form method="post" action="<?php echo $url2; ?>">
  
   
Number
<input type="text" name="recharge_number" value="8840574997" />

Operator
<select name="recharge_operator">
<option value="0">Select Operator:</option>
<option value='Airtel'>Airtel</option>
<option value='Aircel'>Aircel </option>
<option value='Idea'>Idea </option>
<option value='BT'>Bsnl Topup </option>
<option value='BSNL Special'>BSNL SPECIAL TARIFF </option>
<option value='RelianceCDMA'>Reliance CDMA </option>
<option value='Reliance'>Reliance GSM </option>
<option value='Docomo'>Tata Docomo Topup </option>
<option value='DocomoSpecial'>Tata Docomo Special </option>
<option value='TataIndicom'>Tata Indicom </option>
<option value='Vodafone'>Vodafone </option>
<option value='MTS'>MTS </option>
<option value='Uninor'>Uninor </option>
<option value='UninorSpecial'>Uninor Special               </option>
<option value='Loop'>Loop Mobile </option>
<option value='Videocon'>Videocon </option>
<option value='VideoconSpecial'>Videocon Special </option>
<option value='MTNLDLTopup'>MTNL DL Topup </option>
<option value='MTNLDLSpecial'>MTNL DL Special </option>
<option value='MTNLMumbai'>MTNL Mumbai </option>
<option value='MTNLMumbaiSpecial'>MTNL Mumbai Special </option>
<option value='DTV'>Tata Walky </option>
</select>
 
	
Recharge  Amount
<input type="text" name="recharge_amount" value="" required />
	
   
<?php wp_nonce_field('process_recharge', 'process_recharge'); ?>
   
<input type="submit" value="Process Recharge" />
</form>
         
    </div>
      <?php
    
    
    
}





function aistore2030_dth_recharge_form()
{
    
    
    echo "<div class='wrap'>";
    
    
    $url2 = admin_url('admin.php?page=aistore2030_manage_forms_step&step=two');
    
    
?>


 
 <h2>DTH Recharge Form  </h2> 

 
 
  
            
            <form method="post" action="<?php    echo $url2; ?>">
  
   
   Number
    <input type="text" name="recharge_number" value="8840574997" />
	
	
   Operator
    
  <select name="recharge_operator">
 
 <option value="0">Select Operator:</option>
<option value='VideoconD2H'>VIDEOCON DTH </option>
<option value='SunDirect'>SUN DTH </option>
<option value='BIGtv'>BIG TV DTH </option>
<option value='TataSky'>TATA SKY DTH </option>
<option value='AirtelDTH'>AIRTEL DTH </option>
<option value='DishTV'>DISH DTH </option>

</select>
 
	
	
 Recharge  Amount
    <input type="text" name="recharge_amount" value=""  required />
	
   
   <?php
    wp_nonce_field('process_recharge', 'process_recharge');
?>
   
   <input type="submit" value="Process Recharge" />
</form>
         
    </div>
      <?php
    
    
    
}





function processRechargeStep2()
{
    
    if (!isset($_POST['process_recharge']) || !wp_verify_nonce($_POST['process_recharge'], 'process_recharge')) {
        
        exit();
        
    }
    
    
    $user = wp_get_current_user();
    
    $id = $user->ID;
    
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'recharge';
    
    
    $wallet = new Woo_Wallet_Wallet();
    
    
    $recharge_number = sanitize_text_field($_REQUEST['recharge_number']);
    
    
    $recharge_amount   = sanitize_text_field($_REQUEST['recharge_amount']);
    $recharge_operator = sanitize_text_field($_REQUEST['recharge_operator']);
    
    $balance = $wallet->get_wallet_balance($id);
    
    
    
    $url3 = admin_url('admin.php?page=aistore2030_manage_forms_step&step=three');
?>
	
 <h2>Please confirm recharge details   </h2> 
	<h3> Once proceeds this can not be refunded </h3>
	<table border="1">
	
	<tr>
	
	<td> Recharge Number /Consumer Number </td>
	
	<td><?php
    echo $recharge_number;
?>  </td>
	
	</tr>
	
	<tr>
	
	<td> Operator </td>
	
	<td><?php
    echo $recharge_operator;
?>  </td>
	
	</tr><tr>
	
	<td>  Amount </td>
	
	<td><?php
    echo $recharge_amount;
?> INR  </td>
	
	</tr>
	<tr>
	
	<td> Your Current Balance </td>
	
<td><?php
    echo $balance;
?>  </td>
	
	</tr>
	
	
	<tr>
	
	<td>  </td>
	
	<td>
 
 
 <?php
    if ($balance >= $recharge_amount) {
        
?>
  
            <form method="post" action="<?php
        echo $url3;
?>">
   
 
    <input type="hidden" name="recharge_operator" value="<?php
        echo $recharge_operator;
?>" />
	
	 <input type="hidden" name="recharge_number" value="<?php
        echo $recharge_number;
?>" />
	
	
   
    <input type="hidden" name="recharge_amount" value="<?php
        echo $recharge_amount;
?>" />
	
   
     <?php
        wp_nonce_field('process_recharge', 'process_recharge');
?>
   
   <input type="submit" value="Complete Recharge " />
</form>
         
		 
		 <?php
        
    } else {
        echo "<b>Low balance Recharge can not process</b>";
        
    }
?>

	 </td>
	
	</tr>
	</table>
	
	<?php
    
    
    
}



function processRechargeStep3()
{
    if (!isset($_POST['process_recharge']) || !wp_verify_nonce($_POST['process_recharge'], 'process_recharge')) {
        
        exit();
        
    }
    
    $user = wp_get_current_user();
    
    $id = $user->ID;
    
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'recharge';
    
    
    $wallet = new Woo_Wallet_Wallet();
    
    
    $recharge_number   = sanitize_text_field($_REQUEST['recharge_number']);
    $recharge_amount   = sanitize_text_field($_REQUEST['recharge_amount']);
    $recharge_operator = sanitize_text_field($_REQUEST['recharge_operator']);
    
    
    $balance = $wallet->get_wallet_balance($id, "int");
    
    if ($balance >= $recharge_amount) {
        $details = 'Recharge for ' . $_REQUEST['recharge_number'];
        
        $url = "http://api.sakshamapp.com/MobileRech?username=" . esc_attr(get_option('aistore_username')) . "&password=" . esc_attr(get_option('aistore_password')) . "&recharge_circle=0&recharge_operator=$recharge_operator&recharge_number=$recharge_number&amount=$recharge_amount&format=json&requestID=";
        
        
        $wpdb->query($wpdb->prepare("INSERT INTO $table_name (user_id,recharge_number,
recharge_amount,recharge_operator,start_balance,description,url_hit,ip_address ) VALUES (%d, %s,%s,%s,%s, %s ,%s ,%s)", array(
            $id,
            $recharge_number,
            $recharge_amount,
            $recharge_operator,
            $balance,
            $details,
            $url,
            aistore_getRealIpAddr()
        )));
        
        
        
        
        
        $insert_id = $wpdb->insert_id;
        
        $url = $url . $insert_id;
        
        
        
        
        $wallet->debit($id, $recharge_amount, $details);
        
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
            $wallet->credit(1, $recharge_amount, $details = 'Recharge refund ' . $_REQUEST['recharge_number']);
            
            
            
            
            
            $balance = $wallet->get_wallet_balance($id, "int");
            
            
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
            
            $balance = $wallet->get_wallet_balance($id);
            
            
            $wpdb->query($wpdb->prepare("update $table_name 
 set 
  status  =%s,
    message  = %s,
	Error  = %s,
    end_balance  = %d
 where
  id  = %d   
  ", array(
                $ar->Status,
                "Recharge is success",
                $ar->error,
                $balance,
                $insert_id
            )));
            
            
        }
        
?>
  
   
	 <h2>Request for the recharge/payment was completed.  </h2> 
 
	
	<table border="1">
	
	<tr>
		
	<td> Recharge Number /Consumer Number </td>
	
	<td><?php
        echo $recharge_number;
?>  </td>
	
	</tr>
	<tr>
	
	<td> Operator </td>
	
	<td><?php
        echo $recharge_operator;
?>  </td>
	
	</tr>
	<tr>
	
	<td>Amount </td>
	
	<td><?php
        echo $recharge_amount;
?> INR </td>
	
	</tr>
	<tr>
	
	<td> Final Balance </td>
	
<td><?php
        echo $balance;
?>  INR</td>
	
	</tr>
	
	
	<tr>
	
	<td>Current Status  </td>
	
	<td>
 
 
 <?php
        echo $ar->Message;
?>
   
		 
		 

	 </td>
	
	</tr>
	</table>
	
	
	<?php
    } else {
        
        echo "Balance low ";
        $balance = $wallet->get_wallet_balance($id);
        
        echo $balance;
        
    }
    
    
}








function aistore_getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet
        {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //to check ip is pass from proxy
        {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}















function aistore_recharge_settings_group()
{
    //register our settings
    register_setting('aistore_recharge_group', 'aistore_username');
    register_setting('aistore_recharge_group', 'aistore_password');
}

function aistore_recharge_settings_page()
{
?>
<div class="wrap">
<h1>Aistore Recharge </h1>
<p>This form is visible to only admin </p>


<P> You can get username and password via registering api.sakshamapp.com or talk to the support at <a href="https://api.whatsapp.com/send?phone=919682780263&text=Hello%20I%20need%20support%20for%20the%20Recharge%20plugin" target="_blank" >Talk to whatsapp +91 9682780263</a>


<form method="post" action="options.php">
    <?php
    settings_fields('aistore_recharge_group');
?>
    <?php
    do_settings_sections('aistore_recharge_group');
?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">API Username</th>
        <td><input type="text" name="aistore_username" value="<?php
    echo esc_attr(get_option('aistore_username'));
?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">API Password</th>
        <td><input type="text" name="aistore_password" value="<?php
    echo esc_attr(get_option('aistore_password'));
?>" /></td>
        </tr>
        
        
    </table>
    
    <?php
    submit_button();
?>

</form>

<h1>All feedback welcome </h3>
</div>
<?php
}