@extends('layouts.app')

@section('htmlheader_title')
    Materiales
@endsection
@section('contentheader_title')
 Materiales 
@endsection

@section('main-content')

<section class="content">

  
       

  <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Materiales</h3>
        <div class="float-right">
       <button id="btn_add" name="btn_add" class="btn btn-primary pull-right" >Nuevo Producto</button>
      
       <a href=" {{url('registro')}}" ><span class="btn btn-primary" aria-hidden="true">Regresar</span></a>
       

    </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <input type="hidden" name="id" id="id" value={{$id}} >  
            <input type="hidden" name="orden" id="orden" value={{$orden}} >             
          </div>
      </div>
      <div class="box-body">
      <form id="frmdetalle" >
          <div class="table-responsive" >
                  <table id="example1" class="display nowrap"  style="font-size:80%"   >
                    <thead>
                        <tr>
                          <th>ID</th>
                          <th>ORDEN PRODUCCION</th>
                          <th>ARTICULO</th>
                          <th>DESCRIPCION</th>
                          <th>CANTIDAD</th>
                          <th>UNIDAD</th>
                          <th>OPERACION</th>
                          <th>Selecionar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <?php
                        $modal=0;
                        ?>
                      
                      @foreach($consumo as $consumo)
                        <tr>
                                <td >{{ $consumo->id}}</td>
                                <td >{{ $consumo->ORDEN_PRODUCCION}}</td>
                                <td >{{ $consumo->ARTICULO}}</td>
                                <td >{{ $consumo->DESCRIPCION }}</td> 
                                <td>{{ number_format($consumo->CANTIDAD_ESTANDAR ,2)}}</td>
                                <td>{{$consumo->UNIDAD_ALMACEN}}</td>
                                <td>{{$consumo->OPERACION}}</td>

                                <td>
                               
                                <button type="button" class="show-modal btn btn-success"   
                                       data-id="{{$consumo->ORDEN_PRODUCCION}}"  
                                       data-id2="{{$consumo->ARTICULO}}"
                                       data-id3="{{$consumo->DESCRIPCION}}"
                                       data-id4="{{$consumo->CANTIDAD_ESTANDAR}}"
                                       data-id5="{{$consumo->OPERACION}}"
                                       data-id6="{{$consumo->id}}" >
                                       
                                    <span class="glyphicon glyphicon-download"></span> Registar</button>
                               
                               </td>
                        </tr>
                        @include('ControPiso.Transacciones.Registro.agregarMA')   
                        <?php $modal++?>  
                      @endforeach
                    </tbody>         
                  </table>
              </div>
             

            </form>
           

       </div>
    

  </div>

  <div class="box box-default">
 
      <div class="box-header with-border">
        <h3 class="box-title">Registro de Produccion</h3>

      </div>
        <table   class="table table-condensed table-bordered table-hover" >
                  <thead>
                        <tr>
                        <th>ID</th>
                          <th>ORDEN PRODUCCION</th>
                          <th>ARTICULO</th>
                          <th>DESCRIPCION</th>
                          <th>CANTIDAD</th>
                          <th>PROCESO</th>
                          <th >COMENTARIOS</th>
                          <th width="125">Selecionar</th>
                        </tr>
                    </thead>
                    <tbody>
                         
                      
                      @foreach($cp_consumo as $cp_consumo)
                        <tr >
                        
                                <td >{{ $cp_consumo->id}}</td>
                                <td >{{ $cp_consumo->orden_produccion}}</td>
                                <td >{{ $cp_consumo->articulo}}</td>
                                <td >{{ $cp_consumo->descripcion}}</td>
                                <td >{{ number_format($cp_consumo->cantidad,2)}}</td>
                                <td >{{ $cp_consumo->operacion}}</td>
                                <td  >{{ $cp_consumo->comentarios}}</td>
                                <td>
                                
                                 <a href="#"  class="btn btn-primary"  title="Eliminar" onclick="eliminar({{$cp_consumo->id}})">
                                   <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                                 </a>
                                
                                  @if($cp_consumo->aprobada=='N')
                                    <a href="#"  class="btn btn-primary"  title="Aprobar" onclick="aprobar({{$cp_consumo->id}})">
                                   <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                    </a>
                                  @elseif($cp_consumo->conforme=='N')
                                    <a href="#"  class="btn btn-primary"  title="Recibi Conforme" onclick="conforme({{$cp_consumo->id}})">
                                   <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
                                    </a>
                                  @endif
                                 
                                 
                               </td>
                        </tr>
                        @endforeach
                  </tbody>
               </table>

                <div class="form-group" align="center">
                              <br>
                                    <button  align="center"  type="button"  
                                    style="width: 450px;height: 40px " name="guardar" id="guardar" onclick="confirmar()"  
                                    value="Guardar"> Confirmar  </button>
                                   
                            </div> 
    

        
  </div>   
  

   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      <h4 class="modal-title" id="myModalLabel">Producto</h4>
     </div>
     <div class="modal-body">
      <form id="frmproductos" name="frmproductos" class="form-horizontal">
       <div class="form-group">
        <label  class="col-sm-3 control-label">Articulo</label>
        <div class="col-sm-9">
         <input type="text" class="form-control" id="articulo" name="articulo" placeholder="Buscar Articulo">
        </div>
       </div>
       <input type="hidden" name="id_articulo2" id="id_articulo2" value="" >
       <input type="hidden" name="descripcion" id="descripcion" value="" >
       
       <div class="form-group">
        <label for="inputDetail" class="col-sm-3 control-label">Cantidad</label>
        <div class="col-sm-9">
         <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad Solicitada" required >
        </div>
       </div>
       <div class="form-group">
        <label for="inputDetail" class="col-sm-3 control-label">Operacion</label>
        <div class="col-sm-9">
        <select name="id_operacion1" id="id_operacion1" class="form-control">
                                 <option value='C'>Consumo</option>
                                 <option value='D'>Devolucion</option>
                                 <option value='A'>Anulacion</option>
                                 <option value='R'>Remision</option>
                                 </select>
        </div>
       </div>
       <div class="form-group">
       <label for="inputDetail" class="col-sm-3 control-label">Comentarios</label>
        <div class="col-sm-9">
      
        <textarea class="form-control" name="comentarios" id="comentarios"  rows="5"placeholder="Comentarios ......"></textarea>

        </div>
       </div>

      
      </form>
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="btn-save"  onclick="crearconsumo()" value="add">Guardar</button>
     
     </div>
    </div>
   </div>
  </div>
 </div>
 

 
 </section> 
  
       

@section('script2')
<script>


$(document).ready(function(){
  var urlraiz=$("#url_raiz_proyecto").val();
     var miurl =urlraiz+"/registro/buscararticulo";
     $('#articulo').autocomplete({
    
    source:miurl,
    minlenght:1,
    appendTo: "#frmproductos",
    autoFocus:true,
    select:function(e,ui){
      $('#descripcion').val(ui.item.nombre);
      $('#id_articulo2').val(ui.item.id);
      
    }




});
});

$(document).on('click','.show-modal',function(e){   
   var ordenproduccion=$(this).data('id');
   var articulo=$(this).data('id2');
   var descripcion=$(this).data('id3');
   var cantidadestandar=$(this).data('id4');
   var operacion=$(this).data('id5');
   var id=$(this).data('id6');

   cantidadestandar=parseFloat(cantidadestandar).toFixed(2);
   
   var sec=$(this).data('title'); 
   $('#id_ordenproduccion').val(ordenproduccion);
   $('#id_articulo').val(articulo);
   $('#id_descripcion').val(descripcion);
   $('#id_cantidad').val(cantidadestandar);
   $('#id_cantidadentregada').val(cantidadestandar);
   $('#id_operacion').val(operacion);
   $('#id').val(id);


 $('#showModal').modal('show');



 });
 

$('#btn_add').click(function () {
    $('#btn-save').val("add");
   
    $('#frmproductos').trigger("reset");
    $('#myModal').modal('show');
});
 

  

  function eliminar(id){
    var id2=$('#id').val();
//var id=$(this).attr("fila");
var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/registro/eliminarconsumo/"+id+"/"+id2+"";
   
 
 


 if(!confirm("Esta seguro de Eliminar")){
   return false;
 }

 $.ajax({
   url:miurl,
 }).done(function(data){
    actualizar()
 });

}

function aprobar(id){

var id2=$('#id').val();
var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/registro/aprobarconsumo/"+id+"/"+id2+"";
   
 
 

 if(!confirm("Esta seguro de Aprobar")){
   return false;
 }

 $.ajax({
   url:miurl,
 }).done(function(data){
    actualizar()
 });

}

function confirmar(){
  var id=$('#id').val();
  var id2=$('#orden').val();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/registro/confirmarconsumo/"+id+"/"+id2+"";
  if(!confirm("Esta seguro de Confirmar")){
   return false;
 }
 $.ajax({
   url:miurl,
 }).done(function(data){
    actualizar()
 });
  

}


function conforme(id){

//var id=$(this).attr("fila");
var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/registro/conformeconsumo/"+id+"";
   
 
 

 if(!confirm("Esta seguro que Recibe Conforme")){
   return false;
 }

 $.ajax({
   url:miurl,
 }).done(function(data){
    actualizar()
 });

}


   function registroMA2(){
   
 
     var id =$('#id_ordenproduccion').val();
     var id2 =$('#id_articulo').val();
     var id3 =$('#id_cantidad').val();
     var id4 =$('#id_cantidadentregada').val();
     var id5=$('#id_operacion1').val();
     var id6=$('#id_operacion').val();
     var id7=$('#id').val();
     var id8=$('#id_descripcion').val();
     var id9=$('#comentarios').val();

       var urlraiz=$("#url_raiz_proyecto").val();
        var miurl =urlraiz+"/registro/agregarconsumo/";
     
       
     $.ajax({
        url:miurl,
        data:{"id":id,"id2":id2,"id3":id3,"id4":id4,"id5":id5,"id6":id6,"id7":id7,"id8":id8,"id9":id9}
     }).done(function(data){
       //listaempleados();
       //document.getElementById("searchempleado").value="";
       //document.getElementById("nombre").value="";
     });

     $('#showModal').modal('hide');
      actualizar();
   
     }

     function listarOperaciones(){

        var id=$('#id').val();
        var urlraiz=$("#url_raiz_proyecto").val();
        var miurl =urlraiz+"/registro/listaroperaciones";
   

$.ajax({
  type:'get',
  url:miurl,
  data:{id:id},
  success:function(data){
   
    $('#showMA').empty().html(data);
    
  }

 });

}

function crearconsumo(){
    var dataString=$('#frmproductos').serialize();
    var id =$('#id').val();
    var id2 =$('#orden').val();
   
    var urlraiz=$("#url_raiz_proyecto").val();
     var miurl =urlraiz+"/registro/crearconsumo/"+id+"/"+id2+"";
    
    
  $.ajax({
     url:miurl,
    data:dataString,
  }).done(function(data){
    
  
    $('#myModal').modal('hide');
     
      actualizar();


  });

  }

function actualizar(){
        var id1=$('#id').val();
        var id2 =$('#id_ordenproduccion').val();
        var urlraiz=$("#url_raiz_proyecto").val();
        var miurl =urlraiz+"/registro/ma/"+id1+"/"+id2+"";
        $.ajax({
        type:'get',
        url:miurl,
        success:function(data){
   
           // $('#showMA').empty().html(data);
          
         }


 });
       
 location.reload();
}


</script>
@endsection




@endsection