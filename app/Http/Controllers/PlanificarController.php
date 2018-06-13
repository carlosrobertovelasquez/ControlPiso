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
use Illuminate\Support\Facades\DB;
Use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Modelos\ControlPiso\CP_emails;
use App\Mail\ComprasMail;



class PlanificarController extends Controller
{

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
      WHERE EQ.EQUIPO=PL.centrocosto) ");

         $OrdenProduccion=CP_PLANIFICACION::wherein('estado' , ['P','A','B'])->get();
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

}
