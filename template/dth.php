

 
 <h2>DTH Recharge Form  </h2> 

 
 
  
            
            <form method="post" action="<?php    echo $url2; ?>">
  
   <table  class="table">
   
   <tr><td>
   Number  </td><td>
    <input type="text" name="recharge_number" value="" />
	
	</td></tr>
   
   <tr><td>
   Operator  </td><td>
    
  <select name="recharge_operator">
 
 <option value="0">Select Operator:</option>
<option value='VideoconD2H'>VIDEOCON DTH </option>
<option value='SunDirect'>SUN DTH </option>
<option value='BIGtv'>BIG TV DTH </option>
<option value='TataSky'>TATA SKY DTH </option>
<option value='AirtelDTH'>AIRTEL DTH </option>
<option value='DishTV'>DISH DTH </option>

</select>
 
	</td></tr>
   
   <tr><td>
	
 Recharge  Amount  </td><td>
    <input type="text" name="recharge_amount" value=""  required />
	</td></tr>
   
   <tr><td>
   
   <?php
    wp_nonce_field('process_recharge', 'process_recharge');
?>
   </td><td>
   <input type="submit" value="Process Recharge" />
   
   </td></tr>
   
   </table>
</form>