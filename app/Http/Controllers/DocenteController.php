<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Docente;

class DocenteController extends Controller
{
    public function index($id = null) {
      
      if ($id == null){
        return Docente::all()->toArray();
      } else {
        return Docente::find($id);
      }
    }

    public function show($id) {
        return Docente::find($id);
    }

    public function store(Request $request) {
        $docente = new Docente;
        $docente->id_usuario = $request->input('id_usuario');
        $docente->nombre = $request->input('nombre');
        $docente->apellido = $request->input('apellido');
        $docente->telefono = $request->input('telefono');
        $docente->save();
        return 'Docente record successfully created with id' . $docente->id;
    }
    
    public function update(Request $request, $id) {
        $docente = Docente::find($id);
        $docente->id_usuario = $request->input('id_usuario');
        $docente->nombre = $request->input('nombre');
        $docente->apellido = $request->input('apellido');
        $docente->telefono = $request->input('telefono');
        $docente->save();
        return 'Docente record successfully updated with id ' . $docente->id;
    }
    public function destroy($id) {
        $docente = Docente::find($id)->delete();
        return 'Docente record successfully deleted';
    }
}
