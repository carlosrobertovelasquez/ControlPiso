<?php

namespace App\Http\Controllers;
use App\Modelos\ControlPiso\CP_CLAVE_MO;
Use Carbon\Carbon;
use Illuminate\Http\Request;

class ClaveController extends Controller
{
      

         public function index()
    {
       
          $claves=CP_CLAVE_MO::all();

      return view('ControPiso.Maestros.Claves.index')
              ->with('claves',$claves);
           
    }

    public function ConsultarClave(){
        $id=$_GET['id_clave'];

        $clave=CP_CLAVE_MO::where('CLAVE','=',$id)->first();
       
        if(is_null($clave)){
         $valor='0';
        }else{
         $valor='1';
        };

        return response()->json($valor); 
    }

    public function AgregarClave(Request $request){
      
         $id_clave=$request->id_clave;
      
        $date = carbon::now();
            $date = $date->format('d-m-Y H:i:s');
            
            $clave=CP_CLAVE_MO::where('CLAVE','=',$id_clave)->first();

            if(is_null($clave)){
                $valor='0';
                $registroclaves=new CP_CLAVE_MO;

                $registroclaves->CLAVE=$request->id_clave;
                $registroclaves->DESCRIPCION=$request->id_opera;
                $registroclaves->ACTIVA='S';
                $registroclaves->OPERACION=$request->OPERACION;
                $registroclaves->USUARIOCREACION=\Auth::user()->name;
                $registroclaves->FECHACREACION=$date;
                $registroclaves->save();
               
                

               }else{
                $valor='1';
               };

               return redirect()->route('clave.index');






    }






     
}
