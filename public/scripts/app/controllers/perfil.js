(function() {
  'use strict';
  angular
    .module('app')
    .controller('perfilController', function($scope, $state, usuariosService) {
      var perfil = {};
      usuariosService.getUserIdentity().then(function(data) {
        $scope.perfil = data.data;
      });
      $scope.logOut = function() {
        // Borra el token del storage
        localStorage.clear();
        $state.go('login', {});
      }
      $scope.guardar = function() {
        if ($scope.perfilForm.$invalid) {
          swal('Por favor verifique los datos ingresados', '', 'error');
        } else {
          if ($scope.perfil.id) {
            usuariosService.actualizarUsuario($scope.perfil).then(
              function() {
                swal('Perfil actualizado exitosamente !', '', 'success');
              },
              function(error) {
                swal('Hubo un error actualizando el perfil!', error, 'error');
              }
            );
          } else {
            usuariosService.guardarUsuario($scope.perfil).then(
              function() {
                swal('Perfil guardado exitosamente', '', 'success');
              },
              function(error) {
                swal('Hubo un error actualizando el perfil', error, 'error');
              }
            );
          }
        }
      };
      $scope.perfil = perfil;
      $scope.date = new Date();
    });
})();
