@extends('layouts.app')

@section('htmlheader_title')
    Produccion
@endsection


@section('main-content')

  @include('flash::message')
  <div class="row">
      <div class="col-xs-12">
         
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ordenes de Produccion</h3>
          
            <!-- /.box-header -->
                <div class="table-responsive" >
                  <table id="example1" class="display compact"    >
                    <thead>
                        <tr>
                          <th>Ord.Prod</th>
                          <th>Articulo</th>
                          <th>Referencia</th>
                          <th>Cantidad</th>
                          <th>Can.Prod</th>
                          <th>FechaCre</th>
                          <th>Selecionar</th>
                        </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                      @foreach($OrdenProduccion as $OrdenProduccion)
                        <tr>
                                <td >{{ $OrdenProduccion->ORDEN_PRODUCCION }}</td> 
                                <td>{{ $OrdenProduccion->ARTICULO }}</td> 
                                <td >{{ substr($OrdenProduccion->REFERENCIA ,0,25)}}</td>
                                <td>{{ number_format($OrdenProduccion->CANTIDAD_ARTICULO ,2)}}</td>
                                <td>{{ number_format($OrdenProduccion->CANTIDAD_PRODUCCI ,2)}}</td>
                                <td>{{ Carbon\Carbon::parse($OrdenProduccion->FECHA_REQUERIDA)->format('d-m-Y H:i:s') }}</td>
                               
                               
                                <td>
                                  <a href="{{route('planificacion',$OrdenProduccion->ORDEN_PRODUCCION)}}" class="btn btn-primary" title="Asigar"><span class="glyphicon glyphicon-thumbs-up" ></span></a>
                                 <a href="{{route('viajero',$OrdenProduccion->ORDEN_PRODUCCION)}}" class="btn btn-primary" title="Viajero"><span class="glyphicon glyphicon-road" ></span></a></a>
                                 <a href="{{route('EliminarProduccion',$OrdenProduccion->ID)}}"  onclick="return confirm('Esta seguro de Eliminar La Orden de Produccion ')" class="btn btn-danger" title="Eliminar Orden"><span class="glyphicon glyphicon-remove" ></span></a></a>

                                </td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Ord.Produccion</th>
                        <th>Articulo</th>
                        <th>Referencia</th>
                        <th>Cantidad</th>
                        <th>Fecha Requerida</th>
                        <th>Fecha Creacion</th>
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