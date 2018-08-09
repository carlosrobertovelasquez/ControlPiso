<?php

namespace App\Modelos\ControlPiso;

use Illuminate\Database\Eloquent\Model;

class CP_PRODUCCION extends Model
{
    protected $table='IBERPLAS.CP_PRODUCCION';
       
    public $timestamps = false;
    protected $dateFormat='d-m-Y H:i:s';
}