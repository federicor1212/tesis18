(function() {
  'use strict';
  angular
    .module('app')
    .controller('perfilController', function($scope, usuariosService) {
      var perfil = {};
      usuariosService.getUserIdentity().then(function(data) {
        $scope.perfil = data.data;
      });
      $scope.guardar = function() {
        if ($scope.perfilForm.$invalid) {
          swal('no ando !', '', 'error');
        } else {
          if ($scope.perfil.id) {
            usuariosService.actualizarUsuario($scope.perfil).then(
              function() {
                swal('ando !', '', 'success');
              },
              function(error) {
                swal('no ando !', error, 'error');
              }
            );
          } else {
            usuariosService.guardarUsuario($scope.perfil).then(
              function() {
                swal('ando 2 !', '', 'success');
              },
              function(error) {
                swal('no ando !', error, 'error');
              }
            );
          }
        }
      };
      $scope.perfil = perfil;
    });
})();
