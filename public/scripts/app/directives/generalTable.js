(function () {
'use strict';
angular
.module('app')
.directive('generalTable', function () {
  return {
  	scope: {
  		data: '=',
  		headers: '=',
  		type: '='
  	},
    templateUrl: 'scripts/app/views/generalTable.html',
    controller: function (alumnoService, carrerasService, dictadosService, docentesAsignadosService, docentesService, inscriptosService, materiasService, usuariosService, $scope, $location, $auth, $state) {
		  var table = this;
		  
		  table.saveUsuario = function(usuario) {
			if(usuario.nuevo) {
				usuariosService.guardarUsuario(usuario).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "El usuario fue creado exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error creando el usuario",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            ); 
			} else {
				usuariosService.actualizarUsuario(usuario).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "El usuario fue actualizado exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error actualizando el usuario",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            ); 
			}
		  }

		  table.saveAlumno = function(alumno) {
			if(alumno.nuevo) {
				alumnoService.guardarAlumno(alumno).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "El alumno fue creado exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error creando el alumno",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            ); 
			} else {
				alumnoService.actualizarAlumno(alumno).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "El alumno fue actualizado exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error actualizando el alumno",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            ); 
			}
		  }
		  
		  table.saveCarrera = function(carrera) {
			if (carrera.nuevo) {
				carrerasService.guardarCarrera(carrera).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "La carrera fue creado exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error creando la carrera",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            ); 
			} else {
				carrerasService.actualizarCarrera(carrera).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "La carrera fue actualizando exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error actualizando la carrera",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            ); 
			}
		  }

		  table.saveDocasignado = function(docAsignado) {
			if(docAsignado.nuevo) {
				docentesAsignadosService.guardarDocenteAsignado(docAsignado).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "El docente asignado fue creado exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error creando el docente asignado",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            ); 
			} else {
				docentesAsignadosService.actualizarDocenteAsignado(docAsignado).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "El docente asignado fue actualizado exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error actualizando el docente asignado",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            ); 
			}
		  }

		  table.saveDictado = function(dictado) {
			if(dictado.nuevo) {
				dictadosService.guardarDictado(dictado).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "El dictado fue creado exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error creando el dictado",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            ); 
			} else {
				dictadosService.actualizarDictado(dictado).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "El dictado fue actualizado exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error actualizando el dictado",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            ); 
			}  
		  }

		  table.saveDocente = function(docente) {
			if(docente.nuevo) {
				docentesService.guardarDocente(docente).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "El docente fue creado exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error creando el docente",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            ); 
			} else {
			 	docentesService.actualizarDocente(docente).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "El docente fue actualizado exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error actualizado el docente",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            );  
			}


		  }

		  table.saveInscripto = function(inscripto) {
			if(inscripto.nuevo){
				inscriptosService.guardarInscripto(inscripto).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "El alumno fue inscripto exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error guardando la inscripcion",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            ); 
			} else {
				inscriptosService.actualizarInscripto(inscripto).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "Inscripcion actualizada exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
					}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error actualizando la inscripcion",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            );
			}  
		  }

		  table.saveMateria = function(materia) {
			if (materia.nuevo) {
				materiasService.guardarMateria(materia).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "La materia fue creada exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
					}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error creando la materia",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            );
			} else {
				materiasService.actualizarMateria(materia).then(
	              function() {
		              swal({
						  title: "Exito!",
						  text: "La materia fue actualizada exitosamente",
						  icon: "success",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
					}, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error actualizando la materia",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              }
	            );
			}
		  }

		  $scope.initScope = function(type) {
		  	switch (type) {
		  		case 'alumno':
				  	$scope.modal = {
								nombre: null,
								apellido: null,
								telefono: null,
								email: null,
								matricula: null
					}
		  			break;
		  		case 'carreras':
		  			$scope.modal = {
		  				desc_carr: null,
		  				plan: null
		  			}
		  			break;

		  		case 'usuarios':
		  			$scope.modal = {
		  				nombre: null,
		  				apellido: null,
		  				email: null,
		  				permiso: null,
		  				estado: null,
		  				usuarioid: null,
		  			}
		  			$scope.permisos = ['Administrador','Docente'];
		  			$scope.estados = ['Activo','Inactivo'];
		  			break;

		  		case 'docenteasignado':
		  			$scope.modal = {
		  				desc_cargo: null,
		  				email: null,
		  				matricula: null
		  			}

		  			$scope.modal.materia = {
		  				desc_mat: null
		  			};

		  			$scope.modal.docente = {
		  				apellido: null,
		  				nombre: null
		  			}
		  			docentesService.getDocente().then((response) => {
		  				$scope.docentes = response.data;
					});

					dictadosService.getDictadoSinProf().then((response) => {
						$scope.materias = response.data;
					});
			  		$scope.cargos = [{desc_cargo: 'Titular', id:1}, {desc_cargo: 'Suplente', id: 2}]
		  			break;

		  		case 'dictados':
		  			$scope.modal = {
		  				cuat: null,
		  				ano: null,
		  				dia_cursada: null,
		  				alt_hor: null,
		  				fecha_inicio: null,
		  				fecha_fin: null,
		  				cant_insc_act: null,
		  				cant_clases: null,
		  				cant_faltas_max: null
		  			}

		  			$scope.modal.materia = null;

		  			materiasService.getMaterias().then((response) => {
		  				$scope.materias = response.data;
		  			});
		  			break;

		  		case 'docentes':
		  			$scope.modal = {
		  				nombre: null,
		  				apellido: null,
		  				telefono: null
		  			};
		  			break;

		  		case 'inscriptos':
		  			$scope.modal = {
		  				cant_faltas_act: null
		  			}

		  			$scope.modal.alumno = {
		  				nombre: null,
		  				apellido: null
		  			};
		  			
		  			$scope.modal.materia = {
		  				desc_mat: null
		  			}
		  			
					alumnoService.getAlumnos().then((response) => {
		  				$scope.alumnos = response.data;
					})

					dictadosService.getDictado().then((response) => {
		  				$scope.materias = response.data;
		  			});

		  			break;

		  		case 'materias':
		  			$scope.modal = {
		  				desc_mat: null
		  			};

		  			$scope.modal.carrera = {
		  				desc_carr: null,
		  				plan: null
		  			}

		  			carrerasService.getCarrera().then((response) => {
		  				$scope.carreras = response.data;
		  			})

		  			break;

		  		default:
		  			$scope.modal = {}
		  			break;
		  	}
		  }

		  table.openModal = function(type) {
			$scope.initScope(type);
			$scope.modal.nuevo = true;
			switch(type) {
			    case 'alumno':
		  			$('#modal-alumno').modal('show');
			        break;

			    case 'carreras':
		  			$('#modal-carrera').modal('show');
			        break;
			    
			    case 'usuarios':
		  			$('#modal-usuario').modal('show');
			        break;
			    
			    case 'docenteasignado':
		  			$('#modal-docasignado').modal('show');
			        break;
			    
			    case 'dictados':
		  			$('#modal-dictado').modal('show');
			        break;
			    
			    case 'docentes':
		  			$('#modal-docente').modal('show');
			        break;
			    
			    case 'inscriptos':
		  			$('#modal-inscripto').modal('show');
			        break;
			    
			    case 'materias':
		  			$('#modal-materia').modal('show');
			        break;
			    
			    default:
			        break;
			}
		  }

		  table.openEditModal = function(data,type) {
			if (data) {
				$scope.initScope(type);
				switch (type) {
					case 'alumno':
						$scope.modal.nombre = data.nombre;
						$scope.modal.apellido = data.apellido;
						$scope.modal.telefono = data.telefono;
						$scope.modal.email = data.email;
						$scope.modal.matricula = data.matricula;
						$scope.modal.nuevo = false;
						$scope.modal.id = data.id;
						$('#modal-alumno').modal('show');
						break;

					case 'carreras':
						$scope.modal.desc_carr = data.desc_carr;
						$scope.modal.plan = data.plan;
						$scope.modal.nuevo = false;
						$scope.modal.id = data.id;
						$('#modal-carrera').modal('show');
						break;

					case 'usuarios':
						$scope.modal.nombre = data.nombre;
						$scope.modal.apellido = data.apellido;
						$scope.modal.email = data.email;
						$scope.modal.permiso = data.permiso;
						$scope.modal.estado = data.estado;
						$scope.modal.usuarioid = data.id;
						$scope.modal.nuevo = false;
						$scope.modal.id = data.id;
						$('#modal-usuario').modal('show');
						break;

					case 'docenteasignado':
						$scope.modal.materia = data.materia;
						$scope.modal.docente.apellido = data.docente.apellido;
						$scope.modal.docente.nombre = data.docente.nombre;
						$scope.modal.desc_cargo = data.desc_cargo;
						$scope.email = data.email;
						$scope.matricula = data.matricula; 
						$scope.modal.nuevo = false;
						$scope.modal.id = data.id;
						$('#modal-docasignado').modal('show');

						break;

					case 'dictados':
						$scope.modal.id_materia = data.id_materia.toString();
						$scope.modal.materia = data.desc_mat;
						$scope.modal.cuat = data.cuat.toString();
						$scope.modal.ano = data.ano;
						$scope.modal.id_dia = data.id_dia.toString();
						$scope.modal.dia_cursada = data.dia_cursada;
						$scope.modal.id_alternativa = data.id_alternativa.toString();
						var startDateInit = new Date(Date.parse(data.fecha_inicio));
						var day = 60 * 60 * 24 * 1000;
						var endDateInit = new Date(startDateInit.getTime() + day);
						$scope.modal.fecha_inicio = endDateInit;
						var startDateFin = new Date(Date.parse(data.fecha_fin));
						var day = 60 * 60 * 24 * 1000;
						var endDateFin = new Date(startDateFin.getTime() + day);
						$scope.modal.fecha_fin = endDateFin;
						$scope.modal.cant_insc_act = data.cant_insc_act;
						$scope.modal.cant_clases = data.cant_clases;
						$scope.modal.cant_faltas_max = data.cant_faltas_max;
						$scope.modal.nuevo = false;
						$scope.modal.id = data.id;
						$('#modal-dictado').modal('show');
						break;
						
					case 'docentes':
						$scope.modal.nombre = data.nombre;
						$scope.modal.apellido = data.apellido;
						$scope.modal.telefono = data.telefono;
						$scope.modal.id = data.id;
						$('#modal-docente').modal('show');
						break;

					case 'inscriptos':
						$scope.modal.alumno = data.alumno;
						$scope.modal.materia = data.materia;
						$scope.modal.nuevo = false;
						$scope.modal.id = data.id;
						$scope.modal.cant_faltas_act = data.cant_faltas_act;
						$('#modal-inscripto').modal('show');
						break;
						
					case 'materias':
						$scope.modal.carrera = data.carrera;
						$scope.modal.desc_mat = data.desc_mat;
						$scope.modal.nuevo = false;
						$scope.modal.id = data.id;
						$('#modal-materia').modal('show');
						break;

					default:
						break;
				}
			} else { 
				$scope.modal.nuevo = true;
			}
		}

	    table.confirmDelete = function(id, type) {
	      swal({
			  title: "Estas seguro?",
			  text: 'Se eliminará el registro '+id+'. Una vez eliminado no podra recuperarlo',
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  switch (type) {
					case 'alumno':
						alumnoService.borrarAlumno(id).then(
			              function() {
			              swal({
							  title: "Exito!",
							  text: "Alumno eliminado exitosamente",
							  icon: "success",
							  button: "OK",
								})
								.then((willContinue) => {
								  if (willContinue) {
								    location.reload(true);
								  }
								})
			            }, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error eliminando el alumno",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              		}
			         );
					break;

					case 'carreras':
						carrerasService.borrarCarrera(id).then(
			             function() {
			              swal({
							  title: "Exito!",
							  text: "Carrera eliminada exitosamente",
							  icon: "success",
							  button: "OK",
								})
								.then((willContinue) => {
								  if (willContinue) {
								    location.reload(true);
								  }
								})
			            }, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error eliminando la carrera",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              	}); 
					break;

					case 'usuarios':
						usuariosService.borrarUsuario(id).then(
			             function() {
			              swal({
							  title: "Exito!",
							  text: "Usuario eliminando exitosamente",
							  icon: "success",
							  button: "OK",
								})
								.then((willContinue) => {
								  if (willContinue) {
								    location.reload(true);
								  }
								})
			            }, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error eliminando el usuario",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              	}); 
					break;

					case 'docenteasignado':
						docentesAsignadosService.borrarDocenteAsignado(id).then(
			             function() {
			              swal({
							  title: "Exito!",
							  text: "Docente asignado eliminado exitosamente",
							  icon: "success",
							  button: "OK",
								})
								.then((willContinue) => {
								  if (willContinue) {
								    location.reload(true);
								  }
								})
			            }, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error eliminando el docente asignado",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              });
					break;

					case 'dictados':
						dictadosService.borrarDictado(id).then(
			             function() { 
			              swal({
							  title: "Exito!",
							  text: "Dictado eliminado exitosamente",
							  icon: "success",
							  button: "OK",
								})
								.then((willContinue) => {
								  if (willContinue) {
								    location.reload(true);
								  }
								})
			            }, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error eliminando el dictado",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              });
					break;
						
					case 'docentes':
						docentesService.borrarDocente(id).then(
			             function() { 
			              swal({
							  title: "Exito!",
							  text: "Docente eliminado exitosamente",
							  icon: "success",
							  button: "OK",
								})
								.then((willContinue) => {
								  if (willContinue) {
								    location.reload(true);
								  }
								})
			            }, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error eliminando el docente",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              });
					break;

					case 'inscriptos':
						inscriptosService.borrarInscripto(id).then(
			             function() { 
			              swal({
							  title: "Exito!",
							  text: "Inscripto eliminado exitosamente",
							  icon: "success",
							  button: "OK",
								})
								.then((willContinue) => {
								  if (willContinue) {
								    location.reload(true);
								  }
								})
			            }, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error eliminando el inscripto",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              });
					break;
						
					case 'materias':
						materiasService.borrarMateria(id).then(
			             function() { 
			              swal({
							  title: "Exito!",
							  text: "Materia eliminada exitosamente",
							  icon: "success",
							  button: "OK",
								})
								.then((willContinue) => {
								  if (willContinue) {
								    location.reload(true);
								  }
								})
			            }, function(error) {
						swal({
						  title: "Atencion!",
						  text: "Hubo un error eliminando la materia",
						  icon: "error",
						  button: "OK",
							})
							.then((willContinue) => {
							  if (willContinue) {
							    location.reload(true);
							  }
							})
	              });
					break;
				};
			  } else {
			    swal("Los datos no fueron modificados!");
			  }
		  });
	    }

	    $scope.table = table;
    },
  };
});
})();
