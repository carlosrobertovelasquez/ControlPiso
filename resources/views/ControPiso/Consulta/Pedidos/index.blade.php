@extends('layouts.app')

@section('htmlheader_title')
    Ticket
@endsection

@section('contentheader_title')
 Consulta Ticket 
@endsection

@section('main-content')


  <div class="row">
      <div class="col-xs-12">
       

        <div class="box">
            <div class="box-header">
            
          
            <!-- /.box-header -->
                <div class="table-responsive" >
                  <table id="example1" class="display nowrap"    >
                    <thead>
                        <tr>
                          <th>PEDIDO</th>
                          <th>CLIENTE</th>
                          <th>NOMBRE</th>
                          <th>ARTICULO</th>
                          <th>DESCRIPCION</th>
                          
                          <th>FECHA PROMETIDAD</th>
                          <th>CANTIDAD</th>
                        </tr>
                    </thead>
                    <tbody>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                      @foreach($ventas as $ventas)
                        <tr>
                                <td >{{ $ventas->PEDIDO}}</td>
                                <td >{{ $ventas->CLIENTE_ORIGEN}}</td>
                                <td >{{ $ventas->NOMBRE }}</td> 
                                <td>{{ $ventas->ARTICULO }}</td> 
                                <td>{{$ventas->DESCRIPCION}}</td>
                                <td>{{$ventas->FECHA_PROMETIDA}}</td>
                                <td>{{ number_format($ventas->CANTIDAD_PEDIDA ,2)}}</td>              
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                    <th colspan="6" style="text-align:right">Total:</th>
                <th></th>
                    </tfoot>
                  </table>
                </div>
            </div>
        </div>



      </div>
  </div>       
  







@endsection