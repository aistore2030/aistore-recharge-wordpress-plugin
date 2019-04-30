
<html>
    <head>
         <script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.5.2/angular.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="./assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="./assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="./assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="./assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="./assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
     <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.css" type="text/css" media="all" />

         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Recharge</title>
    </head>
    <body ng-app = "myapp">
      
           
              <div  ng-controller = "HelloController" >
                 <div class="col-md-6">
    <div class="portlet light bordered">
        <div class=" portlet-body"> 

            <h1>Mobile Recharge</h1>
            <form>
                <div class="form-group">
                    <label for="mobile">Mobile Number </label>

                    <input  class="form-control" length="10"  ng-change="getOperator()" ng-model="recharge.mobile" type="text" name="recharge_number"  maxlength="10" >

                </div>
                <div class="form-group">
                    <label for="Operator">Operator </label>
                    <select class="form-control" ng-model="recharge.Operator" name="mobile_operator"  autocomplete="on">
                        <option ng-repeat="operators in myData1"   ng-selected="goperator === operators.id" value="{{operators.id}}">
                            {{operators.name}}
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Circle">Circle </label>
                    <select class="form-control" ng-model="recharge.Circle" name="recharge_circle"    autocomplete="on">
                        <option ng-repeat="circle in myData2" ng-selected="gcircle === circle.id" value="{{circle.id}}">
                            {{circle.name}}
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Amount">Amount</label>
                    <input class="form-control" type="text" ng-model="recharge.amount" name="amount"  autocomplete="on" maxlength="4" class="rupee">

                </div>
                <a  ng-click="sendRecharge(recharge)" class="btn btn-primary "  > Proceed To Recharge </a>



            </form>


        </div></div></div>
<div class="col-md-6">
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
                        /*if (response.data.Operator === "jio" || response.data.Operator === "Jio") {
                         $scope.recharge.Operator = "J";
                         $scope.goperator = "J";
                         }*/
                        $http.get("http://api.sakshamapp.com/Offer?Operator=" + $scope.recharge.Operator + "&Circle=" + $scope.recharge.Circle)
                                .then(function (response) {
                                    console.log(response.data);
                                    $scope.myWelcome = response.data;
                                    // $scope.title = "response.data";
                                    // $scope.open();
                                });
                    });
        }

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
       <script src="./assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="./assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        
        
        <script src="./assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="./assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
      
        <script src="./assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="./assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>

    </body>
</html>