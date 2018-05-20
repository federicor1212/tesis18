(function () {
'use strict';
angular
.module('app')
.controller('dictadosController', function ($scope, $location, $auth, $state, dictadosService) {
	var personal = {};
	$scope.personal = personal;
	$scope.logOut = function() {
		// Borra el token del storage
		localStorage.clear();
		$state.go('login', {});
	}
	dictadosService.getDictado().then(function (data) {
    	$scope.tableData = data.data;
  	});
  	$scope.headers = ['ID', 'Materia', 'Cuatrimeste', 'Ano', 'Dia de Cursada', 'Alternativa','Cant. Inscriptos','Cant. Clases','Cant. Faltas max.'];
  	$scope.type = 'dictados';
});
})();
