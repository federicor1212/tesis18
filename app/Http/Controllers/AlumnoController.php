<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;

class AlumnoController extends Controller
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
        return Alumno::all();
      } else {
        return Alumno::find($id);
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

        return Alumno::find($id);
    }

    public function store(Request $request) {
        $auth = new UsuarioController;
          $request = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($request);
          $userData = json_decode($token->getContent());

          if(isset($userData->error)){
              return response()->json($userData, $token->status());
          }

        $alumno = new Alumno;
        $alumno->nombre = $request->input('nombre');
        $alumno->apellido = $request->input('apellido');
        $alumno->telefono = $request->input('telefono');
        $alumno->email = $request->input('email');
        $alumno->matricula = $request->input('matricula');
        $alumno->save();
        return 'Alumno record successfully created with id' . $alumno->id;
    }
    
    public function update(Request $request, $id) {
        $auth = new UsuarioController;
          $request = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($request);
          $userData = json_decode($token->getContent());

          if(isset($userData->error)){
              return response()->json($userData, $token->status());
          }

        $alumno = Alumno::find($id);
        $alumno->nombre = $request->input('nombre');
        $alumno->apellido = $request->input('apellido');
        $alumno->telefono = $request->input('telefono');
        $alumno->email = $request->input('email');
        $alumno->matricula = $request->input('matricula');
        $alumno->save();
        return 'Alumno record successfully updated with id ' . $alumno->id;
    }
    public function destroy($id) {
        $auth = new UsuarioController;
          $request = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($request);
          $userData = json_decode($token->getContent());

          if(isset($userData->error)){
              return response()->json($userData, $token->status());
          }
          
        $alumno = Alumno::find($id)->delete();
        return 'Alumno record successfully deleted';
    }
}
