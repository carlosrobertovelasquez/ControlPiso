@extends('layouts.app')

@section('htmlheader_title')
    Produccion
@endsection


@section('main-content')


  <div class="row">
      <div class="col-xs-12">
         
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ordenes de Produccion</h3>
          
            <!-- /.box-header -->
                <div class="table-responsive" >
                  <table  id="example1" class="display nowrap"    >
                    <thead>
                        <tr>
                        <th></th>
                          <th>ID</th>
                          <th>Centro Costo</th>
                          <th>Ord.Prod</th>
                          <th>Operacion</th>
                          <th>Articulo</th>
                          <th>Fecha Inicio</th>
                          <th>Fecha Fin</th>
                          <th>Cantidad</th>
                          <th>Cant.Produ</th>
                          <th>%</th>
                          <th>Horas</th>
                          

                        </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                      @foreach($OrdenProduccion as $OrdenProduccion)
                        <tr>
                        <td>
                                <a href="{{route('ListaRegistros',$OrdenProduccion->id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                             </td>
                                <td >{{ $OrdenProduccion->id }}</td>
                                <td>{{ $OrdenProduccion->centrocosto }}</td> 
                                <td>{{ $OrdenProduccion->ordenproduccion }}</td>
                                <td>{{ $OrdenProduccion->operacion }}</td> 
                                <td >{{ substr($OrdenProduccion->articulo ,0,25)}}</td>
                                <td>{{ Carbon\Carbon::parse($OrdenProduccion->fechamin)->format('d-m-Y H:i:s') }}</td>
                                <td>{{ Carbon\Carbon::parse($OrdenProduccion->fechamax)->format('d-m-Y H:i:s') }}</td>
                                <td>{{ number_format($OrdenProduccion->cantidad ,2)}}</td>
                                <td>{{ number_format($OrdenProduccion->cantidadproducidad ,2)}}</td>
                                 <td>{{ number_format($OrdenProduccion->porcentaje2,2) }}</td>
                                  <td>{{ $OrdenProduccion->horas }}</td>
                               
                        
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                      <th></th>
                      <th>ID</th>
                          <th>Centro Costo</th>
                          <th>Ord.Prod</th>
                          <th>Operacion</th>
                          <th>Articulo</th>
                          <th>Fecha Inicio</th>
                          <th>Fecha Fin</th>
                          <th>Cantidad</th>
                          <th>Cant.Prod</th>
                          <th>%</th>
                          <th>Horas</th>
                         
                      </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
         </div>
      </div>
  </div>       
  







@endsection