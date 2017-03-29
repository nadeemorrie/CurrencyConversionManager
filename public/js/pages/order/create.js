var app = angular.module('myApp', []);

var selectDefaultText = 'Select a currency';

app.controller('orderController', function($scope, $http, $location, $timeout) {	
	$scope.data = {
		amount : 0,
		foreignAmount : 0,
		cost : 0,
		surcharge : 0,
		total : 0,
		fullname : '',
		email : '',
		isForeign : '',
		currencies : null,
		exchangeRate : 0,
		hideBuyDiv: true,
		options : [],
		disableRateButton : false,
		updateRatesText	: "Update rates",
		updateRatesDate	: "",
		updateRatesSuccess	: "",		
		updateRatesError	: "",		
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
			if (!angular.isNumber(this.amount) || this.amount==0) {
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
		},
		fetchRates : function () {
			// init vars
			this.disableRateButton = true;
			this.updateRatesSuccess = '';
			this.updateRatesError = '';
			this.updateRatesText = 'Loading...';

			// api request
			$http({
			  method: 'GET',			  
			  url: baseurl+'/api/currency/rates',			  
			}).then(function successCallback (response) {				
				$scope.data.disableRateButton = false;
				$scope.data.updateRatesText = 'Update rates';
				$scope.data.updateRatesSuccess = response.data.success;
				$scope.data.updateRatesError = response.data.error;
				$scope.data.updateRatesDate = response.data.updated_at;
			  }, function errorCallback (response) {			 	
			  	$scope.data.disableRateButton = false;
			  	$scope.data.updateRatesText = 'Retry update';
			  	$scope.data.updateRatesError = response.data.error;
			  });
		}	
	}
	
	loadList();
	
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
				alert('currency load list failed');
			  });
	}

	function loadSelectList() {		
		$scope.data.options = $scope.data.currencies;
		$scope.data.options.push($scope.data.selectedOption);
		$scope.data.options = _.sortBy($scope.data.options, 'id');		
	}
	
});

