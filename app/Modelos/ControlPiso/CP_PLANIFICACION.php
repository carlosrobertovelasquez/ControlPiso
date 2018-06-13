<?php

namespace App\Modelos\ControlPiso;

use Illuminate\Database\Eloquent\Model;

class CP_PLANIFICACION extends Model
{
      protected $table='IBERPLAS.CP_PLANIFICACION';
       
       public $timestamps = false;
       protected $dateFormat='d-m-Y H:i:s';
}
