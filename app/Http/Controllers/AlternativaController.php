<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alternativa;

class AlternativaController extends Controller
{
    public function index($id = null) {
      
      if ($id == null){
        return Alternativa::all();
      } else {
        return Alternativa::find($id);
      }
    }

    public function show($id) {
        return Alternativa::find($id);
    }

    public function store(Request $request) {
        $alternativa = new Alternativa;
        $alternativa->codigo = $request->input('codigo');
        $alternativa->descripcion = $request->input('descripcion');
        $alternativa->save();
        return 'alternativa record successfully created with id' . $alternativa->id;
    }
    
    public function update(Request $request, $id) {
        $alternativa = Alternativa::find($id);
        $alternativa->codigo = $request->input('codigo');
        $alternativa->descripcion = $request->input('descripcion');
        $alternativa->save();
        return 'alternativa record successfully updated with id ' . $alternativa->id;
    }
    public function destroy($id) {
        $alternativa = Alternativa::find($id)->delete();
        return 'alternativa record successfully deleted';
    }
}
