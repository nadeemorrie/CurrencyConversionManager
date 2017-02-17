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

app.controller('orderController', function($scope, $http, $location, $timeout) {	
	$scope.data = {
		amount : 100,
		fullname : 'nadeem orrie',
		email : 'nadeem.orrie@gmail.com',
		isForeign : '',
		currencies : null,
		exchangeRate : 0,
		options : [],
		buttonDisabled : false,
		selectedOption : {id:0, name:'Select a currency'},
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
			if (this.selectedOption.name=='Select a currency') {
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
		calculateCurrency : function () {
			$http({
			  method: 'POST',			  
			  url: baseurl+'/api/currency/convert',
			  data : {
			  	_token: csrfToken,			  	
			  	amount : this.amount,
			  	isForeign : this.isForeign
			  }
			}).then(function successCallback(response) {
				// alert(response.data);
				$scope.data.exchangeRate = response.data.exchangeRate;				
			  }, function errorCallback(response) {
				alert('error');
			  });
		}

	}
	
	loadList();
	
	// console.log(GetCurrencyName(2));

	function loadList () {			
		$http.get(baseurl+'/api/currency')
			.then(function successCallback(response) {
			    $scope.data.currencies = response.data;		    
			    
			    loadSelectList();
			});
	}

	function loadSelectList() {		
		$scope.data.options = $scope.data.currencies;
		$scope.data.options.push($scope.data.selectedOption);
		$scope.data.options = _.sortBy($scope.data.options, 'id');
		console.log('options', $scope.data.options);
	}


	
});

