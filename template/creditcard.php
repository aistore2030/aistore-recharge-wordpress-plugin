
      <script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
   
 <h2>Credit Card Bill Recharge Form  </h2> 

 <div ng-app = "myapp" ng-controller = "HelloController">
 <div class="col-md-6">
 <form method="post" action="<?php echo $url2; ?>">

  <table  class="table">

  



  <tr><td>

Number</td><td>

 <input  length="10" pattern="[789][0-9]{9}"  ng-model="recharge.mobile" type="text" ng-change="GetAmount()" name="recharge_number"  maxlength="10" >
   

</td></tr>



<tr><td>

Operator</td><td>
 <select class="form-control" ng-model="recharge.Operator" name="mobile_operator"  autocomplete="on">
                        <option ng-repeat="operators in myData"   ng-selected="goperator === operators.id" value="{{operators.id}}">
                            {{operators.name}}
                        </option>
                    </select>


 </td></tr>

 <tr><td>

	

Recharge  Amount

</td><td>

<input type="text" ng-model="recharge.amount" name="recharge_amount"  autocomplete="on" maxlength="4" class="rupee" />

	

   </td></tr>

   

   <tr>
       <td><?php wp_nonce_field('process_recharge', 'process_recharge'); ?></td> 
       <td>

<input type="submit" value="Process Recharge" />

</td></tr>


</table>


</form>

</div>
   <script>
         angular.module("myapp", [])
         
         .controller("HelloController", function($scope,$http,) {
             $scope.myData = [
    {
        "operator": "Mpos Credit Cards (standard/premium)",
        "id": "MPCC",
        "code": "MPCC"
    },
    {
        "operator": "Mpos Debit Cards - Above Rs.2000",
        "id": "MPSB",
        "code": "MPSB"
    },

    {
        "operator": "Mpos Debit Cards - Below Rs.1000",
        "id": "MPS",
        "code": "MPS"
    },
    {
        "operator": "Mpos Debit Cards - Between Rs.1000- Rs.2000",
        "id": "MPSA",
        "code": "MPSA"
    },     {
        "operator": "Mpos Emi",
        "id": "MPEM",
        "code": "MPEM"
    },
    {
        "operator": "Mpos Upi",
        "id": "MPUP",
        "code": "MPUP"
    },

    {
        "operator": "Mpos Wallet",
        "id": "MPW",
        "code": "MPW"
    }
];
 $scope.GetAmount = function () {
	
 $http.post("http://api.sakshamapp.com/Bill_Fetch?recharge_number=" + $scope.recharge.mobile)
                .then(function (response) {
                    console.log(response);
                    alert(response.data.MSG);
               $scope.recharge.amount = response.data.AMOUNT;
                   
                });
	
      
    };
         });
      </script>
