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
                          <th>ID</th>
                          <th>Hora inicio</th>
                          <th>Hora Fin</th>
                          <th>Articulo</th>
                          <th>Cantidad</th>
                          <th>Horas</th>
                          <th>Maquina</th>
                          <th>Estado</th>
                          <th>Turno</th>
                         
                        </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                      @foreach($cp_encabezadoplanificacion as $OrdenProduccion)
                        <tr>
                                <td >{{ $OrdenProduccion->planificacion_id}}</td>
                                <td >{{ $OrdenProduccion->fhoraini}}</td>
                                <td >{{ $OrdenProduccion->fhorafin }}</td> 
                                <td>{{ $OrdenProduccion->articulo }}</td> 
                                <td>{{ number_format($OrdenProduccion->cantidad ,2)}}</td>
                                <td>{{$OrdenProduccion->horas}}</td>
                                <td>{{$OrdenProduccion->centrocosto}}</td>
                                <td>{{$OrdenProduccion->estado}}</td>
                                <td>{{ $OrdenProduccion->turno }}</td>
                               
                               
                
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Articulo</th>
                        <th>Cantidad</th>
                        <th>Horas</th>
                        <th>Maquina</th>
                        <th>Estado</th>
                        <th>Turno</th>
                       
                      </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
        </div>



      </div>
  </div>       
  







@endsection