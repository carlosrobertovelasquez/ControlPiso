@extends('layouts.app')

@section('htmlheader_title')
    Equipos
@endsection
@section('contentheader_title')
 Centro de Costo 
@endsection


@section('main-content')

  <div class="row">
         <div class="col-xs-12">
           @include('flash::message')
         <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
                      <div class="form-group">
             
                </div>
              <table id="example1" class="display nowrap"  style="width:95%" >
                <thead>
                <tr>
                  <th>Articulo</th>
                  <th>Version</th>
                  <th>Descripcion</th>
                  <th>Estado</th>
                  <th>Selecionar</th>
                </tr>
                </thead>
                <tbody>
                   <?php
                        $modal=0;
                        ?>
                 {{csrf_field()}}       
                 @foreach($ESTRUC_MANUFACTURA as $ESTRUC_MANUFACTURA)
				 		<tr>
                            <td>{{ $ESTRUC_MANUFACTURA->ARTICULO }}</td> 
                            <td>{{ $ESTRUC_MANUFACTURA->VERSION }}</td> 
                            <td>{{ $ESTRUC_MANUFACTURA->DESCRIPCION }}</td> 
                            <td>{{ $ESTRUC_MANUFACTURA->ESTADO }}</td>
                              
                            <td>
                                <a href="{{route('listar_equipo_articulo',$ESTRUC_MANUFACTURA->ARTICULO)}}" class="btn btn-warning"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                                
                                
                               
                                       

                             </td>                






				 		
				 		@endforeach
                </tbody>
                <tfoot>
                <tr>
                <th>Articulo</th>
                  <th>Version</th>
                  <th>Descripcion</th>
                  <th>Estado</th>
                  <th>Selecionar</th>
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