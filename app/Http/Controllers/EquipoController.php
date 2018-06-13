<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Softland\RUBRO_LIQ;
use App\Modelos\Softland\ARTICULO;
use App\Modelos\ControlPiso\CP_EQUIPOARTICULO;
use App\Modelos\Softland\ESTRUC_PROCESO;
use App\Modelos\Softland\ESTRUC_MANUFACTURA;
use App\Modelos\ControlPiso\CP_RUBRO;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
//use App\Http\Controllers\Response;
use Illuminate\Http\Response;

class EquipoController extends Controller
{
     public function index()
    {

        $ESTRUC_MANUFACTURA=ESTRUC_MANUFACTURA::where('ESTADO','=','A')->get();
      
      


        return view('ControPiso.Maestros.Equipos.listado_equipo', ['ESTRUC_MANUFACTURA' => $ESTRUC_MANUFACTURA]);
    }

    public function agregar_articulo($id)
    {

        $Equipo=RUBRO_LIQ::findOrFail($id);
        $Articulo=Articulo::orderby('DESCRIPCION','asc')->get();

    return view('ControPiso.Maestros.Equipos.Equipo_articulo', ['Equipo' => $Equipo], ['Articulo' => $Articulo]);

    }


    public function listar_equipo_articulo2($id){

         
        

      $ESTRUC_PROCESO=DB::Connection()->select("SELECT ARTICULO,OPERACION,DESCRIPCION,EQUIPO,HORAS_STD_MOE ,CANT_PRODUCIDA_PT,(CANT_PRODUCIDA_PT/HORAS_STD_MOE) AS CANTIDADXHORA
      FROM 
      IBERPLAS.ESTRUC_PROCESO  
      WHERE 
      ARTICULO='$id' AND 
       REPORTA_PROD='N' AND
      VERSION IN (SELECT VERSION FROM IBERPLAS.ESTRUC_MANUFACTURA WHERE ESTADO='A' AND ARTICULO='$id')");

          
         return view('ControPiso.Maestros.Equipos.edit')->with('ESTRUC_PROCESO',$ESTRUC_PROCESO);

    }

    public function opera_equipo(Request $request){
    
       $id=$_GET['id'];

       $equipo=ESTRUC_PROCESO::selectRaw('SECUENCIA,DESCRIPCION')->where('ARTICULO','=',$id)
       ->Groupby('SECUENCIA','DESCRIPCION')->get();
      
      return response()->json($equipo);
    

    }

    public function guardar_articulo(Request $request){


      $equi=CP_EQUIPOARTICULO:: where('ARTICULO','=',$request->id_articulo)
                                ->where('OPERACION','=',$request->operacion)
                                ->where('EQUIPO','=',$request->id_equipo)->first();

  if(count($equi)>=1){
    Flash::success('Ya Existe la Relacion Centro Costo-Articulo')->warning();
  }else{

    $equipo=new CP_EQUIPOARTICULO;
      $equipo->equipo=$request->id_equipo;
      $equipo->articulo=$request->id_articulo;
      $equipo->piezasxhoras=$request->piezasxhora;
      $equipo->hora_holgurasxdia=$request->horasholgurapordia;
      $equipo->num_cavidades=$request->numcavidades;
      $equipo->CICLO_SEG_MAQUINA=$request->ciclosegunMaquinas;
      $equipo->num_operadores=$request->numoperarios;
      $equipo->DESC_EQUIPO=$request->desc_equipo;
      $equipo->COLOR=$request->color;
      $equipo->OPERACION=$request->operacion;
      $equipo->TIEMPOMOLDE=$request->tiempoCambiarMolde;

        $equipo->save();
     Flash::success('Se ha registrado de Forma Existosa')->important();    
    
  }


   



           return redirect('Equipo');


    }


    public function listar_equipo_articulo($id){

      $ESTRUC_PROCESO=DB::Connection()->select("SELECT 
      RUBRO.ARTICULO,RUBRO.VERSION,RUBRO.OPERACION,PROCESO.DESCRIPCION, 
      RUBRO.RUBRO,RUBRO.CANTIDAD_ESTANDAR ,RUBRO.RowPointer,
      PROCESO.HORAS_STD_MOE,PROCESO.CANT_PRODUCIDA_PT,
      (PROCESO.CANT_PRODUCIDA_PT/PROCESO.HORAS_STD_MOE) AS HORASXHORA,
      RUBRO.CP_TIEMPOCAMBIOMOLDE
            FROM 
            IBERPLAS.ESTRUC_PROC_RUBRO RUBRO,
            IBERPLAS.ESTRUC_PROCESO PROCESO
            WHERE 
            PROCESO.ARTICULO=RUBRO.ARTICULO AND
            PROCESO.VERSION IN(SELECT VERSION FROM IBERPLAS.ESTRUC_MANUFACTURA WHERE ESTADO='A' AND ARTICULO='$id')AND    
            RUBRO.ARTICULO='$id' AND 
            PROCESO.ARTICULO='$id' AND
            RUBRO.OPERACION=PROCESO.OPERACION and
            PROCESO.OPERACION<>'TERMINADO' AND
            RUBRO.VERSION IN (SELECT VERSION FROM IBERPLAS.ESTRUC_MANUFACTURA WHERE ESTADO='A' AND ARTICULO='$id')
      ");

     
    	 return view('ControPiso.Maestros.Equipos.listar_equipo_articulo', ['ESTRUC_PROCESO' => $ESTRUC_PROCESO]);
    }


    public function autoComplete(Request $request){

    $term=$request->term;
    $items=ARTICULO::where('ARTICULO','LIKE','%'.$term.'%')->
                     orwhere('DESCRIPCION','LIKE','%'.$term.'%')->take(5)->get();
    if(count($items)==0){
        $searchResult[]='No Existe Item';
    }else{
        foreach ($items as $query) {
           // $searchResult[]=$value->ARTICULO;
            $searchResult[] = [ 'id' => $query->ARTICULO, 'value' => $query->ARTICULO.' '.$query->DESCRIPCION ];
        }
    }



   // return $searchResult;
    return Response()->json($searchResult);
    /*

     return $availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];


*/

    function procesoArticulo(){

    }

    }

  public function editarArticuloCentrocosto(Request $request,$id){

    CP_EQUIPOARTICULO::
                 where('id',$id)
                 ->update(['OPERACION'=>$request->operacion,
                          'NUM_CAVIDADES'=>$request->numcavidades,
                          'PIEZASXHORAS'=>$request->piezasxhora,
                          'CICLO_SEG_MAQUINA'=>$request->ciclosegunMaquinas,
                          'HORA_HOLGURASXDIA'=>$request->horasholgurapordia,
                          'NUM_OPERADORES'=>$request->numoperarios,
                          'TIEMPOMOLDE'=>$request->tiempoCambiarMolde ]);
     Flash::success('Se Actualizo en Forma Existosa')->important();               
       
       return redirect('Equipo');

  }

  public function ListarArticuloOperacion(Request $request){
    $id1=$_GET['art'];
    $id2=$_GET['ope'];
   
    DB::table('IBERPLAS.CP_RUBRO')->delete();

     $rubro=DB::Connection()->select("select ARTICULO,RUBRO,CANTIDAD_ESTANDAR as cantidad,OPERACION from IBERPLAS.ESTRUC_PROC_RUBRO where ARTICULO='$id1'  and OPERACION='$id2'
    and VERSION IN (SELECT VERSION FROM IBERPLAS.ESTRUC_MANUFACTURA WHERE ESTADO='A' AND ARTICULO='$id1')
 ");
     

      foreach ($rubro as  $value) {
        $rubro=new CP_RUBRO;
          $rubro->ARTICULO=$value->ARTICULO;
         $rubro->CENTROCOSTO=$value->RUBRO;
         $rubro->CANTIDAD=$value->cantidad;
         $rubro->OPERACION=$value->OPERACION;
          $rubro->save();
      }

      $rubro2=DB::Connection()->select("SELECT MAX(cantidad) as cantidad FROM IBERPLAS.CP_RUBRO");
      
       foreach ($rubro2 as  $value) {
         $cantidad=$value->cantidad;
         
       };


        DB::table('IBERPLAS.CP_RUBRO')->update(['CANTIDAD'=>$cantidad]);
             


    $articulooperacion=DB::Connection()->select("SELECT RUBRO.ARTICULO,RUBRO.OPERACION,RUBRO.RUBRO,MAQUINA.DESCRIP_RUBRO,
    (MANU.CANT_PRODUCCION/RUBRO2.CANTIDAD) AS HORASXHORA,
    CASE  RUBRO.CP_TIEMPOCAMBIOMOLDE WHEN NULL THEN RUBRO.CP_TIEMPOCAMBIOMOLDE ELSE 0.0  END as CP_TIEMPOCAMBIOMOLDE 
     FROM 
     IBERPLAS.ESTRUC_PROC_RUBRO  RUBRO ,
     IBERPLAS.ESTRUC_MANUFACTURA MANU,
     IBERPLAS.RUBRO_LIQ MAQUINA,
     IBERPLAS.CP_RUBRO RUBRO2
     where 
     MAQUINA.RUBRO=RUBRO2.CENTROCOSTO AND
     MAQUINA.RUBRO=RUBRO.RUBRO AND
     MANU.ARTICULO='$id1' AND
     MANU.VERSION IN (SELECT VERSION FROM IBERPLAS.ESTRUC_MANUFACTURA WHERE ESTADO='A' AND ARTICULO='$id1')AND
     RUBRO.ARTICULO='$id1' AND 
     RUBRO.VERSION IN (SELECT VERSION FROM IBERPLAS.ESTRUC_MANUFACTURA WHERE ESTADO='A' AND ARTICULO='$id1')
    AND RUBRO.OPERACION='$id2'");
    
    //dd($articulooperacion);
    //CP_EQUIPOARTICULO::selectRaw('ID,EQUIPO,DESC_EQUIPO,PIEZASXHORAS,TIEMPOMOLDE')-> where('ARTICULO','=',$id1)->where('OPERACION','=',$id2)->get();
    
      return   json_encode ($articulooperacion);
     
  }
}
