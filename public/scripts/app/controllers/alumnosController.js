(function () {
'use strict';
angular
.module('app')
.controller('alumnosController', function ($scope, $location, $auth, $state, alumnoService) {
	var personal = {};
	$scope.personal = personal;
	$scope.logOut = function() {
		// Borra el token del storage
		localStorage.clear();
		$state.go('login', {});
	}
	alumnoService.getAlumnos().then(function (data) {
    	$scope.tableData = data.data;
  	});

  	$scope.headers = ['ID', 'Nombre', 'Apellido', 'Telefono', 'Email', 'Matricula'];
  	$scope.type = 'alumno';
});
})();
