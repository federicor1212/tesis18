<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dictado;
use App\Materia; 
use App\DictadoClase;
use App\Dia;
use App\Alternativa;
use Carbon\Carbon;
use DB;

class DictadosClasesController extends Controller
{
    public function index($id = null) {
        $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }  

        /*$dictado = Dictado::join('materias','dictados.id_materia','=','materias.id')
                 ->join('dictados_clases','dictados.id','=','dictados_clases.id_dictado')
                 ->join('carreras','materias.id_carrera','=','carreras.id')
                 ->join('alternativas','dictados_clases.id_alternativa','=','alternativas.id')
                 ->join('dias','dictados_clases.id_dia','=','dias.id')
                 ->select('carreras.id as id_carrera','carreras.desc_carr','dictados.id','materias.id AS id_materia','materias.desc_mat','dictados.cuat','dictados.ano','dias.id AS id_dia','dias.descripcion As dia_cursada','alternativas.id AS id_alternativa','alternativas.codigo AS alt_hor','dictados_clases.id AS id_dictado_clase')
                 ->where('dictados.id','=',$id)
                 ->get();*/

        $dictado = Dictado::join('materias','dictados.id_materia','=','materias.id')
                 ->join('carreras','materias.id_carrera','=','carreras.id')
                 ->select('carreras.id as id_carrera','carreras.desc_carr','dictados.id','materias.id AS id_materia','materias.desc_mat','dictados.cuat','dictados.ano')
                 ->where('dictados.id','=',$id)
                 ->get();              

        return $dictado;
    }

    public function alternativasSel($id = null) {
        $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }  

        $data = [];

        $myObj = new \StdClass();
        $myObj->dia = 'lunes';
        $myObj->alt = null;
        $data[0] = $myObj;

        $myObj = new \StdClass();
        $myObj->dia = 'martes';
        $myObj->alt = null;
        $data[1] = $myObj;

        $myObj = new \StdClass();
        $myObj->dia = 'miercoles';
        $myObj->alt = null;
        $data[2] = $myObj;

        $myObj = new \StdClass();
        $myObj->dia = 'jueves';
        $myObj->alt = null;
        $data[3] = $myObj;

        $myObj = new \StdClass();
        $myObj->dia = 'viernes';
        $myObj->alt = null;
        $data[4] = $myObj;

        $myObj = new \StdClass();
        $myObj->dia = 'sabado';
        $myObj->alt = null;
        $data[5] = $myObj;

        $myObj = new \StdClass();
        $myObj->dia = 'domingo';
        $myObj->alt = null;
        $data[6] = $myObj;
        

        $dictado = Dictado::join('dictados_clases','dictados.id','=','dictados_clases.id_dictado')
                 ->join('alternativas','dictados_clases.id_alternativa','=','alternativas.id')
                 ->join('dias','dictados_clases.id_dia','=','dias.id')
                 ->select('dias.descripcion As dia_cursada','alternativas.codigo AS cod_alt')
                 ->where('dictados.id','=',$id)
                 ->get();

        foreach ($dictado as $result) {    

            if ($result->dia_cursada == "lunes"){
                $data[0]->alt = $result->cod_alt;
            }
            if ($result->dia_cursada == "martes"){
                $data[1]->alt = $result->cod_alt;
            }
            if ($result->dia_cursada == "miercoles"){
                $data[2]->alt = $result->cod_alt;
            }
            if ($result->dia_cursada == "jueves"){
                $data[3]->alt = $result->cod_alt;
            }
            if ($result->dia_cursada == "viernes"){
                $data[4]->alt = $result->cod_alt;
            }
            if ($result->dia_cursada == "sabado"){
                $data[5]->alt = $result->cod_alt;
            }
            if ($result->dia_cursada == "domingo"){
                $data[6]->alt = $result->cod_alt;
            }      
        }

        return $data;
    }

    //PASAR ID DE DICTADO
    public function update(Request $request) {

        //Arreglo Original.    

        //Arreglo Final.
        $altUpd = $request->all(); //true devuelve un arreglo asociativo.
        $id_dictado = $altUpd[7][0]['idDictado'];
        $altAux = $this->alternativasSel($id_dictado);

        $cant_record = count($altUpd);
        $cant_record-=1;
        //Recorro el Arreglo Final.
        for ($i=0 ; $i<$cant_record ; $i++){

            /*---------------------------------------------------------------*/
            //Obtengo el id del día Original/Final es el mismo.
            $obj = Dia::where('descripcion', '=',$altAux[$i]->dia)
                           ->select('id')
                           ->get();
            $originalDiaId = $obj[0]->id;

            //Obtengo el id de la alternativa Final.
            $obj = Alternativa::where('codigo', '=',$altUpd[$i]['alt'])
                           ->select('id')
                           ->get();
            
            if ($obj->count()){
                $finalAltId = $obj[0]->id;
            }else{
                $finalAltId = null;
            }
              
            /*---------------------------------------------------------------*/  

            if ($altUpd[$i]['alt'] != $altAux[$i]->alt){

                if ($altUpd[$i]['alt'] == null){
                    //Eliminar asociación original.
                     $dictadoClase = DictadoClase::where('id_dictado', $id_dictado)
                                   ->where('id_dia', $originalDiaId)   
                                   ->delete();
                }else{

                    if ($altAux[$i]->alt == null){
                        //Insertar Alternativa.
                        $dictadoClase = new DictadoClase;
                        $dictadoClase->id_dictado = $id_dictado;
                        $dictadoClase->id_dia = $originalDiaId;
                        $dictadoClase->id_alternativa = $finalAltId;
                        $dictadoClase->save();   

                    }else{
                        //Actualizar Alternativa
                        $dictadoClase = DictadoClase::where('id_dictado', $id_dictado)
                                      ->where('id_dia', $originalDiaId)
                                      ->update(['id_alternativa' => $finalAltId]);
                    }
                }

            }
        }
      return 'true';
    }
      
}
