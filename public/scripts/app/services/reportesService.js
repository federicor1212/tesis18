angular
  .module('app')
  .factory('reportesService', ['$log', '$http', '$auth', reportesService]);

function reportesService($log, $http, $auth) {
  function getReportes(idCarrera, idMateria, ano, cuat) {
    return $http({
      method: 'POST',
      url: '/api/cantAsistencias',
      data: { idCarrera, idMateria, ano, cuat },
      cache: false
    });
  }

  const service = {
    getReportes
  };

  return service;
}
