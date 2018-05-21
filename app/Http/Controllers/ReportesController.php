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

    public function cantAsistencias(Request $request) {
        
        $id_carrera = 1;//$request->input('id_carrera');
        $id_materia = 22;//$request->input('id_materia');
        $date_from = '2018-01-01';//$request->input('date_from');
        $date_to = '2018-05-20';//$request->input('date_to');
        $i=1;
        
        $result = new \StdClass();
        
        $myObj = new \StdClass();
        $myObj->cols=[];
        $myObj->rows=[];
        
        $myObj->cols[0] = new \StdClass();
        $myObj->cols[0]->id = "insc";
        $myObj->cols[0]->label = "Inscriptos";
        $myObj->cols[0]->type = "string";
        
        /*PRESENTES*/
        $presentes = Asistente::join('dictados','asistentes.id_dictado','=','dictados.id')
            ->join('materias','dictados.id_materia','=','materias.id')      
            ->where('materias.id_carrera', '=',$id_carrera)
            ->where('materias.id', '=',$id_materia)
            ->where('asistentes.cod_asist', '=','0')
            ->whereDate('asistentes.created_at', '>=',$date_from)
            ->whereDate('asistentes.created_at', '<=',$date_to)
            ->select(DB::raw('count(1) AS total'))
            ->groupBy('asistentes.cod_asist')               
            ->get();
        
        //Si no devuelve registros...
        if (!$presentes->count()){
            $myObj->rows[0]->c[0] = new \StdClass();
            $myObj->rows[0]->c[0]->v = "Presentes";
            $myObj->rows[0]->c[1] = new \StdClass();
            $myObj->rows[0]->c[1]->v = 0;   
        }else{
            $myObj->rows[0]->c[0] = new \StdClass();            
            $myObj->rows[0]->c[0]->v = "Presentes";
            $myObj->rows[0]->c[1] = new \StdClass();
            $myObj->rows[0]->c[1]->v = $presentes[0]->total;
        }
        
        /*AUSENTES*/
        $ausentes = Asistente::join('dictados','asistentes.id_dictado','=','dictados.id')
            ->join('materias','dictados.id_materia','=','materias.id')      
            ->where('materias.id_carrera', '=',$id_carrera)
            ->where('materias.id', '=',$id_materia)
            ->where('asistentes.cod_asist', '=','1')
            ->whereDate('asistentes.created_at', '>=',$date_from)
            ->whereDate('asistentes.created_at', '<=',$date_to)
            ->select(DB::raw('count(1) AS total'))
            ->groupBy('asistentes.cod_asist')   
            ->get();

        if (!$ausentes->count()){
            $myObj->rows[1]->c[0] = new \StdClass();
            $myObj->rows[1]->c[0]->v = "Ausentes";
            $myObj->rows[1]->c[1] = new \StdClass();
            $myObj->rows[1]->c[1]->v = 0;   
        }else{
            $myObj->rows[1]->c[0] = new \StdClass();            
            $myObj->rows[1]->c[0]->v = "Ausentes";
            $myObj->rows[1]->c[1] = new \StdClass();
            $myObj->rows[1]->c[1]->v = $ausentes[0]->total;
        }
    
        /*MEDIA FALTA*/
        $media = Asistente::join('dictados','asistentes.id_dictado','=','dictados.id')
            ->join('materias','dictados.id_materia','=','materias.id')      
            ->where('materias.id_carrera', '=',$id_carrera)
            ->where('materias.id', '=',$id_materia)
            ->where('asistentes.cod_asist', '=','2')
            ->whereDate('asistentes.created_at', '>=',$date_from)
            ->whereDate('asistentes.created_at', '<=',$date_to)
            ->select(DB::raw('count(1) AS total'))
            ->groupBy('asistentes.cod_asist')   
            ->get();

        if (!$media->count()){
            $myObj->rows[2]->c[0] = new \StdClass();            
            $myObj->rows[2]->c[0]->v = "Media Falta";
            $myObj->rows[2]->c[1] = new \StdClass();
            $myObj->rows[2]->c[1]->v = 0;       
        }else{
            $myObj->rows[2]->c[0] = new \StdClass();
            $myObj->rows[2]->c[0]->v = "Media Falta";
            $myObj->rows[2]->c[1] = new \StdClass();
            $myObj->rows[2]->c[1]->v = $media[0]->total;
        }

        $result->inscriptos = $myObj;
        return  json_encode($result);
    }  
    
    public function cantInscriptos(Request $request) {
        
        $id_carrera = 1;//$request->input('id_carrera');
        $id_materia = "";//$request->input('id_materia');
        $ano = 2018;//$request->input('ano');
        $cuat = 1;//$request->input('cuat');
        $i=1;


        $result[0] = ['Materia','total'];

        /*SIN MATERIA SELECCIONADA*/
        if($id_materia == ""){
            echo "vacio";
            $sql = Inscripto::join('dictados','inscriptos.id_dictado','=','dictados.id')
                ->join('materias','dictados.id_materia','=','materias.id')
                ->where('materias.id_carrera', '=',$id_carrera)
                ->where('dictados.ano', '=',$ano)
                ->where('dictados.cuat', '=',$cuat)
                ->select('materias.desc_mat', DB::raw('count(1) AS total'))
                ->groupBy('materias.desc_mat')              
                ->get();

            foreach ($sql as $key => $value) {
                $result[$i] = [$value->desc_mat, $value->total];
                $i++;
            }
        
        /*CON MATERIA SELECCIONADA*/        
        }else{
            $sql = Inscripto::join('dictados','inscriptos.id_dictado','=','dictados.id')
                ->join('materias','dictados.id_materia','=','materias.id')
                ->where('materias.id', '=',$id_materia)
                ->where('materias.id_carrera', '=',$id_carrera)
                ->where('dictados.ano', '=',$ano)
                ->where('dictados.cuat', '=',$cuat)
                ->select('materias.desc_mat', DB::raw('count(1) AS total'))
                ->groupBy('materias.desc_mat')              
                ->get();

            foreach ($sql as $key => $value) {
                $result[$i] = [$value->desc_mat, $value->total];
                $i++;
            }
            
        }

        return $result;
    }
    
    public function cantAlumnosLibres(Request $request) {
        
        $id_carrera = 1;//$request->input('id_carrera');
        $ano = 2018;//$request->input('ano');
        $cuat = 1;//$request->input('cuat');
        $i=1;

        $result[0] = ['Materia','totalLibres'];

        $sql = Inscripto::join('dictados','inscriptos.id_dictado','=','dictados.id')
            ->join('materias','dictados.id_materia','=','materias.id')
            ->where('dictados.ano', '=',$ano)
            ->where('dictados.cuat', '=',$cuat)
            ->where('inscriptos.libre','=','T')
            ->select('materias.desc_mat', DB::raw('count(1) AS total'))
            ->groupBy('materias.desc_mat')              
            ->get();

        foreach ($sql as $key => $value) {
            $result[$i] = [$value->desc_mat, $value->total];
            $i++;
        }
        
        return $result;
    }
}
