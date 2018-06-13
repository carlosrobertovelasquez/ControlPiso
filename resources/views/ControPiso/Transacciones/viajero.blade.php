@extends('layouts.app')

@section('htmlheader_title')
    Viajero
@endsection


@section('main-content')


  <div class="row">
      <div class="col-xs-12">
         
          <div class="box">
            <div class="box-header">
              <h1 align="center">REQUISICION DE MATERIALES</h1>
             @foreach($encabezado as $encabezado)
               <div>
                <h3 class="box-title">Ordenes de Produccion: {{$encabezado->ORDEN_PRODUCCION}}</h3>
              </div>
              <div>
                <h2 class="box-title">Articulo: {{$encabezado->ARTICULO}}-{{$encabezado->DESCRIPCION}}</h2> 
              </div>
              <div>
                <h2 class="box-title">Referencia: {{$encabezado->REFERENCIa}}</h2> 
              </div>   
            @endforeach

              <div class="box-title">
           <a href="{{url('planificador')}}" class="btn btn-primary">Regresar</a>
            </div>

            <!-- /.box-header -->
                <div class="table-responsive" >
                  <table id="example1" class="display nowrap"    >
                    <thead>
                        <tr>
                          <th>Operacion</th>
                          <th>Articulo</th>
                          <th>Descripcion</th>
                          <th>Candtidad</th>
                          <th>Unidad</th>
                          <th>Entregado</th>
                          <th>Recibido</th>
                          <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                      @foreach($detalle as $detalle)
                        <tr>
                                <td >{{ $detalle->des_op }}</td> 
                                <td>{{ $detalle->ARTICULO }}</td> 
                                <td >{{ $detalle->DESCRIPCION }}</td>
                                <td>{{ number_format($detalle->CANTIDAD_ESTANDAR ,2)}}</td>
                                <td>{{ $detalle->UNIDAD_ALMACEN }}</td>
                                <td>--------------</td>
                               <td>--------------</td>
                               <td>--------------</td>
                               
                               
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Articulo</th>
                          <th>Descripcion</th>
                          <th>Operacion</th>
                          <th>Candtidad</th>
                          <th>Unidad</th>
                          <th>Entregado</th>
                          <th>Recibido</th>
                          <th>Fecha</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
         </div>
      </div>
  </div>       
  







@endsection