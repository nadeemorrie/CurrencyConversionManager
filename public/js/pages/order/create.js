// var publicServicePulitzers = [
// {year: 1918, newsroom: "The New York Times",
//   reason: "For its public service in publishing in full so many official reports, documents and speeches by European statesmen relating to the progress and conduct of the war."},
//   {year: 1919, newsroom: "Cape Town",
//   reason: "Test"}
// ];
// var findValue = {id: 2};
// var hay =[
// 			{id:2,name:"nadeem"}
			
// 		];

// var xxx = _.findWhere(hay, findValue);
// console.log('result', xxx);

// var result = _.findWhere(publicServicePulitzers, {year: 1919});


var app = angular.module('myApp', []);

var selectDefaultText = 'Select a currency';

app.controller('orderController', function($scope, $http, $location, $timeout) {	
	$scope.data = {
		amount : 100,
		foreignAmount : 0,
		cost : 0,
		surcharge : 0,
		total : 0,
		fullname : 'nadeem orrie',
		email : 'nadeem.orrie@gmail.com',
		isForeign : '',
		currencies : null,
		exchangeRate : 0,
		hideBuyDiv: true,
		options : [],
		buttonDisabled : false,		
		selectedOption : { id:0, currencyName:selectDefaultText},
		selectedCurrencyName : null,
		validateFields : function () {
			this.buttonDisabled=false;
			this.hasCurrency();
			this.hasFullname();
			this.hasEmail();
			this.hasPurchaseType();
			this.hasAmount();
			
			return this.buttonDisabled;
		},
		hasCurrency : function () {
			if (this.selectedOption.currencyName==selectDefaultText) {
				this.buttonDisabled=true;
			}			
		},
		hasFullname : function () {
			if (this.fullname=='') {
				this.buttonDisabled=true;
				return 'has-error';
			}
			return '';
		},
		hasEmail : function () {
			if (this.email=='') {
				this.buttonDisabled=true;
				return 'has-error';
			}
			return '';
		},
		hasPurchaseType : function () {
			if (this.isForeign=='') {
				this.buttonDisabled=true;
				return 'has-error';
			}
			return '';
		},
		hasAmount : function () {
			if (!angular.isNumber(this.amount)) {
				this.buttonDisabled=true;
				return 'has-error';
			}
			return '';
		},
		setHideBuyDiv : function (val) {			
			this.hideBuyDiv=val;
		},
		calculateCurrency : function () {
			$http({
			  method: 'POST',			  
			  url: baseurl+'/api/currency/convert',
			  data : {
			  	_token: csrfToken,			  	
			  	amount : this.amount,
			  	isForeign : this.isForeign,
			  	exchangeRate : this.selectedOption.exchangeRate,
			  	surchargeRate : this.selectedOption.surchargeRate,			  		  	
			  }
			}).then(function successCallback(response) {
				$scope.data.setHideBuyDiv(false);
				$scope.data.surcharge = response.data.surcharge;				
				$scope.data.cost = response.data.cost;				
				$scope.data.total = response.data.total;				
				$scope.data.foreignAmount = response.data.foreignAmount;				
			  }, function errorCallback(response) {
			  	$scope.data.setHideBuyDiv(true);
				alert('Convert api call failed');
			  });
		}
		// storeOrder : function () {
		// 	$http({
		// 	  method: 'POST',			  
		// 	  url: baseurl+'/order',
		// 	  data : {
		// 	  	_token: csrfToken,			  	
		// 	  	isForeign : this.isForeign,
		// 	  	exchangeRate : this.selectedOption.exchangeRate,
		// 	  	surchargeRate : this.selectedOption.surchargeRate,			  		  	
		// 		rateId : this.selectedOption.id,
		// 	  	surcharge : this.surcharge,
		// 		cost : this.cost,				
		// 		total : this.total,
		// 		foreignAmount : this.foreignAmount,
		// 		customerName : this.fullname,
		// 		customerEmail : this.email
		// 	  }
		// 	}).then(function successCallback(response) {
		// 		console.log('Store order success');							
		// 	  }, function errorCallback(response) {			  	
		// 		console.log('Store api call failed');
		// 	  });
		// }		
	}
	
	loadList();
	
	// console.log(GetCurrencyName(2));

	function loadList () {			
			$http({
			  method: 'POST',			  
			  url: baseurl+'/api/currency/list',
			  data : {
			  	_token: csrfToken,		  	
			  	currencyCode : 'USD'
			  }
			}).then(function successCallback(response) {				
				$scope.data.currencies = response.data;
				loadSelectList();
			  }, function errorCallback(response) {
				console.log('currency load list failed');
			  });
	}

	function loadSelectList() {		
		$scope.data.options = $scope.data.currencies;
		$scope.data.options.push($scope.data.selectedOption);
		$scope.data.options = _.sortBy($scope.data.options, 'id');
		console.log('options', $scope.data.options);
	}
	
});

