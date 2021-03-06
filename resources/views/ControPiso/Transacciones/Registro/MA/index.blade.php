@extends('layouts.app')

@section('htmlheader_title')
    Produccion
@endsection

@section('contentheader_title')
 Registro de Materiales
@endsection

@section('main-content')


  <div class="row">
  
      <div class="col-xs-12">
      <a href=" {{url('/')}}" ><span class="btn btn-primary" aria-hidden="true">Regresar</span></a>       
          <div class="box">
            <div class="box-header">
            
          
            <!-- /.box-header -->
                <div class="table-responsive" >
                  <table id="example1" class="display nowrap"    >
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
                                                               <a href="{{route('registro.ma',[$OrdenProduccion->id,$OrdenProduccion->ordenproduccion])}}" class="btn btn-primary">MAT.</a>

                                @if($OrdenProduccion->aprobadaMA=='S')
                                     <a href="{{route('registro.confirmarproduccion',[$OrdenProduccion->id,$OrdenProduccion->ordenproduccion])}}" class="btn btn-primary">Confirmada</a> 
                                    @else
                                    <a href="#" class="btn btn-primary">Aprobar</a>
            
                                @endif


                                
                                
                                           
                                
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