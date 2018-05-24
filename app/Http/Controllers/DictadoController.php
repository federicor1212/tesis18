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

      if ($id == null){
        
        $dictado = Dictado::join('materias','dictados.id_materia','=','materias.id')
                 ->join('dictados_clases','dictados.id','=','dictados_clases.id_dictado')
                 ->join('alternativas','dictados_clases.id_alternativa','=','alternativas.id')
                 ->join('dias','dictados_clases.id_dia','=','dias.id')
                 ->select('dictados.id','materias.desc_mat','dictados.cuat','dictados.ano','dias.descripcion As dia_cursada','alternativas.codigo AS alt_hor','dictados.fecha_inicio','dictados.fecha_fin','dictados.cant_insc_act','dictados.cant_clases','dictados.cant_faltas_max')
                 ->get();

        return $dictado;
      } else {
        return Dictado::find($id);
      }
    }

    public function dictadosSinProfesor(){
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
        return Dictado::find($id);
    }

    public function store(Request $request) {
        $dictado = new Dictado;
        $dictado->id_materia = $request->input('id_materia');
        $dictado->cuat = $request->input('cuat');
        $dictado->ano = $request->input('ano');
        $dictado->dia_cursada = $request->input('dia_cursada');
        $dictado->alt_hor = $request->input('alt_hor');
        $dictado->cant_insc_act = $request->input('cant_insc_act');
        $dictado->cant_clases = $request->input('cant_clases');
        $dictado->cant_faltas_max = $request->input('cant_faltas_max');
        $dictado->fecha_inicio = $request->input('fecha_inicio');
        $dictado->fecha_fin = $request->input('fecha_fin');
        $dictado->save();
        return 'Dictado record successfully created with id' . $dictado->id;
    }
    
    public function update(Request $request, $id) {
        $dictado = Dictado::find($id);
        $dictado->cuat = $request->input('cuat');
        $dictado->ano = $request->input('ano');
        $dictado->dia_cursada = $request->input('dia_cursada');
        $dictado->alt_hor = $request->input('alt_hor');
        $dictado->cant_insc_act = $request->input('cant_insc_act');
        $dictado->cant_clases = $request->input('cant_clases');
        $dictado->cant_faltas_max = $request->input('cant_faltas_max');
        $dictado->fecha_inicio = $request->input('fecha_inicio');
        $dictado->fecha_fin = $request->input('fecha_fin');
        $dictado->save();
        return 'Dictado record successfully updated with id ' . $dictado->id;
    }
    public function destroy($id) {
        $dictado = Dictado::find($id)->delete();
        return 'Dictado record successfully deleted';
    }
}
