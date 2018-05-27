(function() {
  'use strict';
  angular
    .module('app')
    .controller('chartsController', function(
      $scope,
      $location,
      $auth,
      $state,
      reportesService,
      carrerasService,
      materiasService
    ) {
      var personal = {};
      $scope.logOut = function() {
      // Borra el token del storage
      localStorage.clear();
      $state.go('login', {});
    }
      $scope.materia = null;
      carrerasService.getCarrera().then(function(carreras) {
        $scope.carreras = carreras.data;
      });
      $scope.$watch('carrera', function(newValue, oldValue) {
        $scope.mostrarMateria = false;
        if (newValue) {
          $scope.mostrarMateria = true;
          materiasService
            .buscarMateriasDeCarrera(Number(newValue))
            .then(function(materias) {
              $scope.materias = materias.data;
            });
        } else {
          $scope.mostrarMateria = false;
        }
      });
      $scope.buscar = function() {

        reportesService
          .getReportes(
            $scope.carrera,
            $scope.materia,
            $scope.anio,
            $scope.cuatrimestre
          )
          .then(function(reportes) {
            $scope.inscriptos = reportes.data.asist.inscriptos;
            $scope.cantinsc = reportes.data.asist.inscriptos.cantinsc;
            $scope.cantlibre = reportes.data.asist.inscriptos.cantlibre;
            $scope.asistentes = reportes.data.inscr.asistentes;
            $scope.libres = reportes.data.libre.libres;
            $scope.reportes = reportes.data;
          });
      }
      $scope.personal = personal;
      $scope.date = new Date();
    });
})();
