angular
.module('app')
.factory('inscriptosService', [
  '$log',
  '$http',
  '$auth',
  inscriptosService,
]);

function inscriptosService($log, $http, $auth) {

  function getInscriptos() {
    return $http({ method: "GET", url: '/api/inscripto', cache: false });
  }

  function guardarInscripto(inscripto) {
    return $http({ method: "POST", url: '/api/nuevo-inscripto', data: inscripto});
  }

  function actualizarInscripto(inscripto) {
    return $http({ method: "POST", url: '/api/actualizar-inscripcion/' + inscripto.id, data: inscripto});
  }

  function borrarInscripto(inscripto) {
    return $http({ method: "POST", url: '/api/eliminar-inscripto/' + inscripto});
  }


  const service = {
    getInscriptos,
    guardarInscripto,
    actualizarInscripto,
    borrarInscripto
  };

  return service;
}
