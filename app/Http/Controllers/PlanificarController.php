<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Softland\CP_TCargaOrdenProduccion;
use App\Modelos\Softland\PEDIDO;
use App\Modelos\Softland\EQUIPO;
use App\Modelos\ControlPiso\CP_EQUIPOARTICULO;
use App\Modelos\ControlPiso\CP_CALENDARIO_PLANIFICADOR;
use App\Modelos\ControlPiso\CP_ENCABEZADOPLANIFICACION;
use App\Modelos\ControlPiso\CP_DETALLEPLANIFICACION;
use App\Modelos\ControlPiso\CP_PLANIFICACION;
use App\Modelos\ControlPiso\CP_TEMP_PLANIFICACION;
use App\Modelos\ControlPiso\CP_TEMP_PLANIFICACION_ENCA;
use App\Modelos\ControlPiso\CP_CALENDARIO_PLANIFICADOR_DETALLE;
use App\Modelos\ControlPiso\CP_REGISTROEMPLEADOS;
use App\Modelos\ControlPiso\CP_REGISTROHORAS;
use App\Modelos\ControlPiso\CP_REGISTROPRODUCCION;
use App\Modelos\ControlPiso\CP_consumo;
use App\Modelos\ControlPiso\CP_tasks;
use App\Modelos\ControlPiso\CP_events;
use Illuminate\Support\Facades\DB;
use App\Mail\Produccion;
Use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Modelos\ControlPiso\CP_emails;
use App\Mail\ComprasMail;



class PlanificarController extends Controller
{
  private $FormatoFechaTimeBD="d-m-Y H:i:s";
  private $FormatoFechaBD="d-m-Y";
    public function __construct()
    {
      Carbon::setlocale('es');
    } 
   public function index(Request $request){
    
    if($request->id==null){
      $anio='TODOS';
      $TipoEquipo=DB::Connection()->select("SELECT TIPO_EQUIPO,DESCRIPCION FROM IBERPLAS.TIPO_EQUIPO 
      WHERE TIPO_EQUIPO IN (SELECT  
      EQ.TIPO_EQUIPO
      FROM 
      IBERPLAS.EQUIPO EQ,
      IBERPLAS.CP_PLANIFICACION PL
      WHERE EQ.EQUIPO=PL.centrocosto and pl.VersionEstado='A') ");

         $OrdenProduccion=CP_PLANIFICACION::wherein('estado' , ['P','A','B'])->where('VersionEstado','=','A')->get();
         //->whereIn('ESTADO', ['P', 'A', 'B','C'])->get();
     
          //envio correo aqui:
          

        return view('ControPiso.Transacciones.Planificador.index')
               ->with('OrdenProduccion',$OrdenProduccion)
               ->with('TipoEquipo',$TipoEquipo)
               ->with('anio',$anio);
    }else{
     
       $id=$request->id;
       $TipoEquipo=DB::Connection()->select("SELECT TIPO_EQUIPO,DESCRIPCION FROM IBERPLAS.TIPO_EQUIPO 
       WHERE TIPO_EQUIPO IN (SELECT  
       EQ.TIPO_EQUIPO
       FROM 
       IBERPLAS.EQUIPO EQ,
       IBERPLAS.CP_PLANIFICACION PL
       WHERE EQ.EQUIPO=PL.centrocosto) ");
        $OrdenProduccion=DB::Connection()->select("SELECT * FROM IBERPLAS.CP_PLANIFICACION 
        WHERE centrocosto IN (SELECT  
        EQ.EQUIPO
        FROM 
        IBERPLAS.EQUIPO EQ,
        IBERPLAS.CP_PLANIFICACION PL
        WHERE EQ.EQUIPO=PL.centrocosto and eq.TIPO_EQUIPO='$id')");

        $anio=$id;

   
return view('ControPiso.Transacciones.Planificador.index')
->with('OrdenProduccion',$OrdenProduccion)
->with('TipoEquipo',$TipoEquipo)
->with('anio',$anio);
      

   
  
    } 
  }

  

  public function estadoP($id){

    $fechaSistema = Carbon::now()->format('m-d-Y H:i:s');
    
       $planificar=CP_PLANIFICACION::where('id',$id)->update(['estado'=>'A']);
      
        // $emails=CP_emails::where('email01','=','S')->select('email')->get();
        //    Mail::to($emails)->send(new ComprasMail());
        
       
       return redirect()->route('planificador.index');


  
  }

  public function estadoA($id)
  {


       $fechaSistema = Carbon::now()->format('m-d-Y H:i:s');
    
      $planificar=CP_PLANIFICACION::where('id',$id)->update(['estado'=>'B']);
      

           
      
        
       
      return redirect()->route('planificador.index');
    }






  public function estadoB($id)
  {
$fechaSistema = Carbon::now()->format('m-d-Y H:i:s');
    
    $planificar=CP_ENCABEZADOPLANIFICACION::where('ID',$id)->update(['ESTADO'=>'C']);
      
      
        
       
       return redirect()->route('planificador.index');
  }


  public function procesos(){
    $articulordproduccion=$_GET['id'];
    $user=\Auth::user()->name;
    $centrocosto=DB::Connection()->select("select SECUENCIA,DESCRIPCION,OPERACION from IBERPLAS.ESTRUC_PROCESO 
    where 
    ARTICULO='$articulordproduccion' 
    AND version in (select version from IBERPLAS.ESTRUC_MANUFACTURA where ARTICULO='$articulordproduccion' AND estado='A') 
    and SECUENCIA NOT IN (SELECT SECUENCIA FROM IBERPLAS.CP_TEMP_PLANIFICACION_ENCA WHERE USUARIO='$user')
    order by SECUENCIA");
    return response()->json($centrocosto);
  }

public function CambioHora(Request $request){
  $arr=array($request->lunes_ta,$request->martes_ta,$request->miercoles_ta,$request->jueves_ta,$request->viernes_ta,$request->sabado_ta,$request->domingo_ta,
  $request->lunes_tb,$request->martes_tb,$request->miercoles_tb,$request->jueves_tb,$request->viernes_tb,$request->sabado_tb,$request->domingo_tb,
  $request->lunes_tc,$request->martes_tc,$request->miercoles_tc,$request->jueves_tc,$request->viernes_tc,$request->sabado_tc,$request->domingo_tc,);   
  CP_TEMP_PLANIFICACION_ENCA::where('USUARIO','=',\Auth::user()->name )->delete();
  CP_TEMP_PLANIFICACION::where('USUARIOCREACION','=',\Auth::user()->name )->delete();           
  
  $hoy = date($this->FormatoFechaTimeBD);
  //$date = $date->format('d-m-Y H:i:s');
  $id=$request->id;// id
  $id2=$request->ordenproduccion;// orden produccion
  $id3=$request->horasadicionales;//horas adicionales
  //Seleciono Fecha Final 
  if($request->fechafin=='FF'){
    $id4=$request->fechafin2;  
  };
  //Seleciono Fecha Inicial
  if($request->fechainicio=='FI'){
    $id4=$request->fechainicio2;
  };
  //Fecha
  $idantiguo=$id;
  //Aplicar el aumento de horas a fecha Final
  if($request->fechafin=='FF'){
    if($id3>=1){
      $cambiohoras=DB::Connection()->select("SELECT operacion,ordenproduccion,articulo,pedido,fechamin,DATEADD(HOUR,+$id3,fechamax) as fechamax,
                  cantidad,estado,centrocosto,(horas+$id3) as horas,(version+1) as version,porcentaje,USUARIOCREACION,FECHACREACION,FICHA_TECNICA,CONFIRMADA,APROBADA,fechaCalendariomin ,
                  DATEADD(HOUR,+$id3,fechaCalendariomax) as fechaCalendariomax,aprobadaMO,aprobadaMA
                  FROM IBERPLAS.CP_PLANIFICACION where id='$id'");
    }else{
      $cambiohoras=DB::Connection()->select("SELECT operacion,ordenproduccion,articulo,pedido,fechamin,DATEADD(HOUR,$id3,fechamax) as fechamax,
                  cantidad,estado,centrocosto,(horas $id3) as horas,(version+1) as version,porcentaje,USUARIOCREACION,FECHACREACION,FICHA_TECNICA,CONFIRMADA,APROBADA,fechaCalendariomin ,
                  DATEADD(HOUR,$id3,fechaCalendariomax) as fechaCalendariomax,aprobadaMO,aprobadaMA
                  FROM IBERPLAS.CP_PLANIFICACION where id='$id'");
    }
  }
  //Aplicar el aumento de horas a fecha inicial
  if($request->fechainicio=='FI'){
     if($id3>=1){
      $cambiohoras=DB::Connection()->select("SELECT operacion,ordenproduccion,articulo,pedido,fechamin,DATEADD(HOUR,+$id3,fechamin) as fechamax,
      cantidad,estado,centrocosto,(horas+$id3) as horas,(version+1) as version,porcentaje,USUARIOCREACION,FECHACREACION,FICHA_TECNICA,CONFIRMADA,APROBADA,fechaCalendariomin ,
      DATEADD(HOUR,+$id3,fechaCalendariomin) as fechaCalendariomax,aprobadaMO,aprobadaMA
      FROM IBERPLAS.CP_PLANIFICACION where id='$id'");
    }else{    
      $cambiohoras=DB::Connection()->select("SELECT operacion,ordenproduccion,articulo,pedido,fechamin,DATEADD(HOUR,$id3,fechamin) as fechamax,
      cantidad,estado,centrocosto,(horas $id3) as horas,(version+1) as version,porcentaje,USUARIOCREACION,FECHACREACION,FICHA_TECNICA,CONFIRMADA,APROBADA,fechaCalendariomin ,
      DATEADD(HOUR,$id3,fechaCalendariomin) as fechaCalendariomax,aprobadaMO,aprobadaMA
      FROM IBERPLAS.CP_PLANIFICACION where id='$id'");
    }
  }    
  $centrocosto=DB::Connection()->select("select centrocosto, fechamin from IBERPLAS.CP_PLANIFICACION 
  where centrocosto='$request->centrocosto' and fechamin >'$request->fechainicial'");
  
  foreach ($cambiohoras as $key => $value) {
    $CP_PLANIFICACION=new CP_PLANIFICACION;
    $CP_PLANIFICACION->operacion=$value->operacion;
    $CP_PLANIFICACION->ordenproduccion=$value->ordenproduccion;
    $CP_PLANIFICACION->articulo=$value->articulo;
    $CP_PLANIFICACION->fechamin=date($this->FormatoFechaTimeBD,strtotime($value->fechamin));
    $CP_PLANIFICACION->fechamax=date($this->FormatoFechaTimeBD,strtotime($value->fechamax));
    $CP_PLANIFICACION->fechaCalendariomin=date($this->FormatoFechaTimeBD,strtotime($value->fechaCalendariomin));
    $CP_PLANIFICACION->fechaCalendariomax=date($this->FormatoFechaTimeBD,strtotime($value->fechaCalendariomax));
    $CP_PLANIFICACION->cantidad=$value->cantidad;
    $CP_PLANIFICACION->centrocosto=$value->centrocosto;
    $CP_PLANIFICACION->pedido=$value->pedido;
    $CP_PLANIFICACION->estado=$value->estado;
    $CP_PLANIFICACION->horas=$value->horas;
    $CP_PLANIFICACION->version=$value->version;
    $CP_PLANIFICACION->porcentaje=0;
    $CP_PLANIFICACION->FICHA_TECNICA=$value->FICHA_TECNICA;
    $CP_PLANIFICACION->USUARIOCREACION=\Auth::user()->name;
    $CP_PLANIFICACION->FECHACREACION=$hoy;
    $CP_PLANIFICACION->save();
    $id_planificacion=$CP_PLANIFICACION->id;
  }
  $idnuevo=$id_planificacion;
   
  CP_PLANIFICACION::where('id','=',$id)->update(['VersionEstado'=>'H']);
  $fechainicial=CP_PLANIFICACION::where('id','=',$id_planificacion)->get();
  //calulamos el detalle en la tabla cp_detalleplanificcion
  foreach ($fechainicial as $key => $value) {
    $nueva2=date($this->FormatoFechaBD, strtotime($value->fechamin));
    //$nueva2=date('d-m-Y', strtotime($value->fechamin));
    $hora=date('H',strtotime($value->fechamin) );
    $orden=$value->ordenproduccion;
    $equipo=$value->centrocosto;
    $id3=$value->operacion;
    $id8=$value->FICHA_TECNICA;
    $cantidadproducir=$value->cantidad;
    $articulo=$value->articulo;
    $horas=$value->horas;
    $pedido=$value->pedido;
  }
  $equiposporhora=$this->ConsultaMaquina3($equipo,$articulo,$id3);
  foreach ($equiposporhora as $key => $value) {
    $cantidadxhora2=$value->HORASXHORA;    
  }
  $id=$horas;
  $secuencia2=1; 
  $turnos01=DB::Connection()->select(" SELECT ID  from  IBERPLAS.CP_CALENDARIO_PLANIFICADOR_DETALLE where
            fecha='$nueva2' and DATEPART(HOUR,hora)='$hora'
            and tipo='N'order by id ");
  foreach ($turnos01 as $key => $value) {
    $inicioturno=$value->ID;
  }
  
  $turnos2=CP_CALENDARIO_PLANIFICADOR_DETALLE::whereNull('ESTADO')
  -> where('ID','>=',$inicioturno)
   ->where('tipo','=','N')
   ->get();
  $conta=0;              
  $vcantidad=0;
  $cantidad2=0;
  foreach ($turnos2 as $turnos) {
    $conta=$conta+1;
    if($conta==$id+1){
      break;
    }else{
      if($conta==$id){
        $vcantidad=$cantidadproducir-$cantidad2;
      }else{
        $vcantidad=$cantidadxhora2;
        $cantidad2=$vcantidad+$cantidad2;
      }
      $plantemp=new CP_TEMP_PLANIFICACION;
      $plantemp->hora=$turnos->hora;
      $plantemp->orden=$turnos->orden;     
      $plantemp->turno=$turnos->turno;
      $plantemp->fecha=date($this->FormatoFechaBD,strtotime($turnos->fecha));
      $plantemp->fechaCalendario=date($this->FormatoFechaTimeBD,strtotime( $turnos->fechaCalendario));
      $plantemp->operacion=$id3;
      $plantemp->centrocosto=$equipo;
      $plantemp->secuencia=$secuencia2;
      $plantemp->calendario_id=$turnos->ID;
      $plantemp->orden_prod=$orden;
      $plantemp->cantidadxhora=$vcantidad;
      $plantemp->FICHA_TECNICA=$id8;
      $plantemp->USUARIOCREACION=\Auth::user()->name;
      $plantemp->save();
    }
  }
  $usuario=\Auth::user()->name;
  $turnosasigados=DB::Connection()->select("select min(calendario_id) as Horaini,MAX(calendario_id) as HoraFin,count(orden) as horas,sum(cantidadxhora) as cantidad,turno,fecha,operacion,centrocosto,secuencia,ficha_tecnica 
                  from IBERPLAS.CP_TEMP_PLANIFICACION
                  where  
                  USUARIOCREACION='$usuario' group by turno,fecha,operacion,centrocosto,secuencia,ficha_tecnica order by  secuencia,operacion,fecha,turno");
  CP_TEMP_PLANIFICACION_ENCA:: where('usuario','=',\auth::user()->name)->delete();
  foreach ($turnosasigados as $turnos) {
    $encatemp=new CP_TEMP_PLANIFICACION_ENCA;
    $encatemp->horaini=$turnos->Horaini;
    $encatemp->horafin=$turnos->HoraFin;
    $encatemp->horas=$turnos->horas;
    $encatemp->cantidad=$turnos->cantidad;
    $encatemp->turno=$turnos->turno;
    $encatemp->fecha=$turnos->fecha;
    $encatemp->operacion=$turnos->operacion;
    $encatemp->centrocosto=$turnos->centrocosto;
    $encatemp->secuencia=$turnos->secuencia;
    $encatemp->FICHA_TECNICA=$id8;
    $encatemp->USUARIO=\Auth::user()->name;
    $encatemp->save();
  }    
  // actualizar horas en temporal
  // recorremos la tabla de encabezado tempral
  // 
  $encatem=  CP_TEMP_PLANIFICACION_ENCA::where('USUARIO','=',\Auth::user()->name)->get();
  foreach ($encatem as $value) {
    $horaini=$value->horaini;
    $horafin=$value->horafin;
    $thoraini=CP_CALENDARIO_PLANIFICADOR_DETALLE::where ('ID','=',$horaini)->select('hora','fechahora')->get();
    $thorafin=CP_CALENDARIO_PLANIFICADOR_DETALLE::where ('ID','=',$horafin)->select('hora','fechahora')->get();
    foreach ($thoraini as $value) {
      $hora=$value->hora;
      $fhora=date($this->FormatoFechaTimeBD,strtotime($value->fechahora));
      //$fhora=date('d-m-Y H:i:s',strtotime($value->fechahora));
      CP_TEMP_PLANIFICACION_ENCA::where('horaini','=',$horaini)->update(['thoraini'=>$hora,'fhoraini'=>$fhora]);
    }
    foreach ($thorafin as $value) {
      $hora=$value->hora;
      $fhora=date($this->FormatoFechaTimeBD,strtotime($value->fechahora));     
      CP_TEMP_PLANIFICACION_ENCA::where('horafin','=',$horafin)->update(['thorafin'=>$hora,'fhorafin'=>$fhora]);
    }
  }
  $fechafin=DB::Connection()->select("select id,  DATEADD(MINUTE,59,thorafin) as thorafin2,
            DATEADD(MINUTE,59,fhorafin) as fhorafin2 from IBERPLAS.CP_TEMP_PLANIFICACION_ENCA");
  foreach($fechafin as $fechafin){
    $thorafin=$fechafin->thorafin2;
    $fhorafin=date($this->FormatoFechaTimeBD,strtotime($fechafin->fhorafin2));
    //$fhorafin=date('d-m-Y H:i:s',strtotime($fechafin->fhorafin2));
    $id=$fechafin->id;
    CP_TEMP_PLANIFICACION_ENCA::where('id','=',$id)->update(['thorafin'=>$thorafin,'fhorafin'=>$fhorafin]);
  }
  $turnosasigados= CP_TEMP_PLANIFICACION_ENCA::where('USUARIO','=',\Auth::user()->name)->get();         
  $this->guardar_planificacion2($orden,$pedido,$articulo);
  $this->actualizarRegistros($idantiguo,$idnuevo,$id2);
  $idCentroCosto=$request->centrocosto;
  $idFechaHora=$id4;
  $idCantidadHoras=$request->horasadicionales;    
  $this->ActualizarTicket($idantiguo,$idCentroCosto,$idFechaHora,$idCantidadHoras);
  //return   json_encode ($cambiohoras);
  
  return redirect()->action('OrdenProduccionController@Ticket');
}
public function ActualizarTicket($idantiguo,$idCentroCosto,$idFechaHora,$idCantidadHoras)
{
// Este proceso Actualiza los ticket si se mueven las horas de un ticket anterior
//Primero necesitamos obtener centrocosto,fechaHora del ticket modificado, Cantidad de Horas Trabajar
CP_TEMP_PLANIFICACION_ENCA::where('USUARIO','=',\Auth::user()->name )->delete();
CP_TEMP_PLANIFICACION::where('USUARIOCREACION','=',\Auth::user()->name )->delete();
$conta=0;
$fechafinal=DB::Connection()->select("select  id, DATEADD(MINUTE,-59,fechamax) as fechamax,centrocosto
            from IBERPLAS.CP_PLANIFICACION WHERE id='$idantiguo'");

foreach ($fechafinal as $key => $value) {
  $fechaFinal=date($this->FormatoFechaTimeBD,strtotime($value->fechamax));
  //$fechaFinal=date('d-m-Y H:i:s',strtotime($value->fechamax));
  $centrocosto=$value->centrocosto;
}

$ticketactivos=DB::Connection()->select("select * from 
                IBERPLAS.CP_PLANIFICACION WHERE fechamin>'$fechaFinal' and centrocosto='$centrocosto' and VersionEstado='A' and aprobadaMo='N' and aprobadaMA='N' order by fechamin ");
     //Recorremos los registros que estan en lista para actualizar
if(!is_null($ticketactivos)){
   foreach ($ticketactivos as $ticketactivos) {
    $ticketnumero=$ticketactivos->id;
    if($idCantidadHoras>=1){
      $cambiohoras=DB::Connection()->select("SELECT id,DATEADD(HOUR,+$idCantidadHoras,fechamin) as fechamin,
                  DATEADD(HOUR,+$idCantidadHoras,fechamax) as fechamax,DATEADD(HOUR,+$idCantidadHoras,fechaCalendariomin) as fechaCalendariomin,
                  DATEADD(HOUR,+$idCantidadHoras,fechaCalendariomax) as fechaCalendariomax
                  FROM IBERPLAS.CP_PLANIFICACION where id='$ticketactivos->id'");       
      foreach ($cambiohoras as $key => $cambiohoras) {
        CP_PLANIFICACION::where('id','=',$cambiohoras->id)
        ->update(['fechamin'=>date($this->FormatoFechaTimeBD,strtotime($cambiohoras->fechamin)),
        'fechamax'=>date($this->FormatoFechaTimeBD,strtotime($cambiohoras->fechamax)),'fechaCalendariomin'=>date($this->FormatoFechaTimeBD,strtotime($cambiohoras->fechaCalendariomin)),
        'fechaCalendariomax'=>date($this->FormatoFechaTimeBD,strtotime($cambiohoras->fechaCalendariomax))]);
       /* 
        CP_PLANIFICACION::where('id','=',$cambiohoras->id)->update(['fechamin'=>date('d-m-Y H:i:s',strtotime($cambiohoras->fechamin)),
        'fechamax'=>date('d-m-Y H:i:s',strtotime($cambiohoras->fechamax)),'fechaCalendariomin'=>date('d-m-Y H:i:s',strtotime($cambiohoras->fechaCalendariomin)),
        'fechaCalendariomax'=>date('d-m-Y H:i:s',strtotime($cambiohoras->fechaCalendariomax))]);
       */ 
      }
    }else{
      $cambiohoras=DB::Connection()->select("SELECT id,DATEADD(HOUR,$idCantidadHoras,fechamin) as fechamin,
                  DATEADD(HOUR,$idCantidadHoras,fechamax) as fechamax,DATEADD(HOUR,$idCantidadHoras,fechaCalendariomin) as fechaCalendariomin,
                  DATEADD(HOUR,$idCantidadHoras,fechaCalendariomax) as fechaCalendariomax
                  FROM IBERPLAS.CP_PLANIFICACION where id='$ticketactivos->id'");         
      foreach ($cambiohoras as $key => $cambiohoras) {
        CP_PLANIFICACION::where('id','=',$cambiohoras->id)->update(['fechamin'=>date($this->FormatoFechaTimeBD,strtotime($cambiohoras->fechamin)),
        'fechamax'=>date($this->FormatoFechaTimeBD,strtotime($cambiohoras->fechamax)),
        'fechaCalendariomin'=>date($this->FormatoFechaTimeBD,strtotime($cambiohoras->fechaCalendariomin)),
        'fechaCalendariomax'=>date($this->FormatofechaTimeBD,strtotime($cambiohoras->fechaCalendariomax))]);
        /*
        CP_PLANIFICACION::where('id','=',$cambiohoras->id)->update(['fechamin'=>date('d-m-Y H:i:s',strtotime($cambiohoras->fechamin)),
        'fechamax'=>date('d-m-Y H:i:s',strtotime($cambiohoras->fechamax)),
        'fechaCalendariomin'=>date('d-m-Y H:i:s',strtotime($cambiohoras->fechaCalendariomin)),
        'fechaCalendariomax'=>date('d-m-Y H:i:s',strtotime($cambiohoras->fechaCalendariomax))]);
        */
      }
    }
    $fechainicial=CP_PLANIFICACION::where('id','=',$ticketactivos->id)->get();
          //calulamos el detalle en la tabla cp_detalleplanificcion
    foreach ($fechainicial as  $fechainicial) {
      $nueva2=date($this->FormatoFechaBD, strtotime($fechainicial->fechamin));
      //$nueva2=date('d-m-Y', strtotime($fechainicial->fechamin));
      $hora=date('H',strtotime($fechainicial->fechamin) );
      $orden=$fechainicial->ordenproduccion;
      $equipo=$fechainicial->centrocosto;
      $id3=$fechainicial->operacion;
      $id8=$fechainicial->FICHA_TECNICA;
      $cantidadproducir=$fechainicial->cantidad;
      $articulo=$fechainicial->articulo;
      $horas=$fechainicial->horas;
      $pedido=$fechainicial->pedido;
    }
    //$id=centrocosto,$id2=articulo,$id3=descripcion operacion
    $equiposporhora=$this->ConsultaMaquina3($equipo,$articulo,$id3);
    foreach ($equiposporhora as $equiposporhora) {
      $cantidadxhora2=$equiposporhora->HORASXHORA;
    }
    //$id=round( $horas/8);
    $id=$horas;
    $secuencia2=1; 
    $turnos01=DB::Connection()->select(" SELECT ID  from  IBERPLAS.CP_CALENDARIO_PLANIFICADOR_DETALLE where
              fecha='$nueva2' and DATEPART(HOUR,hora)='$hora'and tipo='N'order by id ");
    foreach ($turnos01 as $turnos01) {
      $inicioturno=$turnos01->ID;
    }
    $turnos2=CP_CALENDARIO_PLANIFICADOR_DETALLE::whereNull('ESTADO')->
     where('ID','>=',$inicioturno)->where('tipo','=','N')->get();
    $conta=0;              
    $vcantidad=0;
    $cantidad2=0;
    foreach ($turnos2 as $turnos2) {
      $conta=$conta+1;
      if($conta==$id+1){
        break;
      } else{
        if($conta==$id){
          $vcantidad=$cantidadproducir-$cantidad2;
          }else{
          $vcantidad=$cantidadxhora2;
          $cantidad2=$vcantidad+$cantidad2;
          }
          $plantemp=new CP_TEMP_PLANIFICACION;
          $plantemp->hora=$turnos2->hora;
          $plantemp->orden=$turnos2->orden;     
          $plantemp->turno=$turnos2->turno;
          $plantemp->fecha=date($this->FormatoFechaBD,strtotime($turnos2->fecha));
          $plantemp->fechaCalendario=date($this->FormatoFechaTimeBD,strtotime( $turnos2->fechaCalendario));
          //$plantemp->fecha=date("d-m-Y",strtotime($turnos2->fecha));
          //$plantemp->fechaCalendario=date("d-m-Y H:i:s",strtotime( $turnos2->fechaCalendario));
          $plantemp->operacion=$id3;
          $plantemp->centrocosto=$equipo;
          $plantemp->secuencia=$secuencia2;
          $plantemp->calendario_id=$turnos2->ID;
          $plantemp->orden_prod=$orden;
          $plantemp->cantidadxhora=$vcantidad;
          $plantemp->FICHA_TECNICA=$id8;
          $plantemp->USUARIOCREACION=\Auth::user()->name;
          $plantemp->save();
      }
    }
    $usuario=\Auth::user()->name;
    $turnosasigados=DB::Connection()->select("select min(calendario_id) as Horaini,MAX(calendario_id) as HoraFin,count(orden) as horas,sum(cantidadxhora) as cantidad,turno,fecha,operacion,centrocosto,secuencia,ficha_tecnica 
                    from IBERPLAS.CP_TEMP_PLANIFICACION where USUARIOCREACION='$usuario' group by turno,fecha,operacion,centrocosto,secuencia,ficha_tecnica order by  secuencia,operacion,fecha,turno");
    CP_TEMP_PLANIFICACION_ENCA:: where('usuario','=',\auth::user()->name)->delete();
    foreach ($turnosasigados as $turnosasigados) {
      $encatemp=new CP_TEMP_PLANIFICACION_ENCA;
      $encatemp->horaini=$turnosasigados->Horaini;
      $encatemp->horafin=$turnosasigados->HoraFin;
      $encatemp->horas=$turnosasigados->horas;
      $encatemp->cantidad=$turnosasigados->cantidad;
      $encatemp->turno=$turnosasigados->turno;
      $encatemp->fecha=$turnosasigados->fecha;
      $encatemp->operacion=$turnosasigados->operacion;
      $encatemp->centrocosto=$turnosasigados->centrocosto;
      $encatemp->secuencia=$turnosasigados->secuencia;
      $encatemp->FICHA_TECNICA=$id8;
      $encatemp->USUARIO=\Auth::user()->name;
      $encatemp->save();
    }
    // actualizar horas en temporal
    // recorremos la tabla de encabezado tempral
    // 
    $encatem= CP_TEMP_PLANIFICACION_ENCA::where('USUARIO','=',\Auth::user()->name)->get();
    foreach ($encatem as $encatem) {
      $horaini=$encatem->horaini;
      $horafin=$encatem->horafin;
      $thoraini=CP_CALENDARIO_PLANIFICADOR_DETALLE::where ('ID','=',$horaini)->select('hora','fechahora')->get();
      $thorafin=CP_CALENDARIO_PLANIFICADOR_DETALLE::where ('ID','=',$horafin)->select('hora','fechahora')->get();
      foreach ($thoraini as $thoraini) {
        $hora=$thoraini->hora;
        $fhora=date($this->FormatoFechaTimeBD,strtotime($thoraini->fechahora));
        //$fhora=date('d-m-Y H:i:s',strtotime($thoraini->fechahora));
        CP_TEMP_PLANIFICACION_ENCA::where('horaini','=',$horaini)->update(['thoraini'=>$hora,'fhoraini'=>$fhora]);
      }
      foreach ($thorafin as $thorafin) {
        $hora=$thorafin->hora;
        $fhora=date($this->FormatoFechaTimeBD,strtotime($thorafin->fechahora));
        //$fhora=date('d-m-Y H:i:s',strtotime($thorafin->fechahora));
        CP_TEMP_PLANIFICACION_ENCA::where('horafin','=',$horafin)->update(['thorafin'=>$hora,'fhorafin'=>$fhora]);
      }
    }      
    //actualizacion de encabezados 04062018
    $fechafin=DB::Connection()->select("select id,  DATEADD(MINUTE,59,thorafin) as thorafin2,DATEADD(MINUTE,59,fhorafin) as fhorafin2 from IBERPLAS.CP_TEMP_PLANIFICACION_ENCA");
    foreach($fechafin as $fechafin){
      $thorafin=$fechafin->thorafin2;
      $fhorafin=date($this->FormatoFechaTimeBD,strtotime($fechafin->fhorafin2));
      //$fhorafin=date('d-m-Y H:i:s',strtotime($fechafin->fhorafin2));
      $id=$fechafin->id;
      CP_TEMP_PLANIFICACION_ENCA::where('id','=',$id)->update(['thorafin'=>$thorafin,'fhorafin'=>$fhorafin]);
    }
    $turnosasigados= CP_TEMP_PLANIFICACION_ENCA::where('USUARIO','=',\Auth::user()->name)->get();    
    $id=$ticketnumero;
    $this->guardar_planificacion3($orden,$pedido,$articulo,$id);
    //$this->actualizarRegistros($idantiguo,$idnuevo,$id2);    
    $conta=1+$conta;
  }  
  $idantiguo=$idantiguo;
  $idnuevo=$idantiguo;
  $id2=$orden;
  $this->actualizarRegistros($idantiguo,$idnuevo,$id2);
}
}

public function guardar_planificacion3($orden,$pedido,$articulo,$id){
$date = carbon::now();
$hoy = date($this->FormatoFechaTimeBD);
//$date = $date->format('d-m-Y H:i:s');    
//  $fechaplanificada=$request->id_fecha;
// $fechaplanificada=date("d-m-Y", strtotime($fechaplanificada)) ;
CP_ENCABEZADOPLANIFICACION::where('planificacion_id','=',$id)->delete();
CP_DETALLEPLANIFICACION::where('planificacion_id','=',$id)->delete();
CP_events::where('planificador_id','=',$id)->delete();
$maximo=$id;   
$encatem=CP_TEMP_PLANIFICACION_ENCA::where('USUARIO','=',\Auth::user()->name)->get();
foreach ($encatem as $value) {    
  $fechai=$value->fhoraini;
  $fechaf=$value->fhorafin;
  $fecha=$value->fecha;
  $fechai=date($this->FormatoFechaTimeBD,strtotime($fechai));
  $fechaf=date($this->FormatoFechaTimeBD,strtotime($fechaf));
  $fecha01=date($this->FormatoFechaBD,strtotime($fecha));
  /*
  $fechai=date("d-m-Y H:i:s",strtotime($fechai));
  $fechaf=date("d-m-Y H:i:s",strtotime($fechaf));
  $fecha01=date("d-m-Y",strtotime($fecha));
  */ 
  $planificacion=new CP_ENCABEZADOPLANIFICACION  ;  
  $planificacion->ordenproduccion=$orden;
  $planificacion->planificacion_id=$maximo;
  $planificacion->pedido=$pedido;
  $planificacion->articulo=$articulo;
  $planificacion->horaini=$value->horaini;
  $planificacion->horafin=$value->horafin;
  $planificacion->thoraini=$value->thoraini;
  $planificacion->thorafin=$value->thorafin;
  $planificacion->fhoraini=$fechai;
  $planificacion->fhorafin=$fechaf;
  $planificacion->horas=$value->horas;
  $planificacion->cantidad=$value->cantidad;
  $planificacion->turno=$value->turno;
  $planificacion->fecha=$fecha01;
  $planificacion->operacion=$value->operacion;
  $planificacion->centrocosto=$value->centrocosto;
  $planificacion->secuencia=$value->secuencia;
  $planificacion->estado='P';
  $planificacion->ficha_tecnica=$value->ficha_tecnica;
  $planificacion->USUARIOCREACION=\Auth::user()->name;
  $planificacion->FECHACREACION=$hoy;
  $planificacion->save();
} 
// recorremos la tabla cp_encabezadoplanificacion para actualizar las cantidades por turnos
//consultamos cantidad a produccion y cantidad de turnos lo sacamos de la tabla cp_planificcion
$cp_planificacion=CP_PLANIFICACION::where('id','=',$maximo)->get();
foreach ($cp_planificacion as $key => $value) {
  $cantidad=$value->cantidad;
  $horas=$value->horas;
  $cantidadxhora2=round($cantidad/$horas);
  $id=$value->horas;
}
$count=CP_ENCABEZADOPLANIFICACION::where('planificacion_id','=',$maximo)->get()->count();
$cp_encabezadoplanificacion=CP_ENCABEZADOPLANIFICACION::where('planificacion_id','=',$maximo)->get();
$conta=0;              
$vcantidad=0;
$cantidad2=0;
foreach ($cp_encabezadoplanificacion as $key => $value) {      
  $conta=$conta+1;
  if($conta==$count+1){
    break;
  }else{
    if($conta==$count){        
      $vcantidad=$cantidad-$cantidad2;
    }else{
      $vcantidad=($cantidadxhora2*$value->horas);
      $cantidad2=$vcantidad+$cantidad2;
    }
  }      
  CP_ENCABEZADOPLANIFICACION::where('id','=',$value->id)->update(['cantidad'=>$vcantidad]); 
};      
$detalleplanificacion=new CP_DETALLEPLANIFICACION;           
$tempdetalle=CP_TEMP_PLANIFICACION::all();   
foreach ($tempdetalle as $value) {       
  $detall=new CP_DETALLEPLANIFICACION;
  $detall->calendario_id=$value->calendario_id;
  $detall->orden_prod=$value->orden_prod;
  $detall->ordenproduccion=$orden;
  $detall->hora=$value->hora;
  $detall->orden=$value->orden;
  $detall->turno=$value->turno;
  $detall->fecha= date($this->FormatoFechaTimeBD,strtotime( $value->fecha));;
  $detall->fechaCalendario= date($this->FormatoFechaTimeBD,strtotime( $value->fechaCalendario));
  /*
  $detall->fecha= date("d-m-Y H:i:s",strtotime( $value->fecha));;
  $detall->fechaCalendario= date("d-m-Y H:i:s",strtotime( $value->fechaCalendario));
  */
  $detall->operacion=$value->operacion;
  $detall->planificacion_id=$maximo;
  $detall->centrocosto=$value->centrocosto;
  $detall->secuencia=$value->secuencia;
  $detall->FICHA_TECNICA=$value->FICHA_TECNICA;
  $detall->cantidadxhora=$value->cantidadxhora;
  $detall->USUARIOCREACION=\Auth::user()->name;
  $detall->FECHACREACION=$hoy;
  $detall->save();
}              
CP_TEMP_PLANIFICACION_ENCA::where('USUARIO','=',\Auth::user()->name )->delete();
CP_TEMP_PLANIFICACION::where('USUARIOCREACION','=',\Auth::user()->name )->delete();
//actualizamos fecha fin
//mandar mail de orden de produccion Planificado
$ordenproduccion2=$orden;
$gannt=DB::Connection()->select("select ('ORDEN='+PLA.ordenproduccion+'-'+'ARTICULO='+ART.ARTICULO+'-'+ART.DESCRIPCION) as text,min(PLA.fechamin) fechamin, SUM(PLA.horas) as horas ,PLA.centrocosto as centrocosto
        from 
        IBERPLAS.CP_PLANIFICACION PLA,
        IBERPLAS.ARTICULO ART
        where
        PLA.articulo=ART.ARTICULO AND 
        ordenproduccion='$ordenproduccion2' and
        PLA.Versionestado='A'
        group by 
        PLA.ordenproduccion,
        ART.ARTICULO,
        ART.DESCRIPCION,
        PLA.centrocosto" );
cp_tasks::where('ordenproduccion','=', $orden)->where('planificador_id','=',$maximo)->delete();
cp_events::where('ordenproduccion','=', $orden)->where('planificador_id','=',$maximo)->delete();
foreach ($gannt as $value) {
  $fecha=date($this->FormatoFechaTimeBD,strtotime($value->fechamin));
  //$fecha=date("d-m-Y H:i:s",strtotime($value->fechamin));
  $task=new cp_tasks;
  $task->text=$value->text;
  $task->duration=$value->horas;
  $task->progress=0.25;
  $task->start_date=$fecha;
  $task->centrocosto=$value->centrocosto;
  $task->ordenproduccion=$ordenproduccion2;
  $task->save(); 
}
//ESTADOS P=PLANIIFICACO,A=EN PROCESO,B=FINALIZADA,C=CERRADA,D=LIQUIDADA
$gannt2=DB::Connection()->select("select pl.fechaCalendariomin,pl.fechaCalendariomax,('ORDEN='+PL.ordenproduccion+'-'+'ARTICULO='+ART.ARTICULO+'-'+ART.DESCRIPCION) as text,SUBSTRING(pl.centrocosto,7,3) as cc,pl.centrocosto,pl.ordenproduccion 
                        from IBERPLAS.CP_PLANIFICACION pl, 
                        IBERPLAS.ARTICULO ART
                        WHERE 
                        PL.ARTICULO=ART.ARTICULO AND
                        pl.id='$maximo' and  VersionEstado='A'" );
$min=DB::Connection()->select("select min(calendario_id) mino, DATEPART(WEEK,fechaCalendario) semana 
                       from IBERPLAS.CP_DETALLEPLANIFICACION 
                       where planificacion_id='$maximo'
                       group by  DATEPART(WEEK,fechaCalendario) ");
foreach ($min as  $value) {
  $fechai=CP_DETALLEPLANIFICACION::where('calendario_id','=',$value->mino)->first();                     
  $task=new CP_events;
  $task->start_date=date($this->FormatoFechaTimeBD,strtotime($fechai->fechaCalendario));
  //$task->start_date=date("d-m-Y H:i:s",strtotime($fechai->fechaCalendario));
  $task->planificador_id=$maximo;
  $task->bloque=$value->semana;                     
  $task->save(); 
}
$max=DB::Connection()->select("select max(calendario_id) max, DATEPART(WEEK,fechaCalendario) semana 
                      from IBERPLAS.CP_DETALLEPLANIFICACION 
                      where planificacion_id='$maximo'
                      group by  DATEPART(WEEK,fechaCalendario) ");
foreach ($max as  $value) {
  $max2=CP_DETALLEPLANIFICACION::where('calendario_id','=',$value->max)->first();
  $fechaf=date($this->FormatoFechaTimeBD,strtotime($max2->fechaCalendario));                     
  //$fechaf=date("d-m-Y H:i:s",strtotime($max2->fechaCalendario));                     
  CP_events::where('bloque','=',$value->semana)->where('planificador_id','=',$maximo)->update(['end_date'=>$fechaf]);
}
foreach ($gannt2 as  $value) {                       
  CP_events::where('planificador_id','=',$maximo)
  ->update(['text'=>$value->text,'type_id'=>$value->cc,'centrocosto'=>$value->centrocosto,'ordenproduccion'=>$value->ordenproduccion]);
}      
return ($orden);
}

public function actualizarRegistros($idantiguo,$idnuevo,$id2){ 
$registroantiguos=CP_ENCABEZADOPLANIFICACION::where('planificacion_id','=',$idantiguo)->get();
foreach ($registroantiguos as $key => $value) {
  $horaini=$value->horaini;
  $idantigo=$value->id;
  $registronuevos=CP_ENCABEZADOPLANIFICACION::where('planificacion_id','=',$idnuevo)->where('horaini','=',$horaini)->select('id')->get();
  foreach ($registronuevos as $registronuevo) {
    $id=$registronuevo->id;
  }
CP_REGISTROEMPLEADOS::where('TURNO','=',$idantigo)->where('ORDENPRODUCCION','=',$id2)->UPDATE(['TURNO'=>$id,'planificador_id'=>$idnuevo]);
CP_REGISTROHORAS::where('TURNO','=',$idantigo)->where('ORDENPRODUCCION','=',$id2)->UPDATE(['TURNO'=>$id,'planificador_id'=>$idnuevo]);
CP_REGISTROPRODUCCION::where('TURNO','=',$idantigo)->where('ORDENPRODUCCION','=',$id2)->UPDATE(['TURNO'=>$id,'planificador_id'=>$idnuevo]);
CP_consumo::where('planificacion_id','=',$idantiguo)->update(['planificacion_id'=>$idnuevo]);       
}  
}
public function guardar_planificacion2($orden,$pedido,$articulo){
$date = carbon::now();
$hoy = date($this->FormatoFechaTimeBD);    
//$date = $date->format('d-m-Y H:i:s');    
$maximo=CP_PLANIFICACION::max('id');
$encatem=CP_TEMP_PLANIFICACION_ENCA::all();
foreach ($encatem as $value) {
  $fechai=$value->fhoraini;
  $fechaf=$value->fhorafin;
  $fecha=$value->fecha;
  $fechai=date($this->FormatoFechaTimeBD,strtotime($fechai));
  $fechaf=date($this->FormatoFechaTimeBD,strtotime($fechaf));
  $fecha01=date($this->FormatoFechaBD,strtotime($fecha));
  /*
  $fechai=date("d-m-Y H:i:s",strtotime($fechai));
  $fechaf=date("d-m-Y H:i:s",strtotime($fechaf));
  $fecha01=date("d-m-Y",strtotime($fecha));
  */
  $planificacion=new CP_ENCABEZADOPLANIFICACION  ;  
  $planificacion->ordenproduccion=$orden;
  $planificacion->planificacion_id=$maximo;
  $planificacion->pedido=$pedido;
  $planificacion->articulo=$articulo;
  $planificacion->horaini=$value->horaini;
  $planificacion->horafin=$value->horafin;
  $planificacion->thoraini=$value->thoraini;
  $planificacion->thorafin=$value->thorafin;
  $planificacion->fhoraini=$fechai;
  $planificacion->fhorafin=$fechaf;
  $planificacion->horas=$value->horas;
  $planificacion->cantidad=$value->cantidad;
  $planificacion->turno=$value->turno;
  $planificacion->fecha=$fecha01;
  $planificacion->operacion=$value->operacion;
  $planificacion->centrocosto=$value->centrocosto;
  $planificacion->secuencia=$value->secuencia;
  $planificacion->estado='P';
  $planificacion->ficha_tecnica=$value->ficha_tecnica;
  $planificacion->USUARIOCREACION=\Auth::user()->name;
  $planificacion->FECHACREACION=$hoy;
  $planificacion->save();
} 
// recorremos la tabla cp_encabezadoplanificacion para actualizar las cantidades por turnos
//consultamos cantidad a produccion y cantidad de turnos lo sacamos de la tabla cp_planificcion
$cp_planificacion=CP_PLANIFICACION::where('id','=',$maximo)->get();
foreach ($cp_planificacion as $key => $value) {
  $cantidad=$value->cantidad;
  $horas=$value->horas;
  $cantidadxhora2=round($cantidad/$horas);
  $id=$value->horas;
}
$count=CP_ENCABEZADOPLANIFICACION::where('planificacion_id','=',$maximo)->get()->count();     
$cp_encabezadoplanificacion=CP_ENCABEZADOPLANIFICACION::where('planificacion_id','=',$maximo)->get();
$conta=0;              
$vcantidad=0;
$cantidad2=0;
foreach ($cp_encabezadoplanificacion as $key => $value) {
  $conta=$conta+1;
  if($conta==$count+1){
    break;
  }else{
    if($conta==$count){         
      $vcantidad=$cantidad-$cantidad2;
    }else{
      $vcantidad=($cantidadxhora2*$value->horas);
      $cantidad2=$vcantidad+$cantidad2;
    }
  }
  CP_ENCABEZADOPLANIFICACION::where('id','=',$value->id)->update(['cantidad'=>$vcantidad]); 
};              
$detalleplanificacion=new CP_DETALLEPLANIFICACION;          
$tempdetalle=CP_TEMP_PLANIFICACION::all();    
foreach ($tempdetalle as $value) {        
  $detall=new CP_DETALLEPLANIFICACION;
  $detall->calendario_id=$value->calendario_id;
  $detall->orden_prod=$value->orden_prod;
  $detall->ordenproduccion=$orden;
  $detall->hora=$value->hora;
  $detall->orden=$value->orden;
  $detall->turno=$value->turno;
  $detall->fecha= date($this->FormatoFechaTimeBD,strtotime( $value->fecha));;
  $detall->fechaCalendario= date($this->FormatoFechaTimeBD,strtotime( $value->fechaCalendario));
  //$detall->fecha= date("d-m-Y H:i:s",strtotime( $value->fecha));;
  //$detall->fechaCalendario= date("d-m-Y H:i:s",strtotime( $value->fechaCalendario));
  $detall->operacion=$value->operacion;
  $detall->planificacion_id=$maximo;
  $detall->centrocosto=$value->centrocosto;
  $detall->secuencia=$value->secuencia;
  $detall->FICHA_TECNICA=$value->FICHA_TECNICA;
  $detall->cantidadxhora=$value->cantidadxhora;
  $detall->USUARIOCREACION=\Auth::user()->name;
  $detall->FECHACREACION=$hoy;
  $detall->save();       
}              
CP_TEMP_PLANIFICACION_ENCA::where('USUARIO','=',\Auth::user()->name )->delete();
CP_TEMP_PLANIFICACION::where('USUARIOCREACION','=',\Auth::user()->name )->delete();
//actualizamos fecha fin
//mandar mail de orden de produccion Planificado
$ordenproduccion2=$orden;
//para no enviar correo
$cp_planificacion2=CP_PLANIFICACION::where('ordenproduccion','=',$ordenproduccion2)->where('VersionEstado','=','A')->get();
$emails=CP_emails::where('email01','=','S')->select('email')->get();  
Mail::to($emails)->send(new Produccion($cp_planificacion2,$ordenproduccion2));
$gannt=DB::Connection()->select("select ('ORDEN='+PLA.ordenproduccion+'-'+'ARTICULO='+ART.ARTICULO+'-'+ART.DESCRIPCION) as text,min(PLA.fechamin) fechamin, SUM(PLA.horas) as horas ,PLA.centrocosto as centrocosto
      from 
      IBERPLAS.CP_PLANIFICACION PLA,
      IBERPLAS.ARTICULO ART
      where
      PLA.articulo=ART.ARTICULO AND 
      ordenproduccion='$ordenproduccion2' and
      PLA.Versionestado='A'
      group by 
      PLA.ordenproduccion,
      ART.ARTICULO,
      ART.DESCRIPCION,
      PLA.centrocosto" );
cp_tasks::where('ordenproduccion','=', $orden)->delete();
cp_events::where('ordenproduccion','=', $orden)->delete();
foreach ($gannt as $value) {
  $fecha=date($this->FormatoFechaTimeBD,strtotime($value->fechamin));
  //$fecha=date("d-m-Y H:i:s",strtotime($value->fechamin));
  $task=new cp_tasks;
  $task->text=$value->text;
  $task->duration=$value->horas;
  $task->progress=0.25;
  $task->start_date=$fecha;
  $task->centrocosto=$value->centrocosto;
  $task->ordenproduccion=$ordenproduccion2;
  $task->save(); 
}
//ESTADOS P=PLANIIFICACO,A=EN PROCESO,B=FINALIZADA,C=CERRADA,D=LIQUIDADA
$gannt2=DB::Connection()->select("select pl.fechaCalendariomin,pl.fechaCalendariomax,('ORDEN='+PL.ordenproduccion+'-'+'ARTICULO='+ART.ARTICULO+'-'+ART.DESCRIPCION) as text,SUBSTRING(pl.centrocosto,7,3) as cc,pl.centrocosto,pl.ordenproduccion 
                from 
                IBERPLAS.CP_PLANIFICACION pl, 
                IBERPLAS.ARTICULO ART
                WHERE 
                PL.ARTICULO=ART.ARTICULO AND
                pl.id='$maximo'" );
foreach ($gannt2 as $value) {
  $fechai=date($this->FormatoFechaTimeBD,strtotime($value->fechaCalendariomin));
  $fechaf=date($this->FormatoFechaTimeBD,strtotime($value->fechaCalendariomax));
  //$fechai=date("d-m-Y H:i:s",strtotime($value->fechaCalendariomin));
  //$fechaf=date("d-m-Y H:i:s",strtotime($value->fechaCalendariomax));
  $task=new CP_events;
  $task->start_date=$fechai;
  $task->end_date=$fechaf;
  $task->text=$value->text;
  $task->type_id=$value->cc;
  $task->centrocosto=$value->centrocosto;
  $task->ordenproduccion=$value->ordenproduccion;
  $task->planificador_id=$maximo;
  $task->save(); 
}
return ($orden);
}

public function ConsultaMaquina3($id,$id2,$id3){
    
    //$id=centrocosto,$id2=articulo,$id3=descripcion operacion
      //$id=$_GET['id'];
      //$id2=$_GET['id2'];
      //$id3=$_GET['id3'];

     
      //$centrocosto=CP_EQUIPOARTICULO::
     // where('ID','=',$id)->
     // get();
      

      $centrocosto=DB::Connection()->select("SELECT  PROCESO.CANT_PRODUCIDA_PT,PROCESO.HORAS_STD_MOE,
      RUBRO.ARTICULO,RUBRO.OPERACION,PROCESO.DESCRIPCION, 
      RUBRO.RUBRO,
      CASE  PROCESO.CP_TIEMPOCAMBIOMOLDE WHEN NULL THEN PROCESO.CP_TIEMPOCAMBIOMOLDE ELSE 0.0  END as CP_TIEMPOCAMBIOMOLDE ,
      CASE PROCESO.CANT_PRODUCIDA_PP WHEN 1 THEN (PROCESO.CANT_PRODUCIDA_PT/PROCESO.HORAS_STD_MOE) ELSE (PROCESO.CANT_PRODUCIDA_PP/PROCESO.HORAS_STD_MOE) END AS HORASXHORA
            FROM 
            IBERPLAS.ESTRUC_PROC_RUBRO RUBRO,
            IBERPLAS.ESTRUC_PROCESO PROCESO
            WHERE 
            PROCESO.ARTICULO=RUBRO.ARTICULO AND
            PROCESO.VERSION IN(SELECT VERSION FROM IBERPLAS.ESTRUC_MANUFACTURA WHERE ESTADO='A' AND ARTICULO='$id2')AND    
            RUBRO.ARTICULO='$id2' AND 
            PROCESO.ARTICULO='$id2' AND
            RUBRO.OPERACION=PROCESO.OPERACION and
            PROCESO.DESCRIPCION='$id3' AND
            RUBRO.RUBRO='$id' AND
            RUBRO.VERSION IN (SELECT VERSION FROM IBERPLAS.ESTRUC_MANUFACTURA WHERE ESTADO='A' AND ARTICULO='$id2')");


     //  dd($centrocosto);
      return ($centrocosto);

    }
}
