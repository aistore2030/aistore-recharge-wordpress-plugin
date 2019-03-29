<?php 


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


<P> Talk to the support at <a href="https://api.whatsapp.com/send?phone=919682780263&text=Hello%20I%20need%20support%20for%20the%20Recharge%20plugin" target="_blank" >Talk to whatsapp +91 9682780263</a>

 

Create  4 Pages <br />
Page 1 for prepaid recharge form and insert this shortcode [ AISTORERECHARGEFORM type="prepaid" ]  Remove spaces <br />
Page 2 for postpaid recharge form and insert this shortcode [ AISTORERECHARGEFORM type="postpaid" ]  Remove spaces<br />
Page 3 for DTH recharge form and insert this shortcode [ AISTORERECHARGEFORM type="dth" ] Remove spaces <br />
Page 4 for report of recharge   and insert this shortcode [ AistoreRechargeReport ]  Remove spaces <br />



  

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
<p>You can get username and password via registering api.sakshamapp.com </p>
</form> 

<h3>Please note that if you want to handle the call back you will need and an add on plugin aistore-recharge-secure-callback plugin which you can purchase in just Rs 1000 <a href="https://api.whatsapp.com/send?phone=919682780263&text=Hello%20I%20need%20aistore-recharge-secure-callback%20for%20the%20Recharge%20plugin" target="_blank" >Talk to whatsapp +91 9682780263</a> </h3>
</div>
<?php
}?>