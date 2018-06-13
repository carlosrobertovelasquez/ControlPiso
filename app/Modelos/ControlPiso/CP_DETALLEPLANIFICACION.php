<?php

namespace App\Modelos\ControlPiso;

use Illuminate\Database\Eloquent\Model;

class CP_DETALLEPLANIFICACION extends Model
{
     protected $table='IBERPLAS.CP_DETALLEPLANIFICACION';
     protected $fillable=[
      'ENCABEZADOPLANIFICADOR_ID',
                'CALENDARIOPLANIFICADOR_ID',
                'MAQUINA',
                'NUMERO',
                'CORRELATIVO',
                'TURNO',
                'FECHAINICIO',
                'FECHAFIN',
                'CANTIDADAPRODUCIR',
                'USUARIOCREACION',
                'FECHACREACION',
                'ESTADO',
                'COLOR',
                'planificacion_id'
      ];
     public $timestamps = false;
     protected $dateFormat='d-m-Y H:i:s';
}
