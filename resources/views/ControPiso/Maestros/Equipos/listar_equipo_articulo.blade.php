@extends('layouts.app')

@section('htmlheader_title')
    Equipos
@endsection


@section('main-content')


  <div class="row">
         <div class="col-xs-12">
         
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Equipos Articulos</h3>
            </div>

               <a href=" {{url('Equipo')}}" ><span class="btn btn-primary" aria-hidden="true">Regresar</span></a>
            <!-- /.box-header -->
              @include('flash::message')
            <div class="box-body">
                      <div class="form-group">
             
                </div>
              <table id="example1" class="display nowrap"  style="width:95%" >
                <thead>
                <tr>
                <th>ARTICULO</th> 
                  <th>OPERACION</th>
                  <th>DESCRIPCION</th>
                  <th>EQUIPO</th>
                  <th>HORASXCICLO</th>
                  <th>CANTXCICLO</th>
                  <th>CANTXHORA</th>
                  <th>TIE MOLDE</th>
                  <th>Selecionar</th>
                </tr>
                </thead>
                <tbody>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <?php
                        $modal=0;
                        ?>
                   
                     
                 @foreach($ESTRUC_PROCESO as $ESTRUC_PROCESO)
				 		<tr>
                            <td>{{ $ESTRUC_PROCESO->ARTICULO }}</td>
                            <td>{{ $ESTRUC_PROCESO->OPERACION }}</td> 
                            <td>{{ $ESTRUC_PROCESO->DESCRIPCION }}</td>
                            <td>{{ $ESTRUC_PROCESO->RUBRO }}</td>
                            <td>{{number_format( $ESTRUC_PROCESO->HORAS_STD_MOE,2) }}</td>
                            <td>{{number_format( $ESTRUC_PROCESO->CANT_PRODUCIDA_PT,2) }}</td> 
                            <td>{{number_format( $ESTRUC_PROCESO->HORASXHORA,2) }}</td>
                            <td>{{number_format( $ESTRUC_PROCESO->CP_TIEMPOCAMBIOMOLDE,2) }}</td> 
                            <td>
                            <button type="button" 
                            class="show-modal btn btn-success"   
                            data-id="{{$ESTRUC_PROCESO->RowPointer}}" 
                            data-title="{{$ESTRUC_PROCESO->ARTICULO}}">
                            <span class="glyphicon glyphicon-eye-open"></span></button>
  
                             </td>                
          
                  </tr>
                  @include('ControPiso.Maestros.Equipos.edit')   
                        <?php $modal++?>  
				 		@endforeach
                </tbody>
                <tfoot>
                <tr>
                <th>OPERACION</th>
                  <th>DESCRIPCION</th>
                  <th>EQUIPO</th>
                  <th>HORASXCICLO</th>
                  <th>CANTXCICLO</th>
                  <th>CANTXHORA</th>
                  <th>TIE MOLDE</th>
                  <th>Selecionar</th>
                </tr>
                </tfoot>
              </table>
            </div>
            @include('ControPiso.Maestros.Equipos.edit')
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  

@endsection

@section('script2')
<script>

 
 $(document).on('click','.show-modal',function(){

  $('.modal-title').text('Show');
  $('#id_show').val($(this).data('id'));
  $('#title_show').val($(this).data('title'));
  $('#des_show').val($(this).data('des'));
  $('#estado_show').val($(this).data('estado'));
$('#showModal').modal('show');
 });
 


</script>

@endsection