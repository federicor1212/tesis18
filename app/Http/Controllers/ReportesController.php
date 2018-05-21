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


        $result[0] = ['asistencias','total'];
        
        /*PRESENTES*/
        $sql0 = Asistente::join('dictados','asistentes.id_dictado','=','dictados.id')
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
        if (!$sql0->count()){
            $result[$i] = ["Presentes", 0];
            $i++;           
        }else{
            foreach ($sql0 as $key => $value) {
                $result[$i] = ["Presentes", $value->total];
                $i++;
            }   
        }
        
        /*AUSENTES*/
        $sql1 = Asistente::join('dictados','asistentes.id_dictado','=','dictados.id')
            ->join('materias','dictados.id_materia','=','materias.id')      
            ->where('materias.id_carrera', '=',$id_carrera)
            ->where('materias.id', '=',$id_materia)
            ->where('asistentes.cod_asist', '=','1')
            ->whereDate('asistentes.created_at', '>=',$date_from)
            ->whereDate('asistentes.created_at', '<=',$date_to)
            ->select(DB::raw('count(1) AS total'))
            ->groupBy('asistentes.cod_asist')   
            ->get();

        //Si no devuelve registros...
        if (!$sql1->count()){
            $result[$i] = ["Ausentes", 0];
            $i++;           
        }else{
            foreach ($sql1 as $key => $value) {
                $result[$i] = ["Ausentes", $value->total];
                $i++;
            }   
        }
    
        /*MEDIA FALTA*/
        $sql2 = Asistente::join('dictados','asistentes.id_dictado','=','dictados.id')
            ->join('materias','dictados.id_materia','=','materias.id')      
            ->where('materias.id_carrera', '=',$id_carrera)
            ->where('materias.id', '=',$id_materia)
            ->where('asistentes.cod_asist', '=','2')
            ->whereDate('asistentes.created_at', '>=',$date_from)
            ->whereDate('asistentes.created_at', '<=',$date_to)
            ->select(DB::raw('count(1) AS total'))
            ->groupBy('asistentes.cod_asist')   
            ->get();

        //Si no devuelve registros...
        if (!$sql2->count()){
            $result[$i] = ["Media Falta", 0];
            $i++;           
        }else{
            foreach ($sql2 as $key => $value) {
                $result[$i] = ["Media Falta", $value->total];
                $i++;
            }   
        }   
    
        return  $result;
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
