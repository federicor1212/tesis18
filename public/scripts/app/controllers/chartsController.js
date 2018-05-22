(function () {
  'use strict';
  angular
  .module('app')
  .controller('chartsController', function ($scope, $location, $auth, $state, reportesService) {
    var personal = {};
    reportesService.getReportes().then(function(data) {
      $scope.data = data.data;
    })
    $scope.personal = personal;
    
  });
  })();