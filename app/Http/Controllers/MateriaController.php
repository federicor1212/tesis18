<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
use App\Carrera;

class MateriaController extends Controller
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
        $materia = Materia::all();
        $carrera = Carrera::all();

        foreach ($materia as $mat) {
            $mat['carrera'] = $carrera->find($mat['id_carrera']);
        }
        return $materia;
      } else {
        return Materia::find($id);
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

        return Materia::find($id);
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

        $materia = new Materia;
        $materia->id_carrera = $request->input('id_carrera');
        $materia->desc_mat = $request->input('desc_mat');
        $materia->save();
        return 'Materia record successfully created with id' . $materia->id;
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

        $materia = Materia::find($id);
        $materia->id_carrera = $request->input('id_carrera');
        $materia->desc_mat = $request->input('desc_mat');
        $materia->save();
        return 'Materia record successfully updated with id ' . $materia->id;
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
          
        $materia = Materia::find($id)->delete();
        return 'Materia record successfully deleted';
    }
}
