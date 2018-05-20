(function() {
  'use strict';
  angular.module('app').directive('navBar', function() {
    return {
      templateUrl: 'scripts/app/views/navbar.html',
      controller: function($scope, $location, usuariosService) {
        var navbar = this;
        if ($(window).width() <= 768) {
        navbar.showSidebar = true;
        } else {
          navbar.showSidebar = false;
        }
        $scope.showHideSidebar = function() {
          if (navbar.showSidebar) {
            $('#sidebar').css({'transform': 'none'});
            navbar.showSidebar = false;
          } else {
            navbar.showSidebar = true;
            $('#sidebar').css({'transform': 'translate(-230px, 0)'});
          }
        };
        usuariosService.getUserIdentity().then(function(data) {
          $scope.username = data.data.nombre + ' ' + data.data.apellido;
        });
        $scope.navbar = navbar;
      }
    };
  });
})();
