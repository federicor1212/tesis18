(function() {
    'use strict';
    angular
        .module('app', ['ui.router', 'satellizer','ui.bootstrap', 'googlechart'])
        .config(function($stateProvider, $urlRouterProvider, $authProvider, $httpProvider) {

            // Satellizer configuration that specifies which API
            // route the JWT should be retrieved from
            $httpProvider.interceptors.push('authInterceptor');
            $authProvider.loginUrl = '/api/authenticate';

            // Redirect to the auth state if any other states
            // are requested other than users
            $urlRouterProvider.otherwise('/login');
            
            $stateProvider
                .state('login', {
                    url: '/login',
                    templateUrl: 'scripts/app/views/login.html',
                    controller: 'loginController',
                    authenticate: false
                })
                .state('alumnos', {
                    url: '/alumnos',
                    templateUrl: 'scripts/app/views/app-main.html',
                    controller: 'alumnosController',
                    authenticate: true
                })
                .state('carreras', {
                    url: '/carreras',
                    templateUrl: 'scripts/app/views/app-main.html',
                    controller: 'carrerasController',
                    authenticate: true
                })
                .state('docenteasignado', {
                    url: '/docentes-asignados',
                    templateUrl: 'scripts/app/views/app-main.html',
                    controller: 'docentesAsignadosController',
                    authenticate: true
                })
                .state('dictados', {
                    url: '/dictados',
                    templateUrl: 'scripts/app/views/app-main.html',
                    controller: 'dictadosController',
                    authenticate: true
                })
                .state('docentes', {
                    url: '/docentes',
                    templateUrl: 'scripts/app/views/app-main.html',
                    controller: 'docentesController',
                    authenticate: true
                })
                .state('inscriptos', {
                    url: '/inscriptos',
                    templateUrl: 'scripts/app/views/app-main.html',
                    controller: 'inscriptosController',
                    authenticate: true
                })
                .state('materias', {
                    url: '/materias',
                    templateUrl: 'scripts/app/views/app-main.html',
                    controller: 'materiasController',
                    authenticate: true
                })
                .state('usuarios', {
                    url: '/usuarios',
                    templateUrl: 'scripts/app/views/app-main.html',
                    controller: 'usuariosController',
                    authenticate: true
                })
                .state('perfil', {
                    url: '/perfil',
                    templateUrl: 'scripts/app/views/perfil.html',
                    controller: 'perfilController',
                    authenticate: true
                })
                .state('reportes', {
                    url: '/reportes',
                    templateUrl: 'scripts/app/views/charts.html',
                    controller: 'chartsController',
                    authenticate: true
                })

        })
        .run(['$rootScope','$state', run]);
        function run($rootScope, $state) {
            $rootScope.$on("$stateChangeStart", function(event, toState, toParams, fromState, fromParams){
                if (toState.authenticate && !localStorage.getItem('token')) {
                    $state.transitionTo("login");
                    event.preventDefault();
                } else if (toState.name === "login" && !!localStorage.getItem('token')){
                    $state.transitionTo("alumnos");
                    event.preventDefault();
                }
            });
        }
})();