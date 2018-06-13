@extends('layouts.app')

@section('htmlheader_title')
    Ficha Tecnica
@endsection

@section('contentheader_title')
 Ficha Tecnica
@endsection
@section('main-content')

  <div class="row">
         <div class="col-xs-12">
         
         <div class="box">
        
            <!-- /.box-header -->
            <div class="box-body">
                      <div class="form-group">
             
                </div>
              <table id="example1" class="display nowrap"  style="width:95%" >
                <thead>
                <tr>
                  <th>Turno</th>
                  <th>Descripcion</th>
                  <th>Hora Inicio</th>
                  <th>Hora Fin</th>
                  <th>Duracion</th>
                  <th>Selecion</th>
                </tr>
                </thead>
                <tbody>
                 
                 {{csrf_field()}}       
                 @foreach($turnos as $turnos)
				 		<tr>
                            <td>{{ $turnos->TURNO }}</td> 
                            <td>{{ $turnos->DESCRIPCION }}</td>
                            <td>{{ $turnos->HORA_INICIO }}</td>
                            <td>{{ $turnos->HORA_TERMINO }}</td>
                            <td>{{ $turnos->DURACION }}</td> 
                            <td>
                                <a href="{{route('listar_equipo_articulo',$turnos->TURNO)}}" class="btn btn-warning"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                
                                
                                <a href="{{route('agregar_articulo',$turnos->TURNO)}}"
                                           class="btn btn-success">
                                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                 </a>
                                       

                             </td>                






				 		
				 		@endforeach
                </tbody>
                <tfoot>
                <tr>
                 <th>Turno</th>
                  <th>Descripcion</th>
                  <th>Hora Inicio</th>
                  <th>Hora Fin</th>
                  <th>Duracion</th>
                  <th>Selecion</th>
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