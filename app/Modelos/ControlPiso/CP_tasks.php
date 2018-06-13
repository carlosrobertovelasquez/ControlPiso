<?php

namespace App\Modelos\ControlPiso;

use Illuminate\Database\Eloquent\Model;

class CP_tasks extends Model
{
    protected $table='IBERPLAS.CP_tasks';
     public $timestamps = false;
      protected $appends = ["open"];
      protected $dateFormat='d-m-Y H:i:s';
 
    public function getOpenAttribute(){
        return true;
    }
}
