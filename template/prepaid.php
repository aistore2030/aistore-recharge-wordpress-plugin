

      <script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
   

 <h2>Prepaid Recharge Form  </h2> 

 <div ng-app = "myapp" ng-controller = "HelloController">

 <form method="post" action="<?php echo $url2; ?>">

  <table  class="table">

  



  <tr><td>

Number</td><td>

<input length="10"  ng-change="getOperator()" ng-model="recharge.mobile" type="text" name="recharge_number"  maxlength="10"/>

</td></tr>



<tr><td>

Operator</td><td>
 <select class="form-control" ng-model="recharge.Operator" name="recharge_operator"  autocomplete="on">
                        <option ng-repeat="operators in myData1"   ng-selected="goperator === operators.id" value="{{operators.id}}">
                            {{operators.name}}
                        </option>
                    </select>


 </td></tr>

 

 

 

 <tr><td>

	

Recharge  Amount

</td><td>

<input type="text" ng-model="recharge.amount" name="recharge_amount" value="" required />

	

   </td></tr>

   

   <tr>
       
       <td><?php wp_nonce_field('process_recharge', 'process_recharge'); ?></td>
       <td>

<input type="submit" value="Process Recharge" />

</td></tr>


</table>


</form>


    <div class="portlet light bordered"  ng-show="recharge.mobile.length == 10">
        <div class=" portlet-body"> 
            <form name="outerForm" class="tab-form-demo" ng-show="recharge.mobile.length == 10">

                <uib-tabset active="activeForm">

                    <uib-tab index="1" heading="3G / 4G">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr class="" ><th>Category</th><th>Description</th><th>Amount</th><th>Talktime</th><th>Validity</th></tr>   
                                <tr ng-repeat="x in myWelcome| filter : '3G'" ng-click="showamount(x)"><td>{{x.category}}</td><td>{{x.description}}</td><td>{{x.amount}}</td><td>{{x.talktime}}</td><td>{{x.validity}}</td></tr></table>
                        </div></uib-tab>
                    <uib-tab index="2" heading="2G"><div class="table-responsive">
                            <table class="table table-bordered">
                                <tr class="" ><th>Category</th><th>Description</th><th>Amount</th><th>Talktime</th><th>Validity</th></tr>   
                                <tr ng-repeat="x in myWelcome| filter : '2G'" ng-click="showamount(x)"><td>{{x.category}}</td><td>{{x.description}}</td><td>{{x.amount}}</td><td>{{x.talktime}}</td><td>{{x.validity}}</td></tr></table>
                        </div></uib-tab>
                    <uib-tab index="3" heading="FULL TALK TIME"><div class="table-responsive">
                            <table class="table table-bordered">
                                <tr class="" ><th>Category</th><th>Description</th><th>Amount</th><th>Talktime</th><th>Validity</th></tr>   
                                <tr ng-repeat="x in myWelcome| filter : 'FULL TT'" ng-click="showamount(x)"><td>{{x.category}}</td><td>{{x.description}}</td><td>{{x.amount}}</td><td>{{x.talktime}}</td><td>{{x.validity}}</td></tr></table>
                        </div>
                    </uib-tab><uib-tab index="4" heading="TOPUP"><div class="table-responsive">
                            <table class="table table-bordered">
                                <tr class=""><th>Category</th><th>Description</th><th>Amount</th><th>Talktime</th><th>Validity</th></tr>   
                                <tr ng-repeat="x in myWelcome| filter : 'Topup'" ng-click="showamount(x)"><td>{{x.category}}</td><td>{{x.description}}</td><td>{{x.amount}}</td><td>{{x.talktime}}</td><td>{{x.validity}}</td></tr></table>
                        </div>
                    </uib-tab><uib-tab index="5" heading="SPL/RATE CUTTER"><div class="table-responsive">
                            <table class="table table-bordered">
                                <tr class=""><th>Category</th><th>Description</th><th>Amount</th><th>Talktime</th><th>Validity</th></tr>   
                                <tr ng-repeat="x in myWelcome| filter : 'SPL/RATE CUTTER'" ng-click="showamount(x)"><td>{{x.category}}</td><td>{{x.description}}</td><td>{{x.amount}}</td><td>{{x.talktime}}</td><td>{{x.validity}}</td></tr></table>
                        </div>
                    </uib-tab>
                </uib-tabset>
            </form>
        </div>   </div> </div></div>

   <script>
         angular.module("myapp", [])
         
         .controller("HelloController", function($scope,$http,) {
             $scope.myData1 = [
    {
        "name": "AIRTEL",
        "id": "Airtel"
    },
    {
        "name": "BSNL",
        "id": "BSNL"
    },
     {
        "name": "BSNL Special",
        "id": "BSNL Special"
    },
    {
        "name": "IDEA",
        "id": "Idea"
    },
     {
        "name": "VODAFONE",
        "id": "Vodafone"
    },
    {
        "name": "JIO",
        "id": "RelianceJio"
    },
     {
        "name": "TATA INDICOM",
        "id": "TataIndicom"
    }, 
    {
        "name": "TATA DOCOMO",
        "id": "Docomo"
    },
    {
        "name": "TELENOR",
        "id": "Uninor"
    },
    {
        "name": "MTS",
        "id": "MTS"
    }, 
    {
        "name": "RELIANCE",
        "id": "Reliance"
    },
    {
        "name": "VIRGIN",
        "id": "Virgin"
    },
    {
        "name": "Airtel Digital TV",
        "id": "AirtelDigitalTV"
    },
    {
        "name": "BIG TV",
        "id": "BIGtv"
    },
    {
        "name": "DISH TV",
        "code": "DishTV"
    },
    {
        "name": "TATASKY DTH TV",
        "code": "TataSky"
    },
    {
        "name": "VIDEOCON DTH TV",
        "code": "VideoconD2H"
    },
    {
        "name": "Sun Direct",
        "id": "SunDirect"
    } 
];
$scope.myData2 = [
   {
      "name":"Uttar Pradesh (E)",
      "id":"UttarPradesh(E)"
        
   },
   {
      "name":"Andhra Pradesh",
      "id":"AndhraPradesh"
   },
   {
      "name":"Assam",
      "id":"Assam"
   },
   {
      "name":"Bihar Jharkhand",
      "id":"BiharJharkhand"
   },
   {
      "name":"Chennai",
      "id":"Chennai"
   },
   {
      "name":"Delhi NCR",
      "id":"DelhiNCR"
   },
   {
      "name":"Gujarat",
      "id":"Gujarat"
   },
   {
      "name":"Haryana",
      "id":"Haryana"
   },
   {
      "name":"Himachal Pradesh",
      "id":"HimachalPradesh"
   },
   {
      "name":"Jammu Kashmir",
      "id":"JK"
   },
   {
      "name":"Karnataka",
      "id":"Karnataka"
   },
   {
      "name":"Kerala",
      "id":"Kerala"
   },
   {
      "name":"Kolkata",
      "id":"Kolkata"
   },
   {
      "name":"Maharashtra & Goa (except Mumbai)",
      "id":"Maharashtra&Goa(exceptMumbai)"
   },
   {
      "name":"MadhyaPradesh & Chhattisgarh",
      "id":"MadhyaPradesh&Chhattisgarh"
   },
   {
      "name":"Mumbai",
      "id":"Mumbai"
   },
   {
      "name":"North East",
      "id":"NorthEast"
   },
   {
      "name":"Orissa",
      "id":"Orissa"
   },
   {
      "name":"Punjab",
      "id":"Punjab"
   },
   {
      "name":"Rajasthan",
      "id":"Rajasthan"
   },
   {
      "name":"Tamil Nadu",
      "id":"TamilNadu"
   },
   {
      "name":"UP WEST",
      "id":"UPWEST"
   },
   {
      "name":"West Bengal",
      "id":"WestBengal"
   }
];
        $scope.getOperator = function () {

        if ($scope.recharge.mobile.length === 10) {

            $http.post("http://api.sakshamapp.com/Operator?mobile=" + $scope.recharge.mobile)
                    .then(function (response) {
 console.log("272");
                        $scope.recharge.Operator = response.data.Operator_code;
                        $scope.recharge.Circle = response.data.Circle_code;

                        console.log(response.data.Operator_code + "response.data.Operator_code" + response.data.Circle_code + "response.data.Circle_code");
                        console.log(response.data.Operator);
                        console.log(response.data);
                        $scope.goperator = response.data.Operator_code;
                        $scope.gcircle = response.data.Circle_code;
                      
                        $http.get("http://api.sakshamapp.com/Offer?Operator=" + $scope.recharge.Operator + "&Circle=" + $scope.recharge.Circle)
                                .then(function (response) {
                                    console.log(response.data);
                                    $scope.myWelcome = response.data;
                                    
                                });
                    });
        }

    };  
    
     $scope.showamount = function (x) {
        $scope.recharge.amount = x.amount;
    };
        
         });
      </script>