angular
.module('app')
.factory('dictadosService', [
  '$log',
  '$http',
  '$auth',
  dictadoService,
]);

function dictadoService($log, $http, $auth) {

  function getDictado() {
    return $http({ method: "GET", url: '/api/dictado', cache: false });
  }

  function getDictadoModal() {
    return $http({ method: "GET", url: '/api/dictado-modal', cache: false });
  }

  function getDaysOfCourse(idDictado){
    return $http({ method: "GET", url: '/api/dictado-clase/' + idDictado, cache: false});
  }

  function getDictadoSinProf() {
    return $http({ method: "GET", url: '/api/dictado-sin-prof', cache: false});
  }

  function getDictadoSinProfModal() {
    return $http({ method: "GET", url: '/api/dictado-sin-prof-modal', cache: false});
  }

  function guardarDictado(dictado) {
    return $http({ method: "POST", url: '/api/nuevo-dictado', data: dictado});
  }

  function actualizarDictado(dictado) {
    return $http({ method: "POST", url: '/api/actualizar-dictado/' + dictado.id, data: dictado});
  }

  function borrarDictado(dictado) {
    return $http({ method: "POST", url: '/api/eliminar-dictado', data: dictado});
  }

  function verificarSiDictadoExiste(dictado) {
    return $http({ method: "POST", url: '/api/consultar-dictado', data: dictado});
  }

  function getAlternativas(){
    return $http({ method: "GET", url: '/api/alternativa', cache: false});
  }

  function getAlternativasSeleccionada(id_dictado){
    return $http({ method: "GET", url: '/api/dictado-clase-sel/' + id_dictado});
  }

  function saveAlternativasSeleccionadas(alternativa){
    return $http({ method: "POST", url: '/api/actualizar-dictado-clase' , data: alternativa});
  }

  const service = {
    getDictado,
    guardarDictado,
    actualizarDictado,
    borrarDictado,
    getDictadoSinProf,
    verificarSiDictadoExiste,
    getDictadoSinProfModal,
    getDictadoModal,
    getDaysOfCourse,
    getAlternativas,
    getAlternativasSeleccionada,
    saveAlternativasSeleccionadas
  };

  return service;
}
