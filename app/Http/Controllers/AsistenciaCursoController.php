<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AsistenciaCurso;

class AsistenciaCursoController extends Controller
{
    public function index($id = null) {
      $auth = new UsuarioController;
          $request = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($request);
          if (!isset($token['id'])) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

      if ($id == null){
        return AsistenciaCurso::all();
      } else {
        return AsistenciaCurso::find($id);
      }
    }

    public function show($id) {
        $auth = new UsuarioController;
          $request = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($request);
          if (!isset($token['id'])) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

        return AsistenciaCurso::find($id);
    }

    public function store(Request $request) {
        $auth = new UsuarioController;
          $request = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($request);
          if (!isset($token['id'])) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

        $asistenciaCurso = new AsistenciaCurso;
        $asistenciaCurso->id_dictado = $request->input('id_dictado');
        $asistenciaCurso->id_docente = $request->input('id_docente');
        $asistenciaCurso->estado_curso = $request->input('estado_curso');
        $asistenciaCurso->save();
        return 'AsistenciaCurso record successfully created with id' . $asistenciaCurso->id;
    }
    
    public function update(Request $request, $id) {
        $auth = new UsuarioController;
          $request = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($request);
          if (!isset($token['id'])) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

        $asistenciaCurso = AsistenciaCurso::find($id);
        $asistenciaCurso->id_dictado = $request->input('id_dictado');
        $asistenciaCurso->id_docente = $request->input('id_docente');
        $asistenciaCurso->estado_curso = $request->input('estado_curso');
        $asistenciaCurso->save();
        return 'AsistenciaCurso record successfully updated with id ' . $asistenciaCurso->id;
    }

    public function destroy($id) {
        $auth = new UsuarioController;
          $request = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($request);
          if (!isset($token['id'])) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }
          
        $asistenciaCurso = AsistenciaCurso::find($id)->delete();
        return 'AsistenciaCurso record successfully deleted';
    }
}
