<?php

namespace App\Http\Controllers;
use Dhtmlx\Connector\SchedulerConnector; 

use App\Modelos\ControlPiso\CP_events;
use App\Modelos\ControlPiso\CP_types;


use Illuminate\Http\Request;


class SchedulerController extends Controller
{
    public function index (){
    		


    	   return view("ControPiso.Consulta.scheduler");

    }

    public function get(){
    	$events = new CP_events();
    	$types = new CP_types();
        


    	return response()->json([
            "data" => $events->all(),
            "sections"=>$types->all()

        ]);
    }
}
