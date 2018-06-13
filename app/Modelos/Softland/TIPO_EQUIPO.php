<?php

namespace App\Modelos\Softland;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TIPO_EQUIPO extends Model
{
    protected $table='IBERPLAS.TIPO_EQUIPO';

    public function scopeTipoEquipos($query){
        return $query->DB::Connection()->select("SELECT TIPO_EQUIPO,DESCRIPCION FROM IBERPLAS.TIPO_EQUIPO 
        WHERE TIPO_EQUIPO IN (SELECT  
        EQ.TIPO_EQUIPO
        FROM 
        IBERPLAS.EQUIPO EQ,
        IBERPLAS.CP_PLANIFICACION PL
        WHERE EQ.EQUIPO=PL.centrocosto) ");
    }
}
