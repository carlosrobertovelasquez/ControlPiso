<!doctype html>
<html lang="es">

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Orden de Produccion</title>
        <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

    </head>
    <body>
       
<table>
<thead>
  <tr>
  <th>ID</th>
    <th>Orden Produccion</th>
    <th>Pedido</th>
    <th>Centro Costo</th>
    <th>Operacion</th>
    <th>Fecha Inicio</th>
    <th>Fecha Fin</th>
    <th>Cantidad</th>
    <th>Horas</th>
  </tr>
<thead>
<tbody>


@foreach($detalle as $detalle)         
   
                        <tr>
                      
                                <td >{{ $detalle->id}}
                                <a href="{{url('ConsultarTicket/'.$detalle->id)}}"</a>
                                </td>

                               
                                <td >{{ $detalle->ordenproduccion}}</td>
                                <td >{{ $detalle->pedido}}</td>
                                <td >{{ $detalle->centrocosto}}</td>
                                <td >{{ $detalle->operacion}}</td>
                              
                                <td >{{ Carbon\Carbon::parse( $detalle->fechamin)->format('d-m-Y H:i:s') }}</td>
                                <td >{{ Carbon\Carbon::parse($detalle->fechamax)->format('d-m-Y H:i:s')}}</td>
                                <td >{{ $detalle->cantidad}}</td>
                                <td >{{ $detalle->horas}}</td>
                             
                        </tr>
                    
 @endforeach
</tbody>
</table>


        <script src="js/main.js"></script>
      
    </body>
</html>