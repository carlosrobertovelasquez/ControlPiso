@extends('layouts.app')

@section('htmlheader_title')
    Produccion
@endsection

@section('contentheader_title')
 Ordenes de Produccion 
@endsection

@section('main-content')

 @include('flash::message')
  <div class="row">
   

      <div class="col-xs-12">
         
          <div class="box">
            <div class="box-header">
                 
              
                
           
          
            <!-- /.box-header -->
                <div class="table-responsive" >
                  <table id="example1" class="display compact"    >
                    <thead>
                        <tr>
                          <th>ID</th>
                          <th>Operacion</th>
                          <th>Ord.Prod</th>
                          <th>Articulo</th>
                          <th>Cantidad</th>
                          <th>Pedido</th>
                          <th>Maquina</th>
                          <th>Estado</th>
                          <th>Fecha</th>
                          <th>Selecionar</th>
                        </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                      @foreach($OrdenProduccion as $OrdenProduccion)
                        <tr>
                                <td >{{ $OrdenProduccion->id}}</td>
                                <td >{{ $OrdenProduccion->operacion}}</td>
                                <td >{{ $OrdenProduccion->ordenproduccion }}</td> 
                                <td>{{ $OrdenProduccion->articulo }}</td> 
                                <td>{{ number_format($OrdenProduccion->cantidad ,2)}}</td>
                                <td>{{$OrdenProduccion->pedido}}</td>
                                <td>{{$OrdenProduccion->centrocosto}}</td>
                                <td>{{$OrdenProduccion->estado}}</td>
                                <td>{{ Carbon\Carbon::parse($OrdenProduccion->FECHAPLANIFICADA)->format('d-m-Y') }}</td>
                               
                               
                                <td>
                                 <a href="{{route('ConsultarTicket',[$OrdenProduccion->id])}}" class="btn btn-primary" title="Consultar"><span class="glyphicon glyphicon-info-sign" ></span></a></a>
                                 <a href="{{route('registro.impresion',[$OrdenProduccion->id,$OrdenProduccion->ordenproduccion])}}" class="btn btn-primary"  title="Imprimir"><span class="glyphicon glyphicon-print" ></span></a>
                                 <a href="#" class="btn btn-success" title="Editar"><span class="glyphicon glyphicon-pencil" ></span></a></a>
                                 <a href="{{route('EliminarTicket',[$OrdenProduccion->id,$OrdenProduccion->ordenproduccion])}}"
                                   onclick="return confirm('Esta seguro de Eliminar el Ticker borrar todo su Historial')" class="btn btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove" ></span></a></a>


                                </td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Operacion</th>
                        <th>Ord.Produ</th>
                        <th>Articulo</th>
                        <th>Cantidad</th>
                        <th>Pedido</th>
                        <th>Maquina</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Selecionar</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
         </div>
      </div>
  </div>       
  







@endsection