@extends('layouts.app')

@section('htmlheader_title')
    Planificacion
@endsection


@section('main-content')
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>



<div class="container">
  <div class="row">
    <div  class="col-md-12">
       
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="box box-default">
              <div class="box-header with-border">
                <h1  align="center" >Produccion</h1>
              <form   id="form_planificacion" role="search" action="{{route('guardar_planificacion')}}" method="GET" >

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6">

                   
                      <div class="form-group">
                        <label>Numero de Orden de Produccion</label>
                        <input id="norden" name="norden" type="text" class="form-control" value="{{ $ordenproduccion->ORDEN_PRODUCCION}}" readonly="readonly" >
                      </div>


                      <div class="form-group">
                        <label>Cantidad a Producir </label>
                        <input type="text" id="id_cantidadaproducir" name="id_cantidadaproducir" class="form-control" value=" {{ ($ordenproduccion->CANTIDAD_ARTICULO-$ordenproduccion->CANTIDAD_PRODUCCI)}}"  onkeypress="return valida(event)" >
                      </div>

                  </div>
                  <!-- /.col -->
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Articulo a Producir </label>
                        <input type="hidden" name="articulo" id="articulo"  value={{$ordenproduccion->ARTICULO}}>
                        <input type="text" class="form-control" value=" {{$ordenproduccion->ARTICULO}} - {{$ordenproduccion->REFERENCIA}} " disabled>
                      </div>



                    <div class="form-group">
                        <label>Fecha Planificada en Produccion </label>
                        <input type="text" class="form-control" value="{{Carbon\Carbon::parse($ordenproduccion->FECHA_REQUERIDA)->format('d-m-Y H:i:s')}}" disabled>
                      </div>                

                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.box-body -->
          </div>


          <div class="box box-default">
                <div class="box-header with-border">
                  <h1  align="center" >Pedido</h1>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                   
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">  
                        <div class="form-group">

                           <label>Selecione el Pedido </label>

                          <select id="id_pedido" name="id_pedido" class="form-control select2" style="width: 100%;">
                                   <option value="0">SELECIONES UN PEDIDO:</option>
                                    <option value="000000">PRODUCCION INTERNA</option>
                                   @foreach($pedido as $pedido)
                                   <option value="{{ $pedido->PEDIDO }}">{{ $pedido->PEDIDO }}--{{ $pedido->NOMBRE_CLIENTE }} </option>
                                   @endforeach
                          </select>


                         </div>

                        </div>

                        <div class="form-group">
                          <label >Direccion Clientes </label>
                          <input type="text" class="form-control" id="nombrecliente" disabled  >
                        </div>

                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                      <div class="form-group">
                          <label  >Pais </label>
                          <input  type="text" class="form-control"   id="Pais" disabled>
                        </div>
                      <div class="form-group">
                          <label >Fecha Ofrecida por Ventas </label>
                          <input  type="text" class="form-control" id="fecharequerida" disabled>
                      </div>                

                      <div class="form-group">

                           <label>Selecione Ficha Tecnica </label>

                          <select id="id_ficha" name="id_ficha" class="form-control select2" style="width: 100%;">
                                   <option value="0">SELECIONES UN CLIENTE:</option>
                                   <option value="00">SIN FICHA</option>
                                   @foreach($ft_ficha as $ft_ficha)
                                   <option value="{{ $ft_ficha->id }}">{{ $ft_ficha->CLIENTE }}--{{ $ft_ficha->PAIS }} </option>
                                   @endforeach
                          </select>


                         </div>


                  

                      
                    </div>
                  </div>
                </div>
          </div>

          <div class="box box-default">
                <div class="box-header with-border">
                  <h1  align="center" >Procesos</h1>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                   
                  </div>
                </div>
                <!-- /.box-header -->
                <div id="procesos" class="box-body">
              
                  
             
                     <table id="procesos"  name="procesos" class="table">
                    <thead>
                        <tr>
                          <th>OPERACION</th>
                          <th>DESCRIPCION</th>
                          <th>SECUENCIA</th>
                          
                          <th>Selecionar</th>
                        </tr>
                    </thead>

                   

                    <tbody>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <?php
                        $modal=0;
                        ?>

                      @foreach($centrocosto as $centrocosto)
                        <tr>
                                <td >{{ $centrocosto->OPERACION }}</td> 
                                <td>{{ $centrocosto->DESCRIPCION }}</td> 
                                <td >{{$centrocosto->SECUENCIA}}</td>
                                
                               
                                <td>

                                          
                                 

                                   <button type="button" class="show-modal btn btn-success"   data-id="{{$centrocosto->OPERACION}}" data-title="{{$centrocosto->SECUENCIA}}"  data-id2="{{$centrocosto->DESCRIPCION}}" >
                                    <span class="glyphicon glyphicon-eye-open"></span>Planificar</button>
                                    
                                </td>

                        </tr>
                        @include('ControPiso.Transacciones.agregar')   
                        <?php $modal++?>           
                      @endforeach
                      </tbody>
                   
                  </table>
             

                      <!-- /.form-group -->
                    </div>
                    

                    <!-- /.col -->   @include('ControPiso.Transacciones.agregar')
     

               @include('ControPiso.Transacciones.show')
                


              
                 

                             <!-- /.row -->
                



                <!-- /.box-body -->
          </div>

          <div class="box box-default">
                <div class="box-header with-border">
                  <h1  align="center" >Detalle Planificacion</h1>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                   
                  </div>
                  
                  <div class="form-group">
                     <table class="table" border="1" id="tabla" ></table>
                  </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                
                
                <!-- /.box-body -->
                 <div class="col-md-12">
                   <div class="row">
                    <div class="form-group" alig="center">
                      <div>
                        <label  style="display:none " id="ltotal">Total de Horas <input type="hidden" name="total" id="total" value="" disabled="disabled"></label>
                      </div>  

                      </div>
                 </div>     
               </div>


                  


                   
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                             <div class="form-group" align="center">
                              <br>
                                    <button  align="center"  type="submit" onmouseover="this.backgroundColor='blue' "  
                                    style="width: 450px;height: 40px ;visibility:hidden " name="guardar" id="guardar"  
                                    value="Guardar"> Guardar </button>
                            </div> 
         </div> 
        </form>
    </div>
  </div>
    
</div>  






@endsection



@section('script2')


<script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<script src="../js/moment.js"></script>
<script src="../js/formatonumeros.js"></script>

 <script >





  //Consulta de Pedidos
$(document).ready(function()
{

  document.getElementById('turnoad').style.display='none';
$('#showModal').on('hidden.bs.modal',function(e){
   $(this).removeData();
});

  $('#id_pedido').on('change',function () {

  var id =$('#id_pedido').val();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/ConsultaPedidos/"+id+"";
  $.ajax({
    url:miurl
  }).done(function(data){
     
     var content=JSON.parse(data);
     //console.log(content);

    //alert(content[0].PAIS);
    
    $("#nombrecliente").val(content[0].DESC_DIREC_EMBARQUE);
    $("#Pais").val(content[0].PAIS);
    $("#fecharequerida").val(content[0].FECHA_PROMETIDA);
   
  }) 


});



//Consulta de Centro de Costo
$('#id_centrocosto').on('change',function () 
{

  
  var id =$('#id_centrocosto').val();
  var id2=$('#articulo').val();
  var id3=$('#Mid_opera').val();
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/ConsultaMaquina/";

  var nf=new Intl.NumberFormat(); 
  $.ajax({
    url:miurl,
    type:'get',
    data:{"id":id,"id2":id2,"id3":id3}
  }).done(function(data)
  {   

     var content=JSON.parse(data);  
     
     if((content[0].CP_TIEMPOCAMBIOMOLDE)==0.00){
     piezaxh=parseInt((content[0].HORASXHORA));
     total=piezaxh;

     }else{
     piezaxh=parseInt((content[0].HORASXHORA));
     tiempomolde=parseInt((content[0].CP_TIEMPOCAMBIOMOLDE));
     total=piezaxh+tiempomolde;
      
     }

     

    $("#idm_tiempocm").val( content[0].CP_TIEMPOCAMBIOMOLDE);
    $("#idm_cantidadxh").val(total);



   
   var vcantidadaproducir=$("#id_cantidad").val();


    var vcantixturno=total;    //$('#piezaxhora').val();
    r=vcantixturno*8;// piezas por turno
     
    v01= parseFloat(vcantidadaproducir).toFixed(2) ;
    v04=parseFloat(vcantixturno).toFixed(2) ;
    v02=parseFloat(r);
  
    v03=Math.round(v01/v04);
     v05=Math.round(v03/8);
   
   
  $("#idm_totalhoras").val(v03);
$("#idm_totalturnos").val(v05);
   
  
    
  })

    
   
 });



//Cambiar el Tiempo del Molde

$('#idm_tiempocm').on('change',function () 
{

  
   //procedemos a ver el valor Tiempo de cambio de Molde 
   var nuevovalor=$("#idm_tiempocm").val();
   var totalhoras=$("#idm_totalhoras").val();
   if(nuevovalor==0){
    $("#idm_totalhoras").val(totalhoras);
    var total=totalhoras;

   }else{
  
      v01=parseInt(nuevovalor);
      v02=parseInt(totalhoras);   
      var total=v01+v02;


      $("#idm_totalhoras").val(total);
   
   } 

    v01=parseInt(nuevovalor);
      v02=parseInt(totalhoras);   
      var total=v01+v02;


      $("#idm_totalhoras").val(total);

    v04=total ;
    v05=Math.round(v04/8);
    $("#idm_totalturnos").val(v05);
//fin   
 });

//Cambiar Unidades por Hora

$('#idm_cantidadxh').on('change',function () 
{
 
  
   //procedemos a ver el valor Tiempo de cambio de Molde 
   var nuevovalor=$("#idm_cantidadxh").val();
   var cambiomolde=$("#idm_tiempocm").val();
   if(nuevovalor==0){
    alert('No puede quedar Cero')
    $("#idm_cantidadxh").val(nuevovalor);
    var total=nuevovalor;

   }else{
  
      v01=parseInt(nuevovalor);
    
      if(cambiomolde==0){
      v02=0.00;
      }else{
      v02=parseInt(cambiomolde);  
      }
      

      var total=v01+v02;
      $("#idm_cantidadxh").val(total);
   
   } 

    var vcantidadaproducir=$("#id_cantidad").val();
    var vcantixturno=total;    //$('#piezaxhora').val();
    r=vcantixturno*8;// piezas por turno
    v01= parseFloat(vcantidadaproducir).toFixed(2) ;
    v04=parseFloat(vcantixturno).toFixed(2) ;
    v02=parseFloat(r);
    v03=Math.round(v01/v04);
    v05=Math.round(v03/8);
    $("#idm_totalhoras").val(v03);
    $("#idm_totalturnos").val(v05);
//fin   
 });





$('#piezaxhora').keyup(function(){
    
    var vcantixturno=document.getElementById('piezaxhora').value;    //$('#piezaxhora').val();
    var vcantidadaproducir=document.getElementById('cantidadaproducir').value;  //$('#cantidadaproducir').val();
    r=vcantixturno*8;// piezas por turno

    v01= parseFloat(vcantidadaproducir).toFixed(2) ;
    v02=parseFloat(r);
    v03=Math.round(v01/v02);

    //r2 = vcantidadaproducir/r; //turnos necesarios
    
    document.getElementById("piezaxturno").value=r;
   document.getElementById("cantidadturnos").value=v03;
    
  })

});


$('#cantidadaproducir').keyup(function(){

    var vcantixturno=document.getElementById('piezaxhora').value;    //$('#piezaxhora').val();
    var vcantidadaproducir=document.getElementById('cantidadaproducir').value;  //$('#cantidadaproducir').val();
    r=vcantixturno*8;// piezas por turno

    v01= parseFloat(vcantidadaproducir).toFixed(2) ;
    v02=parseFloat(r);
    v04=v01/v02;

    v03=Math.round(v04);



    //r2 = vcantidadaproducir/r; //turnos necesarios

    document.getElementById("piezaxturno").value=r;
    document.getElementById("cantidadturnos").value=v03;

});

// Boton de Planificacion
$('#planificar').click(function(){
  
eliminarFilas();
ValdiarCampos();
procesos2();



  
  var dataString=$('#form_planificacion').serialize();


 var id8=document.getElementById('id_ficha').value;

  
  var vcantidadaproducir=document.getElementById('cantidadaproducir').value;  
  id2= parseFloat(vcantidadaproducir).toFixed(2) ;
  
  var id=$("#idm_totalhoras").val();//total de horas
  var id3=$("#Mid_opera").val();// operacion a realizar
  var id4=document.getElementById('id_fecha').value;//fecha selecionada
  var id5=document.getElementById('id_hora').value;// hora selecionada
  var id6=document.getElementById('id_centrocosto').value;//maquina a utilizar
  var id7=$("#idm_totalturnos").val();

  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/planificar/"+id+"/"+id4+"/"+id5+"/"+id6+"/"+id8+"";

  
  var d='<tr>'+
   '<th>No</th>'+
   '<th>Centro Costo</th>'+
   '<th>Fecha</th>'+
   '<th>Hora Inicio</th>'+
   '<th>Hora Fin</th>'+
   '<th>Horas</th>'+
   '<th>Cantidad</th>'+
   '<th>Turno</th>'+
   '<th>Operacion</th>'+
   '</tr>';
 
  $.ajax({
    url:miurl,
    data:dataString,
  }).done(function(data){
     //console.log(data);
     var valor=data 
    if(valor==1){

      alert("No Existe Disponibilidad para esta Fecha");

    }else
    { 
         $no=0 
         $acumulado=0
          v01= parseFloat(vcantidadaproducir).toFixed(2) ;
          $variable= id3;
          $variable=$variable.replace(/,/g,""); 
          $variable=parseFloat($variable);


          var nf=new Intl.NumberFormat();
          var df=new Intl.DateTimeFormat("en-US");
         var content=JSON.parse(data);
         for(var i=0;i<content.length;i++)
          {
          $no=$no+1

          $acumulado=$variable+$acumulado  ;
          
            
           if($no==id7){
             $x=vcantidadaproducir-$acumulado;
             
             id3=$variable+$x
             
             id3=nf.format(id3);
              
             
           }else{
              id3=nf.format($variable);
           }

           
               
           id3=$("#idm_cantidadxh").val();  
           id3=id3*content[i].horas;  
           id3=parseFloat(id3).toFixed(2);

           if(content[i].turno=='1'){
           d+='<tr>'+
          '<td bgcolor="#FF0000" >'+$no+'</td>'+
          '<td bgcolor="#FF0000">'+content[i].centrocosto+'</td>'+
          '<td bgcolor="#FF0000">'+moment(content[i].fecha).format('DD/MM/YYYY')+'</td>'+
          '<td bgcolor="#FF0000">'+content[i].thoraini+'</td>'+
          '<td bgcolor="#FF0000">'+content[i].thorafin+'</td>'+
          '<td bgcolor="#FF0000">'+content[i].horas+'</td>'+
          '<td bgcolor="#FF0000" Align="right" >'+formatNumber.new(content[i].cantidad)+'</td>'+
          '<td bgcolor="#FF0000">'+content[i].turno+'</td>'+
          '<td bgcolor="#FF0000">'+content[i].operacion+'</td>'+
          '</tr>';
           }  
           if(content[i].turno=='4'){
            d+='<tr>'+
           '<td bgcolor="#E6E6FA" >'+$no+'</td>'+
           '<td bgcolor="#E6E6FA">'+content[i].centrocosto+'</td>'+
           '<td bgcolor="#E6E6FA">'+moment(content[i].fecha).format('DD/MM/YYYY')+'</td>'+
           '<td bgcolor="#E6E6FA">'+content[i].thoraini+'</td>'+
           '<td bgcolor="#E6E6FA">'+content[i].thorafin+'</td>'+
           '<td bgcolor="#E6E6FA">'+content[i].horas+'</td>'+
           '<td bgcolor="#E6E6FA" Align="right" >'+formatNumber.new(content[i].cantidad)+'</td>'+
           '<td bgcolor="#E6E6FA">'+content[i].turno+'</td>'+
           '<td bgcolor="#E6E6FA">'+content[i].operacion+'</td>'+
           '</tr>';
            }  

          if(content[i].turno=='3'){
          d+='<tr>'+
          '<td bgcolor="#00FF00" >'+$no+'</td>'+
          '<td bgcolor="#00FF00">'+content[i].centrocosto+'</td>'+
          '<td bgcolor="#00FF00">'+moment(content[i].fecha).format('DD/MM/YYYY')+'</td>'+
          '<td bgcolor="#00FF00">'+content[i].thoraini+'</td>'+
          '<td bgcolor="#00FF00">'+content[i].thorafin+'</td>'+
          '<td bgcolor="#00FF00">'+content[i].horas+'</td>'+
          '<td bgcolor="#00FF00" Align="right"  >'+formatNumber.new(content[i].cantidad)+'</td>'+
          '<td bgcolor="#00FF00">'+content[i].turno+'</td>'+
          '<td bgcolor="#00FF00">'+content[i].operacion+'</td>'+
          '</tr>';
          }    

          if(content[i].turno=='2'){
            d+='<tr>'+
          '<td bgcolor="#FFFF00">'+$no+'</td>'+
          '<td bgcolor="#FFFF00">'+content[i].centrocosto+'</td>'+
          '<td bgcolor="#FFFF00">'+moment(content[i].fecha).format('DD/MM/YYYY')+'</td>'+
          '<td bgcolor="#FFFF00">'+content[i].thoraini+'</td>'+
          '<td bgcolor="#FFFF00">'+content[i].thorafin+'</td>'+
          '<td bgcolor="#FFFF00">'+content[i].horas+'</td>'+
          '<td bgcolor="#FFFF00" Align="right" >'+formatNumber.new(content[i].cantidad)+'</td>'+
          '<td bgcolor="#FFFF00">'+content[i].turno+'</td>'+
          '<td bgcolor="#FFFF00">'+content[i].operacion+'</td>'+
          '</tr>';
          }
                   
          
  
          
         }
         $("#tabla").append(d);

          document.getElementById('guardar').style.visibility='visible';
       
   
   } 
   $('#showModal').modal('hide');
  })
  
  


});

function procesos2()
{
var id= document.getElementById("articulo").value;
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/planificador/procesos";

$.ajax({
  type:'get',
  url:miurl,
  data:{id:id},
  success:function(resul){
    $("#procesos").val(resul);
  }
 });
}


function eliminarFilas(){

 var Parent =document.getElementById("tabla");
 while(Parent.hasChildNodes())
 {
     Parent.removeChild(Parent.firstChild);
 }
};

function ValdiarCampos()
{
  var pedido=$('#id_pedido').val();
  var ficha=$('#id_ficha').val();
 if(pedido=="0" ){
  alert(' Tiene que Selecionar un  pedido');

  return false;
 }
 if(ficha=="0" ){
  alert(' Tiene que Selecionar un  cliente');

  return false;
 }

 
}

function ValdiarCampos2()
{

  var ficha=$('#id_ficha').val();

 if(ficha=="0" ){
  alert(' Tiene que Selecionar un  cliente');

  return false;
 }
 
}


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


function modal(btn){


//alert (btn.value);
 $("#operacion").val('hola');
 $("#showModal").modal('show');


}


$(document).on('click','.show-modal',function(e){
   
  //ValdiarCampos(); 

  if(ValdiarCampos()==false){

   $('#showModal').modal('hide');
  }else{

var art=document.getElementById("articulo").value;
  var cant=document.getElementById("id_cantidadaproducir").value;
  var ope=$(this).data('id');
  var ope2=$(this).data('id2');

  var sec=$(this).data('title');



 AppendMaquinas(art,ope); 
$('#Mid_opera').val(ope2);
$('#id_articulo').val(art);
$('#id_cantidad').val(cant);
$('#id_secuencia').val(sec);





$('#showModal').modal('show');

  }

  

});

$(function(){
$('#showModal').on('hidden.bs.modal',function(e){
   $(this).removeData();
});

});






function AppendMaquinas(art,ope){
  

  //alert(art+ope);

   var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/ListarArticuloOperacion/";




   $.ajax({
     url:miurl,
     type:'get',
      data:{"art":art,"ope":ope}    
   }).done(function(data){
      
     var content=JSON.parse(data);
     //console.log(content);

    //alert(content[0].ARTICULO);
    //
    
    $.each(content,function(i,item){

     $('#id_centrocosto').append('<option value='+content[i].RUBRO+'>'+content[i].RUBRO+"-"+content[i].DESCRIP_RUBRO +'</option>' );
     
     if((content[i].CP_TIEMPOCAMBIOMOLDE)==0.0){
     
     piezaxh=parseInt((content[i].HORASXHORA));
     total=piezaxh;

     }else{
     piezaxh=parseInt((content[i].HORASXHORA));
     tiempomolde=parseInt((content[i].CP_TIEMPOCAMBIOMOLDE));
     total=piezaxh+tiempomolde;
      
     }

     $("#idm_tiempocm").val( content[i].CP_TIEMPOCAMBIOMOLDE);
    $("#idm_cantidadxh").val(total);

    var vcantidadaproducir=$("#id_cantidad").val();




    var vcantixturno=total;    //$('#piezaxhora').val();
    r=vcantixturno*8;// piezas por turno
     
    v01= parseFloat(vcantidadaproducir).toFixed(2) ;
    v04=parseFloat(vcantixturno).toFixed(2) ;
    v02=parseFloat(r);
  
    v03=Math.round(v01/v04);
     v05=Math.round(v03/8);
   
   
  $("#idm_totalhoras").val(v03);
$("#idm_totalturnos").val(v05);
   

    




    });
    
    //$("#nombrecliente").val(content[0].DESC_DIREC_EMBARQUE);
    //$("#Pais").val(content[0].PAIS);
    //$("#fecharequerida").val(content[0].FECHA_PROMETIDA);
  

   });




 





}







 
</script>


@endsection
 

 

