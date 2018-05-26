<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dictado;
use App\Materia; 
use App\Asignado;
use App\DictadosClases;
use App\Dia;
use Carbon\Carbon;
use DB;

class DictadoController extends Controller
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
        
        $dictado = Dictado::join('materias','dictados.id_materia','=','materias.id')
                 ->join('dictados_clases','dictados.id','=','dictados_clases.id_dictado')
                 ->join('alternativas','dictados_clases.id_alternativa','=','alternativas.id')
                 ->join('dias','dictados_clases.id_dia','=','dias.id')
                 ->select('dictados.id','materias.id AS id_materia','materias.desc_mat','dictados.cuat','dictados.ano','dias.id AS id_dia','dias.descripcion As dia_cursada','alternativas.id AS id_alternativa','alternativas.codigo AS alt_hor','dictados.fecha_inicio','dictados.fecha_fin','dictados.cant_insc_act','dictados.cant_clases','dictados.cant_faltas_max')
                 ->get();

        return $dictado;
      } else {
        return Dictado::find($id);
      }
    }

    public function dictadosSinProfesor(){
        $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }
        $allDictados = Dictado::all();
        $allAsignados = Asignado::select(DB::raw('id_dictado, count(id_dictado) as cant_asignada'))->groupBy('id_dictado')->get();

        foreach ($allDictados as $dict) {
            $lookupDictado = $allAsignados->where('id_dictado',$dict['id'])->first();
            $dict['materia'] = Materia::where('id',$dict['id_materia'])->first();
            if (count($lookupDictado) > 0) {
                if ($lookupDictado['cant_asignada'] < 2) {
                    $dictadoToDisplay[] = $dict;
                }
            } else {
                $dictadoToDisplay[] = $dict;
            }
        }

        return $dictadoToDisplay;
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

        return Dictado::find($id);
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

        $dictado = new Dictado;
        $dictado->id_materia = $request->input('id_materia');
        $dictado->cuat = $request->input('cuat');
        $dictado->ano = $request->input('ano');
        /*$dictado->id_dia = $request->input('id_dia');
        $dictado->id_alternativa = $request->input('id_alternativa');*/
        $dictado->cant_insc_act = $request->input('cant_insc_act');
        $dictado->cant_clases = $request->input('cant_clases');
        $dictado->cant_faltas_max = $request->input('cant_faltas_max');
        $dictado->fecha_inicio = $request->input('fecha_inicio');
        $dictado->fecha_fin = $request->input('fecha_fin');
        $dictado->save();
        return 'Dictado record successfully created with id' . $dictado->id;
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

        $dictadoClase = DictadoClase::where('id_dictado', $id)
                      ->update(['id_alternativa' => $request->input('id_alternativa'), 
                                'id_dia' => $request->input('id_dia')]
                              );


        $dictado = Dictado::find($id);
        $dictado->id_materia = $request->input('id_materia');
        $dictado->ano = $request->input('ano');
        $dictado->cuat = $request->input('cuat');
        $dictado->cant_insc_act = $request->input('cant_insc_act');
        $dictado->cant_clases = $request->input('cant_clases');
        $dictado->cant_faltas_max = $request->input('cant_faltas_max');
        $dictado->fecha_inicio = $request->input('fecha_inicio');
        $dictado->fecha_fin = $request->input('fecha_fin');
        $dictado->save();

        return 'Dictado record successfully updated with id ' . $dictado->id;
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
          
        $dictado = Dictado::find($id)->delete();
        return 'Dictado record successfully deleted';
    }
}
