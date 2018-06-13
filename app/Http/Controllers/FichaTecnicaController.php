<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Modelos\ControlCalidad\FT_FICHA;
use App\Modelos\ControlCalidad\FT_INSERTADO;
use App\Modelos\ControlCalidad\FT_SOPORTE;
use App\Modelos\ControlCalidad\FT_FIBRA_ALAMBRE;
use App\Modelos\ControlCalidad\FT_DIMENSION_CEPILLO;
use App\Modelos\ControlCalidad\FT_BOLILLO;
use App\Modelos\ControlCalidad\FT_CORRUGADO;
use App\Modelos\ControlCalidad\FT_GANCHO;
use App\Modelos\ControlCalidad\FT_RESORTE;
use App\Modelos\ControlCalidad\FT_ESPECIFICACION;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class FichaTecnicaController extends Controller
{
    public function index(){

    	
        

    }

    public function FichaTecnica($id){

        $linea=FT_FICHA::where('id','=',$id)->first();
        
        if($linea->LINEA='BOLILLO'){
            $ft_ficha=FT_FICHA::where('id','=',$id)->first();
            $ft_insertado=FT_INSERTADO::where('ficha_id','=',$id)->first();
            $ft_soporte=FT_SOPORTE::where('ficha_id','=',$id)->first();
            $ft_fibra_alambre=FT_FIBRA_ALAMBRE::where('ficha_id','=',$id)->first();
            $ft_dimension_cepillo=FT_DIMENSION_CEPILLO:: where('ficha_id','=',$id)->first();
            $ft_bolillo=FT_BOLILLO::where('ficha_id','=',$id)->first();
            $ft_corrugado=FT_CORRUGADO::where('ficha_id','=',$id)->first();
            $ft_gancho=FT_GANCHO::where('ficha_id','=',$id)->first();
            $ft_resorte=FT_RESORTE::where('ficha_id','=',$id)->first();
      
            
            
            
              return view('ControlCalidad.Ficha_Tecnica.Bolillo.Ficha_Tecnica')
              ->with('ft_ficha',$ft_ficha)
              ->with('ft_insertado',$ft_insertado)
              ->with('ft_soporte',$ft_soporte)
              ->with('ft_fibra_alambre',$ft_fibra_alambre)
              ->with('ft_dimension_cepillo',$ft_dimension_cepillo)
              ->with('ft_bolillo',$ft_bolillo)
              ->with('ft_corrugado',$ft_corrugado)
              ->with('ft_gancho',$ft_gancho)
              ->with('ft_resorte',$ft_resorte);
        }

        if($linea->LINEA='INSERTADO'){
            $ft_ficha=FT_FICHA::where('id','=',$id)->first();
            $ft_insertado=FT_INSERTADO::where('ficha_id','=',$id)->first();
            $ft_soporte=FT_SOPORTE::where('ficha_id','=',$id)->first();
            $ft_fibra_alambre=FT_FIBRA_ALAMBRE::where('ficha_id','=',$id)->first();
            $ft_dimension_cepillo=FT_DIMENSION_CEPILLO:: where('ficha_id','=',$id)->first();
            $ft_bolillo=FT_BOLILLO::where('ficha_id','=',$id)->first();
            $ft_corrugado=FT_CORRUGADO::where('ficha_id','=',$id)->first();
            $ft_gancho=FT_GANCHO::where('ficha_id','=',$id)->first();
            $ft_resorte=FT_RESORTE::where('ficha_id','=',$id)->first();
      
            
            
            
              return view('ControlCalidad.Ficha_Tecnica.Insertado.Ficha_Tecnica')
              ->with('ft_ficha',$ft_ficha)
              ->with('ft_insertado',$ft_insertado)
              ->with('ft_soporte',$ft_soporte)
              ->with('ft_fibra_alambre',$ft_fibra_alambre)
              ->with('ft_dimension_cepillo',$ft_dimension_cepillo)
              ->with('ft_bolillo',$ft_bolillo)
              ->with('ft_corrugado',$ft_corrugado)
              ->with('ft_gancho',$ft_gancho)
              ->with('ft_resorte',$ft_resorte);
        }

        if($linea->LINEA='EXTRUSION'){
            $ft_ficha=FT_FICHA::where('id','=',$id)->first();
            $ft_insertado=FT_INSERTADO::where('ficha_id','=',$id)->first();
            $ft_soporte=FT_SOPORTE::where('ficha_id','=',$id)->first();
            $ft_fibra_alambre=FT_FIBRA_ALAMBRE::where('ficha_id','=',$id)->first();
            $ft_dimension_cepillo=FT_DIMENSION_CEPILLO:: where('ficha_id','=',$id)->first();
            $ft_bolillo=FT_BOLILLO::where('ficha_id','=',$id)->first();
            $ft_corrugado=FT_CORRUGADO::where('ficha_id','=',$id)->first();
            $ft_gancho=FT_GANCHO::where('ficha_id','=',$id)->first();
            $ft_resorte=FT_RESORTE::where('ficha_id','=',$id)->first();
            $ft_especificacion=FT_ESPECIFICACION::where('ficha_id','=',$id)->first();
    
          
      
            
            
            
              return view('ControlCalidad.Ficha_Tecnica.Extrusion.Ficha_Tecnica')
              ->with('ft_ficha',$ft_ficha)
              ->with('ft_insertado',$ft_insertado)
              ->with('ft_soporte',$ft_soporte)
              ->with('ft_fibra_alambre',$ft_fibra_alambre)
              ->with('ft_dimension_cepillo',$ft_dimension_cepillo)
              ->with('ft_bolillo',$ft_bolillo)
              ->with('ft_corrugado',$ft_corrugado)
              ->with('ft_gancho',$ft_gancho)
              ->with('ft_resorte',$ft_resorte)
              ->with('ft_especificacion',$ft_especificacion);
        }
        if($linea->LINEA='INYECCION'){
            $ft_ficha=FT_FICHA::where('id','=',$id)->first();
            $ft_insertado=FT_INSERTADO::where('ficha_id','=',$id)->first();
            $ft_soporte=FT_SOPORTE::where('ficha_id','=',$id)->first();
            $ft_fibra_alambre=FT_FIBRA_ALAMBRE::where('ficha_id','=',$id)->first();
            $ft_dimension_cepillo=FT_DIMENSION_CEPILLO:: where('ficha_id','=',$id)->first();
            $ft_bolillo=FT_BOLILLO::where('ficha_id','=',$id)->first();
            $ft_corrugado=FT_CORRUGADO::where('ficha_id','=',$id)->first();
            $ft_gancho=FT_GANCHO::where('ficha_id','=',$id)->first();
            $ft_resorte=FT_RESORTE::where('ficha_id','=',$id)->first();
            $ft_especificacion=FT_ESPECIFICACION::where('ficha_id','=',$id)->first();
    
              return view('ControlCalidad.Ficha_Tecnica.Inyeccion.Ficha_Tecnica')
              ->with('ft_ficha',$ft_ficha)
              ->with('ft_insertado',$ft_insertado)
              ->with('ft_soporte',$ft_soporte)
              ->with('ft_fibra_alambre',$ft_fibra_alambre)
              ->with('ft_dimension_cepillo',$ft_dimension_cepillo)
              ->with('ft_bolillo',$ft_bolillo)
              ->with('ft_corrugado',$ft_corrugado)
              ->with('ft_gancho',$ft_gancho)
              ->with('ft_resorte',$ft_resorte)
              ->with('ft_especificacion',$ft_especificacion);
        }

        if($linea->LINEA='PALA'){
            $ft_ficha=FT_FICHA::where('id','=',$id)->first();
            $ft_insertado=FT_INSERTADO::where('ficha_id','=',$id)->first();
            $ft_soporte=FT_SOPORTE::where('ficha_id','=',$id)->first();
            $ft_fibra_alambre=FT_FIBRA_ALAMBRE::where('ficha_id','=',$id)->first();
            $ft_dimension_cepillo=FT_DIMENSION_CEPILLO:: where('ficha_id','=',$id)->first();
            $ft_bolillo=FT_BOLILLO::where('ficha_id','=',$id)->first();
            $ft_corrugado=FT_CORRUGADO::where('ficha_id','=',$id)->first();
            $ft_gancho=FT_GANCHO::where('ficha_id','=',$id)->first();
            $ft_resorte=FT_RESORTE::where('ficha_id','=',$id)->first();
            $ft_especificacion=FT_ESPECIFICACION::where('ficha_id','=',$id)->first();
    

              return view('ControlCalidad.Ficha_Tecnica.Pala.Ficha_Tecnica')
              ->with('ft_ficha',$ft_ficha)
              ->with('ft_insertado',$ft_insertado)
              ->with('ft_soporte',$ft_soporte)
              ->with('ft_fibra_alambre',$ft_fibra_alambre)
              ->with('ft_dimension_cepillo',$ft_dimension_cepillo)
              ->with('ft_bolillo',$ft_bolillo)
              ->with('ft_corrugado',$ft_corrugado)
              ->with('ft_gancho',$ft_gancho)
              ->with('ft_resorte',$ft_resorte)
              ->with('ft_especificacion',$ft_especificacion);
          }
  



      }

    public function Insertado(){
        $ficha=DB::Connection()->select("SELECT FI.id,FI.REVISION,FI.ARTICULO,AR.DESCRIPCION,FI.FAMILIA ,FI.CLIENTE,FI.PAIS
        FROM
        IBERPLAS.FT_FICHA FI,
        IBERPLAS.ARTICULO AR
        WHERE 
        FI.ARTICULO=AR.ARTICULO AND LINEA='INSERTADO'");

       

    	return view('ControlCalidad.Ficha_Tecnica.insertado.index', ['ficha' => $ficha]);

    }

    public function Inyeccion(){
        $ficha=DB::Connection()->select("SELECT FI.id,FI.REVISION,FI.ARTICULO,AR.DESCRIPCION,FI.FAMILIA ,FI.CLIENTE,FI.PAIS
        FROM
        IBERPLAS.FT_FICHA FI,
        IBERPLAS.ARTICULO AR
        WHERE 
        FI.ARTICULO=AR.ARTICULO AND LINEA='INYECCION'");
        return view('ControlCalidad.Ficha_Tecnica.Inyeccion.index', ['ficha' => $ficha]);


    }

    public function Extrusion(){
        $ficha=DB::Connection()->select("SELECT FI.id,FI.REVISION,FI.ARTICULO,AR.DESCRIPCION,FI.FAMILIA ,FI.CLIENTE,FI.PAIS
        FROM
        IBERPLAS.FT_FICHA FI,
        IBERPLAS.ARTICULO AR
        WHERE 
        FI.ARTICULO=AR.ARTICULO AND LINEA='EXTRUSION'");

       

    	return view('ControlCalidad.Ficha_Tecnica.Extrusion.index', ['ficha' => $ficha]);

    }

    public function bolillo(){
        $ficha=DB::Connection()->select("SELECT FI.id,FI.REVISION,FI.ARTICULO,AR.DESCRIPCION,FI.FAMILIA ,FI.CLIENTE,FI.PAIS
        FROM
        IBERPLAS.FT_FICHA FI,
        IBERPLAS.ARTICULO AR
        WHERE 
        FI.ARTICULO=AR.ARTICULO AND LINEA='BOLILLO'");

       

    	return view('ControlCalidad.Ficha_Tecnica.Bolillo.index', ['ficha' => $ficha]);
    }

    public function Pala(){
        $ficha=DB::Connection()->select("SELECT FI.id,FI.REVISION,FI.ARTICULO,AR.DESCRIPCION,FI.FAMILIA ,FI.CLIENTE,FI.PAIS
        FROM
        IBERPLAS.FT_FICHA FI,
        IBERPLAS.ARTICULO AR
        WHERE 
        FI.ARTICULO=AR.ARTICULO AND LINEA='PALA'");
        return view('ControlCalidad.Ficha_Tecnica.Pala.index', ['ficha' => $ficha]);


    }

    public function FichaTecnicaInsertado($id){

      $ft_ficha=FT_FICHA::where('id','=',$id)->first();
      $ft_insertado=FT_INSERTADO::where('ficha_id','=',$id)->first();
      $ft_soporte=FT_SOPORTE::where('ficha_id','=',$id)->first();
      $ft_fibra_alambre=FT_FIBRA_ALAMBRE::where('ficha_id','=',$id)->first();
      $ft_dimension_cepillo=FT_DIMENSION_CEPILLO:: where('ficha_id','=',$id)->first();
      $ft_bolillo=FT_BOLILLO::where('ficha_id','=',$id)->first();
      $ft_corrugado=FT_CORRUGADO::where('ficha_id','=',$id)->first();
      $ft_gancho=FT_GANCHO::where('ficha_id','=',$id)->first();
      $ft_resorte=FT_RESORTE::where('ficha_id','=',$id)->first();

      
      
      
        return view('ControlCalidad.Ficha_Tecnica.Insertado.Ficha_Tecnica')
        ->with('ft_ficha',$ft_ficha)
        ->with('ft_insertado',$ft_insertado)
        ->with('ft_soporte',$ft_soporte)
        ->with('ft_fibra_alambre',$ft_fibra_alambre)
        ->with('ft_dimension_cepillo',$ft_dimension_cepillo)
        ->with('ft_bolillo',$ft_bolillo)
        ->with('ft_corrugado',$ft_corrugado)
        ->with('ft_gancho',$ft_gancho)
        ->with('ft_resorte',$ft_resorte);
    }
    public function FichaTecnicaInsertadoEdit($id){

        $ft_ficha=FT_FICHA::where('id','=',$id)->first();
        $ft_insertado=FT_INSERTADO::where('ficha_id','=',$id)->first();
        $ft_soporte=FT_SOPORTE::where('ficha_id','=',$id)->first();
        $ft_fibra_alambre=FT_FIBRA_ALAMBRE::where('ficha_id','=',$id)->first();
        $ft_dimension_cepillo=FT_DIMENSION_CEPILLO:: where('ficha_id','=',$id)->first();
        $ft_bolillo=FT_BOLILLO::where('ficha_id','=',$id)->first();
        $ft_corrugado=FT_CORRUGADO::where('ficha_id','=',$id)->first();
        $ft_gancho=FT_GANCHO::where('ficha_id','=',$id)->first();
        $ft_resorte=FT_RESORTE::where('ficha_id','=',$id)->first();
  
        
        
        
          return view('ControlCalidad.Ficha_Tecnica.Insertado.Ficha_Tecnica_Edit')
          ->with('ft_ficha',$ft_ficha)
          ->with('ft_insertado',$ft_insertado)
          ->with('ft_soporte',$ft_soporte)
          ->with('ft_fibra_alambre',$ft_fibra_alambre)
          ->with('ft_dimension_cepillo',$ft_dimension_cepillo)
          ->with('ft_bolillo',$ft_bolillo)
          ->with('ft_corrugado',$ft_corrugado)
          ->with('ft_gancho',$ft_gancho)
          ->with('ft_resorte',$ft_resorte);
      }



      

      public function FichaTecnicaInyeccion($id){

        $ft_ficha=FT_FICHA::where('id','=',$id)->first();
        $ft_insertado=FT_INSERTADO::where('ficha_id','=',$id)->first();
        $ft_soporte=FT_SOPORTE::where('ficha_id','=',$id)->first();
        $ft_fibra_alambre=FT_FIBRA_ALAMBRE::where('ficha_id','=',$id)->first();
        $ft_dimension_cepillo=FT_DIMENSION_CEPILLO:: where('ficha_id','=',$id)->first();
        $ft_bolillo=FT_BOLILLO::where('ficha_id','=',$id)->first();
        $ft_corrugado=FT_CORRUGADO::where('ficha_id','=',$id)->first();
        $ft_gancho=FT_GANCHO::where('ficha_id','=',$id)->first();
        $ft_resorte=FT_RESORTE::where('ficha_id','=',$id)->first();
  
        
        
        
          return view('ControlCalidad.Ficha_Tecnica.Inyeccion.Ficha_Tecnica')
          ->with('ft_ficha',$ft_ficha)
          ->with('ft_insertado',$ft_insertado)
          ->with('ft_soporte',$ft_soporte)
          ->with('ft_fibra_alambre',$ft_fibra_alambre)
          ->with('ft_dimension_cepillo',$ft_dimension_cepillo)
          ->with('ft_bolillo',$ft_bolillo)
          ->with('ft_corrugado',$ft_corrugado)
          ->with('ft_gancho',$ft_gancho)
          ->with('ft_resorte',$ft_resorte);
      }  

    public function FichaTecnicaBolillo($id){

        $ft_ficha=FT_FICHA::where('id','=',$id)->first();
        $ft_insertado=FT_INSERTADO::where('ficha_id','=',$id)->first();
        $ft_soporte=FT_SOPORTE::where('ficha_id','=',$id)->first();
        $ft_fibra_alambre=FT_FIBRA_ALAMBRE::where('ficha_id','=',$id)->first();
        $ft_dimension_cepillo=FT_DIMENSION_CEPILLO:: where('ficha_id','=',$id)->first();
        $ft_bolillo=FT_BOLILLO::where('ficha_id','=',$id)->first();
        $ft_corrugado=FT_CORRUGADO::where('ficha_id','=',$id)->first();
        $ft_gancho=FT_GANCHO::where('ficha_id','=',$id)->first();
        $ft_resorte=FT_RESORTE::where('ficha_id','=',$id)->first();
  
        
        
        
          return view('ControlCalidad.Ficha_Tecnica.Bolillo.Ficha_Tecnica')
          ->with('ft_ficha',$ft_ficha)
          ->with('ft_insertado',$ft_insertado)
          ->with('ft_soporte',$ft_soporte)
          ->with('ft_fibra_alambre',$ft_fibra_alambre)
          ->with('ft_dimension_cepillo',$ft_dimension_cepillo)
          ->with('ft_bolillo',$ft_bolillo)
          ->with('ft_corrugado',$ft_corrugado)
          ->with('ft_gancho',$ft_gancho)
          ->with('ft_resorte',$ft_resorte);
      }
 public function FichaTecnicaExtrusion(Request $request,$id){

        $ft_ficha=FT_FICHA::where('id','=',$id)->first();
        $ft_insertado=FT_INSERTADO::where('ficha_id','=',$id)->first();
        $ft_soporte=FT_SOPORTE::where('ficha_id','=',$id)->first();
        $ft_fibra_alambre=FT_FIBRA_ALAMBRE::where('ficha_id','=',$id)->first();
        $ft_dimension_cepillo=FT_DIMENSION_CEPILLO:: where('ficha_id','=',$id)->first();
        $ft_bolillo=FT_BOLILLO::where('ficha_id','=',$id)->first();
        $ft_corrugado=FT_CORRUGADO::where('ficha_id','=',$id)->first();
        $ft_gancho=FT_GANCHO::where('ficha_id','=',$id)->first();
        $ft_resorte=FT_RESORTE::where('ficha_id','=',$id)->first();
        $ft_especificacion=FT_ESPECIFICACION::where('ficha_id','=',$id)->first();

      
  
        
        
        
          return view('ControlCalidad.Ficha_Tecnica.Extrusion.Ficha_Tecnica')
          ->with('ft_ficha',$ft_ficha)
          ->with('ft_insertado',$ft_insertado)
          ->with('ft_soporte',$ft_soporte)
          ->with('ft_fibra_alambre',$ft_fibra_alambre)
          ->with('ft_dimension_cepillo',$ft_dimension_cepillo)
          ->with('ft_bolillo',$ft_bolillo)
          ->with('ft_corrugado',$ft_corrugado)
          ->with('ft_gancho',$ft_gancho)
          ->with('ft_resorte',$ft_resorte)
          ->with('ft_especificacion',$ft_especificacion);
      }


      
}
