<?php

namespace App\Http\Controllers;
use  App\Modelos\Softland\turno;
use App\Modelos\ControlPiso\CP_CALENDARIO_PLANIFICADOR_DETALLE;
use Illuminate\Http\Request;

class TurnosController extends Controller
{
    public function index(){

    	$turnos=turno::all();

    	return view('ControPiso.Maestros.turnos.index', ['turnos' => $turnos]);

    }

    public function DetalleTurno($id){
        $turnodetalle=CP_CALENDARIO_PLANIFICADOR_DETALLE::where('turno','=',$id)->get();
       
        return view('ControPiso.Maestros.turnos.DetalleTurno', ['turnodetalle' => $turnodetalle]);
       
    }

}
