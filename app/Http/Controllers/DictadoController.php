<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dictado;
use App\Materia; 
use App\Asignado;
use App\DictadoClase;
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
                 ->join('carreras','materias.id_carrera','=','carreras.id')
                 ->join('alternativas','dictados_clases.id_alternativa','=','alternativas.id')
                 ->join('dias','dictados_clases.id_dia','=','dias.id')
                 ->select('carreras.id as id_carrera','carreras.desc_carr','dictados.id','materias.id AS id_materia','materias.desc_mat','dictados.cuat','dictados.ano','dias.id AS id_dia','dias.descripcion As dia_cursada','alternativas.id AS id_alternativa','alternativas.codigo AS alt_hor','dictados.fecha_inicio','dictados.fecha_fin','dictados.cant_insc_act','dictados.cant_clases','dictados.cant_faltas_max','dictados_clases.id AS id_dictado_clase')
                 ->groupby('dictados.id')
                 ->orderby('materias.desc_mat', 'dictados.ano', 'dictados.cuat')
                 ->get();

        return $dictado;
      } else {
        return Dictado::find($id);
      }
    }

    public function consultar(Request $request){
      $materia = $request->input('id_materia');
      $cuat = $request->input('cuat');
      $ano = $request->input('ano');

      $result = Dictado::where('id_materia',$materia)->where('cuat',$cuat)->where('ano',$ano)->first();

      return $result;
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
        $date = Carbon::now();

        if ($date->month >= 1 && $date->month <=7) {
          $cuat = 1;
        } else {
          $cuat = 2;
        }
        $allDictados = Dictado::join('materias','dictados.id_materia','=','materias.id')
                        ->join('dictados_clases','dictados.id','dictados_clases.id_dictado')
                        ->join('carreras','materias.id_carrera','carreras.id')
                        ->where('dictados.ano','=',$date->year) 
                        ->where('dictados.cuat','=',$cuat)
                        ->select('dictados.id AS id','materias.desc_mat','dictados.cuat','dictados.ano','carreras.desc_carr')
                        ->groupby('dictados.id')
                        ->get(); 
        

        return $allDictados;
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
        
        $dateInicio = $request->input('fecha_inicio');
        $dateFin = $request->input('fecha_fin');

        $existeMateria = Dictado::where('id_materia',$request->input('id_materia'))->where('cuat',$request->input('cuat'))
                         ->where('ano',$request->input('ano'))->first();        

        if (count($existeMateria) == 0) {
          $dictado = new Dictado;
          $dictado->id_materia = $request->input('id_materia');
          $dictado->ano = $request->input('ano');
          $dictado->cuat = $request->input('cuat');
          $dictado->cant_insc_act = $request->input('cant_insc_act');
          $dictado->cant_clases = $request->input('cant_clases');
          $dictado->cant_faltas_max = $request->input('cant_faltas_max');
          $dictado->fecha_inicio = date('Y-m-d', strtotime($dateInicio));
          $dictado->fecha_fin = date('Y-m-d', strtotime($dateFin));
          $dictado->save();
          
          $dictadoClase = new DictadoClase;
          $dictadoClase->id_dictado = $dictado->id;
          $dictadoClase->id_dia = $request->input('id_dia');
          $dictadoClase->id_alternativa = $request->input('id_alternativa');
          $dictadoClase->save();
          return 'Dictado record successfully created with id' . $dictado->id;
        } else {
          $dictadoClase = new DictadoClase;
          $dictadoClase->id_dictado = $existeMateria->id;
          $dictadoClase->id_dia = $request->input('id_dia');
          $dictadoClase->id_alternativa = $request->input('id_alternativa');
          $dictadoClase->save();
          return 'Dictado record successfully created with id' . $dictadoClase->id;
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

        $dictadoClase = DictadoClase::find($request->input('id_dictado_clase'));
        $dictadoClase->id_alternativa = $request->input('id_alternativa');
        $dictadoClase->id_dia = $request->input('id_dia');
        $dictadoClase->save();

        $dateInicio = $request->input('fecha_inicio');
        $dateFin = $request->input('fecha_fin');
        $dictado = Dictado::find($id);
        $dictado->id_materia = $request->input('id_materia');
        $dictado->ano = $request->input('ano');
        $dictado->cuat = $request->input('cuat');
        $dictado->cant_insc_act = $request->input('cant_insc_act');
        $dictado->cant_clases = $request->input('cant_clases');
        $dictado->cant_faltas_max = $request->input('cant_faltas_max');
        $dictado->fecha_inicio = date('Y-m-d', strtotime($dateInicio));
        $dictado->fecha_fin = date('Y-m-d', strtotime($dateFin));
        $dictado->save();

        return 'Dictado record successfully updated with id ' . $dictado->id;
    }

    public function destroy(Request $request) {
        $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }
        
        try {
            DB::beginTransaction();
            
            $dictadoClase = DictadoClase::find($request->input('id_dictado_clase'));
            $dictadoClase->delete();

            $qtyDictadosClases = DictadoClase::join('dictados','dictados_clases.id_dictado','=','dictados.id')
                              ->where('dictados_clases.id_dictado', '=',$request->input('id'))                
                              ->select(DB::raw('count(1) AS qty'))
                              ->get();

            foreach ($qtyDictadosClases as $value) {    
                /*Si se elimina el último dictado clase tmb tengo que eliminar el dictado!*/
                if($value->qty == 0)
                    $dictado = Dictado::find($request->input('id'))->delete();
            }

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        };
    
    }    
}
