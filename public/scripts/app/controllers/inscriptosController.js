(function () {
'use strict';
angular
.module('app')
.controller('inscriptosController', function ($scope, $location, $auth, $state, inscriptosService) {
	var personal = {};
	$scope.personal = personal;
	$scope.date = new Date();
	$scope.logOut = function() {
		// Borra el token del storage
		localStorage.clear();
		$state.go('login', {});
	}
	inscriptosService.getInscriptos().then(function (data) {
    	$scope.tableData = data.data;
  	});
  	$scope.headers = ['ID', 'Nombre', 'Materia', 'Faltas acumuladas', 'Libre'];
  	$scope.type = 'inscriptos';
});
})();
