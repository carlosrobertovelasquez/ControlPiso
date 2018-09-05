@extends('layouts.app')

@section('htmlheader_title')
    Produccion
@endsection

@section('contentheader_title')
 Registro de Produccion
@endsection

@section('main-content')

         
        
<section class="content">
<a href=" {{url('registroPR')}}" ><span class="btn btn-primary" aria-hidden="true">Regresar</span></a>
<button id="btn_add" name="btn_add" class="btn btn-primary pull-right" >Registar Produccion</button>
<form  id="form_registrohoras" role="search" action="#" method="GET" >
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="id" id="id" value={{$id}} >  
    <input type="hidden" name="orden" id="orden" value={{$orden}} >
   
    <input type="hidden" name="operacion" id="operacion" value={{$opera3}} >
                 
    <div class="box box-default">
        <div class="box-header with-border">
         <h3 class="box-title">Datos Generales</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
        <div class="table-responsive" >
        @if(!is_null($consumo))
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

                                
                        </tr>
                        @include('ControPiso.Transacciones.Registro.agregarMA')   
                        <?php $modal++?>  
                      @endforeach
                    </tbody>         
                  </table>
               @endif     
                  
              </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">
        <h3 class="box-title">Registro de Produccion</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
        <div class="box-body">
        </div>        
        <div id="registros"></div>         
        <div class="form-group" align="center">
            <br>
            <button  align="center"  type="button"  
            style="width: 450px;height: 40px " name="guardar" id="guardar" onclick="confirmar()"  
            value="Guardar"> Confirmar  </button>
        </div> 
    </div>
 </form>
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
                            <input type="text" class="form-control" id="articulo" name="articulo" readonly="readonly">
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
                                <option value='P'>Produccion</option>
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
                <button type="button" class="btn btn-primary" id="btn-save"  onclick="crearproduccion()" value="add">Guardar</button>
            </div>
        </div>
    </div>
</div> 
</section>




@endsection





@section('script2')


<script>
$(document).ready(function(){
 
  listhoras();
 });

function listhoras(){
var id= document.getElementById("orden").value;
var id2= document.getElementById("id").value;
var id3= document.getElementById("operacion").value; 
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/registro/listarproduccion2";
$.ajax({
  type:'get',
  url:miurl,
  data:{id:id,id2:id2,id3:id3},
  success:function(data){
    $('#registros').empty().html(data);
  }
 });
}

function actualizar(){
  listhoras();
}
$('#btn_add').click(function () {
    var id= document.getElementById("orden").value;
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/registro/produccion";
$.ajax({
  type:'get',
  url:miurl,
  data:{id:id},
  success:function(data){
      
      $('#articulo').val(data[0]+'-'+data[1]);
      $('#id_articulo2').val(data[0]);
      $('#descripcion').val(data[1]);
  }
 });
$('#btn-save').val("add");
   






    $('#frmproductos').trigger("reset");
    $('#myModal').modal('show');
});
function crearproduccion(){
var dataString=$('#frmproductos').serialize();
var id =$('#id').val();
var id2 =$('#orden').val();
var id3 =$('#operacion').val();
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/registro/crearproduccion/"+id+"/"+id2+"/"+id3+"";
$.ajax({
    url:miurl,
    data:dataString,
}).done(function(data){
$('#myModal').modal('hide');
    actualizar();
});
}
function confirmar(){
  var id=$('#id').val();
  var id2=$('#orden').val();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/registro/confirmarproduccion2/"+id+"/"+id2+"";
  if(!confirm("Esta seguro de Confirmar")){
   return false;
 }
 $.ajax({
   url:miurl,
 }).done(function(data){
    actualizar()
 });
  

}
function eliminarproduccion(id){

//var id=$(this).attr("fila");
var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/registro/eliminarproduccion2/"+id+"";
   
 
 

 if(!confirm("Esta seguro de Eliminar")){
   return false;
 }

 $.ajax({
   url:miurl,
 }).done(function(data){
    actualizar();
 });

}

 
</script>
@endsection