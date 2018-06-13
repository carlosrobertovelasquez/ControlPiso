<?php

namespace App\Modelos\ControlPiso;

use Illuminate\Database\Eloquent\Model;

class CP_TEMP_PLANIFICACION extends Model
{
      protected $table='IBERPLAS.CP_TEMP_PLANIFICACION';
     public $timestamps = false;
     protected $dateFormat='d-m-Y H:i:s';
}
