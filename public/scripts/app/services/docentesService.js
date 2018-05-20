angular
.module('app')
.factory('docentesService', [
  '$log',
  '$http',
  '$auth',
  docenteService,
]);

function docenteService($log, $http, $auth) {

  function getDocente() {
    return $http({ method: "GET", url: '/api/docente', cache: false });
  }

  function guardarDocente(docente) {
    return $http({ method: "POST", url: '/api/nuevo-docente', data: docente});
  }

  function actualizarDocente(docente) {
    return $http({ method: "POST", url: '/api/actualizar-docente/' + docente.id, data: docente});
  }

  function borrarDocente(docente) {
    return $http({ method: "POST", url: '/api/eliminar-docente/' + docente});
  }

  const service = {
    getDocente,
    guardarDocente,
    actualizarDocente,
    borrarDocente
  };

  return service;
}
