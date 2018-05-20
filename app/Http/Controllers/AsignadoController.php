<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asignado;
use App\Docente;
use App\Materia;
use App\Dictado;

class AsignadoController extends Controller
{
    public function index($id = null) {
      if ($id == null){
        $asignado = Asignado::all();
        $docentes = Docente::all();
        $materias = Materia::all();

        foreach ($asignado as $asign) {
            $asign['docente'] = $docentes->find($asign['id_docente']);
            $dictInfo = Dictado::where('id',$asign['id_dictado'])->first();
            $asign['dictado'] = $dictInfo;
            $asign['materia'] = $materias->find($dictInfo['id_materia']);
            unset($asign['dictado']);
        }
        return $asignado;
      } else {
        return Asignado::find($id);
      }
    }

    public function show($id) {
        return Asignado::find($id);
    }

    public function store(Request $request) {
        $asignado = new Asignado;
        $asignado->id_dictado = $request->input('id_materia');
        $asignado->id_docente = $request->input('id_docente');
        if ($request->input('id_cargo') == 1) {
            $asignado->desc_cargo = 'Titular';
        } else {
            $asignado->desc_cargo = 'Suplente';
        }
        $asignado->save();
        return 'Asignado record successfully created with id' . $asignado->id;
    }
    
    public function update(Request $request, $id) {
        $asignado = Asignado::find($id);
        $asignado->id_dictado = $request->input('id_dictado');
        $asignado->id_docente = $request->input('id_docente');
        $asignado->desc_cargo = $request->input('desc_cargo');
        $asignado->save();
        return 'Asignado record successfully updated with id ' . $asignado->id;
    }
    
    public function destroy($id) {
        $asignado = Asignado::find($id)->destroy();
        return 'Asignado record successfully deleted';
    }
}
