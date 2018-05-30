(function () {
'use strict';
angular
.module('app')
.controller('docentesController', function ($scope, $location, $auth, $state, docentesService) {
	var personal = {};
	$scope.personal = personal;
	$scope.date = new Date();
	$scope.logOut = function() {
		// Borra el token del storage
		localStorage.clear();
		$state.go('login', {});
	}
	docentesService.getDocente().then(function (data) {
		var i = 0;
		var docentesActivos = [];
		data.data.find(function(data) {
                var estado = data.estado.search('Activo');
                if (estado != -1) {
                  docentesActivos[i] = data;
                  i +=1;
                }
         })
    	$scope.tableData = docentesActivos;
		$scope.tableData.hiddenData = data.data;
  	});
  	$scope.headers = ['ID', 'Nombre', 'Apellido', 'Tel\u00E9fono', 'Estado','Usuario ID'];
  	$scope.type = 'docentes';
});
})();
