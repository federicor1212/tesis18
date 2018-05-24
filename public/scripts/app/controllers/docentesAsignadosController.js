(function () {
'use strict';
angular
.module('app')
.controller('docentesAsignadosController', function ($scope, $location, $auth, $state, docentesAsignadosService) {
	var personal = {};
	$scope.personal = personal;
	$scope.date = new Date();
	$scope.logOut = function() {
		// Borra el token del storage
		localStorage.clear();
		$state.go('login', {});
	}
	docentesAsignadosService.getDocenteAsignado().then(function (data) {
    	$scope.tableData = data.data;
  	});
  	$scope.headers = ['ID', 'Materia', 'Docente', 'Cargo'];
  	$scope.type = 'docenteasignado';
});
})();
