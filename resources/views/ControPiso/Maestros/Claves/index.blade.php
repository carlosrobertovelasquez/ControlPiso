@extends('layouts.app')

@section('htmlheader_title')
    Claves
@endsection
@section('contentheader_title')
 Claves 
@endsection


@section('main-content')
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <div class="row">
         <div class="col-xs-12">
         
         <div class="box">
            
            
            
            <a href="#" class="add-modal"><span class="btn btn-primary" aria-hidden="true">ADICIONAR CLAVE</span></a>            
            <!-- /.box-header -->
            <div class="box-body">
                      <div class="form-group">
             
                </div>
              <table id="example1" class="display nowrap"  style="width:95%" >
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Claves</th>
                  <th>Descripcion</th>
                  <th>Estado</th>
                  <th>Operacion</th>
                  <th>Selecionar</th>
                </tr>
                </thead>
                <tbody>
                   <?php
                        $modal=0;
                        ?>
                 {{csrf_field()}}       
                 
				 		

                       @foreach($claves as $claves)
               <tr>
                            <td>{{$claves->ID}}</td>
                            <td>{{$claves->CLAVE}}</td>
                            <td>{{$claves->DESCRIPCION}}</td> 
                            <td>{{$claves->ACTIVA}}</td>
                            <td>{{$claves->OPERACION}}</td> 
                            <td>
                               <button class="show-modal btn btn-success" 
                               data-id="{{$claves->ID}}" 
                               data-title="{{$claves->CLAVE}}"
                               data-des="{{$claves->DESCRIPCION}}"
                               data-estado="{{$claves->ACTIVA}}"
                               data-operacion="{{$claves->OPERACION}}"
                               <span class="glyphicon glyphicon-eye-open"></span>Editar</button>
                                     

                             </td>                

               </tr>

                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Claves</th>
                  <th>Descripcion</th>
                  <th>Estado</th>
                  <th>Operacion</th>
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
      @include('ControPiso.Maestros.Claves.edit')
      @include('ControPiso.Maestros.Claves.crear')




@endsection

@section('script2')
<script>

 
 $(document).on('click','.show-modal',function(){
  $('.modal-title').text('Show');
  $('#id_show').val($(this).data('id'));
  $('#title_show').val($(this).data('title'));
  $('#des_show').val($(this).data('des'));
  $('#estado_show').val($(this).data('estado'));
  $('#operacion_show').val($(this).data('operacion'));
$('#showModal').modal('show');
 });
 
 $(document).on('click','.add-modal',function(){
    
    $('.modal-title').text('Add');
    $('#addModal').modal('show');
 });

 $('#id_clave').on('change',function () 
{
  var id_clave=document.getElementById('id_clave').value;
  validar(id_clave);
});

function validar(id_clave){
  
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/ConsultarClave/";
   $.ajax({
     url:miurl,
     type:'get',
      data:{"id_clave":id_clave} ,
      success: function(data) {
        if(data=='1'){
          alert('Ya existe Esta Clave')
         
        };
      } , 
   });

  
};


</script>

@endsection