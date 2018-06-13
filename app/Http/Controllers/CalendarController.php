<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\ControlPiso\CP_DETALLEPLANIFICACION;
use App\Modelos\ControlPiso\CP_ENCABEZADOPLANIFICACION;
use App\Modelos\ControlPiso\CP_PLANIFICACION;
use App\Modelos\ControlPiso\CP_EQUIPOARTICULO;
use App\Modelos\ControlPiso\CP_events;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Calendar;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
      
    
     $maquina=0;
   /*
     if($request->id_centrocosto==null or $request->id_centrocosto==0 ){

      $maquina=0;
      $data=CP_events::all();

    
     }else{

     $data=CP_events::where('centrocosto','=',$request->id_centrocosto)->get();
     $maquina=$request->id_centrocosto;
     }
    */ 


    
      

      



 
  /*
        $centrocosto=DB::Connection()->select("select events.centrocosto as EQUIPO,ru.DESCRIP_RUBRO 
         AS DESC_EQUIPO from 
        IBERPLAS.CP_events events,
        IBERPLAS.RUBRO_LIQ RU
        where 
        events.centrocosto=RU.RUBRO
        group by events.centrocosto,ru.DESCRIP_RUBRO");  
        return view('ControPiso.Transacciones.calendario',['maquina'=>$maquina], compact('calendar','centrocosto'));
  */
  return view('ControPiso.Transacciones.calendario');
    }

     public function cargaeventos(){
        $data = array(); //declaramos un array principal que va contener los datos
        $id = CP_events::all()->pluck('id'); //listamos todos los id de los eventos
        $titulo = CP_events::all()->pluck('text'); //lo mismo para lugar y fecha
        $fechaIni = CP_events::all()->pluck('start_date');
        $fechaFin = CP_events::all()->pluck('end_date');
        //$allDay = CalendarioEvento::all()->lists('todoeldia');
        //$background = CalendarioEvento::all()->lists('color');
        //$borde = CalendarioEvento::all()->lists('borde');
        $count = count($id); //contamos los ids obtenidos para saber el numero exacto de eventos
 
        //hacemos un ciclo para anidar los valores obtenidos a nuestro array principal $data
        for($i=0;$i<$count;$i++){
            $data[$i] = array(
                "title"=>$titulo[$i], //obligatoriamente "title", "start" y "url" son campos requeridos
                "start"=>$fechaIni[$i], //por el plugin asi que asignamos a cada uno el valor correspondiente
                "end"=>$fechaFin[$i],
          //      "allDay"=>$allDay[$i],
            //    "backgroundColor"=>$background[$i],
              //  "borderColor"=>$borde[$i],
                "id"=>$id[$i]
                //"url"=>"cargaEventos".$id[$i]
                //en el campo "url" concatenamos el el URL con el id del evento para luego
                //en el evento onclick de JS hacer referencia a este y usar el método show
                //para mostrar los datos completos de un evento
            );
        }
 
       json_encode($data); //convertimos el array principal $data a un objeto Json 
       return $data; //para luego retornarlo y estar listo para consumirlo 

    }
    public function create(){
        //Valores recibidos via ajax
        $title = $_POST['title'];
        $start = $_POST['start'];
        $back = $_POST['background'];

        //Insertando evento a base de datos
        $evento=new CalendarioEventos;
        $evento->fechaIni=$start;
        //$evento->fechaFin=$end;
        $evento->todoeldia=true;
        $evento->color=$back;
        $evento->titulo=$title;

        $evento->save();
   }

   public function update(){
        //Valores recibidos via ajax
        $id = $_POST['id'];
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $allDay = $_POST['allday'];
        $back = $_POST['background'];
        dd($id);

        $evento= CP_events::find($id);
        if($end=='NULL'){
            $evento->start_date=NULL;
        }else{
            $evento->start_date=$end;
        }
        $evento->end_date=$start;
        $evento->todoeldia=$allDay;
        $evento->color=$back;
        $evento->titulo=$title;
        //$evento->fechaFin=$end;

        $evento->save();
   }

   public function delete(){
        //Valor id recibidos via ajax
        $id = $_POST['id'];
        

        CalendarioEventos::destroy($id);
   }
}
