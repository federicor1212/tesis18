(function() {
  'use strict';
  angular.module('app').directive('sideBar', [
    '$state',
    function($state) {
      return {
        templateUrl: 'scripts/app/views/sidebar.html',
        controller: function($rootScope, $scope) {
          $scope.activeMenu = $state.current.name;;
          var sidebar = this;
          $scope.sidebar = sidebar;
        }
      };
    }
  ]);
})();
