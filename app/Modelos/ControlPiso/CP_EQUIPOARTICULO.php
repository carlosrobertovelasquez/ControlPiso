<?php

namespace App\Modelos\ControlPiso;

use Illuminate\Database\Eloquent\Model;

class CP_EQUIPOARTICULO extends Model
{
       protected $table='IBERPLAS.CP_EQUIPOARTICULO';
       
       public $timestamps = false;
       protected $dateFormat='Y-m-d H:i:s';
}
