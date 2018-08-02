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
		var i = 0;
		var dictadosActivos = [];
		data.data.find(function(data) {
                var ano = data.ano.search('2018');
                var cuat = data.cuat.toString().search('1');
                if (ano != -1 && cuat != -1) {
                  dictadosActivos[i] = data;
                  i +=1;
                }
         })
    	$scope.tableData = dictadosActivos;
		$scope.tableData.hiddenData = data.data;
  	});
  	$scope.headers = ['ID', 'Carrera', 'Materia', 'Cuat.', 'A\u00F1o', 'Inicio','Fin','Inscriptos','Clases','Faltas m\u00E1x.'];
  	$scope.type = 'dictados';
});
})();
