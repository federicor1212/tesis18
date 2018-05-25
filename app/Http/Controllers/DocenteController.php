<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Docente;

class DocenteController extends Controller
{
    public function index($id = null) {
      $auth = new UsuarioController;
      $request = new \Illuminate\Http\Request();
      $token = $auth->getAuthenticatedUser($request);
      $userData = json_decode($token->getContent());

      if(isset($userData->error)){
          return response()->json($userData, $token->status());
      }

      if ($id == null){
        return Docente::all()->toArray();
      } else {
        return Docente::find($id);
      }
    }

    public function show($id) {
          $auth = new UsuarioController;
          $request = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($request);
          $userData = json_decode($token->getContent());

          if(isset($userData->error)){
              return response()->json($userData, $token->status());
          }
        return Docente::find($id);
    }

    public function store(Request $request) {
        $auth = new UsuarioController;
          $request = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($request);
          $userData = json_decode($token->getContent());

          if(isset($userData->error)){
              return response()->json($userData, $token->status());
          }

        $docente = new Docente;
        $docente->id_usuario = $request->input('id_usuario');
        $docente->nombre = $request->input('nombre');
        $docente->apellido = $request->input('apellido');
        $docente->telefono = $request->input('telefono');
        $docente->save();
        return 'Docente record successfully created with id' . $docente->id;
    }
    
    public function update(Request $request, $id) {
        $auth = new UsuarioController;
          $request = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($request);
          $userData = json_decode($token->getContent());

          if(isset($userData->error)){
              return response()->json($userData, $token->status());
          }

        $docente = Docente::find($id);
        $docente->id_usuario = $request->input('id_usuario');
        $docente->nombre = $request->input('nombre');
        $docente->apellido = $request->input('apellido');
        $docente->telefono = $request->input('telefono');
        $docente->save();
        return 'Docente record successfully updated with id ' . $docente->id;
    }

    public function destroy($id) {
        $auth = new UsuarioController;
          $request = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($request);
          $userData = json_decode($token->getContent());

          if(isset($userData->error)){
              return response()->json($userData, $token->status());
          }

        $docente = Docente::find($id)->delete();
        return 'Docente record successfully deleted';
    }
}
