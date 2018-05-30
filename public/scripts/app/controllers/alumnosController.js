(function () {
'use strict';
angular
.module('app')
.controller('alumnosController', function ($scope, $location, $auth, $state, alumnoService) {
	var personal = {};
	$scope.personal = personal;
	$scope.date = new Date();
	$scope.logOut = function() {
		// Borra el token del storage
		localStorage.clear();
		$state.go('login', {});
	}
	alumnoService.getAlumnos().then(function (data) {
    	$scope.tableData = [];
    	$scope.tableData.hiddenData = data.data;
  	});

  	$scope.headers = ['ID', 'Nombre', 'Apellido', 'Tel\u00E9fono', 'Email', 'Matr\u00EDcula'];
  	$scope.type = 'alumno';
});
})();
