@extends('layouts.app')

@section('htmlheader_title')
    Equipos
@endsection

@section('contentheader_title')
 Turnos 
@endsection
@section('main-content')

  <div class="row">
         <div class="col-xs-12">
         
         <div class="box">
         <a href=" {{url('Turno')}}" ><span class="btn btn-primary" aria-hidden="true">Regresar</span></a>
            <!-- /.box-header -->
            <div class="box-body">
                      <div class="form-group">
             
                </div>
              <table id="example1" class="display nowrap"  style="width:95%" >
                <thead>
                <tr>
                  <th>ID</th>
                  <th>FECHA</th>
                  <th>HORA</th>
                  <th>TURNO</th>
                  <th>ORDEN</th>
                  <th>FECHAHORA</th>
                  <th>DIA</th>
                  <th>TIPO</th>
                  <th>ESTADO</th>
                  <th>SELECCION</th>
                </tr>
                </thead>
                <tbody>
                 
                 {{csrf_field()}}       
                 @foreach($turnodetalle as $turnodetalle)
				 		<tr>
                         <td>{{ $turnodetalle->ID     }}</td>
                            <td>{{ $turnodetalle->fecha }}</td> 
                            <td>{{ $turnodetalle->hora }}</td>
                            <td>{{ $turnodetalle->turno }}</td>
                            <td>{{ $turnodetalle->orden }}</td>
                            <td>{{ $turnodetalle->fechahora }}</td>
                            <td>{{ $turnodetalle->dia }}</td>
                            <td>{{ $turnodetalle->tipo }}</td>
                            <td>{{ $turnodetalle->estado }}</td> 
                            <td>
                                <a href="#" class="btn btn-warning"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                
                                
                                <a href="#"
                                           class="btn btn-success">
                                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                 </a>
                                       

                             </td>                






				 		
				 		@endforeach
                </tbody>
                <tfoot>
                <tr>
                <th>ID</th>
                  <th>FECHA</th>
                  <th>HORA</th>
                  <th>TURNO</th>
                  <th>ORDEN</th>
                  <th>FECHAHORA</th>
                  <th>DIA</th>
                  <th>TIPO</th>
                  <th>ESTADO</th>
                  <th>SELECCION</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  

@endsection