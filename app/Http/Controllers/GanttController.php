<?php

namespace App\Http\Controllers;
use Dhtmlx\Connector\SchedulerConnector; 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modelos\ControlPiso\CP_tasks;
use App\Modelos\ControlPiso\CP_PLANIFICACION;
use App\Modelos\Softland\EQUIPO;

class GanttController extends Controller
{
private $FechaTimeBD="d-m-Y H:i:s";
private $FechaBD="d-m-Y";
public function index(Request $request){
$anio='TODOS';
$TipoEquipo=DB::Connection()->select("SELECT TIPO_EQUIPO,DESCRIPCION FROM IBERPLAS.TIPO_EQUIPO 
          WHERE TIPO_EQUIPO IN (SELECT  
          EQ.TIPO_EQUIPO
          FROM 
          IBERPLAS.EQUIPO EQ,
          IBERPLAS.CP_PLANIFICACION PL
          WHERE EQ.EQUIPO=PL.centrocosto) ");
DB::table('IBERPLAS.CP_tasks')->delete();

     //'OP='+PLA.ordenproduccion+'-'+'ARTICULO='+ART.ARTICULO+'-'+ART.DESCRIPCION
$gannt=DB::Connection()->select("select (ART.DESCRIPCION) as text,
            min(PLA.fechamin) fechamin, 
            SUM(PLA.horas) as horas ,
            PLA.centrocosto as centrocosto,pla.id
            from 
            IBERPLAS.CP_PLANIFICACION PLA,
            IBERPLAS.ARTICULO ART
            where
            PLA.articulo=ART.ARTICULO AND 
            PLA.Versionestado='A' and
            PLa.estado='A' and PLA.centrocosto NOT IN (select EQUIPO FROM IBERPLAS.ATRIB_EQUIPO WHERE ATRIBUTO='GANTT')
            group by 
            PLA.ordenproduccion,
            ART.ARTICULO,
            ART.DESCRIPCION,
            PLA.centrocosto,
            PLA.id");
foreach ($gannt as $value) {
  $fecha=date($this->FechaTimeBD,strtotime($value->fechamin));
  $task=new cp_tasks;
  $task->text=$value->text;
  $task->duration=$value->horas;
  $task->progress=0.00;
  $task->start_date=$fecha;
  $task->centrocosto=$value->centrocosto;
  $task->planificador_id=$value->id;
  $task->abierto='cerrado';
  $task->save(); 
};

$gannt2=CP_tasks::all();
foreach ($gannt2 as  $gannt2) {
  $planificacion=CP_PLANIFICACION::where('id','=',$gannt2->planificador_id)->get();
    foreach ($planificacion as  $pla) {
      $ubicacion=EQUIPO::where('equipo','=',$pla->centrocosto)->select('TIPO_EQUIPO')->get();
      foreach ($ubicacion as $key => $value) {
          $ubicacion=$value->TIPO_EQUIPO;
      }
      CP_tasks::where('planificador_id','=',$pla->id)->update(['ordenproduccion'=>$pla->ordenproduccion,'progress'=>number_format(($pla->porcentaje2/100),2),
                    'progreso'=>$pla->porcentaje2,
                    'cantidadplanificada'=>$pla->cantidad,
                    'cantidadproduccida'=>$pla->cantidadproducidad,
                    'estadoMO'=>$pla->aprobadaMO,
                    'estadoMA'=>$pla->aprobadaMA,
                    'Proceso'=>$pla->operacion,
                     'TipoMaquina'=>$ubicacion]);
    }
}    
               
$agruparporcc=DB::Connection()->select("
  select  
  SUM(duration) as horas,
  MIN(start_date) as fechamin,
  SUM(cantidadplanificada) as cantplanificada,
  cast((SUM(cantidadproduccida)) as decimal(16,0)) as cantproducida ,
  cast((SUM(cantidadproduccida)/SUM(cantidadplanificada)) as decimal(16,2)) as porc,  
  centrocosto as text 
  from IBERPLAS.CP_tasks group by centrocosto");     
foreach ($agruparporcc as $value) {
  $fecha=date($this->FechaTimeBD,strtotime($value->fechamin));
  $task=new cp_tasks;
  $task->text=$value->text;
  $task->duration=$value->horas;
  $task->progress=$value->porc;
  $task->cantidadplanificada=$value->cantplanificada;
  $task->cantidadproduccida=$value->cantproducida;
  $task->start_date=$fecha;
  $task->centrocosto=$value->text;
  $task->abierto='cerrado';
  $task->save(); 
  $id2=$task->id;
  CP_tasks::where('centrocosto','=',$value->text)->whereNotnull('ordenproduccion') ->update(['parent'=>$id2]);
};
return view("ControPiso.Consulta.gantt")
->with('TipoEquipo',$TipoEquipo)
->with('anio',$anio);
}

public function get(){
$tasks = new CP_tasks();
$tasks = CP_tasks::orderBy('start_date', 'desc')->get();
return response()->json([
            "data" => $tasks
        ]);	
}    
}
