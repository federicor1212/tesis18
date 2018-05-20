angular
.module('app')
.factory('alumnoService', [
  '$log',
  '$http',
  '$auth',
  alumnoService,
]);

function alumnoService($log, $http, $auth) {

  function getAlumnos() {
    return $http({ method: "GET", url: '/api/alumno', cache: false });
  }

  function guardarAlumno(alumno) {
    return $http({ method: "POST", url: '/api/crear-alumno', data: alumno});
  }

  function actualizarAlumno(alumno) {
    return $http({ method: "POST", url: '/api/actualizar-alumno/' + alumno.id, data: alumno});
  }

  function borrarAlumno(alumno) {
    return $http({ method: "POST", url: '/api/eliminar-alumno/' + alumno});
  }


  const service = {
    getAlumnos,
    guardarAlumno,
    actualizarAlumno,
    borrarAlumno
  };

  return service;
}
