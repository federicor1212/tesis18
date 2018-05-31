<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return view('index.blade.php');
});

Route::post('/authenticate', 'LoginController@authenticate')->middleware('cors');


//Usuario
Route::get('/usuario/{id?}', 'UsuarioController@index');
Route::get('/usuarios-docentes', 'UsuarioController@getUsuariosDocentes');
Route::post('/identity','UsuarioController@getAuthenticatedUser');
Route::post('/crear-usuario', 'UsuarioController@store');
Route::post('/actualizar-usuario/{id}', 'UsuarioController@store');
Route::post('/eliminar-usuario/{id}', 'UsuarioController@destroy');

//Alumnos
Route::get('/alumno/{id?}', 'AlumnoController@index');
Route::post('/crear-alumno', 'AlumnoController@store');
Route::post('/actualizar-alumno/{id}', 'AlumnoController@update');
Route::post('/eliminar-alumno/{id}', 'AlumnoController@destroy');

//Carreras
Route::get('/carrera/{id?}', 'CarreraController@index');
Route::post('/crear-carrera', 'CarreraController@store');
Route::post('/actualizar-carrera/{id}', 'CarreraController@update');
Route::post('/eliminar-carrera/{id}', 'CarreraController@destroy');

//Materias
Route::get('/materia/{id?}', 'MateriaController@index');
Route::get('/materias-carrera/{id?}', 'MateriaController@getMateriasCarrera');
Route::post('/crear-materia', 'MateriaController@store');
Route::post('/actualizar-materia/{id}', 'MateriaController@update');
Route::post('/eliminar-materia/{id}', 'MateriaController@destroy');

//Inscriptos
Route::get('/inscripto/{id?}', 'InscriptoController@index');
Route::post('/nuevo-inscripto', 'InscriptoController@store');
Route::post('/	/{id}', 'InscriptoController@update');
Route::post('/eliminar-inscripto/{id}', 'InscriptoController@destroy');

//Docentes asignados
Route::get('/docente-asignado/{id?}', 'AsignadoController@index');
Route::post('/asignar-docente', 'AsignadoController@store');
Route::post('/actualizar-asignacion/{id}', 'AsignadoController@update');
Route::post('/eliminar-asignacion/{id}', 'AsignadoController@destroy');

//Asistencias Cursos
Route::get('/asistenciaCurso/{id?}', 'AsistenciaCursoController@index');
Route::post('/nueva-asistencia', 'AsistenciaCursoController@store');
Route::post('/modificar-asistencia/{id}', 'AsistenciaCursoController@update');
Route::post('/eliminar-asistencia/{id}', 'AsistenciaCursoController@destroy');

//Asistentes
Route::get('/asistente/{id?}', 'AsistenteController@index');
Route::post('/nuevo-asistente', 'AsistenteController@store');
Route::post('/actualizar-asistente/{id}', 'AsistenteController@update');
Route::post('/eliminar-asistente/{id}', 'AsistenteController@destroy');

//Alternativas
Route::get('/alternativa/{id?}', 'AlternativaController@index');
Route::post('/nuevo-alternativa', 'AlternativaController@store');
Route::post('/actualizar-alternativa/{id}', 'AlternativaController@update');
Route::post('/eliminar-alternativa/{id}', 'AlternativaController@destroy');

//Dias
Route::get('/dia/{id?}', 'DiaController@index');
Route::post('/nuevo-dia', 'DiaController@store');
Route::post('/actualizar-dia/{id}', 'DiaController@update');
Route::post('/eliminar-dia/{id}', 'DiaController@destroy');

//Permisos
Route::get('/permisos/{id?}', 'PermisosController@index');
Route::post('/nuevo-permisos', 'PermisosController@store');
Route::post('/actualizar-permisos/{id}', 'PermisosController@update');
Route::post('/eliminar-permisos/{id}', 'PermisosController@destroy');

//Cantidad de Inscriptos
Route::get('/dia/{id?}', 'DiaController@index');
Route::post('/nuevo-dia', 'DiaController@store');
Route::post('/actualizar-dia/{id}', 'DiaController@update');
Route::post('/eliminar-dia/{id}', 'DiaController@destroy');

//Dictados Clases
Route::get('/dia/{id?}', 'DiaController@index');
Route::post('/nuevo-dia', 'DiaController@store');
Route::post('/actualizar-dia/{id}', 'DiaController@update');
Route::post('/eliminar-dia/{id}', 'DiaController@destroy');

//Dictados
Route::get('/dictado/{id?}', 'DictadoController@index');
Route::get('/dictado-modal/{id?}', 'DictadoController@indexModal');
Route::get('/dictado-sin-prof', 'DictadoController@dictadosSinProfesor');
Route::get('/dictado-sin-prof-modal', 'DictadoController@dictadosSinProfesorModal');
Route::post('/nuevo-dictado', 'DictadoController@store');
Route::post('/actualizar-dictado/{id}', 'DictadoController@update');
Route::post('/eliminar-dictado', 'DictadoController@destroy');
Route::post('/consultar-dictado', 'DictadoController@consultar');

//Docentes
Route::get('/docente/{id?}', 'DocenteController@index');
Route::post('/nuevo-docente', 'DocenteController@store');
Route::post('/actualizar-docente/{id}', 'DocenteController@update');
Route::post('/eliminar-docente/{id}', 'DocenteController@destroy');

//APP
Route::get('/login', 'DocenteController@index');

//Reportes
Route::post('/cantAsistencias', 'ReportesController@loadReports');