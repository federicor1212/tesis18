(function () {
'use strict';
angular
.module('app')
.controller('carrerasController', function ($scope, $location, $auth, $state, carrerasService) {
	var personal = {};
	$scope.personal = personal;
	$scope.date = new Date();
	$scope.logOut = function() {
		// Borra el token del storage
		localStorage.clear();
		$state.go('login', {});
	}
	carrerasService.getCarrera().then(function (data) {
    	$scope.tableData = data.data;
  	});
  	$scope.headers = ['ID', 'Carrera', 'Plan'];
  	$scope.type = 'carreras';
});
})();
