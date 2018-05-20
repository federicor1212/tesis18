<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inscripto;
use App\Materia;
use App\Alumno;
use App\Dictado;

class InscriptoController extends Controller
{
    public function index($id = null) {
      
      if ($id == null){
        $materias = Materia::all();
        $alumno = Alumno::all();
        $inscripciones = Inscripto::all();
        $dictados = Dictado::all();

        foreach ($inscripciones as $insc) {
            $insc['alumno'] = $alumno->find($insc['id_alumno']);
            $insc['dictado'] = $dictados->find($insc['id_dictado']);
            $insc['materia'] = $materias->find($insc['dictado']->id_materia);
            unset($insc['dictado']);
        }

        return $inscripciones;
      } else {
        return Inscripto::find($id);
      }
    }

    public function show($id) {
        return Inscripto::find($id);
    }

    public function store(Request $request) {
        $inscripto = new Inscripto;
        $inscripto->id_alumno = $request->input('id_alumno');
        $inscripto->id_dictado = $request->input('id_dictado');
        $inscripto->cant_faltas_act = $request->input('cant_faltas_act');
        $inscripto->save();
        return 'Inscripto record successfully created with id' . $inscripto->id;
    }
    
    public function update(Request $request, $id) {
        $inscripto = Inscripto::find($id);
        $inscripto->id_alumno = $request->input('id_alumno');
        $inscripto->id_dictado = $request->input('id_dictado');
        $inscripto->cant_faltas_act = $request->input('cant_faltas_act');
        $inscripto->save();
        return 'Inscripto record successfully updated with id ' . $inscripto->id;
    }
    public function destroy($id) {
        try {
            $inscripto = Inscripto::find($id)->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            var_dump('PEPE'.$e);
            return false;
        }
        return 'Inscripto record successfully deleted';
    }
}
