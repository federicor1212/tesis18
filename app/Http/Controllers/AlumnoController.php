<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;

class AlumnoController extends Controller
{
    public function index($id = null) {
      
      if ($id == null){
        return Alumno::all();
      } else {
        return Alumno::find($id);
      }
    }

    public function show($id) {
        return Alumno::find($id);
    }

    public function store(Request $request) {
        $alumno = new Alumno;
        $alumno->nombre = $request->input('nombre');
        $alumno->apellido = $request->input('apellido');
        $alumno->telefono = $request->input('telefono');
        $alumno->email = $request->input('email');
        $alumno->matricula = $request->input('matricula');
        $alumno->save();
        return 'Alumno record successfully created with id' . $alumno->id;
    }
    
    public function update(Request $request, $id) {
        $alumno = Alumno::find($id);
        $alumno->nombre = $request->input('nombre');
        $alumno->apellido = $request->input('apellido');
        $alumno->telefono = $request->input('telefono');
        $alumno->email = $request->input('email');
        $alumno->matricula = $request->input('matricula');
        $alumno->save();
        return 'Alumno record successfully updated with id ' . $alumno->id;
    }
    public function destroy($id) {
        $alumno = Alumno::find($id)->delete();
        return 'Alumno record successfully deleted';
    }
}
