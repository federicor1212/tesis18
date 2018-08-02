<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dictado;
use App\Materia; 
use App\DictadoClase;
use App\Dia;
use Carbon\Carbon;
use DB;

class DictadosClasesController extends Controller
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

        $dictado = Dictado::join('materias','dictados.id_materia','=','materias.id')
                 ->join('dictados_clases','dictados.id','=','dictados_clases.id_dictado')
                 ->join('carreras','materias.id_carrera','=','carreras.id')
                 ->join('alternativas','dictados_clases.id_alternativa','=','alternativas.id')
                 ->join('dias','dictados_clases.id_dia','=','dias.id')
                 ->select('carreras.id as id_carrera','carreras.desc_carr','dictados.id','materias.id AS id_materia','materias.desc_mat','dictados.cuat','dictados.ano','dias.id AS id_dia','dias.descripcion As dia_cursada','alternativas.id AS id_alternativa','alternativas.codigo AS alt_hor','dictados_clases.id AS id_dictado_clase')
                 ->where('dictados.id','=',$id)
                 ->get();

        return $dictado;
    }

      
}
