@extends('layouts.app')

@section('htmlheader_title')
    Produccion
@endsection

@section('contentheader_title')
 Ordenes de Produccion 
@endsection

@section('main-content')

 @include('flash::message')
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
                          <th>Horas</th>
                          <th>Maquina</th>  
                          <th>Fecha Inicio</th>
                          <th>Fecha Fin</th>
                          <th>Selecionar</th>
                        </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     
                           <?php
                        $modal=0;
                        ?>

                      @foreach($OrdenProduccion as $OrdenProduccion)
                        <tr>
                                <td >{{ $OrdenProduccion->id}}</td>
                                <td >{{ $OrdenProduccion->operacion}}</td>
                                <td >{{ $OrdenProduccion->ordenproduccion }}</td> 
                                <td>{{ $OrdenProduccion->articulo }}</td> 
                                <td>{{ number_format($OrdenProduccion->cantidad ,2)}}</td>
                                <td>{{$OrdenProduccion->horas}}</td>
                                <td>{{$OrdenProduccion->centrocosto}}</td>
                                <td>{{ Carbon\Carbon::parse($OrdenProduccion->fechamin)->format('d-m-Y H:i:s') }}</td>
                                 <td>{{ Carbon\Carbon::parse($OrdenProduccion->fechamax)->format('d-m-Y H:i:s') }}</td>
                               
                                <td>
                                 <a href="{{route('ConsultarTicket',[$OrdenProduccion->id])}}" class="btn btn-primary" title="Consultar"><span class="glyphicon glyphicon-info-sign" ></span></a></a>
                                 <button type="button" class="show-modal btn btn-success"
                                       data-id="{{ $OrdenProduccion->id}}"  
                                       data-id2="{{$OrdenProduccion->ordenproduccion}}"
                                       data-id3="{{$OrdenProduccion->operacion}}"
                                       data-id4="{{$OrdenProduccion->articulo}}"
                                       data-id5="{{$OrdenProduccion->centrocosto}}"
                                       data-id6="{{$OrdenProduccion->horas}}"
                                       data-id7="{{ Carbon\Carbon::parse($OrdenProduccion->fechamin)->format('d-m-Y H:m') }}"
                                       data-id8="{{ Carbon\Carbon::parse($OrdenProduccion->fechamax)->format('d-m-Y H:m') }}"
                                        title="Reasigar Horas " >
                                <span class="glyphicon glyphicon-dashboard"></span></button>
                                 <a href="{{route('registro.impresion',[$OrdenProduccion->id,$OrdenProduccion->ordenproduccion])}}" class="btn btn-primary"  title="Imprimir"><span class="glyphicon glyphicon-print" ></span></a>
                                 <a href="{{route('EliminarTicket',[$OrdenProduccion->id,$OrdenProduccion->ordenproduccion])}}"
                                   onclick="return confirm('Esta seguro de Eliminar el Ticker borrar todo su Historial')" class="btn btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove" ></span></a></a>


                                </td>
                        </tr>
                        <?php $modal++?>  
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                         <th>ID</th>
                          <th>Operacion</th>
                          <th>Ord.Prod</th>
                          <th>Articulo</th>
                          <th>Cantidad</th>
                          <th>Horas</th>
                          <th>Maquina</th>  
                          <th>Fecha Inicio</th>
                          <th>Fecha Fin</th>
                          <th>Selecionar</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
         </div>
      </div>
  </div>       
  

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      <h4 class="modal-title" id="myModalLabel">Orden de Produccion Planificada</h4>
     </div>
     <div class="modal-body">
     <form   id="form_planificacion">
      <div class="box-body">
      
				<div class="row">
        <div class="col-md-6">
            <div class="form-group">
               <label >Orden Produccion</label>
                <input type="text" class="form-control" id="ordenproduccion" name="ordenproduccion"  readonly="readonly" >
            </div>
            <div class="form-group">
              <label>Operacion</label>
              <input type="text" class="form-control" id="operacion" name="operacion"  readonly="readonly" >
            </div>
            <div class="form-group">
               <label >Articulo</label>
               <input type="text" class="form-control" id="articulo" name="articulo"  readonly="readonly" >
            </div>
            <div class="form-group">
            <label >Centro Costo</label>
              <input type="text" class="form-control" id="centrocosto" name="centrocosto"   readonly="readonly" >
            </div>
           
            <div class="form-group">
                  <fieldset data-role="controlgroup" data-type="horizontal" >
                                 <legend>Selecion de Cambio </legend>  
                      <p>               
                       <INPUT type="radio" id="fechainicio" name="fechainicio" onclick="ckekfechainicio()" value="FI">Fecha Hora Inicio<BR>
                       <INPUT type="radio" id="fechafin"  name="fechafin"  onclick="ckekfechafin()"  value="FF" checked>Fecha Hora Fin<BR>
                    </p>
                </fieldset>
                <fieldset data-role="controlgroup" data-type="horizontal" >
                                  <legend>Horarios </legend>
                                  <label for="normal">Turno A</label>
                    <input type="checkbox" name="turno" id="turnoA" value="A" class="turno" checked onclick="ValidarTurnoa()" >
                    <label for="normal">Turno B</label>
                    <input type="checkbox" name="turno" id="turnoB" value="B" class="turno" checked onclick="ValidarTurnob()" >
                    <label for="normal">Turno C</label>
                    <input type="checkbox" name="turno" id="turnoC" value="C" class="turno" checked onclick="ValidarTurnoc()" >
                                  <label for="normal">Admin</label>
                    <input type="checkbox" name="admin" id="admin" value="admin"    onclick="ValidarAdmin()" >  
                </fieldset>
                <fieldset data-role="controlgroup" data-type="horizontal" id="turnob">	
                  <div id="turnob" >
                                  <h4>Turno B (02:00 pm- 09:00 pm)</h4>
                                  <label for="lunes">L</label>
                                  <input type="checkbox" name="lunes_tb" id="lunes_tb" value="21"  class="turnob"  checked >
                                  <label for="martes">M</label>
                                  <input type="checkbox" name="martes_tb" id="martes_tb" value="22" class="turnob" checked   >
                                  <label for="miercoles">K</label>
                                  <input type="checkbox" name="miercoles_tb" id="miercoles_tb" value="23" class="turnob" checked >
                                  <label for="red">J</label>
                                  <input type="checkbox" name="jueves_tb" id="jueves_tb" value="24" class="turnob"  checked >
                                  <label for="red">V</label>
                                  <input type="checkbox" name="viernes_tb" id="viernes_tb" value="25"  class="turnob" checked >
                                  <label for="red">S</label>
                                  <input type="checkbox" name="sabado_tb" id="sabado_tb" value="26"  class="turnob"  >
                                  <label for="red">D</label>
                    <input type="checkbox" name="domingo_tb" id="domingo_tb" value="27" class="turnob"  >
                  </div>
                  </fieldset>
                  <fieldset data-role="controlgroup" data-type="horizontal" id="turnoad">	
                  <div id="turnoad" >
                    <h4>Turno Admi (08:00 pm- 05:00 am)</h4>
                                  <label for="lunes">L</label>
                                  <input type="checkbox" name="lunes_tad" id="lunes_tad" value='1'  class="turnoad"  checked >
                                  <label for="martes">M</label>
                                  <input type="checkbox" name="martes_tad" id="martes_tad" value="2" class="turnoad"  checked  >
                                  <label for="miercoles">K</label>
                                  <input type="checkbox" name="miercoles_tad" id="miercoles_tad" value="3" class="turnoad" checked >
                                  <label for="red">J</label>
                                  <input type="checkbox" name="jueves_tad" id="jueves_tad" value="4" class="turnoad"  checked >
                                  <label for="red">V</label>
                                  <input type="checkbox" name="viernes_tad" id="viernes_tad" value="5"  class="turnoad" checked >
                                  <label for="red">S</label>
                    <input type="checkbox" name="sabado_tad" id="sabado_tad" value="6"  class="turnoad" >
                    <label for="red">D</label>
                    <input type="checkbox" name="domingo_tad" id="domingo_tad" value="7" class="turnoad"  >
                  </div>
                </fieldset>

            </div>

        </div>
        <div class="col-md-6">
           <div class="form-group">
              <label >Fecha  Hora Inicio</label>
              <input  type="text" class="form-control" id="fechainicio2" readonly="readonly" name="fechainicio2"  value="<?php echo date("Y-m-d H:m:i");?>"  >
            </div>
            <div class="form-group">
              <label >Fecha Hora Fin</label>
              <input  type="text" class="form-control" id="fechafin2" name="fechafin2" readonly="readonly" value="<?php echo date("Y-m-d H:m:i");?>"  >
            </div>

            <div class="form-group">
              <label > Cantidad de Horas Horas</label>
              <input type="number" class="form-control" id="horas" name="horas"  readonly="readonly"  >
            </div>
            <div class="form-group">
            <label >Horas Adicionales</label>
              <input type="number" onKeyUp="jsFunction()" class="form-control" id="horasadicionales" name="horasadicionales"  placeholder="Digite las Horas a Adicionar o Restar" required="required" >
            </div>
            <div class="form-group">
            <label >Total de Horas</label>
              <input type="number" class="form-control" id="thoras" name="thoras"   readonly="readonly" >
            </div>
            <div class="form-group">
            
            <fieldset data-role="controlgroup" data-type="horizontal" id="turnoa" >
                  <div id="turnoa" >
                    <h4> Turno A (06:00 am- 02:00 pm)</h4>
                                  <label for="lunes">L</label>
                                  <input type="checkbox" name="lunes_ta" id="lunes_ta" value="11"  class="turnoa"  checked >
                                  <label for="martes">M</label>
                                  <input type="checkbox" name="martes_ta" id="martes_ta" value="12" class="turnoa" checked   >
                                  <label for="miercoles">K</label>
                                  <input type="checkbox" name="miercoles_ta" id="miercoles_ta" value="13" class="turnoa" checked  >
                                  <label for="red">J</label>
                                  <input type="checkbox" name="jueves_ta" id="jueves_ta" value="14" class="turnoa" checked  >
                                  <label for="red">V</label>
                                  <input type="checkbox" name="viernes_ta" id="viernes_ta" value="15"  class="turnoa"  checked >
                                  <label for="red">S</label>
                                  <input type="checkbox" name="sabado_ta" id="sabado_ta" value="16"  class="turnoa" checked >
                                  <label for="red">D</label>
                    <input type="checkbox" name="domingo_ta" id="domingo_ta" value="17" class="turnoa"  >
                  </div>  
                  </fieldset>
                 
                </div>
                <div class="form-group">
               
                <fieldset data-role="controlgroup" data-type="horizontal" id="turnoc">	
                  <div id="turnoc" >
                    <h4>Turno C (09:00 pm- 06:00 am)</h4>
                                  <label for="lunes">L</label>
                                  <input type="checkbox" name="lunes_tc" id="lunes_tc" value="31"  class="turnoc"  checked >
                                  <label for="martes">M</label>
                                  <input type="checkbox" name="martes_tc" id="martes_tc" value="32" class="turnoc"  checked  >
                                  <label for="miercoles">K</label>
                                  <input type="checkbox" name="miercoles_tc" id="miercoles_tc" value="33" class="turnoc" checked >
                                  <label for="red">J</label>
                                  <input type="checkbox" name="jueves_tc" id="jueves_tc" value="34" class="turnoc"  checked >
                                  <label for="red">V</label>
                                  <input type="checkbox" name="viernes_tc" id="viernes_tc" value="35"  class="turnoc" checked >
                                  <label for="red">S</label>
                                  <input type="checkbox" name="sabado_tc" id="sabado_tc" value="36"  class="checar" >
                                  <label for="red">D</label>
                    <input type="checkbox" name="domingo_tc" id="domingo_tc" value="37" class="checar"  >
                  </div>
                </fieldset>
               
                </div>


        </div>
        
            <input type="hidden" class="form-control" id="id" name="id"  readonly="readonly" >
        </div>
        </div>  
     </div>

     <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="btn-save"  onclick="actualizarhoras()" value="add">Actualizar</button>
     
     </div>
    </form>
    </div>
   </div>
  
  </div>
 </div>



@section('script2')
<script>
$(document).ready(function()
{

  document.getElementById('turnoad').style.display='none';
});

function ValidarCkecked(){

 

if($(this.normal).prop('checked')){

 
  $('.admin').prop('checked',false);

}else{
  $('.admin').prop('checked',true);
}
}

function ValidarAdmin(){

if($(this.admin).prop('checked')){

 $('.turno').prop('checked',false);

 document.getElementById('turnoad').style.display='block';
 
 document.getElementById('turnoa').style.display='none';
 document.getElementById('turnob').style.display='none';
 document.getElementById('turnoc').style.display='none';
 
}else{
 
 $('.turno').prop('checked',true);
 document.getElementById('turnoad').style.display='none';
 document.getElementById('turnoa').style.display='block';
 document.getElementById('turnob').style.display='block';
 document.getElementById('turnoc').style.display='block';
}
}

function ValidarTurnoa(){
if($(this.turnoA).prop('checked')){
 document.getElementById('turnoa').style.display='block';
}else{

 document.getElementById('turnoa').disabled=true;
 document.getElementById('turnoa').style.display='none';
}

}

function ValidarTurnob(){
 if($(this.turnoB).prop('checked')){

   document.getElementById('turnob').style.display='block';
 }else{
   
   document.getElementById('turnob').disabled=true;
   document.getElementById('turnob').style.display='none';
   
 }
 
 }

 function ValidarTurnoc(){
   if($(this.turnoC).prop('checked')){
     document.getElementById('turnoc').style.display='block';
   }else{
     document.getElementById('turnoc').disabled=true;
     document.getElementById('turnoc').style.display='none';
   }
   
   }  
  
  function ckekfechainicio(){
    var fi = document.getElementById('fechainicio').checked;
    if(fi==true){
      document.getElementById('fechainicio').checked=true;
      document.getElementById("fechafin").checked = false;

    }


  }
  function ckekfechafin(){
   var ff = document.getElementById('fechafin').checked;
    if(ff==true){
      document.getElementById("fechainicio").checked = false;

    }
    
  }

$(document).on('click','.show-modal',function(e){   

var id=$(this).data('id');
   var ordenproduccion=$(this).data('id2');
   var operacion=$(this).data('id3');
   var articulo=$(this).data('id4');
   var centrocosto=$(this).data('id5');
   var horas=$(this).data('id6');
   var fecha=$(this).data('id7');
   var horaini=$(this).data('id8');
   var horasadicionales=0.00;
 
 
   var sec=$(this).data('title'); 
   $('#id').val(id);
   $('#ordenproduccion').val(ordenproduccion);
   $('#operacion').val(operacion);
   $('#articulo').val(articulo);
   $('#centrocosto').val(centrocosto);
   $('#fechainicio2').val(fecha);
   $('#fechafin2').val(horaini);
   //document.getElementById("fechainicio2").value =fecha
   //document.getElementById("fechainicio2").innerHTML = fecha;
   $('#horas').val(horas);
   $('#horasadicionales').val(horasadicionales);
   $('#thoras').val(horas);



 $('#myModal').modal('show');



 });
 $("#fechainicio2").datepicker(
{
  dateFormat: 'dd-mm-yyyy',
  firstDay: 1
}).datepicker("setDate", new Date());
 

 


 $('#btn_add').click(function () {
    $('#btn-save').val("add");
   
    $('#frmproductos').trigger("reset");
    $('#myModal').modal('show');
});
  

function jsFunction(){
  
  document.getElementById("thoras").value = 
    parseInt(document.getElementById("horas").value) + 
    parseInt(document.getElementById("horasadicionales").value) ;

}

function actualizarhoras(){
  var dataString=$('#form_planificacion').serialize();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/planificador/cambiohora/";     
  $.ajax({
    url:miurl,
        //data:{"id":id,"id2":id2,"id3":id3,"id4":id4,dataString}
    data:dataString+'&_token={{csrf_token()}}',
  }).done(function(data){    
     });
     $('#myModal').modal('hide');
    location.reload(true);
}


function actualizar(){
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/Ticket/";
  $.ajax({
        url:miurl,
        data:{"id":id}
     }).done(function(data){
      
       //listaempleados();
       //document.getElementById("searchempleado").value="";
       //document.getElementById("nombre").value="";
     });

     
}



</script>
@endsection
@endsection