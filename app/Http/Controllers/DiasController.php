<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dias;

class DiasController extends Controller
{
    public function index($id = null) {
      $auth = new UsuarioController;
          $requestUser = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($requestUser);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

      if ($id == null){
        return Dias::all();
      } else {
        return Dias::find($id);
      }
    }

    public function show($id) {
        $auth = new UsuarioController;
          $requestUser = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($requestUser);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

        return Dias::find($id);
    }

    public function store(Request $request) {
        $auth = new UsuarioController;
          $requestUser = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($requestUser);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

        $Dias = new Dias;
        $Dias->desc_carr = $request->input('desc_carr');
        $Dias->plan = $request->input('plan');
        $Dias->save();
        return 'Dias record successfully created with id' . $Dias->id;
    }
    
    public function update(Request $request, $id) {
        $auth = new UsuarioController;
          $requestUser = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($requestUser);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

        $Dias = Dias::find($id);
        $Dias->desc_carr = $request->input('desc_carr');
        $Dias->plan = $request->input('plan');
        $Dias->save();
        return 'Dias record successfully updated with id ' . $Dias->id;
    }

    public function destroy($id) {
        $auth = new UsuarioController;
          $requestUser = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($requestUser);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }
          
        $Dias = Dias::find($id)->delete();
        return 'Dias record successfully deleted';
    }
}
