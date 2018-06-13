<?php

namespace App\Http\Controllers;
use Dhtmlx\Connector\SchedulerConnector; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\ControlPiso\CP_tasks;

class GanttController extends Controller
{

         public function index(Request $request){
          $anio='TODOS';
          $TipoEquipo=DB::Connection()->select("SELECT TIPO_EQUIPO,DESCRIPCION FROM IBERPLAS.TIPO_EQUIPO 
          WHERE TIPO_EQUIPO IN (SELECT  
          EQ.TIPO_EQUIPO
          FROM 
          IBERPLAS.EQUIPO EQ,
          IBERPLAS.CP_PLANIFICACION PL
          WHERE EQ.EQUIPO=PL.centrocosto) ");


           return view("ControPiso.Consulta.gantt")
           ->with('TipoEquipo',$TipoEquipo)
           ->with('anio',$anio);
          }

     public function get(){

      $tasks = new CP_tasks();
      $tasks = CP_tasks::orderBy('id', 'desc')->get();

         return response()->json([
            "data" => $tasks
        ]);	
     }
    


}
