<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Usuario;
use App\Docente;
use App\Inscripto;
use App\AsistenciaCurso;
use App\DictadoClase;
use App\Asistente;
use Carbon\Carbon;

class ReportesController extends Controller
{
    public function loadReports(Request $request) {
        $auth = new UsuarioController;
          $userRequest = new \Illuminate\Http\Request();
          $token = $auth->getAuthenticatedUser($userRequest);
          if ($token instanceof \Illuminate\Http\JsonResponse) {
            $userData = json_decode($token->getContent());
            if(isset($userData->error)){
                return response()->json($userData, $token->status());
            }
          }

        $id_carrera = $request->input('idCarrera');
        $id_materia = $request->input('idMateria');
        $ano = $request->input('ano');
        $cuat = $request->input('cuat');

        
        $result = new \StdClass();
        $result->asist = $this->cantAsistencias($id_carrera,$id_materia,$ano,$cuat);
        $result->inscr = $this->cantInscriptos($id_carrera,$ano,$cuat);
        $result->libre = $this->cantAlumnosLibres($id_carrera,$ano,$cuat);
        
        return json_encode($result);
    }

    public function cantAsistencias($id_carrera,$id_materia,$ano,$cuat) {  
        $result = new \StdClass();
        
        $empty = 0;
        
        $myObj = new \StdClass();
        $myObj->cols=[];
        $myObj->rows=[];
       
        $myObj->cols[0] = new \StdClass();
        $myObj->cols[0]->id = "insc";
        $myObj->cols[0]->label = "Inscriptos1";
        $myObj->cols[0]->type = "string";
    
        $myObj->cols[1] = new \StdClass();
        $myObj->cols[1]->id = "insc";
        $myObj->cols[1]->label = "Inscriptos2";
        $myObj->cols[1]->type = "string";
        
        if ($id_materia != "") {
        /*PRESENTES*/
        $presentes = Asistente::join('dictados','asistentes.id_dictado','=','dictados.id')
            ->join('materias','dictados.id_materia','=','materias.id')      
            ->where('materias.id_carrera', '=',$id_carrera)
            ->where('materias.id', '=',$id_materia)
            ->where('asistentes.cod_asist', '=','0')
            ->where('dictados.ano', '=',$ano)
            ->where('dictados.cuat', '=',$cuat)
            ->select(DB::raw('count(1) AS total'))
            ->groupBy('asistentes.cod_asist') 
            ->get();
        } else {
        /*PRESENTES*/
        $presentes = Asistente::join('dictados','asistentes.id_dictado','=','dictados.id')
            ->join('materias','dictados.id_materia','=','materias.id')      
            ->where('materias.id_carrera', '=',$id_carrera)
            ->where('asistentes.cod_asist', '=','0')
            ->where('dictados.ano', '=',$ano)
            ->where('dictados.cuat', '=',$cuat)
            ->select(DB::raw('count(1) AS total'))
            ->groupBy('asistentes.cod_asist') 
            ->get();
        }

        //Si no devuelve registros...
        if (!$presentes->count()){
            $myObj->rows[0]->c[0] = new \StdClass();
            $myObj->rows[0]->c[0]->v = "Presentes";
            $myObj->rows[0]->c[1] = new \StdClass();
            $myObj->rows[0]->c[1]->v = 0;
            $empty +=1;
        }else{
            $myObj->rows[0]->c[0] = new \StdClass();            
            $myObj->rows[0]->c[0]->v = "Presentes";
            $myObj->rows[0]->c[1] = new \StdClass();
            $myObj->rows[0]->c[1]->v = $presentes[0]->total;
        }
        
        if ($id_materia != "") {
        /*AUSENTES*/
        $ausentes = Asistente::join('dictados','asistentes.id_dictado','=','dictados.id')
            ->join('materias','dictados.id_materia','=','materias.id')      
            ->where('materias.id_carrera', '=',$id_carrera)
            ->where('materias.id', '=',$id_materia)
            ->where('asistentes.cod_asist', '=','1')
            ->where('dictados.ano', '=',$ano)
            ->where('dictados.cuat', '=',$cuat)
            ->select(DB::raw('count(1) AS total'))
            ->groupBy('asistentes.cod_asist')   
            ->get();
        } else {
        /*AUSENTES*/
        $ausentes = Asistente::join('dictados','asistentes.id_dictado','=','dictados.id')
            ->join('materias','dictados.id_materia','=','materias.id')      
            ->where('materias.id_carrera', '=',$id_carrera)
            ->where('asistentes.cod_asist', '=','1')
            ->where('dictados.ano', '=',$ano)
            ->where('dictados.cuat', '=',$cuat)
            ->select(DB::raw('count(1) AS total'))
            ->groupBy('asistentes.cod_asist')   
            ->get();
        }

        if (!$ausentes->count()){
            $myObj->rows[1]->c[0] = new \StdClass();
            $myObj->rows[1]->c[0]->v = "Ausentes";
            $myObj->rows[1]->c[1] = new \StdClass();
            $myObj->rows[1]->c[1]->v = 0;
            $empty +=1;
        }else{
            $myObj->rows[1]->c[0] = new \StdClass();            
            $myObj->rows[1]->c[0]->v = "Ausentes";
            $myObj->rows[1]->c[1] = new \StdClass();
            $myObj->rows[1]->c[1]->v = $ausentes[0]->total;
        }
        
        if ($id_materia != "") {
        /*MEDIA FALTA*/
        $media = Asistente::join('dictados','asistentes.id_dictado','=','dictados.id')
            ->join('materias','dictados.id_materia','=','materias.id')      
            ->where('materias.id_carrera', '=',$id_carrera)
            ->where('materias.id', '=',$id_materia)
            ->where('asistentes.cod_asist', '=','2')
            ->where('dictados.ano', '=',$ano)
            ->where('dictados.cuat', '=',$cuat)
            ->select(DB::raw('count(1) AS total'))
            ->groupBy('asistentes.cod_asist')   
            ->get();
        } else {
        /*MEDIA FALTA*/
        $media = Asistente::join('dictados','asistentes.id_dictado','=','dictados.id')
            ->join('materias','dictados.id_materia','=','materias.id')      
            ->where('materias.id_carrera', '=',$id_carrera)
            ->where('asistentes.cod_asist', '=','2')
            ->where('dictados.ano', '=',$ano)
            ->where('dictados.cuat', '=',$cuat)
            ->select(DB::raw('count(1) AS total'))
            ->groupBy('asistentes.cod_asist')   
            ->get();
        }

        if (!$media->count()){
            $myObj->rows[2]->c[0] = new \StdClass();            
            $myObj->rows[2]->c[0]->v = "Media Falta";
            $myObj->rows[2]->c[1] = new \StdClass();
            $myObj->rows[2]->c[1]->v = 0;
            $empty +=1;       
        }else{
            $myObj->rows[2]->c[0] = new \StdClass();
            $myObj->rows[2]->c[0]->v = "Media Falta";
            $myObj->rows[2]->c[1] = new \StdClass();
            $myObj->rows[2]->c[1]->v = $media[0]->total;
        }
    
        $result->inscriptos = new \StdClass();
        $result->inscriptos->data = $myObj;
        $result->inscriptos->options =  new \StdClass();
        $result->inscriptos->options->title = "Cantidad de Asistencias";
        if ($id_materia != "") {

            $cantInscripto = Inscripto::join('dictados','inscriptos.id_dictado','=','dictados.id')
                ->join('materias','dictados.id_materia','=','materias.id')
                ->where('materias.id', '=',$id_materia)
                ->where('materias.id_carrera', '=',$id_carrera)
                ->where('dictados.ano', '=',$ano)
                ->where('dictados.cuat', '=',$cuat)
                ->select('materias.desc_mat', DB::raw('count(1) AS total'))
                ->groupBy('materias.desc_mat')              
                ->get();

            $cantLibre = Inscripto::join('dictados','inscriptos.id_dictado','=','dictados.id')
            ->join('materias','dictados.id_materia','=','materias.id')
            ->where('materias.id', '=',$id_materia)
            ->where('materias.id_carrera', '=',$id_carrera)
            ->where('dictados.ano', '=',$ano)
            ->where('dictados.cuat', '=',$cuat)
            ->where('inscriptos.libre','=','T')
            ->select('materias.desc_mat', DB::raw('count(1) AS total'))
            ->groupBy('materias.desc_mat')              
            ->get();

            $result->inscriptos->style = "particular";
            if (!empty($cantInscripto[0])) {
                $result->inscriptos->cantinsc = $cantInscripto[0]->total;
            } else {
                $result->inscriptos->cantinsc = 0;
            } 

            if (!empty($cantInscripto[0])) {
                $result->inscriptos->cantlibre = $cantLibre[0]->total;
            } else {
                $result->inscriptos->cantlibre = 0;
            }
        } else {
            $result->inscriptos->style = "general";
        }
        $result->inscriptos->type = "PieChart";
        
        if ($empty == 3) {
            $result->inscriptos->empty  = true;
        } else {
            $result->inscriptos->empty  = false;
        }

        return $result;    
    }
    
    public function cantInscriptos($id_carrera,$ano,$cuat) {
        $contEmpty = 0;

        $cantIns = Inscripto::join('dictados','inscriptos.id_dictado','=','dictados.id')
            ->join('materias','dictados.id_materia','=','materias.id')
            ->where('materias.id_carrera', '=',$id_carrera)
            ->where('dictados.ano', '=',$ano)
            ->where('dictados.cuat', '=',$cuat)
            ->select('materias.desc_mat', DB::raw('count(1) AS total'))
            ->groupBy('materias.desc_mat')              
            ->get();

        $result = new \StdClass();

        $myObj = new \StdClass();
        $myObj->cols=[];
        $myObj->rows=[];
        
        $myObj->cols[0] = new \StdClass();
        $myObj->cols[0]->id = "insc";
        $myObj->cols[0]->label = "Inscriptos1";
        $myObj->cols[0]->type = "string";
    
        $myObj->cols[1] = new \StdClass();
        $myObj->cols[1]->id = "insc";
        $myObj->cols[1]->label = "Cantidad por materia";
        $myObj->cols[1]->type = "number";

        $result->asistentes = new \StdClass();
        $result->asistentes->data = $myObj;
        $result->asistentes->options =  new \StdClass();
        $result->asistentes->options->title = "Alumnos Inscriptos";

        foreach ($cantIns as $key => $value) {
            $myObj->rows[$key]->c[0] = new \StdClass();            
            $myObj->rows[$key]->c[0]->v = $cantIns[$key]->desc_mat;
            $myObj->rows[$key]->c[1] = new \StdClass();
            $myObj->rows[$key]->c[1]->v = $cantIns[$key]->total;
            if ($cantIns[$key]->total == 0) {
                $contEmpty +=1;
            }       
        }        
        
        $result->asistentes->type = "BarChart";

        if ($contEmpty == count($cantIns)) {
            $result->asistentes->empty = true;
        } else {
            $result->asistentes->empty = false;
        }

        return $result;
    }
    
    public function cantAlumnosLibres($id_carrera,$ano,$cuat) {
        $contEmpty =    0;

        $result[0] = ['Materia','totalLibres'];

        $cantLib = Inscripto::join('dictados','inscriptos.id_dictado','=','dictados.id')
            ->join('materias','dictados.id_materia','=','materias.id')
            ->where('dictados.ano', '=',$ano)
            ->where('dictados.cuat', '=',$cuat)
            ->where('inscriptos.libre','=','T')
            ->select('materias.desc_mat', DB::raw('count(1) AS total'))
            ->groupBy('materias.desc_mat')              
            ->get();

        $result = new \StdClass();

        $myObj = new \StdClass();
        $myObj->cols=[];
        $myObj->rows=[];
        
        $myObj->cols[0] = new \StdClass();
        $myObj->cols[0]->id = "insc";
        $myObj->cols[0]->label = "Inscriptos1";
        $myObj->cols[0]->type = "string";
    
        $myObj->cols[1] = new \StdClass();
        $myObj->cols[1]->id = "insc";
        $myObj->cols[1]->label = "Cantidad por materia";
        $myObj->cols[1]->type = "number";

        $result->libres = new \StdClass();
        $result->libres->data = $myObj;
        $result->libres->options =  new \StdClass();
        $result->libres->options->title = "Alumnos en condicion libre";

        foreach ($cantLib as $key => $value) {
            $myObj->rows[$key]->c[0] = new \StdClass();            
            $myObj->rows[$key]->c[0]->v = $cantLib[$key]->desc_mat;
            $myObj->rows[$key]->c[1] = new \StdClass();
            $myObj->rows[$key]->c[1]->v = $cantLib[$key]->total; 
            if ($cantLib[$key]->total == 0) {
                $contEmpty +=1;
            }      
        }        
        
        $result->libres->type = "BarChart";
        
        if ($contEmpty == count($cantLib)) {
            $result->libres->empty = true;
        } else {
            $result->libres->empty = false;
        }

        return $result;
    }
}
