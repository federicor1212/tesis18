<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
use App\Carrera;

class MateriaController extends Controller
{
    public function index($id = null) {
      
      if ($id == null){
        $materia = Materia::all();
        $carrera = Carrera::all();

        foreach ($materia as $mat) {
            $mat['carrera'] = $carrera->find($mat['id_carrera']);
        }
        return $materia;
      } else {
        return Materia::find($id);
      }
    }

    public function show($id) {
        return Materia::find($id);
    }

    public function store(Request $request) {
        $materia = new Materia;
        $materia->id_carrera = $request->input('id_carrera');
        $materia->desc_mat = $request->input('desc_mat');
        $materia->save();
        return 'Materia record successfully created with id' . $materia->id;
    }
    
    public function update(Request $request, $id) {
        $materia = Materia::find($id);
        $materia->id_carrera = $request->input('id_carrera');
        $materia->desc_mat = $request->input('desc_mat');
        $materia->save();
        return 'Materia record successfully updated with id ' . $materia->id;
    }
    public function destroy($id) {
        $materia = Materia::find($id)->delete();
        return 'Materia record successfully deleted';
    }
}
