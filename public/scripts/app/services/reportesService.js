angular
.module('app')
.factory('reportesService', [
  '$log',
  '$http',
  '$auth',
  reportesService,
]);

function reportesService($log, $http, $auth) {

  function getReportes() {
    return $http({ method: "POST", url: '/api/cantAsistencias', cache: false });
  }

  const service = {
    getReportes,
  };

  return service;
}
