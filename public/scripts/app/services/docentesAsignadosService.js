angular
.module('app')
.factory('docentesAsignadosService', [
  '$log',
  '$http',
  '$auth',
  docentesAsignadosService,
]);

function docentesAsignadosService($log, $http, $auth) {

  function getDocenteAsignado() {
    return $http({ method: "GET", url: '/api/docente-asignado', cache: false });
  }

  function guardarDocenteAsignado(docenteAsignado) {
    return $http({ method: "POST", url: '/api/asignar-docente', data: docenteAsignado});
  }

  function actualizarDocenteAsignado(docenteAsignado) {
    return $http({ method: "POST", url: '/api/actualizar-asignacion/' + docenteAsignado.id, data: docenteAsignado});
  }

  function borrarDocenteAsignado(docente) {
    return $http({ method: "POST", url: '/api/eliminar-asignacion/' + docente});
  }

  const service = {
    getDocenteAsignado,
    guardarDocenteAsignado,
    actualizarDocenteAsignado,
    borrarDocenteAsignado
  };

  return service;
}
