(function() {
  'use strict';
  angular.module('app').directive('generalTable', function() {
    return {
      scope: {
        data: '=',
        headers: '=',
        type: '='
      },
      templateUrl: 'scripts/app/views/generalTable.html',
      controller: function(
        alumnoService,
        carrerasService,
        dictadosService,
        docentesAsignadosService,
        docentesService,
        inscriptosService,
        materiasService,
        usuariosService,
        $scope,
        $location,
        $auth,
        $state
      ) {
        var table = this;
        $scope.filter = {};
        $scope.$watch('searchAlumno', function(newValue, oldValue) {
          if ($scope.type === 'usuarios' && $scope.data !== undefined) {
            var nuevoUsuario = [];
            var hiddenData = $scope.data.hiddenData;
            var i = 0;
            $scope.data.hiddenData.find(function(data) {
                var nombre = data.nombre.toUpperCase().search(newValue.toUpperCase());
                var apellido = data.apellido.toUpperCase().search(newValue.toUpperCase());
                var email = data.email.toUpperCase().search(newValue.toUpperCase());
                var permiso = data.permiso.toUpperCase().search(newValue.toUpperCase());
                var estado = data.estado.toUpperCase().search(newValue.toUpperCase());
                if (nombre != -1 || apellido != -1 || email != -1 || permiso != -1 || estado != -1) {
                  nuevoUsuario[i] = data;
                  i +=1;
                }
            });
            $scope.data = nuevoUsuario;
            if ($scope.data != undefined) {
              $scope.data.hiddenData =  hiddenData;
            }
          }
          if ($scope.type === 'alumno' && $scope.data !== undefined) {
            var nuevoAlumno = [];
            var hiddenData = $scope.data.hiddenData;
            var i = 0;
            $scope.data.hiddenData.find(function(data) {
                var nombre = data.nombre.toUpperCase().search(newValue.toUpperCase());
                var apellido = data.apellido.toUpperCase().search(newValue.toUpperCase());
                var email = data.email.toUpperCase().search(newValue.toUpperCase());
                var matricula = data.matricula.toUpperCase().search(newValue.toUpperCase());
                var telefono = data.telefono.toUpperCase().search(newValue.toUpperCase());
                if (nombre != -1 || apellido != -1 || email != -1 || matricula != -1 || telefono != -1) {
                  nuevoAlumno[i] = data;
                  i +=1;
                }
            });
            $scope.data = nuevoAlumno;
            if ($scope.data != undefined) {
              $scope.data.hiddenData =  hiddenData;
            }
          }
          if ($scope.type === 'carreras' && $scope.data !== undefined) {
            var nuevaCarrera = [];
            var hiddenData = $scope.data.hiddenData;
            var i = 0;
            $scope.data.hiddenData.find(function(data) {
                var desc = data.desc_carr.toUpperCase().search(newValue.toUpperCase());
                var plan = data.plan.toUpperCase().search(newValue.toUpperCase());
               if (desc != -1 || plan != -1) {
                  nuevaCarrera[i] = data;
                  i +=1;
                }
            });
            $scope.data = nuevaCarrera;
            if ($scope.data != undefined) {
              $scope.data.hiddenData =  hiddenData;
            }
          }
          if ($scope.type === 'docenteasignado' && $scope.data !== undefined) {
            var nuevoDocente = [];
            var hiddenData = $scope.data.hiddenData;
            var i = 0;
            $scope.data.hiddenData.find(function(data) {
                var ano = data.dictados.ano.toUpperCase().search(newValue.toUpperCase());
                var cuat = data.dictados.cuat.toString().search(newValue.toUpperCase());
                var materia = data.materia.desc_mat.toUpperCase().search(newValue.toUpperCase());
                var nombre = data.docente.nombre.toUpperCase().search(newValue.toUpperCase());
                var apellido = data.docente.apellido.toUpperCase().search(newValue.toUpperCase());
                var cargo = data.desc_cargo.toUpperCase().search(newValue.toUpperCase());
                if (cuat != -1 || ano != -1 || materia != -1 || nombre != -1 || apellido != -1 || cargo != -1) {
                  nuevoDocente[i] = data;
                  i +=1;
                }
            });
            $scope.data = nuevoDocente;
            if ($scope.data != undefined) {
              $scope.data.hiddenData =  hiddenData;
            }
          }
          if ($scope.type === 'dictados' && $scope.data !== undefined) {
            var nuevoDictado = [];
            var hiddenData = $scope.data.hiddenData;
            var i = 0;
            $scope.data.hiddenData.find(function(data) {
                //var alternativa = data.alt_hor.toUpperCase().search(newValue.toUpperCase());
                var ano = data.ano.toUpperCase().search(newValue.toUpperCase());
                var cant_clases = data.cant_clases.toString().search(newValue.toUpperCase());
                var cant_faltas_max = data.cant_faltas_max.toString().search(newValue.toUpperCase());
                var cant_insc_act = data.cant_insc_act.toString().search(newValue.toUpperCase());
                var cuat = data.cuat.toString().search(newValue.toUpperCase());
                var desc_mat = data.desc_mat.toUpperCase().search(newValue.toUpperCase());
                //var dia_cursada = data.dia_cursada.toUpperCase().search(newValue.toUpperCase());
                
                if (ano != -1 || cant_clases != -1 || cant_faltas_max != -1 || cant_insc_act != -1 || cuat!= -1 || desc_mat != -1 ) {
                  nuevoDictado[i] = data;
                  i +=1;
                }
            });
            $scope.data = nuevoDictado;
            if ($scope.data != undefined) {
              $scope.data.hiddenData =  hiddenData;
            }
          }
          if ($scope.type === 'docentes' && $scope.data !== undefined) {
            var nuevoProfe = [];
            var hiddenData = $scope.data.hiddenData;
            var i = 0;
            $scope.data.hiddenData.find(function(data) {
                var nombre = data.nombre.toUpperCase().search(newValue.toUpperCase());
                var apellido = data.apellido.toUpperCase().search(newValue.toUpperCase());
                var telefono = data.telefono.toUpperCase().search(newValue.toUpperCase());
                var estado = data.estado.toUpperCase().search(newValue.toUpperCase());
                var id_usuario = data.id_usuario.toString().search(newValue.toUpperCase());
                if (nombre != -1 || apellido != -1 || estado != -1 || id_usuario != -1 || telefono != -1) {
                  nuevoProfe[i] = data;
                  i +=1;
                }
            });
            $scope.data = nuevoProfe;
            if ($scope.data != undefined) {
              $scope.data.hiddenData =  hiddenData;
            }
          }
          if ($scope.type === 'inscriptos' && $scope.data !== undefined) {
            var nuevoInscripto = [];
            var hiddenData = $scope.data.hiddenData;
            var i = 0;
            $scope.data.hiddenData.find(function(data) {
                var nombre = data.nombre.toUpperCase().search(newValue.toUpperCase());
                var apellido = data.apellido.toUpperCase().search(newValue.toUpperCase());
                var materia = data.desc_mat.toUpperCase().search(newValue.toUpperCase());
                var cant_faltas = data.cant_faltas_act.toString().search(newValue);
                var libre = data.libre.toUpperCase().search(newValue.toUpperCase());
                if (nombre != -1 || apellido != -1 || materia != -1 || cant_faltas != -1 || libre != -1) {
                  nuevoInscripto[i] = data;
                  i +=1;
                }
            });
            $scope.data = nuevoInscripto;
            if ($scope.data != undefined) {
              $scope.data.hiddenData =  hiddenData;
            }
          }
          if ($scope.type === 'materias' && $scope.data !== undefined) {
            var nuevaMateria = [];
            var hiddenData = $scope.data.hiddenData;
            var i = 0;
            $scope.data.hiddenData.find(function(data) {
                var nombre = data.desc_mat.toUpperCase().search(newValue.toUpperCase());
                var carrera = data.carrera.desc_carr.toUpperCase().search(newValue.toUpperCase());
                var plan = data.carrera.plan.toUpperCase().search(newValue.toUpperCase());
                if (nombre != -1 || carrera != -1 || plan != -1) {
                  nuevaMateria[i] = data;
                  i +=1;
                }
            });
            $scope.data = nuevaMateria;
            if ($scope.data != undefined) {
              $scope.data.hiddenData =  hiddenData;
            }
          }

        });
        table.saveUsuario = function(usuario) {
          if (usuario.nuevo) {
            usuariosService.guardarUsuario(usuario).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'El usuario fue creado exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error creando el usuario',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
          } else {
            usuariosService.actualizarUsuario(usuario).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'El usuario fue actualizado exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error actualizando el usuario',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
          }
        };

        table.saveAlumno = function(alumno) {
          if (alumno.nuevo) {
            alumnoService.guardarAlumno(alumno).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'El alumno fue creado exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error creando el alumno',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
          } else {
            alumnoService.actualizarAlumno(alumno).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'El alumno fue actualizado exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error actualizando el alumno',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
          }
        };

        table.saveCarrera = function(carrera) {
          if (carrera.nuevo) {
            carrerasService.guardarCarrera(carrera).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'La carrera fue creada exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error creando la carrera',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
          } else {
            carrerasService.actualizarCarrera(carrera).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'La carrera fue actualizada exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error actualizando la carrera',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
          }
        };

        table.saveDocasignado = function(docAsignado) {
          if (docAsignado.nuevo) {
            docentesAsignadosService.guardarDocenteAsignado(docAsignado).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'El docente asignado fue creado exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error creando el docente asignado',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
          } else {
            docentesAsignadosService
              .actualizarDocenteAsignado(docAsignado)
              .then(
                function() {
                  swal({
                    title: 'Éxito!',
                    text: 'El docente asignado fue actualizado exitosamente',
                    icon: 'success',
                    button: 'OK'
                  }).then(willContinue => {
                    if (willContinue) {
                      location.reload(true);
                    }
                  });
                },
                function(error) {
                  swal({
                    title: 'Atención!',
                    text: 'Hubo un error actualizando el docente asignado',
                    icon: 'error',
                    button: 'OK'
                  }).then(willContinue => {
                    if (willContinue) {
                      //location.reload(true);
                    }
                  });
                }
              );
          }
        };

        table.saveDictado = function(dictado) {
          if (dictado.nuevo) {
            dictadosService.guardarDictado(dictado).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'El dictado fue creado exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error creando el dictado',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
          } else {
            dictadosService.actualizarDictado(dictado).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'El dictado fue actualizado exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error actualizando el dictado',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
          }
        };

        table.saveDocente = function(docente) {
          if (docente.nuevo) {
            docentesService.guardarDocente(docente).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'El docente fue creado exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error creando el docente',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
          } else {
            docentesService.actualizarDocente(docente).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'El docente fue actualizado exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error actualizando el docente',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
          }
        };

        table.saveInscripto = function(inscripto) {
		   /*var nuevoInscripto = $scope.materias.find(function(mat) {
		    return inscripto.materia.desc_mat === mat.desc_mat;
		  });*/
		   //nuevoInscripto.id_alumno = inscripto.alumno.nombre;
		   //nuevoInscripto.cant_faltas_act = inscripto.cant_faltas_act;
          if (inscripto.nuevo) {
            inscriptosService.guardarInscripto(inscripto).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'El alumno fue inscripto exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error guardando la inscripción',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
          } else {
            inscriptosService.actualizarInscripto(inscripto).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'Inscripción actualizada exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error actualizando la inscripción',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
          }
        };

        table.saveMateria = function(materia) {
          if (materia.nuevo) {
            var nuevaMateria = $scope.carreras.find(function(mat) {
              return materia.carrera.desc_carr === mat.desc_carr;
            });
            nuevaMateria.desc_mat = materia.desc_mat;
            materiasService.guardarMateria(nuevaMateria).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'La materia fue creada exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error creando la materia',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
          } else {
            materiasService.actualizarMateria(materia).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'La materia fue actualizada exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error actualizando la materia',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
          }
        };

        $scope.initScope = function(type) {
          switch (type) {
            case 'alumno':
              $scope.modal = {
                nombre: null,
                apellido: null,
                telefono: null,
                email: null,
                matricula: null
              };
              break;
            case 'carreras':
              $scope.modal = {
                desc_carr: null,
                plan: null
              };
              break;

            case 'usuarios':
              $scope.modal = {
                nombre: null,
                apellido: null,
                email: null,
                permiso: null,
                estado: null,
                usuarioid: null
              };
              $scope.permisos = ['Administrador', 'Docente'];
              $scope.estados = ['Activo', 'Inactivo'];
              break;

            case 'docenteasignado':
              $scope.modal = {
                desc_cargo: null,
                email: null,
                matricula: null
              };

              $scope.modal.materia = {
                desc_mat: null
              };

              $scope.modal.docente = {
                apellido: null,
                nombre: null
              };
              docentesService.getDocente().then(response => {
                $scope.docentes = response.data;
              });

              dictadosService.getDictadoSinProfModal().then(response => {
                $scope.materias = response.data;
              });
              $scope.cargos = [
                { desc_cargo: 'Titular', id: 1 },
                { desc_cargo: 'Suplente', id: 2 }
              ];
              break;

            case 'dictados':
              $scope.modal = {
                cuat: null,
                ano: null,
                dia_cursada: null,
                alt_hor: null,
                fecha_inicio: null,
                fecha_fin: null,
                id_carrera: null,
                cant_insc_act: null,
                cant_clases: null,
                cant_faltas_max: null
              };

              $scope.modal.materia = null;

              if ($scope.modal.isEdit !== undefined || $scope.mostrarOpen) {
                  $scope.$watch('modal.id_materia', function(newValue, oldValue) {
                      $scope.mostrarCampos = false;
                      dictadosService
                        .verificarSiDictadoExiste($scope.modal)
                        .then(function(response) {
                          if (response.data == "") {
                            $scope.mostrarCampos = true;
                          }
                        });
                  });

                  $scope.$watch('modal.cuat', function(newValue, oldValue) {
                      $scope.mostrarCampos = false;
                      dictadosService
                        .verificarSiDictadoExiste($scope.modal)
                        .then(function(response) {
                          if (response.data == "") {
                            $scope.mostrarCampos = true;
                          }
                        });
                  });

                  $scope.$watch('modal.ano', function(newValue, oldValue) {
                      $scope.mostrarCampos = false;
                      dictadosService
                        .verificarSiDictadoExiste($scope.modal)
                        .then(function(response) {
                          if (response.data == "") {
                            $scope.mostrarCampos = true;
                          }
                        });
                  });

              } else {
                $scope.mostrarCampos = true;
              }
                  $scope.$watch('modal.id_carrera', function(newValue, oldValue) {
                      $scope.showModalDictado = false;
                      if (newValue) {
                        $scope.showModalDictado = true;
                        if ($scope.modal.nuevo) {
                          materiasService
                            .buscarMateriasDeCarrera(Number(newValue))
                            .then(function(materias) {
                              $scope.materias = materias.data;
                            });
                        } else {
                          materiasService.getMaterias().then(response => {
                            $scope.materias = response.data;
                          });
                        }
                      } else {
                        $scope.showModalDictado = false;
                      }
                  });

              carrerasService.getCarrera().then(response => {
                $scope.carreras = response.data;
              });
              break;

            case 'docentes':
              $scope.modal = {
                nombre: null,
                apellido: null,
                telefono: null
              };

              usuariosService.getUsuariosDocentes().then(response => {
                $scope.docentes = response.data;
              });
              break;

            case 'inscriptos':
              $scope.modal = {
                cant_faltas_act: null
              };

              $scope.modal.alumno = {
                nombre: null,
                apellido: null
              };

              $scope.modal.materia = {
                desc_mat: null
              };

              alumnoService.getAlumnos().then(response => {
                $scope.alumnos = response.data;
              });

              dictadosService.getDictadoModal().then(response => {
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
              };

              carrerasService.getCarrera().then(response => {
                $scope.carreras = response.data;
              });

              break;

            default:
              $scope.modal = {};
              break;
          }
        };

        table.openModal = function(type) {
          $scope.mostrarOpen = true;
          $scope.initScope(type);
          $scope.modal.nuevo = true;
          switch (type) {
            case 'alumno':
              $scope.frmAlumno.$setUntouched();
              $('#modal-alumno').modal('show');
              break;

            case 'carreras':
              $scope.frmCarrera.$setUntouched();
              $('#modal-carrera').modal('show');
              break;

            case 'usuarios':
              $scope.frmUsuario.$setUntouched();
              $('#modal-usuario').modal('show');
              break;

            case 'docenteasignado':
              $scope.frmDocAsignado.$setUntouched();
              $('#modal-docasignado').modal('show');
              break;

            case 'dictados':
              $scope.frmDictado.$setUntouched();
              $scope.modal.edit = '';
              $('#modal-dictado').modal('show');
              break;

            case 'docentes':
              $scope.frmDocente.$setUntouched();
              $('#modal-docente').modal('show');
              break;

            case 'inscriptos':
              $scope.frmInscriptos.$setUntouched();
              $('#modal-inscripto').modal('show');
              break;

            case 'materias':
              $scope.frmMateria.$setUntouched();
              $('#modal-materia').modal('show');
              break;
            case 'search':
              $scope.frmSearch.$setUntouched();
              $("#search-modal").modal('show');
            default:
              break;
          }
        };

        table.openEditModal = function(data, type) {
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
                $scope.modal.isEdit = true;
                $scope.modal.id = data.id;
                $('#modal-alumno').modal('show');
                break;

              case 'carreras':
                $scope.modal.desc_carr = data.desc_carr;
                $scope.modal.plan = data.plan;
                $scope.modal.nuevo = false;
                $scope.modal.isEdit = true;
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
                $scope.modal.isEdit = true;
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
                $scope.modal.isEdit = true;
                $scope.modal.id = data.id;
                $('#modal-docasignado').modal('show');

                break;

              case 'dictados':
                $scope.modal.edit = 'T';
                $scope.modal.id_materia = data.id_materia.toString();
                $scope.modal.materia = data.desc_mat;
                $scope.modal.cuat = data.cuat.toString();
                $scope.modal.ano = data.ano;
                //$scope.modal.id_dia = data.id_dia.toString();
                //$scope.modal.dia_cursada = data.dia_cursada;
                //$scope.modal.id_alternativa = data.id_alternativa.toString();
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
                $scope.modal.id_carrera = data.id_carrera.toString();
                $scope.modal.nuevo = false;
                $scope.modal.isEdit = true;
                $scope.modal.id = data.id;
                $('#modal-dictado').modal('show');
                break;

              case 'docentes':
                $scope.modal.nombre = data.nombre;
                $scope.modal.apellido = data.apellido;
                $scope.modal.telefono = data.telefono;
                $scope.modal.id = data.id;
                $scope.modal.isEdit = true;
                $('#modal-docente').modal('show');
                break;

              case 'inscriptos':
                $scope.modal.alumno = data.alumno;
                $scope.modal.materia = data.materia;
                $scope.modal.nuevo = false;
                $scope.modal.isEdit = true;
                $scope.modal.id = data.id;
                $scope.modal.cant_faltas_act = data.cant_faltas_act;
                $('#modal-inscripto').modal('show');
                break;

              case 'materias':
                $scope.modal.carrera = data.carrera;
                $scope.modal.desc_mat = data.desc_mat;
                $scope.modal.nuevo = false;
                $scope.modal.isEdit = true;
                $scope.modal.id = data.id;
                $('#modal-materia').modal('show');
                break;

              default:
                break;
            }
          } else {
            $scope.modal.nuevo = true;
          }
        };

        table.openDaysModal = function(dictado) {

          dictadosService.getDaysOfCourse(dictado.id).then(response => {
                $scope.materia = response.data[0].desc_mat;
                $scope.carrera = response.data[0].desc_carr;
                $scope.cuatrim = response.data[0].cuat;
                $scope.ano = response.data[0].ano;
                var fullData = response.data;
                $scope.days = {};
                
                $scope.selectedListLun = {};
                $scope.selectedListMar = {};
                $scope.selectedListMier = {};
                $scope.selectedListJue = {};
                $scope.selectedListVier = {};
                $scope.selectedListSab = {};
                $scope.selectedListDom = {};

                var alternativa = [];
                dictadosService.getAlternativas().then( response => { 
                  response.data.forEach( function(element, index) {
                    alternativa.push(element.codigo);
                  });
                  $scope.selectDaysLun = alternativa;
                  $scope.selectDaysMar = alternativa;
                  $scope.selectDaysMier = alternativa;
                  $scope.selectDaysJue = alternativa;
                  $scope.selectDaysVier = alternativa;
                  $scope.selectDaysSab= alternativa;
                  $scope.selectDaysDom = alternativa;
                  
                  dictadosService.getAlternativasSeleccionada(dictado.id).then (response => {
                    response.data.forEach( function(element, index) {
                      if (element.dia === 'lunes' && element.alt !== null) {
                        $scope.selectedListLun[element.alt] = true;
                      } 
                      if (element.dia === 'martes' && element.alt !== null) {
                        $scope.selectedListMar[element.alt] = true;
                      }
                      if (element.dia === 'miercoles' && element.alt !== null) {
                        $scope.selectedListMier[element.alt] = true;
                      }
                      if (element.dia === 'jueves' && element.alt !== null) {
                        $scope.selectedListJue[element.alt] = true;
                      }
                      if (element.dia === 'viernes' && element.alt !== null) {
                        $scope.selectedListVier[element.alt] = true;
                      }
                      if (element.dia === 'sabado' && element.alt !== null) {
                        $scope.selectedListSab[element.alt] = true;
                      }
                      if (element.dia === 'domingo' && element.alt !== null) {
                        $scope.selectedListDom[element.alt] = true;
                      }
                      $scope.dictadoId = dictado.id;
                      $("#modal-dias-cursada").modal('show');
                    });
                  })

                });


          });
        }

        $scope.submit = function () {
            var finalDays = [];
            var success = true;
            finalDays[0] = {dia:"lunes",alt: null};
            finalDays[1] = {dia:"martes",alt: null};
            finalDays[2] = {dia:"miercoles",alt: null};
            finalDays[3] = {dia:"jueves",alt: null};
            finalDays[4] = {dia:"viernes",alt: null};
            finalDays[5] = {dia:"sabado",alt: null};
            finalDays[6] = {dia:"domingo",alt: null};

            var contLun = 0;
            angular.forEach($scope.selectedListLun, function (selected, day) {
                if (selected && contLun == 0) {
                  finalDays[0] = {dia:"lunes",alt: day};
                  contLun +=1;
                } else {
                  if (contLun >= 1 && selected) {
                    success = false;
                  }
                }
            });
            
            var contMar = 0;
            angular.forEach($scope.selectedListMar, function (selected, day) {
                if (selected && contMar == 0) {
                  finalDays[1] = {dia:"martes",alt: day};
                  contMar +=1;
                } else {
                  if (contMar >= 1 && selected) {
                    success = false;
                  }
                }
            });
            
            var contMier = 0;
            angular.forEach($scope.selectedListMier, function (selected, day) {
                if (selected && contMier == 0) {
                  finalDays[2] = {dia:"miercoles",alt: day};
                  contMier+=1;
                } else {
                  if (contMier >= 1 && selected) {
                    success = false;
                  }
                }
            });

            var contJue = 0;
            angular.forEach($scope.selectedListJue, function (selected, day) {
                if (selected && contJue == 0) {
                  finalDays[3] = {dia:"jueves",alt: day};
                  contJue+=1;
                } else {
                  if (contJue >= 1 && selected) {
                    success = false;
                  }
                }
            });

            var contVie = 0;
            angular.forEach($scope.selectedListVier, function (selected, day) {
                if (selected && contVie == 0) {
                  finalDays[4] = {dia:"viernes",alt: day};
                  contVie+=1;
                } else {
                  if (contVie >= 1 && selected) {
                    success = false;
                  }
                }
            });

            var contSab = 0;
            angular.forEach($scope.selectedListSab, function (selected, day) {
                if (selected && contSab == 0) {
                  finalDays[5] = {dia:"sabado",alt: day};
                  contSab+=1;
                } else {
                  if (contSab >= 1 && selected) {
                    success = false;
                  }
                }
            });

            var contDom = 0;
            angular.forEach($scope.selectedListDom, function (selected, day) {
                if (selected && contDom == 0) {
                  finalDays[6] = {dia:"domingo",alt: day};
                  contDom+=1;
                } else {
                  if (contDom >= 1 && selected) {
                    success = false;
                  }
                }
            });

            finalDays[7] = [{idDictado: $scope.dictadoId}];

            if (!success) {
              swal({
                  title: 'Atención!',
                  text: 'No se puede seleccionar mas de una alternativa para un mismo día',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                }); 
            } else {
              //if (contLun > 0 || contMar > 0 || contMier > 0 || contJue > 0 || contVie > 0 || contSab > 0 || contDom > 0) {
                dictadosService.saveAlternativasSeleccionadas(finalDays).then(response => {
                      swal({
                        title: 'Éxito!',
                        text: 'Las alternativas selecionadas fueron guardadas exitosamente',
                        icon: 'success',
                        button: 'OK'
                      }).then(willContinue => {
                        if (willContinue) {
                          location.reload(true);
                        }
                      });
                    });
              /*} else {
                swal({
                  title: 'Atención!',
                  text: 'Debe seleccionar al menos una alternativa',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                }); 
              }*/
            }
        };

        table.saveDiasMateria = function(dias) {
            materiasService.actualizarDiasMateria(materia).then(
              function() {
                swal({
                  title: 'Éxito!',
                  text: 'Los dias fue actualizada exitosamente',
                  icon: 'success',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    location.reload(true);
                  }
                });
              },
              function(error) {
                swal({
                  title: 'Atención!',
                  text: 'Hubo un error actualizando los dias',
                  icon: 'error',
                  button: 'OK'
                }).then(willContinue => {
                  if (willContinue) {
                    //location.reload(true);
                  }
                });
              }
            );
        };

        table.confirmDeleteDDO = function(dictado) {
          swal({
            title: 'Estas seguro?',
            text:
              'Se eliminará el registro ' +
              dictado.id +
              '. Una vez eliminado no podrá recuperarlo',
            icon: 'warning',
            buttons: true,
            dangerMode: true
          }).then(willDelete => {
            if (willDelete) {
              dictadosService.borrarDictado(dictado).then(
                function() {
                  swal({
                    title: 'Éxito!',
                    text: 'Dictado eliminado exitosamente',
                    icon: 'success',
                    button: 'OK'
                  }).then(willContinue => {
                    if (willContinue) {
                      location.reload(true);
                    }
                  });
                },
                function(error) {
                  swal({
                    title: 'Atención!',
                    text: 'Hubo un error eliminando el dictado',
                    icon: 'error',
                    button: 'OK'
                  }).then(willContinue => {
                    if (willContinue) {
                      //location.reload(true);
                    }
                  });
                }
              );
            } else {
              swal('Los datos no fueron modificados!');
            }
          });
        };

        table.confirmDelete = function(id, type) {
          swal({
            title: 'Estas seguro?',
            text:
              'Se eliminará el registro ' +
              id +
              '. Una vez eliminado no podrá recuperarlo',
            icon: 'warning',
            buttons: true,
            dangerMode: true
          }).then(willDelete => {
            if (willDelete) {
              switch (type) {
                case 'alumno':
                  alumnoService.borrarAlumno(id).then(
                    function() {
                      swal({
                        title: 'Éxito!',
                        text: 'Alumno eliminado exitosamente',
                        icon: 'success',
                        button: 'OK'
                      }).then(willContinue => {
                        if (willContinue) {
                          location.reload(true);
                        }
                      });
                    },
                    function(error) {
                      swal({
                        title: 'Atención!',
                        text: 'Hubo un error eliminando el alumno',
                        icon: 'error',
                        button: 'OK'
                      }).then(willContinue => {
                        if (willContinue) {
                          //location.reload(true);
                        }
                      });
                    }
                  );
                  break;

                case 'carreras':
                  carrerasService.borrarCarrera(id).then(
                    function() {
                      swal({
                        title: 'Éxito!',
                        text: 'Carrera eliminada exitosamente',
                        icon: 'success',
                        button: 'OK'
                      }).then(willContinue => {
                        if (willContinue) {
                          location.reload(true);
                        }
                      });
                    },
                    function(error) {
                      swal({
                        title: 'Atención!',
                        text: 'Hubo un error eliminando la carrera',
                        icon: 'error',
                        button: 'OK'
                      }).then(willContinue => {
                        if (willContinue) {
                          //location.reload(true);
                        }
                      });
                    }
                  );
                  break;

                case 'usuarios':
                  usuariosService.borrarUsuario(id).then(
                    function() {
                      swal({
                        title: 'Éxito!',
                        text: 'Usuario eliminando exitosamente',
                        icon: 'success',
                        button: 'OK'
                      }).then(willContinue => {
                        if (willContinue) {
                          location.reload(true);
                        }
                      });
                    },
                    function(error) {
                      swal({
                        title: 'Atención!',
                        text: 'Hubo un error eliminando el usuario',
                        icon: 'error',
                        button: 'OK'
                      }).then(willContinue => {
                        if (willContinue) {
                          //location.reload(true);
                        }
                      });
                    }
                  );
                  break;

                case 'docenteasignado':
                  docentesAsignadosService.borrarDocenteAsignado(id).then(
                    function() {
                      swal({
                        title: 'Éxito!',
                        text: 'Docente asignado eliminado exitosamente',
                        icon: 'success',
                        button: 'OK'
                      }).then(willContinue => {
                        if (willContinue) {
                          location.reload(true);
                        }
                      });
                    },
                    function(error) {
                      swal({
                        title: 'Atención!',
                        text: 'Hubo un error eliminando el docente asignado',
                        icon: 'error',
                        button: 'OK'
                      }).then(willContinue => {
                        if (willContinue) {
                          //location.reload(true);
                        }
                      });
                    }
                  );

                  break;

                case 'docentes':
                  docentesService.borrarDocente(id).then(
                    function() {
                      swal({
                        title: 'Éxito!',
                        text: 'Docente eliminado exitosamente',
                        icon: 'success',
                        button: 'OK'
                      }).then(willContinue => {
                        if (willContinue) {
                          location.reload(true);
                        }
                      });
                    },
                    function(error) {
                      swal({
                        title: 'Atención!',
                        text: 'Hubo un error eliminando el docente',
                        icon: 'error',
                        button: 'OK'
                      }).then(willContinue => {
                        if (willContinue) {
                          //location.reload(true);
                        }
                      });
                    }
                  );
                  break;

                case 'inscriptos':
                  inscriptosService.borrarInscripto(id).then(
                    function() {
                      swal({
                        title: 'Éxito!',
                        text: 'Inscripto eliminado exitosamente',
                        icon: 'success',
                        button: 'OK'
                      }).then(willContinue => {
                        if (willContinue) {
                          location.reload(true);
                        }
                      });
                    },
                    function(error) {
                      swal({
                        title: 'Atención!',
                        text: 'Hubo un error eliminando el inscripto',
                        icon: 'error',
                        button: 'OK'
                      }).then(willContinue => {
                        if (willContinue) {
                          //location.reload(true);
                        }
                      });
                    }
                  );
                  break;

                case 'materias':
                  materiasService.borrarMateria(id).then(
                    function() {
                      swal({
                        title: 'Éxito!',
                        text: 'Materia eliminada exitosamente',
                        icon: 'success',
                        button: 'OK'
                      }).then(willContinue => {
                        if (willContinue) {
                          location.reload(true);
                        }
                      });
                    },
                    function(error) {
                      swal({
                        title: 'Atención!',
                        text: 'Hubo un error eliminando la materia',
                        icon: 'error',
                        button: 'OK'
                      }).then(willContinue => {
                        if (willContinue) {
                          //location.reload(true);
                        }
                      });
                    }
                  );
                  break;
              }
            } else {
              swal('Los datos no fueron modificados!');
            }
          });
        };

        $scope.table = table;
      }
    };
  });
})();
