angular
.module('app')
.factory('carrerasService', [
  '$log',
  '$http',
  '$auth',
  carrerasService,
]);

function carrerasService($log, $http, $auth) {

  function getCarrera() {
    return $http({ method: "GET", url: '/api/carrera', cache: false });
  }

  function guardarCarrera(carrera) {
    return $http({ method: "POST", url: '/api/crear-carrera', data: carrera});
  }

  function actualizarCarrera(carrera) {
    return $http({ method: "POST", url: '/api/actualizar-carrera/' + carrera.id, data: carrera});
  }
  
  function borrarCarrera(carrera) {
    return $http({ method: "POST", url: '/api/eliminar-carrera/' + carrera});
  }

  const service = {
    getCarrera,
    guardarCarrera,
    actualizarCarrera,
    borrarCarrera
  };

  return service;
}
