(function() {
  'use strict';
  angular
    .module('app')
    .controller('loginController', function(
      $scope,
      $location,
      authService,
      $state
    ) {
      var login = {};
      login.goTo = function() {
        $location.url('register');
      };
      $scope.error = 'true';
      login.logIn = function() {
        authService
          .logIn(login.userInfo)
          .then(function(data) {
            // If login is successful, redirect to the users state
            localStorage.setItem('token', data.data.token);
            $state.go('alumnos', {});
          })
          .catch(function(fallback) {
            $scope.error = 'false';
          });
      };
      $scope.login = login;
    });
})();
