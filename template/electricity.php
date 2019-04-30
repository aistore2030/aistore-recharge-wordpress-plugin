
      <script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
   
 <h2>ElectricityBill Recharge Form  </h2> 

 <div ng-app = "myapp" ng-controller = "HelloController">
 <div class="col-md-6">
 <form method="post" action="<?php echo $url2; ?>">

  <table  class="table">

  



  <tr><td>

Number</td><td>

 <input  length="10" pattern="[789][0-9]{9}"  ng-model="recharge.mobile" ng-change="GetAmount(x)" type="text" name="recharge_number"  maxlength="10" >
   

</td></tr>



<tr><td>

Operator</td><td>
 <select class="form-control" ng-model="recharge.Operator" name="mobile_operator"  autocomplete="on">
                        <option ng-repeat="operators in myData"   ng-selected="goperator === operators.id" value="{{operators.id}}">
                            {{operators.operator}}
                        </option>
                    </select>


 </td></tr>

 <tr><td>

	

Recharge  Amount

</td><td>

<input type="text" ng-model="recharge.amount" name="amount"  autocomplete="on" maxlength="4" class="rupee" />

	

   </td></tr>

   

   <tr><td>

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
        "operator": "BSES Yamuna",
        "id": "BSESY",
        "code": "BSESY"
    },
    {
        "operator": "Southern Power Distribution Company Of Telengana Limited",
        "id": "SPTL",
        "code": "39"
    },

    {
        "operator": "MSEDC Limited",
        "id": "MSEDC",
        "code": "MSEDC"
    },
    {
        "operator": "Rajasthan Vidyt Vitran Nigam Limited",
        "id": "RVVNL",
        "code": "RVVNL"
    },
    {
        "operator": "Souther Power Distribution Comapany LTD Of Andhra Pradesh",
        "id": "SPAP",
        "code": "43"
    },
    {
        "operator": "Torrent Power",
        "id": "TPB",
        "code": "TPB"
    },

    {
        "operator": "Madhya Pradesh Madhya Kshetra Vidyut Vitran Company Limited-Bhopal",
        "id": "MPMKVCLB",
        "code": "46"
    },
    {
        "operator": "Noida Power Company Limited",
        "id": "NPCL",
        "code": "NPCL"
    },
    {
        "operator": "Madhya Pradesh Paschim Kshetra Vidyut Vitaran Indore",
        "id": "MPMKVCL",
        "code": "48"
    },
    {
        "operator": "Calcutta Electricity Supply LTD",
        "id": "CESL",
        "code": "CESL"
    },
    {
        "operator": "CHHATTISGARH STATE ELECTRICITY BOARD",
        "id": "CESL",
        "code": "CESL"
    },
    {
        "operator": "INDIA POWER CORPORATION LIMITED - BIHAR",
        "id": "IPCLB",
        "code": "IPCLB"
    },

    {
        "operator": "BANGALORE ELECTRICITY SUPPLY COMPANY",
        "id": "BESC",
        "code": "BESC"
    },
    {
        "operator": "BHARATPUR ELECTRICITY SERVICES LTD",
        "id": "BESL",
        "code": "BESL"
    },
    {
        "operator": "BIKANER ELECTRICITY SUPPLY LIMITED (BKESL)",
        "id": "BESL",
        "code": "BESL"
    },
    {
        "operator": "BRIHAN MUMBAI ELECTRIC SUPPLY AND TRANSPORT UNDERT",
        "id": "BMSTU",
        "code": "BMSTU"
    },
    {
        "operator": "BSES RAJDHANI",
        "id": "BSESR",
        "code": "BSESR"
    },
    {
        "operator": "DAMAN AND DIU ELECTRICITY ARTMENT",
        "id": "DDED",
        "code": "DDED"
    },
    {
        "operator": "DAKSHIN HARYANA BIJLI VITRAN NIGAM",
        "id": "DHBVN",
        "code": "DHBVN"
    },
    {
        "operator": "DNH POWER DISTRIBUTION COMPANY LIMITED",
        "id": "DNHPD",
        "code": "DNHPD"
    },
    {
        "operator": "EASTERN POWER DISTRIBUTION COMPANY OF ANDHRA PRADE",
        "id": "EPDCA",
        "code": "EPDCA"
    },
    {
        "operator": "GULBARGA ELECTRICITY SUPPLY COMPANY LIMITED",
        "id": "GESC",
        "code": "GESC"
    },
    {
        "operator": "JAMSHEDPUR UTILITIES AND SERVICES COMPANY LIMITED",
        "id": "JUSC",
        "code": "JUSC"
    },
    {
        "operator": "JAIPUR AND AJMER VIYUT VITRAN NIGAM",
        "id": "JAVVN",
        "code": "JAVVN"
    },
    {
        "operator": "JODHPUR VIDYUT VITRAN NIGAM LTD",
        "id": "JVVNL",
        "code": "JVVNL"
    },
    {
        "operator": "JHARKHAND BIJLI VITRAN NIGAM LIMITED (JBVNL)",
        "id": "JVVNL",
        "code": "JVVNL"
    },
    {
        "operator": "KOTA ELECTRICITY DISTRIBUTION LTD",
        "id": "KEDL",
        "code": "KEDL"
    },
    {
        "operator": "MEGHALAYA POWER DISTRIBUTION CORPORATI ON LTD",
        "id": "MPDC",
        "code": "MPDC"
    },

    {
        "operator": "MUZAFFARPUR VIDYUT VITRAN LIMITED",
        "id": "MVVL",
        "code": "MVVL"
    },
    {
        "operator": "NORTH DELHI POWER LIMITED(TATA POWER - DDL)",
        "id": "NDPL",
        "code": "NDPL"
    },
    {
        "operator": "NORTH BIHAR POWER DISTRIBUTION COMPANY LTD",
        "id": "NBPDC",
        "code": "NBPDC"
    },
    {
        "operator": "MUNICIPAL CORPORATION OF GURUGRAM",
        "id": "MCOG",
        "code": "MCOG"
    },
    {
        "operator": "PUNJAB STATE POWER CORPORATION LTD (PSPCL)",
        "id": "PSPCL",
        "code": "PSPCL"
    },
    {
        "operator": "SOUTH BIHAR POWER DISTRIBUTION COMPANY LTD.",
        "id": "SBPDC",
        "code": "SBPDC"
    },
    {
        "operator": "SNDL NAGPUR",
        "id": "SNDLN",
        "code": "SNDLN"
    },
    {
        "operator": "SOUTHERN POWER DISTR OF ANDHRA PRADESH",
        "id": "SPDAP",
        "code": "SPDAP"
    },
    {
        "operator": "TRIPURA STATE ELECTRICITY CORPORATION LTD",
        "id": "TSECL",
        "code": "TSECL"
    },
    {
        "operator": "TAMIL NADU ELECTRICITY BOARD (TNEB)",
        "id": "TNEB",
        "code": "TNEB"
    },
    {
        "operator": "TP AJMER DISTRIBUTION LTD",
        "id": "TPADL",
        "code": "TPADL"
    },
    {
        "operator": "TATA POWER – MUMBA",
        "id": "TPM",
        "code": "TPM"
    },
    {
        "operator": "UTTAR HARYANA BIJLI VITRAN NIGAM",
        "id": "UHBVN",
        "code": "UHBVN"
    },
    {
        "operator": "UTTARAKHAND POWER CORPORATION LIMITED",
        "id": "UPCL",
        "code": "UPCL"
    },
    {
        "operator": "UTTAR PRADESH POWER CORP LTD (UPPCL) - URBAN",
        "id": "UPPCL",
        "code": "UPPCL"
    },
    {
        "operator": "UTTAR PRADESH POWER CORP LTD (UPPCL) - RURAL",
        "id": "UPPCR",
        "code": "UPPCR"
    },

    {
        "operator": "WEST BENGAL STATE ELECTRICITY",
        "id": "WBSE",
        "code": "WBSE"
    },
    {
        "operator": "INDIA POWER CORPORATION -WEST BENGAL",
        "id": "IPCWB",
        "code": "IPCWB"
    }
];
$scope.GetAmount = function () {
	
	console.log(recharge);
        console.log("recharge amount" + recharge.amount);
        console.log("MobileRech?requestID=1&amount=" + recharge.amount + "&recharge_operator=" + recharge.Operator + "&recharge_circle=" + recharge.Circle + "&recharge_number=" + recharge.mobile + "&format=json");
         $http.post("http://api.sakshamapp.com/Ambika_Bill_Fetch?recharge_number=" + $scope.recharge.mobile)
                .then(function (response) {
                    console.log(response);
                    alert(response.data.MSG);
$scope.recharge.amount = response.data.AMOUNT;//$scope.y.panprice * $scope.x.Circle+"";
                    //$state.go('AllRecharge');
                });
	
       
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
