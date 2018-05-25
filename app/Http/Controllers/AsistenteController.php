<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asistente;

class AsistenteController extends Controller
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
        return Asistente::all();
      } else {
        return Asistente::find($id);
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

        return Asistente::find($id);
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

        $asistente = new Asistente;
        $asistente->id_alumno = $request->input('id_alumno');
        $asistente->id_dictado = $request->input('id_dictado');
        $asistente->fecha_clase = $request->input('fecha_clase');
        $asistente->cod_asist = $request->input('cod_asist');
        $asistente->save();
        return 'Asistente record successfully created with id' . $asistente->id;
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

        $asistente = Asistente::find($id);
        $asistente->id_alumno = $request->input('id_alumno');
        $asistente->id_dictado = $request->input('id_dictado');
        $asistente->fecha_clase = $request->input('fecha_clase');
        $asistente->cod_asist = $request->input('cod_asist');
        $asistente->save();
        return 'Asistente record successfully updated with id ' . $asistente->id;
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
          
        $asistente = Asistente::find($id)->delete();
        return 'Asistente record successfully deleted';
    }
}
