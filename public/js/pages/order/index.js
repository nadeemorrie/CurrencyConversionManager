
var app = angular.module('myApp', []);

app.controller('orderController', function($scope, $http, $location, $timeout) {	
	
	LoadList();

	function LoadList () {			
		$http.get(baseurl+'/api/currency').then(function successCallback(response) {
		    $scope.currencies = response.data;
		    console.log($scope.currencies);
		});
	}
});

