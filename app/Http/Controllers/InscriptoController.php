<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inscripto;
use App\Materia;
use App\Alumno;
use App\Dictado;
use App\AsistenciaCurso;
use App\Enums\Generic;

class InscriptoController extends Controller
{
    public function index($id = null) {
      $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

      if ($id == null){

        $today = date("Y-m-d");
        $inscripciones = Inscripto::join('dictados','inscriptos.id_dictado','=','dictados.id')
                 ->join('alumnos','inscriptos.id_alumno','=','alumnos.id')
                 ->join('materias','dictados.id_materia','=','materias.id')
                 ->join('carreras','materias.id_carrera','=','carreras.id')
                 ->leftJoin('asistencias_cursos', function ($query) use ($today) {
                          $query->on('dictados.id','=','asistencias_cursos.id_dictado')
                                ->whereDate('asistencias_cursos.created_at','=',$today)
                                ->where('asistencias_cursos.estado_curso','=','G');
                  })
                 ->leftJoin('asistentes', function ($query) use ($today) {
                          $query->on('inscriptos.id_alumno','=','asistentes.id_alumno')
                                ->on('inscriptos.id_dictado','=','asistentes.id_dictado')
                                ->whereDate('asistentes.created_at','=',$today);;
                  })
                 ->select('inscriptos.id',
                          'alumnos.nombre',
                          'alumnos.apellido',
                          'materias.desc_mat',
                          'carreras.desc_carr',
                          'dictados.cuat',
                          'dictados.ano',
                          'inscriptos.cant_faltas_act',
                          'inscriptos.libre',
                          'asistencias_cursos.estado_curso',
                          'asistentes.cod_asist')
                 ->orderBy('inscriptos.id')
                 ->get();

          foreach ($inscripciones as $result) {    

              if ($result['libre'] == Generic::SI) {
                  $result['libre'] = 'Si';
              } else {
                  $result['libre'] = 'No';
              }

              if ($result['estado_curso'] == 'G' && $result['cod_asist'] == "1"){

                  $result['cant_faltas_act'] = $result['cant_faltas_act'] - 1;

              }else if ($result['estado_curso'] == 'G' && $result['cod_asist'] == "2"){

                  $result['cant_faltas_act'] = $result['cant_faltas_act'] - 0.5;

              }
          }                 

        return $inscripciones;
      } else {
        return Inscripto::find($id);
      }
    }

    public function show($id) {
        $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

        return Inscripto::find($id);
    }

    public function store(Request $request) {
        $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

        $inscripto = new Inscripto;
        $inscripto->id_alumno = $request['alumno']['nombre'];
        $inscripto->id_dictado = $request['materia']['desc_mat'];
        $inscripto->cant_faltas_act = $request->input('cant_faltas_act');
        $inscripto->save();
        return 'Inscripto record successfully created with id' . $inscripto->id;
    }
    
    public function update(Request $request, $id) {
        $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }
        
        $alumnoData = json_decode($request->id_alumno);
        $inscripto = new Inscripto;
        $inscripto->id_alumno = $alumnoData->id;
        $inscripto->id_dictado = $request->input('id');
        $inscripto->cant_faltas_act = $request->input('cant_faltas_act');
        $inscripto->save();

        return 'Inscripto record successfully updated with id ' . $inscripto->id;
    }

    public function destroy($id) {
        $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }
          
        try {
            $inscripto = Inscripto::find($id)->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            var_dump('Error: '.$e);
            return false;
        }
        return 'Inscripto record successfully deleted';
    }
}
