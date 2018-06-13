<?php

namespace App\Modelos\ControlPiso;

use Illuminate\Database\Eloquent\Model;

class Fullcalendareventos extends Model
{
    
     protected $table='IBERPLAS.Fullcalendareventos';
      protected $fillable = ['fechaIni','fechaFin','todoeldia','lugar','color','titulo','turno','equipo'];
    protected $hidden = ['id'];
     public $timestamps = false;
}
