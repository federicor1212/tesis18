<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AsistenciaCurso;

class AsistenciaCursoController extends Controller
{
    public function index($id = null) {
      
      if ($id == null){
        return AsistenciaCurso::all();
      } else {
        return AsistenciaCurso::find($id);
      }
    }

    public function show($id) {
        return AsistenciaCurso::find($id);
    }

    public function store(Request $request) {
        $asistenciaCurso = new AsistenciaCurso;
        $asistenciaCurso->id_dictado = $request->input('id_dictado');
        $asistenciaCurso->id_docente = $request->input('id_docente');
        $asistenciaCurso->estado_curso = $request->input('estado_curso');
        $asistenciaCurso->save();
        return 'AsistenciaCurso record successfully created with id' . $asistenciaCurso->id;
    }
    
    public function update(Request $request, $id) {
        $asistenciaCurso = AsistenciaCurso::find($id);
        $asistenciaCurso->id_dictado = $request->input('id_dictado');
        $asistenciaCurso->id_docente = $request->input('id_docente');
        $asistenciaCurso->estado_curso = $request->input('estado_curso');
        $asistenciaCurso->save();
        return 'AsistenciaCurso record successfully updated with id ' . $asistenciaCurso->id;
    }
    public function destroy($id) {
        $asistenciaCurso = AsistenciaCurso::find($id)->delete();
        return 'AsistenciaCurso record successfully deleted';
    }
}
