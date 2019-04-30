
      <script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
   
 <h2>Landline Recharge Form  </h2> 

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
        "operator": "Airtel",
        "id": "ATL",
        "code": "ATL"
    },
    {
        "operator": "Bsnl - Corporate",
        "id": "BCL",
        "code": "BCL"
    },

    {
        "operator": "Bsnl - Individual",
        "id": "BGL",
        "code": "BGL"
    },
   
    {
        "operator": "Tata Docomo",
        "id": "TCL",
        "code": "TCL"
    }
];
$scope.GetAmount = function () {
	
	//console.log(recharge);
       // console.log("recharge amount" + recharge.amount);
       // console.log("MobileRech?requestID=1&amount=" + recharge.amount + "&recharge_operator=" + recharge.Operator + "&recharge_circle=" + recharge.Circle + "&recharge_number=" + recharge.mobile + "&format=json");
         $http.post("http://api.sakshamapp.com/Ambika_Bill_Fetch?recharge_number=" + $scope.recharge.mobile)
                .then(function (response) {
                    console.log(response);
                    alert(response.data.MSG);
               $scope.recharge.amount = response.data.AMOUNT;//$scope.y.panprice * $scope.x.Circle+"";
                    //$state.go('AllRecharge');
                });
	
       // $scope.x.amount = $scope.y.panprice * $scope.x.Circle+"";
        //console.log($scope.x.amount);
    };
             $scope.sendRecharge = function (recharge) {
        console.log(recharge);
        console.log("recharge amount" + recharge.amount);
        console.log("MobileRech?requestID=1&amount=" + recharge.amount + "&recharge_operator=" + recharge.Operator + "&recharge_circle=" + recharge.Circle + "&recharge_number=" + recharge.mobile + "&format=json");
        $http.get("MobileRech?requestID=1&amount=" + recharge.amount + "&recharge_operator=" + recharge.Operator + "&recharge_circle=" + recharge.Circle + "&recharge_number=" + recharge.mobile + "&format=json")
                .then(function (response) {
                    console.log(response);
                    alert(response.data.Message);

                    //$state.go('AllRecharge');
                });

    };
         });
      </script>
