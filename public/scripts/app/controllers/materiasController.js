(function() {
  'use strict';
  angular
    .module('app')
    .controller('materiasController', function(
      $scope,
      $location,
      $auth,
      $state,
      materiasService
    ) {
      var personal = {};
      $scope.personal = personal;
      $scope.date = new Date();
      $scope.logOut = function() {
        // Borra el token del storage
        localStorage.clear();
        $state.go('login', {});
      };
      materiasService.getMaterias().then(function(data) {
        $scope.tableData = [];
        $scope.tableData.hiddenData = data.data;
      });
      $scope.headers = ['ID', 'Nombre de la Materia', 'Carrera', 'Plan'];
      $scope.type = 'materias';
    });
})();
