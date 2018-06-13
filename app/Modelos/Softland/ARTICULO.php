<?php

namespace App\Modelos\Softland;

use Illuminate\Database\Eloquent\Model;

class ARTICULO extends Model
{
    protected $table='IBERPLAS.ARTICULO';
    protected $id='ARTICULO';
     protected $fillable=[
      'ARTICULO','DESCRIPCION'
      ];
}
