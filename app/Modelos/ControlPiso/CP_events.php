<?php

namespace App\Modelos\ControlPiso;

use Illuminate\Database\Eloquent\Model;

class CP_events extends Model
{
    protected $table='IBERPLAS.CP_events';
     public $timestamps = false;
     protected $dateFormat='d-m-Y H:i:s';
   
}
