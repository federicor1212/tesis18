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
		var i = 0;
		var docentesActivos = [];
		data.data.find(function(data) {
                var ano = data.dictados.ano.search('2018');
                var cuat = data.dictados.cuat.toString().search('1');
                if (ano != -1 && cuat != -1) {
                  docentesActivos[i] = data;
                  i +=1;
                }
         })
    	$scope.tableData = docentesActivos;
    	$scope.tableData.hiddenData = data.data;
  	});
  	$scope.headers = ['ID', 'Carrera', 'Materia', 'Cuat', 'A\u00F1o', 'Docente', 'Cargo'];
  	$scope.type = 'docenteasignado';
});
})();
