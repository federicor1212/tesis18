<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alternativa;

class AlternativaController extends Controller
{
    public function index($id = null) {
      $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if (!isset($token['id'])) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }
      if ($id == null){
        return Alternativa::all();
      } else {
        return Alternativa::find($id);
      }
    }

    public function show($id) {
        $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if (!isset($token['id'])) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }
        return Alternativa::find($id);
    }

    public function store(Request $request) {
        $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if (!isset($token['id'])) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }
        $alternativa = new Alternativa;
        $alternativa->codigo = $request->input('codigo');
        $alternativa->descripcion = $request->input('descripcion');
        $alternativa->save();
        return 'alternativa record successfully created with id' . $alternativa->id;
    }
    
    public function update(Request $request, $id) {
        $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if (!isset($token['id'])) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }
        $alternativa = Alternativa::find($id);
        $alternativa->codigo = $request->input('codigo');
        $alternativa->descripcion = $request->input('descripcion');
        $alternativa->save();
        return 'alternativa record successfully updated with id ' . $alternativa->id;
    }

    public function destroy($id) {
        $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if (!isset($token['id'])) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }
        $alternativa = Alternativa::find($id)->delete();
        return 'alternativa record successfully deleted';
    }
}
