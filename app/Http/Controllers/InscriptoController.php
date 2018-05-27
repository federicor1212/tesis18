<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inscripto;
use App\Materia;
use App\Alumno;
use App\Dictado;
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
        $materias = Materia::all();
        $alumno = Alumno::all();
        $inscripciones = Inscripto::all();
        $dictados = Dictado::all();

        foreach ($inscripciones as $insc) {
            if ($insc['libre'] == Generic::SI) {
                $insc['libre'] = 'Si';
            } else {
                $insc['libre'] = 'No';
            }
            $insc['alumno'] = $alumno->find($insc['id_alumno']);
            $insc['dictado'] = $dictados->find($insc['id_dictado']);
            $insc['materia'] = $materias->find($insc['dictado']->id_materia);
            unset($insc['dictado']);
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
        $inscripto->id_alumno = $request->input('id_alumno');
        $inscripto->id_dictado = $request->input('id');
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
            var_dump('PEPE'.$e);
            return false;
        }
        return 'Inscripto record successfully deleted';
    }
}
