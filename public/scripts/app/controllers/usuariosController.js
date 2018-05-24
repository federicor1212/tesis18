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
    	$scope.tableData = data.data;
  	});
  	
  	$scope.headers = ['ID', 'Nombre', 'Apellido', 'Email', 'Rol', 'Estado'];
  	$scope.type = 'usuarios';
});
})();
