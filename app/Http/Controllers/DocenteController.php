<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Docente;
use App\Usuario;
use App\Enums\Status;

class DocenteController extends Controller
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
        $usuario = Usuario::all();
        $docente = Docente::all();
        

        foreach ($docente as $doc) {
            $doc['usuarios'] = $usuario->find($doc['id_usuario']);
            if ($doc['usuarios']->estado == Status::ACTIVO) {
                $doc['estado'] = 'Activo';
            } else {
                $doc['estado'] = 'Inactivo';
            }
            unset($doc['usuarios']);
        }
        return $docente;
      } else {
        return Docente::find($id);
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
        return Docente::find($id);
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
        $docente = new Docente;
        $docente->id_usuario = $request['docente']['id'];
        $docente->nombre = $request->input('nombre');
        $docente->apellido = $request->input('apellido');
        $docente->telefono = $request->input('telefono');
        $docente->save();
        return 'Docente record successfully created with id' . $docente->id;
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

        $docente = Docente::find($id);
        $docente->nombre = $request->input('nombre');
        $docente->apellido = $request->input('apellido');
        $docente->telefono = $request->input('telefono');
        $docente->save();
        return 'Docente record successfully updated with id ' . $docente->id;
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

        $docente = Docente::find($id)->delete();
        return 'Docente record successfully deleted';
    }
}
