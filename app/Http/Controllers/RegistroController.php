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
use App\Modelos\Softland\OP_OPER_CONSUMO;
use App\Modelos\ControlPiso\CP_consumo;
use Illuminate\Support\Facades\DB;
Use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Response;

class RegistroController extends Controller
{
    public function index(){


         $OrdenProduccion=CP_PLANIFICACION::wherein('ESTADO',['A','B'])->get();
        return view('ControPiso.Transacciones.Registro.index')
               ->with('OrdenProduccion',$OrdenProduccion);
    }
    public function mo($id,$id2)
    {
 
       

        $globales = CP_globales::max('produccdetallada');

          if($globales=="S"){

                $encabezado=CP_planificacion::where('id','=',$id)->get()->first();
               
                $encabezado2=CP_planificacion::where('id','=',$id)->get();
                 $detalle=DB::Connection()->select("select id, turno,thoraini,thorafin,fecha, horas from IBERPLAS.CP_ENCABEZADOPLANIFICACION where planificacion_id='$id'");
               
               // $detalle=CP_ENCABEZADOPLANIFICACION::where('planificacion_id','=',$id)->get();
               
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
          $detalle=DB::Connection()->select("select turno,thoraini,thorafin,fecha, (horas) as horas2 from IBERPLAS.CP_ENCABEZADOPLANIFICACION where planificacion_id='$id'");
     //   $detalle=CP_ENCABEZADOPLANIFICACION::where('planificacion_id','=',$id)->get();
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

    public function listarhoras(){

        $id=$_GET['id'];
      $id2=$_GET['id2'];
      $id3=$_GET['id3'];
     $registrohoras=CP_REGISTROHORAS::
     where('ORDENPRODUCCION','=',$id)
     ->where('TURNO','=',$id2)
     ->where('OPERACION','=',$id3)->get() ;
    
    

    
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
    public function listarproduccion(){
        $id=$_GET['id'];
        $id2=$_GET['id2'];
        $id3=$_GET['id3'];
         $listarproduccion=CP_REGISTROPRODUCCION::
         where('ORDENPRODUCCION','=',$id)
         ->where('TURNO','=',$id2)
         ->where('OPERACION','=',$id3)->first() ;
        
        // dd($listarproduccion);
    
         return response()->json($listarproduccion);
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
    
   $cantidad=CP_ENCABEZADOPLANIFICACION::where ('id','=',$id2)->get();

  
   foreach ($cantidad as $value) {
     $cantidad2=$value->cantidad;
    
   }
    
return response::json($cantidad2); 
}


public function horasplanificadas(){
    $id=$_GET['id'];
    $id2=$_GET['id2'];
    $id3=$_GET['id3'];
    
  // $cantidad3=CP_ENCABEZADOPLANIFICACION::where ('id','=',$id2)->get();

   $cantidad3=DB::Connection()->select("select  (horas) as horas from IBERPLAS.CP_ENCABEZADOPLANIFICACION where id=$id2");  

    
   foreach ($cantidad3 as $value) {
    
     $horas=$value->horas;
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
             $date = $date->format('d-m-Y H:i:s');
     
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
     $registrohoras->COMENTARIOS=$request->comentarios;
     $registrohoras->USUARIOCREACION=\Auth::user()->name;
     $registrohoras->FECHACREACION=$date;
     $registrohoras->save();

    }

    public function agregarconsumo(Request $request,$id1,$id2,$id3){
        $date = carbon::now();
        $date = $date->format('d-m-Y H:i:s');
       
        $agregarconsumo=new CP_CONSUMO;

      $agregarconsumo->planificacion_id=$id3;
      $agregarconsumo->orden_produccion=$id1;
      $agregarconsumo->articulo=$id2;
      $agregarconsumo->cantidad=0.0;
      $agregarconsumo->USUARIOCREACION=\Auth::user()->name;
     $agregarconsumo->FECHACREACION=$date;
     $agregarconsumo->save();
     return redirect()->action('RegistroController@index');

    }
    
    public function agregaremple(Request $request){

       $date = carbon::now();
             $date = $date->format('d-m-Y H:i:s');
     
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
     $registroemple->save();

    }

   
  public function agregarproduccion(Request $request){

       $date = carbon::now();
             $date = $date->format('d-m-Y H:i:s');
     
   
     $existe=CP_REGISTROPRODUCCION::where('TURNO','=',$request->id_turno)
     ->first();

        
     if(count($existe)==1){
       
       CP_REGISTROPRODUCCION::where('TURNO','=',$request->id_turno)
       ->update(['PRODUCCION'=>$request->produccion,
                 'DESPERDICIORECU'=>$request->desrecuperable,
                 'DESPERDICIONORECU'=>$request->desnorecuperable,
                 'EFICIENCIA'=>$request->eficiencia,
                 'TOTAL'=>$request->total,
                 'USUARIOUPDATE'=>\Auth::user()->name,
                 'FECHAUPDATE'=>$date]);
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
     $registroproduccion->save();
     $this->aprobar($request->id_turno);

     }

    
     
    }



  public function aprobar($id2){
   $fechaSistema = Carbon::now()->format('m-d-Y H:i:s');
    

      $planificar=CP_ENCABEZADOPLANIFICACION::where('id',$id2)->update(['estado'=>'B']);

      $idpla=CP_ENCABEZADOPLANIFICACION::where('id','=',$id2)->max('planificacion_id');


      $planificar=CP_PLANIFICACION::where('id',$idpla)->update(['estado'=>'B']);
      $planificar=CP_PLANIFICACION::where('id',$idpla)->update(['CONFIRMADA'=>'S']);
      
       return redirect()->action('RegistroController@index');

 

    


  }

    public function eliminarconsumo($id1){
        $horas=CP_consumo::where('ID','=',$id1)->delete();
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

      
       
       $consumo=DB::connection()->select("select cons.OPERACION,cons.ORDEN_PRODUCCION,cons.ARTICULO,art.DESCRIPCION,cons.CANTIDAD_ESTANDAR,art.UNIDAD_ALMACEN from 
            IBERPLAS.OP_OPER_CONSUMO cons,
                IBERPLAS.ARTICULO art 
                where 
                cons.ARTICULO=art.ARTICULO and
                cons.ORDEN_PRODUCCION='$id2' and cons.OPERACION='$opera3' ");
    	        return view('ControPiso.Transacciones.Registro.ma')
       ->with('consumo',$consumo)
        ->with('cp_consumo',$cp_consumo)
        ->with('id',$id)
        ->with('orden',$orden);
    }

    public function impresion($id,$id2)
    {

    	 return view('ControPiso.Transacciones.Registro.impresion');
    }
    
   
}
