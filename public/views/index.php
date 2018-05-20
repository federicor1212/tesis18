<!DOCTYPE html>
<html ng-app="app">
  <head>
    <meta charset="utf-8">
    <title>Asistencia 2017</title>

    <!-- main library files -->
    <script src="/../scripts/node_modules/angular/angular.min.js"></script>
    <script src="/../scripts/js/vendor/angular-route.js"></script>
    <script src="/../scripts/js/vendor/angular-messages.js"></script>
    <script src="/../scripts/js/vendor/jquery.js"></script>
    <script src="/../scripts/js/vendor/boostrap.min.js"></script>
    <script src="/../scripts/js/vendor/ui-bootstrap-tpls-1.3.2.min.js"></script>
    <script src="/../scripts/node_modules/angular-ui-bootstrap/dist/ui-bootstrap.js"></script>
    <script src="/../scripts/node_modules/ui-select/dist/select.min.js"></script>
    <script src="/../scripts/js/vendor/jQuery-viewport-checker.min.js"></script>
    <script src="/../scripts/node_modules/satellizer/dist/satellizer.min.js"></script>
    <script src="/../scripts/node_modules/angular-ui-router/release/angular-ui-router.min.js"></script>
    <script src="/../scripts/node_modules/angular-local-storage/dist/angular-local-storage.min.js"></script>
    <script src="/../scripts/node_modules/angular/angular.min.js"></script>
    <script src="/../scripts/node_modules/angular-aria/angular-aria.min.js"></script>    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- main style files -->
    <link rel="stylesheet" href="/../scripts/style/css/bootstrap-theme.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/../scripts/style/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/../scripts/style/css/main.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/../scripts/style/css/animate.css" media="screen" title="no title" charset="utf-8">
    <!-- main Angular app file -->
    <script src="scripts/app.js"></script>

    <!-- controllers -->
      <script src="scripts/app/controllers/carrerasController.js"></script>
      <script src="scripts/app/controllers/alumnosController.js"></script>
      <script src="scripts/app/controllers/loginController.js"></script>
      <script src="scripts/app/controllers/docentesController.js"></script>
      <script src="scripts/app/controllers/docentesAsignadosController.js"></script>
      <script src="scripts/app/controllers/materiasController.js"></script>
      <script src="scripts/app/controllers/dictadosController.js"></script>
      <script src="scripts/app/controllers/usuariosController.js"></script>
      <script src="scripts/app/controllers/inscriptosController.js"></script>
      <script src="scripts/app/controllers/perfil.js"></script>
    <!-- directives -->
      <script src="scripts/app/directives/navbar.js"></script>
      <script src="scripts/app/directives/sidebar.js"></script>
      <script src="scripts/app/directives/generalTable.js"></script>
    <!-- services -->
      <script src="scripts/app/services/alumnoService.js"></script>
      <script src="scripts/app/services/carrerasService.js"></script>
      <script src="scripts/app/services/dictadosService.js"></script>
      <script src="scripts/app/services/docentesService.js"></script>
      <script src="scripts/app/services/docentesAsignadosService.js"></script>
      <script src="scripts/app/services/inscriptosService.js"></script>
      <script src="scripts/app/services/materiasService.js"></script>
      <script src="scripts/app/services/usuariosService.js"></script>
      <script src="scripts/app/services/authService.js"></script>
      <script src="scripts/app/services/userService.js"></script>
      <script src="scripts/app/services/interceptor.es6.js"></script>
      <script src="scripts/app/services/api.services.es6.js"></script>
    <!-- factories -->
    
    <!-- Angular route file -->
  </head>
<body class="hold-transition skin-blue sidebar-mini">
    <div ui-view style="height: 100%;"></div>
	</body>
</html>
