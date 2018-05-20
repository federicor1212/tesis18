<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asistente;

class AsistenteController extends Controller
{
    public function index($id = null) {
      
      if ($id == null){
        return Asistente::all();
      } else {
        return Asistente::find($id);
      }
    }

    public function show($id) {
        return Asistente::find($id);
    }

    public function store(Request $request) {
        $asistente = new Asistente;
        $asistente->id_alumno = $request->input('id_alumno');
        $asistente->id_dictado = $request->input('id_dictado');
        $asistente->fecha_clase = $request->input('fecha_clase');
        $asistente->cod_asist = $request->input('cod_asist');
        $asistente->save();
        return 'Asistente record successfully created with id' . $asistente->id;
    }
    
    public function update(Request $request, $id) {
        $asistente = Asistente::find($id);
        $asistente->id_alumno = $request->input('id_alumno');
        $asistente->id_dictado = $request->input('id_dictado');
        $asistente->fecha_clase = $request->input('fecha_clase');
        $asistente->cod_asist = $request->input('cod_asist');
        $asistente->save();
        return 'Asistente record successfully updated with id ' . $asistente->id;
    }
    public function destroy($id) {
        $asistente = Asistente::find($id)->delete();
        return 'Asistente record successfully deleted';
    }
}
