<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
use App\Carrera;

class MateriaController extends Controller
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

    public function getMateriasCarrera($id) {
      $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

      $materiasSelected = Materia::where('id_carrera',$id)->get();

      return $materiasSelected;
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

        return Materia::find($id);
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
        
        $request = $request->all();

        $idCarrera = Carrera::where('desc_carr',$request['carrera']['desc_carr'])->first();
        $materia = new Materia();
        $materia->id_carrera = $idCarrera->id;
        $materia->desc_mat = $request['desc_mat'];
        $planCheck = Carrera::where('desc_carr',$request['carrera']['desc_carr'])->where('plan',$request['carrera']['plan'])->first();

          $materia->plan = $request['carrera']['plan'];
          return 'Materia record successfully created with id' . $materia->id;
        } else {
          return response()->json($materia, 500);
        }
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

        $materia = Materia::find($id);

        $request = $request->all();

        $idCarrera = Carrera::where('desc_carr',$request['carrera']['desc_carr'])->first();

        $materia->id_carrera = $idCarrera->id;
        $materia->desc_mat = $request['desc_mat'];
        $materia->save();
        return 'Materia record successfully updated with id ' . $materia->id;
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
          
        $materia = Materia::find($id)->delete();
        return 'Materia record successfully deleted';
    }
}
