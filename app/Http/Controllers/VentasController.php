<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelos\Softland\PEDIDO;
use App\Modelos\Softland\PEDIDO_LINEA;
use Illuminate\Support\Facades\DB;
class VentasController extends Controller
{
    public function index(){
       $ventas=DB::Connection()->select("select PL.PEDIDO,PE.CLIENTE_ORIGEN,CL.NOMBRE,PL.ARTICULO,AR.DESCRIPCION,PL.CANTIDAD_PEDIDA,PE.FECHA_PROMETIDA 
       from 
       IBERPLAS.PEDIDO_LINEA PL,
       IBERPLAS.PEDIDO PE,
       IBERPLAS.CLIENTE CL,
       IBERPLAS.ARTICULO AR 
       where 
       PE.PEDIDO=PL.PEDIDO and
       PL.ARTICULO=AR.ARTICULO and
       pe.CLIENTE_ORIGEN=cl.CLIENTE and
       pe.ESTADO='A' and
       pe.FECHA_PROMETIDA>='2017-01-08' and
       pe.FECHA_PROMETIDA<='2018-30-03'
       ");

        return view('ControPiso.Consulta.Pedidos.index')
        ->with('ventas',$ventas);
    }
}
