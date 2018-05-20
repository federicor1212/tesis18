<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrera;

class CarreraController extends Controller
{
    public function index($id = null) {
      
      if ($id == null){
        return Carrera::all();
      } else {
        return Carrera::find($id);
      }
    }

    public function show($id) {
        return Carrera::find($id);
    }

    public function store(Request $request) {
        $carrera = new Carrera;
        $carrera->desc_carr = $request->input('desc_carr');
        $carrera->plan = $request->input('plan');
        $carrera->save();
        return 'Carrera record successfully created with id' . $carrera->id;
    }
    
    public function update(Request $request, $id) {
        $carrera = Carrera::find($id);
        $carrera->desc_carr = $request->input('desc_carr');
        $carrera->plan = $request->input('plan');
        $carrera->save();
        return 'Carrera record successfully updated with id ' . $carrera->id;
    }
    public function destroy($id) {
        $carrera = Carrera::find($id)->delete();
        return 'Carrera record successfully deleted';
    }
}
