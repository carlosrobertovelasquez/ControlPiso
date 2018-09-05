<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\ControlPiso\CP_ENCABEZADOPLANIFICACION;
use App\Modelos\ControlPiso\CP_DETALLEPLANIFICACION;
use App\Modelos\ControlPiso\CP_PLANIFICACION;
use App\Modelos\ControlPiso\CP_CLAVE_MO;
use App\Modelos\Softland\OP_OPERACION;
use App\Modelos\ControlPiso\CP_REGISTROHORAS;
use App\Modelos\ControlPiso\CP_REGISTROEMPLEADOS;
use App\Modelos\ControlPiso\CP_REGISTROPRODUCCION;
use App\Modelos\ControlPiso\CP_globales;
use App\Modelos\ControlPiso\CP_EQUIPOARTICULO;
use App\Modelos\Softland\EMPLEADO;
use App\Modelos\ControlPiso\CP_PRODUCCION;
use App\Modelos\Softland\ATRIB_EQUIPO;
use App\Modelos\Softland\ARTICULO;
use App\Modelos\Softland\OP_OPER_CONSUMO;
use App\Modelos\Softland\OP_OPER_DET;
use App\Modelos\Softland\OP_OPER_DET_MO;
use App\Modelos\ControlPiso\CP_consumo;
use Illuminate\Support\Facades\DB;
Use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Input;
use Response;

class RegistroController extends Controller
{
    public function index(){


         $OrdenProduccion=CP_PLANIFICACION::wherein('ESTADO',['A' ])->where('VersionEstado','=','A')->get();
        return view('ControPiso.Transacciones.Registro.index')
               ->with('OrdenProduccion',$OrdenProduccion);
    }

    public function RegistroMO(){
    $OrdenProduccion=CP_PLANIFICACION::wherein('ESTADO',['A' ])->where('VersionEstado','=','A')->get();
        return view('ControPiso.Transacciones.Registro.MO.index')
               ->with('OrdenProduccion',$OrdenProduccion);

    }
    public function RegistroMA(){
      $OrdenProduccion=CP_PLANIFICACION::wherein('ESTADO',['A' ])->where('VersionEstado','=','A')->get();
        return view('ControPiso.Transacciones.Registro.MA.index')
               ->with('OrdenProduccion',$OrdenProduccion);

    }
public function RegistroPR(){
$OrdenProduccion=CP_PLANIFICACION::wherein('ESTADO',['A' ])->where('VersionEstado','=','A')->get();
        return view('ControPiso.Transacciones.Registro.PR.index')
               ->with('OrdenProduccion',$OrdenProduccion);

}
public function mo($id,$id2,$id3)
{
   //id= id de planificacion
  //id2= Ordende produccion
  //id3= centroCosto
  $globales = CP_globales::max('produccdetallada');
  if($globales=="S"){
    $encabezado=CP_planificacion::where('id','=',$id)->get()->first();
    $encabezado2=CP_planificacion::where('id','=',$id)->get();
    $atributoarticulo=ATRIB_EQUIPO::where('EQUIPO','=',$id3)->where('ATRIBUTO','=','PLANIFICA')->first();
    if(count($atributoarticulo)==1){
         $detalle=DB::Connection()->select ("select rank() OVER (ORDER BY turno) as id,TURNO as turno ,
         CONVERT(char(8), HORA_INICIO, 108)  AS thoraini,CONVERT(char(8), HORA_TERMINO, 108)  AS  thorafin,'01-01-1988' as fecha,duracion as horas from IBERPLAS.TURNO");
 
    }else{
         $detalle=CP_ENCABEZADOPLANIFICACION::where('planificacion_id','=',$id)->get();  
     
    }
   
    $operacion=OP_OPERACION::where('ORDEN_PRODUCCION','=',$id2)->get();
    $clave_mo=CP_CLAVE_MO::all();
    $registrohoras=CP_REGISTROHORAS::all();
    foreach ($encabezado2 as $value) {
      $equipo=$value->centrocosto;
      $articulo=$value->articulo;
    }
    $equipo=CP_EQUIPOARTICULO::where('EQUIPO','=',$equipo)->where('ARTICULO','=',$articulo)->get()->first();    
    return view('ControPiso.Transacciones.Registro.mo')
    ->with('operacion',$operacion)
    ->with('encabezado',$encabezado)
    ->with('detalle',$detalle)
    ->with('clave_mo',$clave_mo)
    ->with('registrohoras',$registrohoras)
    ->with('equipo',$equipo);
  }else{
    $encabezado=CP_PLANIFICACION::where('id','=',$id)->get()->first();
    $detalle=CP_ENCABEZADOPLANIFICACION::where('planificacion_id','=',$id)->get();
    $operacion=OP_OPERACION::where('ORDEN_PRODUCCION','=',$id2)->get();
    $clave_mo=CP_CLAVE_MO::all();
    $registrohoras=CP_REGISTROHORAS::all();  
    return view('ControPiso.Transacciones.Registro.mo02')
    ->with('operacion',$operacion)
    ->with('encabezado',$encabezado)
    ->with('detalle',$detalle)
    ->with('clave_mo',$clave_mo)
    ->with('registrohoras',$registrohoras);
  }
}

public function ma($id,$id2)
    {
     
        $operacion=CP_PLANIFICACION::where('id','=',$id)->first();
        $cp_consumo=CP_consumo::where('planificacion_id','=',$id)->get();    
             $opera=$operacion->operacion;
             $id=$operacion->id;
             $orden=$operacion->ordenproduccion;
          $opera2=OP_OPERACION::where('ORDEN_PRODUCCION','=',$id2)->
          where('DESCRIPCION','=',$opera)->get();
          foreach ($opera2 as $value) {
                 $opera3=$value->OPERACION;
          }
           $consumo=DB::connection()->select("select '$id' as id,cons.OPERACION,cons.ORDEN_PRODUCCION,cons.ARTICULO,art.DESCRIPCION,cons.CANTIDAD_ESTANDAR,art.UNIDAD_ALMACEN from 
                IBERPLAS.OP_OPER_CONSUMO cons,
                    IBERPLAS.ARTICULO art 
                    where 
                    cons.ARTICULO=art.ARTICULO and
                    cons.ORDEN_PRODUCCION='$id2' and cons.OPERACION='$opera3' ");        
            return view('ControPiso.Transacciones.Registro.MA.ma')
           ->with('consumo',$consumo)
            ->with('cp_consumo',$cp_consumo)
            ->with('id',$id)
            ->with('orden',$orden);
        
    }
    public function pr($id,$id2,$id3)
    {
    //id= id de planificacion
      //id2= Ordende produccion
      //id3= centroCosto
      $operacion=CP_PLANIFICACION::where('id','=',$id)->get();
      foreach ($operacion as $key => $operacion) {
        # code...
        $opera=$operacion->operacion;
           $id=$operacion->id;
           $orden=$operacion->ordenproduccion;

      }
            $cp_consumo=CP_consumo::where('planificacion_id','=',$id)->get();    
           
        $opera2=OP_OPERACION::where('ORDEN_PRODUCCION','=',$id2)->
        where('DESCRIPCION','=',$opera)->get();

        foreach ($opera2 as $value) {
               $opera3=$value->OPERACION;
        }

         $consumo=DB::connection()->select("select '$id' as id,cons.OPERACION,cons.ORDEN_PRODUCCION,cons.ARTICULO,art.DESCRIPCION,cons.CANTIDAD_ESTANDAR,art.UNIDAD_ALMACEN from 
              IBERPLAS.OP_OPER_CONSUMO cons,
                  IBERPLAS.ARTICULO art 
                  where 
                  cons.ARTICULO=art.ARTICULO and
                  cons.ORDEN_PRODUCCION='$id2' and cons.OPERACION='$opera3' "); 
          
        $operacion=OP_OPER_CONSUMO::where('ORDEN_PRODUCCION','=',$id2)->where('OPERACION','=',$opera3)->select('OPERACION')->first();
         
//        $operacion=$opera3;                # code...
              

        return view('ControPiso.Transacciones.Registro.PR.pr')
        ->with('consumo',$consumo)
        ->with('cp_consumo',$cp_consumo)
        ->with('id',$id)
        ->with('opera3',$opera3)
        ->with('orden',$orden);
        
       
    }

public function listarhoras(){

        $id=$_GET['id'];
      $id2=$_GET['id2'];
      $id3=$_GET['id3'];
     $registrohoras=CP_REGISTROHORAS::
     where('ORDENPRODUCCION','=',$id)
     ->where('TURNO','=',$id2)
     ->where('OPERACION','=',$id3)->orderby ('HORAINICIO','DESC')->get() ;
    
    

    
      return view('ControPiso.Transacciones.Registro.lista_horas')  
      ->with('registrohoras',$registrohoras); 
    }

public function listaremple(){
    $id=$_GET['id'];
    $id2=$_GET['id2'];
    $id3=$_GET['id3'];
     $registroempleados=CP_REGISTROEMPLEADOS::
     where('ORDENPRODUCCION','=',$id)
     ->where('TURNO','=',$id2)
     ->where('OPERACION','=',$id3)->get() ;
    

      return view('ControPiso.Transacciones.Registro.lista_empleados')  
      ->with('registroempleados',$registroempleados); 
    }
    public function listarproducc2(){
        $id=$_GET['id'];
        $id2=$_GET['id2'];
        $id3=$_GET['id3'];
        dd($id2); 
        $registroproduccion=CP_REGISTROPRODUCCION::
         where('ORDENPRODUCCION','=',$id)
         ->where('TURNO','=',$id2)
         ->where('OPERACION','=',$id3)->get() ;
        
    
          return view('ControPiso.Transacciones.Registro.lista_produccion')  
          ->with('registroproduccion',$registroproduccion); 
        }    
    public function listarproduccion(){
        $id=$_GET['id'];
        $id2=$_GET['id2'];
        $id3=$_GET['id3'];
         $listarproduccion=CP_REGISTROPRODUCCION::
         where('ORDENPRODUCCION','=',$id)
         ->where('TURNO','=',$id2)
         ->where('OPERACION','=',$id3)->first() ;
        
          
    
         return response()->json($listarproduccion);
        }

        public function listarconsumo(){
            $id=$_GET['id'];//id
            $id2=$_GET['id2'];//orden produccion
           
             $listarconsumo=CP_CONSUMO::
             where('orden_produccion','=',$id2)
             ->where('planificacion_id','=',$id)
             ->first() ;
            
             
              
        
             return response()->json($listarconsumo);
            }
        

public function totalhoras(){

    $id=$_GET['id'];
    $id2=$_GET['id2'];
    $id3=$_GET['id3'];
     $horastrabajadas=DB::Connection()->select ("select  
SUM((DATEPART(HOUR,tiempo))*60+DATEPART(MINUTE,tiempo)) as total
from IBERPLAS.CP_REGISTROHORAS
where 
OPERACION='$id3' and
ORDENPRODUCCION='$id' and 
TURNO='$id2' ");

 

    foreach ($horastrabajadas as $value) {

       $horas=intval(($value->total)/60);
       $minutos=(($value->total)/60)-intval(($value->total)/60); 
      // $minutos=($minutos*60);  
      // 
      if($minutos<0.1){

        $minutos=(($minutos*60)/10);
      }else{
        $minutos=(($minutos*60));
      }

        
    }



 if($horas==0){
    $horastotal="00:".+$minutos;
}else{
    $horastotal=$horas.":".$minutos;
}  
    
    return response()->json($horastotal);
    //  return view('ControPiso.Transacciones.Registro.lista_horas')
    //  ->with('horastrabajadas',$horastrabajadas); 
    }

public function tiempoPerdido(){
    $id=$_GET['id'];
    $id2=$_GET['id2'];
    $id3=$_GET['id3'];
    
     $horasPerdidas=DB::Connection()->select ( "select  
SUM((DATEPART(HOUR,tiempo))*60+DATEPART(MINUTE,tiempo)) as total
from IBERPLAS.CP_REGISTROHORAS
where 
OPERACION='$id3' and
ORDENPRODUCCION='$id' and 
TURNO='$id2' and
OPERA='RESTA' ");

    foreach ($horasPerdidas as $value) {
       
            $horas=intval(($value->total)/60);
       $minutos=(($value->total)/60)-intval(($value->total)/60); 
      // $minutos=($minutos*60);  
      // 
      if($minutos<0.1){

        $minutos=(($minutos*60)/10);
      }else{
        $minutos=(($minutos*60));
      } 
    }
   
   
  if($horas==0){
    $horastotal="00:".+$minutos;
}else{
    $horastotal=$horas.":".$minutos;
}

return response()->json($horastotal); 
}

public function metaxTurno(){
    $id=$_GET['id'];
    $id2=$_GET['id2'];
    $id3=$_GET['id3'];
    $id4=$_GET['id4'];
    $id5=$_GET['id5'];
    
   $cantidad=CP_ENCABEZADOPLANIFICACION::where ('id','=',$id2)->select('cantidad')->first();
      
   if(is_null($cantidad)){
    $cantidad2=0;
   }else{
    
     $cantidad2=$cantidad;
   } 
  
return response::json ($cantidad2); 
}

public function metaxTurno2(){
    $id=$_GET['id'];
    $id2=$_GET['id2'];
    $id3=$_GET['id3'];
    $id4=$_GET['id4'];
    $id5=$_GET['id5'];
    
    

   $ESTRUC_PROCESO=DB::Connection()->select("select 
        CASE CANT_PRODUCIDA_PP WHEN 1 THEN (CANT_PRODUCIDA_PT/HORAS_STD_MOE) ELSE (CANT_PRODUCIDA_PP/HORAS_STD_MOE) END AS HORASXHORA
         from IBERPLAS.ESTRUC_PROCESO 
        where 
        ARTICULO='$id5' and 
        DESCRIPCION='$id3' and
        VERSION IN(SELECT VERSION FROM IBERPLAS.ESTRUC_MANUFACTURA WHERE ESTADO='A' AND ARTICULO='$id5')");
  foreach ($ESTRUC_PROCESO as $key => $value) {
    $cantidad2=$value->HORASXHORA;
  }
  
return response::json ($cantidad2); 
}

public function horasplanificadas(){
    $id=$_GET['id'];
    $id2=$_GET['id2'];
    $id3=$_GET['id3'];
    
   $cantidad3=CP_ENCABEZADOPLANIFICACION::where ('id','=',$id2)->get();

  
   foreach ($cantidad3 as $value) {
    
     $horas=$value->horas;
   }
    
   if(!is_null($cantidad3)){
    $horas=8;
   } 
return response::json($horas); 
}



public function horasTrabajadas(){

    $id=$_GET['id'];
    $id2=$_GET['id2'];
    $id3=$_GET['id3'];

$horasPerdidas=DB::Connection()->select ( "select  
SUM((DATEPART(HOUR,tiempo))*60+DATEPART(MINUTE,tiempo)) as total
from IBERPLAS.CP_REGISTROHORAS
where 
OPERACION='$id3' and
ORDENPRODUCCION='$id' and 
TURNO='$id2' and
OPERA='RESTA' ");


$cantidad3=CP_ENCABEZADOPLANIFICACION::where ('id','=',$id2)->get();


foreach ($horasPerdidas as $value) {
    
    $horasperdidas=$value->total;

}


$horastrabajadas=DB::Connection()->select ("select  
SUM((DATEPART(HOUR,tiempo))*60+DATEPART(MINUTE,tiempo)) as total
from IBERPLAS.CP_REGISTROHORAS
where 
OPERACION='$id3' and
ORDENPRODUCCION='$id' and 
TURNO='$id2' ");

foreach ($horastrabajadas as $value) {
    
    $horastrabajadas=$value->total;
}


  $total=($horastrabajadas-$horasperdidas);




   if($total<60){

    $tiempo="00:".+$total;
   }else{

        
        $horas=intval(($total)/60);
       $minutos=intval(((($total)/60)-intval(($total)/60))*60); 

       $tiempo=$horas.":".$minutos;
         
   }

    

   


    
   return response()->json($tiempo);   

}



    public function agregar(Request $request){

       $date = carbon::now();
             $date = $date->format('Y-m-d H:i:s');
     
     $opera=CP_CLAVE_MO::where('CLAVE','=',$request->id_clave)->get();

     
     foreach ($opera as $opera) {
         
         $opera1=$opera->OPERACION;
     }

     

     $registrohoras=new CP_REGISTROHORAS;
 
     $registrohoras->ORDENPRODUCCION=$request->norden;
     $registrohoras->TURNO=$request->id_turno;
     $registrohoras->FECHA=$request->id_fecha;
     $registrohoras->OPERACION=$request->id_operacion;
     $registrohoras->OPERA=$opera1;
     $registrohoras->HORAINICIO=$request->hora1;
     $registrohoras->HORAFIN=$request->hora2;
     $registrohoras->TIEMPO=$request->horatotal;
     $registrohoras->CLAVE=$request->id_clave;
     $registrohoras->subclave=$request->id_subclave;
     $registrohoras->COMENTARIOS=$request->comentarios;
     $registrohoras->USUARIOCREACION=\Auth::user()->name;
     $registrohoras->FECHACREACION=$date;
      $registrohoras->planificador_id=$request->planificacion_id;
     $registrohoras->save();

    }
    public function agregar2(Request $request){

        $date = carbon::now();
              $date = $date->format('Y-m-d H:i:s');
      


      //$opera=CP_CLAVE_MO::where('CLAVE','=',$request->id_clave)->get();
 
     /* 
      foreach ($opera as $opera) {
          
          $opera1=$opera->OPERACION;
      }
      */
      //Claves 100 operando y suma
      
     $hp=$request->horasPlanificadas*60;
     $ht=$request->total_horas;

     list($hr,$min) = explode(':', $ht);

     $horas=($hr*60)+$min;

     $total=($hp-$horas);

     $horas=intval(($total)/60);
     $minutos=intval(((($total)/60)-intval(($total)/60))*60); 

     $tiempo=$horas.":".$minutos;

   

      $registrohoras=new CP_REGISTROHORAS;
  
      $registrohoras->ORDENPRODUCCION=$request->norden;
      $registrohoras->TURNO=$request->id_turno;
      $registrohoras->FECHA=$request->id_fecha;
      $registrohoras->OPERACION=$request->id_operacion;
      $registrohoras->OPERA='SUMA';
      $registrohoras->HORAINICIO='00:00';
      $registrohoras->HORAFIN='00:00';
      $registrohoras->TIEMPO=$tiempo;
      $registrohoras->CLAVE='100';
      $registrohoras->subclave='00';
      $registrohoras->COMENTARIOS=$request->comentarios;
      $registrohoras->USUARIOCREACION=\Auth::user()->name;
      $registrohoras->FECHACREACION=$date;
      $registrohoras->planificador_id=$request->planificacion_id;
      $registrohoras->save();
 
     }

    public function agregarconsumo(){
      
        $id=$_GET['id'];//Orden de Produccion
      $id2=$_GET['id2'];//id Articulo
      $id3=$_GET['id3'];//Cantidad segun Viajero
      $id4=$_GET['id4'];//Cantidad Entregada
      $id5=$_GET['id5'];//operacion devolucion, consummo
      $id6=$_GET['id6'];//operacion de proceso
      $id7=$_GET['id7'];//Id_planificacion
      $id8=$_GET['id8'];//Id_planificacion
      $id9=$_GET['id9'];//comentarios
    
      
        $date = carbon::now();
        $date = $date->format('Y-m-d H:i:s');
       
        $agregarconsumo=new CP_CONSUMO;

      $agregarconsumo->planificacion_id=$id7;
      $agregarconsumo->orden_produccion=$id;
      $agregarconsumo->articulo=$id2;
      $agregarconsumo->descripcion=$id8;
      $agregarconsumo->cantidad_viajero=$id3;
      $agregarconsumo->cantidad=$id4;
      $agregarconsumo->operacion=$id5;
      $agregarconsumo->comentarios=$id9;
      $agregarconsumo->origen='V';
      $agregarconsumo->aprobada='N';
      $agregarconsumo->conforme='N';
      $agregarconsumo->USUARIOCREACION=\Auth::user()->name;
     $agregarconsumo->FECHACREACION=$date;
     $agregarconsumo->save();
    // return redirect()->action('RegistroController@index');

    }

    public function crearconsumo(Request $request,$id,$id2){
      
       //id=id_planificacion
      //id2=Orden de produccion
  
      
        $date = carbon::now();
        $date = $date->format('Y-m-d H:i:s');
       
        $agregarconsumo=new CP_CONSUMO;

      $agregarconsumo->planificacion_id=$id;
      $agregarconsumo->orden_produccion=$id2;
      $agregarconsumo->articulo=$request->id_articulo2;
      $agregarconsumo->descripcion=$request->descripcion;
      $agregarconsumo->cantidad=$request->cantidad;
      $agregarconsumo->cantidad_viajero=0.00;
      $agregarconsumo->origen='N';
      $agregarconsumo->operacion=$request->id_operacion1;
      $agregarconsumo->comentarios=$request->comentarios;
      $agregarconsumo->aprobada='N';
      $agregarconsumo->conforme='N';
      $agregarconsumo->USUARIOCREACION=\Auth::user()->name;
     $agregarconsumo->FECHACREACION=$date;
     $agregarconsumo->save();
    // return redirect()->action('RegistroController@index');

    }
    public function agregaremple(Request $request){

       $date = carbon::now();
             $date = $date->format('Y-m-d H:i:s');
     
     $opera=CP_CLAVE_MO::where('CLAVE','=',$request->id_clave)->get();

     
     foreach ($opera as $opera) {
         
         $opera1=$opera->OPERACION;
     }

    
     $registroemple=new CP_REGISTROEMPLEADOS;
 
     $registroemple->ORDENPRODUCCION=$request->norden;
     $registroemple->TURNO=$request->id_turno;
     $registroemple->FECHA=$request->id_fecha;
     $registroemple->OPERACION=$request->id_operacion;
     $registroemple->EMPLEADO=$request->id_empleado;
     $registroemple->NOMBRE=$request->nombre;
     $registroemple->ROL=$request->id_rol;
     $registroemple->PARTICIPACION=$request->participacion;
     $registroemple->USUARIOCREACION=\Auth::user()->name;
     $registroemple->FECHACREACION=$date;
     $registroemple->planificador_id=$request->planificacion_id;
     $registroemple->save();

    }

   
  public function agregarproduccion(Request $request){

    
       $date = carbon::now();
             $date = $date->format('Y-m-d H:i:s');
     
    $opera=CP_CLAVE_MO::where('CLAVE','=',$request->id_clave)->get();

     
     foreach ($opera as $opera) {
         
         $opera1=$opera->OPERACION;
     }

     $existe=CP_REGISTROPRODUCCION::where('TURNO','=',$request->id_turno)->where('OPERACION','=',$request->id_operacion)->where('ORDENPRODUCCION','=',$request->norden)->first();

    
     if(count($existe)==1){
      
       CP_REGISTROPRODUCCION::where('TURNO','=',$request->id_turno)
      ->where('OPERACION','=',$request->id_operacion)
      ->where('ORDENPRODUCCION','=',$request->norden)
      ->update(['PRODUCCION'=>$request->produccion,
        'DESPERDICIORECU'=>$request->desrecuperable,
        'DESPERDICIONORECU'=>$request->desnorecuperable,
        'EFICIENCIA'=>$request->eficiencia,
        'TOTAL'=>$request->total]);
      Flash::success("Se ha Actualizo la Orden de Produccion  ".$request->norden." de manera exitosa!");

     }else{

     $registroproduccion=new CP_REGISTROPRODUCCION;
 
     $registroproduccion->ORDENPRODUCCION=$request->norden;
     $registroproduccion->TURNO=$request->id_turno;
     $registroproduccion->FECHA=$request->id_fecha;
     $registroproduccion->OPERACION=$request->id_operacion;
      $registroproduccion->CICLOPIEZA=$request->piezasxhora;
      $registroproduccion->METATURNO=$request->meta;
      $registroproduccion->PRODUCCION=$request->produccion;
      $registroproduccion->EFICIENCIA=$request->eficiencia;
      $registroproduccion->DESPERDICIORECU=$request->desrecuperable;
      $registroproduccion->DESPERDICIONORECU=$request->desnorecuperable;
      $registroproduccion->TOTAL=$request->total;
     $registroproduccion->USUARIOCREACION=\Auth::user()->name;
     $registroproduccion->FECHACREACION=$date;
     $registroproduccion->planificador_id=$request->planificacion_id;
     $registroproduccion->save();

     Flash::success("Se ha registrado la Orden de Produccion ".$request->norden." de manera exitosa!");
    
     }

    //ACTUALIZAMOS LA TABLA CP_PLANIFICACION CANTIDAD PRODUCCIDA
    $sumaproduccion=CP_REGISTROPRODUCCION::where('planificador_id','=',$request->planificacion_id)->sum('produccion');
    
    CP_PLANIFICACION::where('id','=',$request->planificacion_id)->UPDATE(['cantidadproducidad'=>$sumaproduccion]);
    
    $cantidad=CP_PLANIFICACION::where('id','=',$request->planificacion_id)->where('VersionEstado','=','A')->get();
    foreach ($cantidad as $key => $value) {
        $cantidad=$value->cantidad;
    }
   $porcentaje=($sumaproduccion/$cantidad)*100;
   CP_PLANIFICACION::where('id','=',$request->planificacion_id)->where('VersionEstado','=','A')->UPDATE(['porcentaje2'=>$porcentaje]);
 

    
    
    
    //ACTUALIZAMOS LA TABLA CP_EMCABEZADOPLANIFICCION LA CANTIDAD CONSUMIDA.

  
    
    
     
    }

public function aprobarproduccion(Request $request){

   
       $this->aprobar($request->id_turno);

      Flash::success("Se Aporbo la Orden de Produccion  ".$request->norden." de manera exitosa!");
}


  public function aprobar($id2){
   $fechaSistema = Carbon::now()->format('Y-m-d H:i:s');
    
    //  $planificar=CP_ENCABEZADOPLANIFICACION::where('id',$id2)->update(['estado'=>'B']);

      $idpla=CP_ENCABEZADOPLANIFICACION::where('id','=',$id2)->max('planificacion_id');


     // $planificar=CP_PLANIFICACION::where('id',$idpla)->update(['estado'=>'B']);
      $planificar=CP_PLANIFICACION::where('id',$idpla)->update(['aprobadaMO'=>'S']);
      
       return redirect()->action('RegistroController@index');

 

    


  }

  public function confirmarproduccion($id,$id2){

   
    $fechaSistema = Carbon::now()->format('Y-m-d H:i:s');
     
 
       
       $idpla=CP_ENCABEZADOPLANIFICACION::where('id','=',$id2)->max('planificacion_id');
 
 
       $planificar=CP_PLANIFICACION::where('id',$id)->where('aprobadaMA','=','S')->where('aprobadaMO','=','S')->where('aprobadaPR','=','S')
       ->update(['estado'=>'B','CONFIRMADA'=>'S']);
      
      // $planificar=CP_PLANIFICACION::where('id',$idpla)->update(['aprobadaMO'=>'S']);
       
        return redirect()->action('RegistroController@index');
 
  
 
     
 
 
   }

public function procesarsoftland($id){
$date = carbon::now();
$date = $date->format('Y-m-d H:i:s');
$usuario=\Auth::user()->name;

$planificacion=CP_PLANIFICACION::where('id','=',$id)->get();
foreach ($planificacion as $key => $planificacion) {
  $ordenproduccion=$planificacion->ordenproduccion;
  $descripcion=$planificacion->operacion;
  $centrocosto=$planificacion->centrocosto;
}
$OPERACION=OP_OPERACION::where('ORDEN_PRODUCCION','=',$ordenproduccion)->where('DESCRIPCION','=',$descripcion)->where('EQUIPO','=',$centrocosto)->select('OPERACION')->get();
foreach ($OPERACION as  $OPERACION) {
  # code...$
  $proceso=$OPERACION->OPERACION;
}
$consumo=CP_consumo::where('planificacion_id','=',$id)->where('procesadoERP','=','N')->get();
  
    //Insertamos productos nuevos en softland
$nuevos=CP_consumo::where('planificacion_id','=',$id)->where('origen','=','N')->where('procesadoERP','=','N')->get();
foreach ($nuevos as  $nuevos) {
  # code...
  $articulocosto=ARTICULO::where('ARTICULO','=',$nuevos->articulo)->select('COSTO_STD_LOC')->first();
  $SoftlanNuevos=new OP_OPER_CONSUMO;
  $SoftlanNuevos->ORDEN_PRODUCCION=$nuevos->orden_produccion;
  $SoftlanNuevos->OPERACION=$proceso;
  $SoftlanNuevos->ARTICULO=$nuevos->articulo;
  $SoftlanNuevos->CANTIDAD_CONSUMIDA=$nuevos->cantidad;
  $SoftlanNuevos->CANTIDAD_ESTANDAR=$nuevos->cantidad;
  $SoftlanNuevos->CANTIDAD_RESERVADA=0.00;
  $SoftlanNuevos->COSTO_STD_LOCAL=$articulocosto->COSTO_STD_LOC;
  $SoftlanNuevos->COSTO_STD_DOLAR=0.00;
  $SoftlanNuevos->COSTO_REAL_LOCAL=0.00;
  $SoftlanNuevos->COSTO_REAL_DOLAR=0.00;
  $SoftlanNuevos->ACEPTA_MOVIMIENTOS='S';
  $SoftlanNuevos->PERMITE_BACKFLUSH='S';
  $SoftlanNuevos->CANTIDAD_PEND_APLICAR=0.0;
  $SoftlanNuevos->save();
}

foreach ($consumo as  $consumo) {
    // Actualizamos cantidades en softlandERP
    OP_OPER_CONSUMO::where('ORDEN_PRODUCCION','=',$ordenproduccion)->where('OPERACION','=',$proceso)->where('ARTICULO','=',$consumo->articulo)->update(['CANTIDAD_CONSUMIDA'=>$consumo->cantidad]);


     
    //Actualizamos Costos UEPS en softland
      $costoarticulo=DB::Connection()->select("SELECT COSTO_LOCAL from 
      IBERPLAS.COSTO_UEPS_PEPS 
      where ARTICULO='$consumo->articulo' and SECUENCIA in (select MAX(SECUENCIA) as SECUENCIA from IBERPLAS.COSTO_UEPS_PEPS 
        where ARTICULO='$consumo->articulo')");
       foreach ($costoarticulo as $costoarticulo) {
         # code...
        $costo=$costoarticulo->COSTO_LOCAL;
       }

      $costo2=$consumo->cantidad*$costo;
      
     OP_OPER_CONSUMO::where('ORDEN_PRODUCCION','=',$ordenproduccion)->where('OPERACION','=',$consumo->proceso)->where('ARTICULO','=',$consumo->articulo)->update(['COSTO_REAL_LOCAL'=>$costo2]);
      //Guardadmos Victacora
      
  CP_consumo::where('planificacion_id','=',$id)->where('articulo','=',$consumo->articulo)->update(['procesadoERP'=>'S','fechahoraprocesadoERP'=>$date,'usuarioprocesadoERP'=>$usuario]);

  }


  //iniciacion la insercion de produccion en softland
  
   $produccion_enca=new OP_OPER_DET;
   $produccion_enca->ORDEN_PRODUCCION=$ordenproduccion;
   $produccion_enca->OPERACION=$proceso;
   $produccion_enca->EQUIPO=$centrocosto;
   $produccion_enca->FECHA_HORA_PRODUC=$date;
   $produccion_enca->TURNO=1;
   $produccion_enca->TIPO_DE_CAMBIO=1;
   $produccion_enca->HORAS_MAQ=0.00;
   $produccion_enca->HORAS_MOP=0.00;
   $produccion_enca->HORAS_MOE=0.00;
   $produccion_enca->EMP_MOP=0.00;
   $produccion_enca->EMP_MOE=0.00;
   $produccion_enca->CANTIDAD_PRODUCIDA=0.00;
   $produccion_enca->CANTIDAD_RECHAZADA=0.00;
   $produccion_enca->CANTIDAD_TARJETAS=0.00;
   $produccion_enca->CONTABILIZADA='N';
   $produccion_enca->USUARIO='SA';
   $produccion_enca->FECHA_HORA=$date;
   $produccion_enca->APROBADO='N';
   $produccion_enca->COSTO_MO_LOC=0.00;
   $produccion_enca->COSTO_MO_DOL=0.00;
   $produccion_enca->COSTO_GIF_LOC=0.00;
   $produccion_enca->COSTO_GIF_DOL=0.00;
   $produccion_enca->ORIGEN='M';
   $produccion_enca->REPORTA_PROD='N';
   $produccion_enca->REPORTA_MO='S';
   $produccion_enca->REPORTA_GIF='S';
   $produccion_enca->REPORTA_CONSUMO='N';
   $produccion_enca->PRORRATEO_MO='N';
   $produccion_enca->PRORRATEO_GIF='N';
   $produccion_enca->PRORRATEO_CONSUMO='N';
   $produccion_enca->save();

   $produccion_mo=DB::Connection()->select("SELECT rhoras.ORDENPRODUCCION,'SILO' AS OPERACION,fempleado.PUESTO, remple.EMPLEADO,fempleado.NOMINA,
     rhoras.TIEMPO as cantidadhoras,
   (((fempleado.SALARIO_REFERENCIA/30)/8)*factor.FACTOR) as costoxhoraloc,
   (((fempleado.SALARIO_REFERENCIA/30)/8)*factor.FACTOR) as costoxhoradol,
    enca.turno,
    enca.fhoraini,
    enca.fhorafin
    from
    IBERPLAS.CP_REGISTROEMPLEADOS remple,
    IBERPLAS.CP_REGISTROHORAS rhoras,
    IBERPLAS.CP_ENCABEZADOPLANIFICACION enca,
    IBERPLAS.EMPLEADO fempleado,
    IBERPLAS.FACTOR_AJU_HORA factor
    where 
    remple.planificador_id=rhoras.planificador_id
    and enca.id=rhoras.TURNO
    and remple.TURNO=rhoras.TURNO
    and factor.HORARIO=enca.turno
    and remple.EMPLEADO=fempleado.EMPLEADO 
    and remple.planificador_id='$id'
  and rhoras.OPERA='SUMA'
");

$secuencia=0;

  foreach ($produccion_mo as  $produccion_mo) {
    # code...
    $con_nomina_softland=DB::Connection()->select("select max(NUMERO_NOMINA) as corre from IBERPLAS.EMPLEADO_CONC_NOMI where NOMINA='$produccion_mo->NOMINA' and EMPLEADO='$produccion_mo->EMPLEADO'");
   
    foreach ($con_nomina_softland as  $nomina) {
      # code...
    $correnomina=$nomina->corre;
    }

    $secuencia=$secuencia+1;
    $produccion_mo_erp=new OP_OPER_DET_MO;
    $produccion_mo_erp->ORDEN_PRODUCCION=$ordenproduccion;
    $produccion_mo_erp->OPERACION=$proceso;
    $produccion_mo_erp->FECHA_HORA_PRODUC=$date;
    $produccion_mo_erp->HORARIO=$produccion_mo->turno;
    $produccion_mo_erp->SECUENCIA_MO=$secuencia;
    $produccion_mo_erp->PUESTO=$produccion_mo->PUESTO;
    $produccion_mo_erp->EMPLEADO=$produccion_mo->EMPLEADO;
    $produccion_mo_erp->TIPO_MANO_OBRA='E';
    $produccion_mo_erp->NOMINA=$produccion_mo->NOMINA;
    $produccion_mo_erp->CONSECUTIVO_NOMI=$correnomina;
    $produccion_mo_erp->CANTIDAD_HORAS=0.00;
    $produccion_mo_erp->EXPORTADO_NOMINA='N';
    $produccion_mo_erp->COSTO_POR_HORA_LOC=$produccion_mo->costoxhoraloc;
    $produccion_mo_erp->COSTO_POR_HORA_DOL=$produccion_mo->costoxhoradol;
    $produccion_mo_erp->HORARIO=$produccion_mo->turno;
    $produccion_mo_erp->FECHA_INICIO=$produccion_mo->fhoraini;
    $produccion_mo_erp->FECHA_FIN=$produccion_mo->fhorafin;
    $produccion_mo_erp->save();
  };


    
}
public function confirmarconsumo($id1,$id2){

      
        $confirmacion=CP_consumo::where('planificacion_id','=',$id1)->where('conforme','=','N')->first();
          
       if(is_null($confirmacion)){
        CP_PLANIFICACION::where('id','=',$id1)
        ->update(['aprobadaMA'=>'S']);   
        return redirect()->action('RegistroController@index');
       }}
  public function confirmarproduccion2($id1,$id2){

      
        $confirmacion=CP_PRODUCCION::where('planificacion_id','=',$id1)->where('conforme','=','N')->first();
          
       if(is_null($confirmacion)){
        CP_PLANIFICACION::where('id','=',$id1)
        ->update(['aprobadaPR'=>'S']);   
        return redirect()->action('RegistroController@index');
       }}     
    public function eliminarconsumo($id1,$id2){
        $horas=CP_consumo::where('ID','=',$id1)->delete();
        $horas2=CP_PLANIFICACION::where('id','=',$id2)
        ->update(['aprobadaMA'=>'N']);
    }

    public function aprobarconsumo($id1,$id2){
       
        $horas=CP_consumo::where('ID','=',$id1)
        ->update(['aprobada'=>'S','correoaprobada'=>\Auth::user()->email]);
        $horas2=CP_PLANIFICACION::where('id','=',$id2)
        ->update(['aprobadaMA'=>'S']);
    }
    public function conformeconsumo($id1){
       
        $horas=CP_consumo::where('ID','=',$id1)
        ->update(['conforme'=>'S','correoconforme'=>\Auth::user()->email]);
    }
    
    public function eliminar(Request $request,$id){

     
      
      
        $horas=CP_REGISTROHORAS::where('ID','=',$id)->delete();
       // return response()->json(['message'=> $horas->CLAVE.'Fue eliminado Corretamente']);
      }

    public function eliminaremple(Request $request,$id){

     
      
      
        $horas=CP_REGISTROEMPLEADOS::where('ID','=',$id)->delete();
       // return response()->json(['message'=> $horas->CLAVE.'Fue eliminado Corretamente']);
      }

 
    public function buscarempleado(Request $request){

     $term=$request->term;
     $data=EMPLEADO::where ('EMPLEADO','LIKE','%'.$term.'%')
     ->orwhere('NOMBRE','LIKE','%'.$term.'%')
     ->where('ACTIVO','=','S')
     ->take(5)
     ->get();
     if(count($data)==0){
          $result[]='No Existe Item';
     }else{
     foreach ($data as $data) {
         $result[]=['id'=>$data->EMPLEADO, 'nombre'=>$data->NOMBRE,'value'=>$data->EMPLEADO.' '.$data->NOMBRE];
     }
     }
     return response()->json($result);
    }

    public function buscararticulo(Request $request){

        $term=$request->term;
        $data=ARTICULO::where ('ARTICULO','LIKE','%'.$term.'%')
        ->orwhere('DESCRIPCION','LIKE','%'.$term.'%')
        ->where('ACTIVO','=','S')
        ->take(5)
        ->get();
        if(count($data)==0){
             $result[]='No Existe Item';
        }else{
        foreach ($data as $data) {
            $result[]=['id'=>$data->ARTICULO, 'nombre'=>$data->DESCRIPCION,'value'=>$data->ARTICULO.' '.$data->DESCRIPCION];
        }
        }
        return response()->json($result);
       }

    

    public function listaroperaciones(){
        $id=$_GET['id'];//Orden de Produccion
        $cp_consumo=CP_consumo::where('planificacion_id','=',$id)->get(); 
        return response()->json($cp_consumo);

    }
    public function impresion($id,$id2)
    {

    	 return view('ControPiso.Transacciones.Registro.impresion');
    }
    
 public function listarproduccion2(){
            $id=$_GET['id'];//id
            $id2=$_GET['id2'];//orden produccion
           
             $listarproduccion=CP_PRODUCCION::
             where('orden_produccion','=',$id)
             ->where('planificacion_id','=',$id2)
             ->get() ;

             return view('ControPiso.Transacciones.Registro.PR.registros')  
             ->with('listarproduccion',$listarproduccion);
            
             
              
        
            
            }
 public function eliminarproduccion2($id1){
        $horas=CP_PRODUCCION::where('id','=',$id1)->delete();
        
    }           
   
public function crearproduccion(Request $request, $id,$id2,$id3){

    //id=id_planificacion
      //id2=Orden de produccion
  
      
      $date = carbon::now();
      $date = $date->format('Y-m-d H:i:s');
      //$date = $date->format('d-m-Y H:i:s');
     
      $agregarproduccion2=new CP_PRODUCCION;

    $agregarproduccion2->planificacion_id=$id;
    $agregarproduccion2->orden_produccion=$id2;
    $agregarproduccion2->articulo=$request->id_articulo2;
    $agregarproduccion2->descripcion=$request->descripcion;
    $agregarproduccion2->cantidad=$request->cantidad;
    $agregarproduccion2->cantidad_viajero=0.00;
    $agregarproduccion2->origen='N';
    $agregarproduccion2->operacion=$request->id_operacion1;
    $agregarproduccion2->comentarios=$request->comentarios;
    $agregarproduccion2->aprobada='N';
    $agregarproduccion2->conforme='N';
    $agregarproduccion2->proceso=$id3;
    $agregarproduccion2->USUARIOCREACION=\Auth::user()->name;
   $agregarproduccion2->FECHACREACION=$date;
   $agregarproduccion2->save();

}

}