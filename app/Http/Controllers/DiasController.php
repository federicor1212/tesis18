<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dias;

class DiasController extends Controller
{
    public function index($id = null) {
      
      if ($id == null){
        return Dias::all();
      } else {
        return Dias::find($id);
      }
    }

    public function show($id) {
        return Dias::find($id);
    }

    public function store(Request $request) {
        $Dias = new Dias;
        $Dias->desc_carr = $request->input('desc_carr');
        $Dias->plan = $request->input('plan');
        $Dias->save();
        return 'Dias record successfully created with id' . $Dias->id;
    }
    
    public function update(Request $request, $id) {
        $Dias = Dias::find($id);
        $Dias->desc_carr = $request->input('desc_carr');
        $Dias->plan = $request->input('plan');
        $Dias->save();
        return 'Dias record successfully updated with id ' . $Dias->id;
    }
    public function destroy($id) {
        $Dias = Dias::find($id)->delete();
        return 'Dias record successfully deleted';
    }
}
