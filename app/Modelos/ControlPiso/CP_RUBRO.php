<?php

namespace App\Modelos\ControlPiso;

use Illuminate\Database\Eloquent\Model;

class CP_RUBRO extends Model
{
     protected $table='IBERPLAS.CP_RUBRO';
     public $timestamps = false;
     protected $fillable=['fechamax'];
     protected $dates=['fechamax'];
     protected $dateFormat='d-m-Y H:i:s';
      
}
