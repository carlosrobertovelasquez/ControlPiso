<?php

namespace App\Modelos\ControlPiso;

use Illuminate\Database\Eloquent\Model;

class CP_ENCABEZADOPLANIFICACION extends Model
{

	 
     protected $table='IBERPLAS.CP_ENCABEZADOPLANIFICACION';
     protected $fillable=['ORDENPRODUCCION','ARTICULO','CANTIDADAPRODUCIR','PEDIDO','MAQUINA','PIEZASXHORA','PIEZAXTURNO','CANTIDADXTURNO','FECHAPLANIFICADA','TURNOSPLANIFICADOS','USUARIOCREACION','FECHACREACION','USUARIOUPDATE','FECHAUPDATE','ESTADO'];
     public $timestamps = false;
     protected $dateFormat='d-m-Y H:i:s';
}
