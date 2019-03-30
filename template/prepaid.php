
 
 <h2>Prepaid Recharge Form  </h2> 

 <form method="post" action="<?php echo $url2; ?>">
  <table  class="table">
  

  <tr><td>
Number</td><td>
<input type="text" name="recharge_number" value="" />
</td></tr>

<tr><td>
Operator</td><td>
<select name="recharge_operator">
<option value="0">Select Operator:</option>
<option value='Airtel'>Airtel</option> 
<option value='Idea'>Idea </option>
<option value='BT'>Bsnl Topup </option>
<option value='BSNL Special'>BSNL SPECIAL TARIFF </option>
<option value='RelianceJio'>Reliance Jio </option> 
<option value='Docomo'>Tata Docomo Topup </option>
<option value='DocomoSpecial'>Tata Docomo Special </option>
<option value='TataIndicom'>Tata Indicom </option>
<option value='Vodafone'>Vodafone </option>
<option value='MTS'>MTS </option>


</select>
 </td></tr>
 
 
 
 <tr><td>
	
Recharge  Amount
</td><td>
<input type="text" name="recharge_amount" value="" required />
	
   </td></tr>
   
   <tr><td>
<?php wp_nonce_field('process_recharge', 'process_recharge'); ?>
   </td><td>
<input type="submit" value="Process Recharge" />
</td></tr>


</table>
</form>