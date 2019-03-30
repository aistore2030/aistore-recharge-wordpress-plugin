
 
 <h2>Postpaid Recharge Form  </h2> 

 
 
  
            
            <form method="post" action="<?php    echo $url2; ?>">
  <table class="table">
  
  <tr><td>
   Number</td><td>
    <input type="text" name="recharge_number" value="" />
	</td></tr>
	
	<td>
	
   Operator
    </td><td>
  <select name="recharge_operator">
 
 <option value="0">Select Operator:</option>
  <option value="AirtelPostpaid">AIRTEL POSTPAID</option>
	
	 <option value="BsnlPostpaid">BSNL POSTPAID</option>
    <option value="IdeaPostpaid">IDEA POSTPAID</option>
    <option value="VodafonePostpaid">VODAFONE POSTPAID</option>
	
	  
</select>
 
	</td></tr><tr><td>
	
 Recharge  Amount</td><td>
    <input type="text" name="recharge_amount" value=""  required />
	
   </td></tr>
   
   <tr><td>
   <?php
    wp_nonce_field('process_recharge', 'process_recharge');
?>
   </td><td>
   <input type="submit" value="Process Recharge" />
   </td></tr></table>
   
</form>
         
		 