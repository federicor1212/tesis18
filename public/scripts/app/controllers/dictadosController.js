(function () {
'use strict';
angular
.module('app')
.controller('dictadosController', function ($scope, $location, $auth, $state, dictadosService) {
	var personal = {};
	$scope.personal = personal;
	$scope.date = new Date();
	$scope.logOut = function() {
		// Borra el token del storage
		localStorage.clear();
		$state.go('login', {});
	}
	dictadosService.getDictado().then(function (data) {
    	$scope.tableData = data.data;
  	});
  	$scope.headers = ['ID', 'Materia', 'Cuat.', 'A\u00F1o', 'D\u00EDa de Cursada', 'Alt.','Inicio','Fin','Inscriptos','Clases','Faltas m\u00E1x.'];
  	$scope.type = 'dictados';
});
})();
