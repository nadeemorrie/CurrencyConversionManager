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
		amount : 0,
		fullname : '',
		email : '',
		currencies : null,
		options : [],
		buttonDisabled : false,
		selectedOption : {id:0, name:'Select a currency'},
		selectedCurrencyName : null,
		validateFields : function () {
			this.buttonDisabled=false;
			this.isSelected();
			this.hasFullname();
			this.hasEmail();

			return this.buttonDisabled;
		},
		isSelected : function () {
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


	
	// function getCurrencyName (selectedId) {
		
	// 	var needle = Object.create({id: 2});
		
	// 	var result = _.findWhere($scope.currencies, needle);

	// 	console.log('needle?',needle, 'result', result);

	// 	if (_.isObject(result))
	// 		return result.code;
		
	// 	// return error for now.
	// 	return "error";
	// }
});

