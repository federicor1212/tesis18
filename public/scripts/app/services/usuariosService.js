angular
  .module('app')
  .factory('usuariosService', ['$log', '$http', '$auth', usuariosService]);

function usuariosService($log, $http, $auth) {
  function getUsuarios() {
    return $http({ method: 'GET', url: '/api/usuario', cache: false });
  }

  function deleteUsuario(id) {
    return $http({ method: 'POST', url: '/api/eliminar-usuario', data: id });
  }

  function guardarUsuario(usuario) {
    return $http({ method: 'POST', url: '/api/crear-usuario', data: usuario });
  }

  function actualizarUsuario(usuario) {
    return $http({
      method: 'POST',
      url: '/api/actualizar-usuario/' + usuario.id,
      data: usuario
    });
  }

  function borrarUsuario(usuario) {
    return $http({ method: 'POST', url: '/api/eliminar-usuario/' + usuario });
  }

  function getUserIdentity() {
    return $http({
      method: 'POST',
      url: '/api/identity',
      data: { token: localStorage.getItem('token') }
    });
  }

  const service = {
    getUsuarios,
    guardarUsuario,
    getUserIdentity,
    actualizarUsuario,
    borrarUsuario
  };

  return service;
}
