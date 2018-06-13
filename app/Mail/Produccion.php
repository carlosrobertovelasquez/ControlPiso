<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Modelos\ControlPiso\CP_PLANIFICACION;

class Produccion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public $cp_planificacion2;
    public $ordenproduccion2;

    public function __construct($cp_planificacion2,$ordenproduccion2)
    {
       $this->cp_planificacion2=$cp_planificacion2;
       $this->ordenprodcuccion2=$ordenproduccion2;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      
        return $this->subject( 'Orden de produccion:' ,$this->ordenproduccion2)->view('emails.OrdenProducion')
        ->with('detalle',$this->cp_planificacion2);
    }
}
