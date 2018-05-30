(function () {
'use strict';
angular
.module('app')
.controller('usuariosController', function ($scope, $location, $auth, $state, usuariosService) {
	var personal = {};
	$scope.personal = personal;
	$scope.date = new Date();
	$scope.logOut = function() {
		// Borra el token del storage
		localStorage.clear();
		$state.go('login', {});
	}
	usuariosService.getUsuarios().then(function (data) {
		var i = 0;
		var usuariosActivos = [];
		data.data.find(function(data) {
                var estado = data.estado.search('Activo');
                if (estado != -1) {
                  usuariosActivos[i] = data;
                  i +=1;
                }
         })
    	$scope.tableData = usuariosActivos;
    	$scope.tableData.hiddenData = data.data;
  	});
  	
  	$scope.headers = ['ID', 'Nombre', 'Apellido', 'Email', 'Rol', 'Estado'];
  	$scope.type = 'usuarios';
});
})();
