@extends('layouts.app')

@section('htmlheader_title')
    Planificacion
@endsection


@section('main-content')




<div class="container">
  <div class="row">
    <div  class="col-md-10">
       <form   id="form_planificacion" role="search" action="{{route('guardar_planificacion')}}" method="GET" >
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="box box-default">
              <div class="box-header with-border">
                <h1  align="center" >Produccion</h1>
             

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
                        <input type="text" id="cantidadaproducir" name="cantidadaproducir" class="form-control" value=" {{ ($ordenproduccion->CANTIDAD_ARTICULO-$ordenproduccion->CANTIDAD_PRODUCCI)}}"  onkeypress="return valida(event)" >
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
                          <label >Direccion Clientesss </label>
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
                      <label>Selecione Cliente Ficha Tecnica </label>

                      <select id="id_ficha" name="id_ficha" class="form-control select2" style="width: 100%;">
                        <option value="0">SELECIONES UN FICHA:</option>
                          <option value="000000">SIN FICHA TECNICA</option>
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
                  <h1  align="center" >Centro Costo</h1>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                   
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
              
                   <div class="row">
                    <div class="col-md-6">
                     
                      <div class="form-group">
                           <label>Selecione el Centro Costo </label>

                          <select id="id_centrocosto" name="id_centrocosto" class="form-control select2" style="width: 100%;">
                                    <option value="0">SELECIONES UN CENTRO COSTO:</option>
                                   @foreach($centrocosto as $centrocosto)
                                   <option value="{{ $centrocosto->ID}}">{{ $centrocosto->EQUIPO }}--{{ $centrocosto->DESC_EQUIPO }} </option>
                                   @endforeach
                          </select>

                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                          <label > Cantidad de Piezas Por Hora </label>
                          <input  type="text" class="form-control" id="idm_cantidadxh" name="idm_cantidadxh" onkeypress="return valida(event)" >
                      </div>

                        <input type="hidden" name="color" id="color" />
                       


                     
                         <div class="form-group">
                            <label>Tiempo por Cambio Molde  </label>
                          <input type="number" id="idm_tiempocm" name="idm_tiempocm" class="form-control" >
                                 
                         </div>

                          <div class="form-group">
                          <fieldset data-role="controlgroup" data-type="horizontal" >
                            <legend>Horario Normal </legend>
                            <label for="normal">Normal</label>
                            <input type="checkbox" name="normal" id="normal" value="normal" checked onclick="ValidarCkecked()" >

                          </fieldset>

                         </div>
    



                         <div class="form-group">
                          <fieldset data-role="controlgroup" data-type="horizontal" >
                            <legend>Dias de Trabajo </legend>
                            <label for="lunes">L</label>
                            <input type="checkbox" name="lunes" id="lunes" value=1  class="checar"  >
                            <label for="martes">M</label>
                            <input type="checkbox" name="martes" id="martes" value="2" class="checar"    >
                            <label for="miercoles">K</label>
                            <input type="checkbox" name="miercoles" id="miercoles" value="3" class="checar"  >
                            <label for="red">J</label>
                            <input type="checkbox" name="jueves" id="jueves" value="4" class="checar"  >
                            <label for="red">V</label>
                            <input type="checkbox" name="viernes" id="viernes" value="5"  class="checar"  >
                            <label for="red">S</label>
                            <input type="checkbox" name="sabado" id="sabado" value="6"  class="checar" >
                            <label for="red">D</label>
                            <input type="checkbox" name="domingo" id="domingo" value="7" class="checar"  >

                          </fieldset>

                         </div>


                        
                        
                     
                         </div>

                    

                    <!-- /.col -->
                    <div class="col-md-6">
                      
                      <!-- /.form-group -->
                      <div class="form-group">
                          <label>Total Horas </label>
                          <input type="text" id="idm_totalhoras" name="operacion" class="form-control" readonly="readonly" >
                      </div>

                      <div class="form-group">
                            <label>Total de Turnos Estimados </label>
                          <input type="text" id="idm_totalturnos" name="operacion" class="form-control" readonly="readonly" >  
                      </div>

                      <div class="form-group">
                         <label > Fecha : </label>
                              <input  type="date" class="form-control" id="id_fecha"  name="id_fecha" style="width: 250px;height: 40px"   value="<?php echo date("Y-m-d");?>">
                      </div>
                      <div class="form-group">
                              <label > Hora : </label>
                              <input  type="time" class="form-control" id="id_hora"  name="id_hora" style="width: 250px;height: 40px"   value="<?php echo date("H:i");?>">
                                    
                            </div>

                      <br>

                            <div class="form-group ">
              
                                    
                                    
                                    <input type="button" onmouseover="this.backgroundColor='blue' "  style="width: 450px;height: 40px" name="planificar" id="planificar"  value="Planificar Produccion" >
                            </div> 


                            <div class="form-group ">
              
                                    
                                
                                   
                            </div> 
                      </div>

            
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->   



                
                    
                </div>
                 

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
                
                  


                   
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
                        <input type="hidden" name="id_secuencia" id="id_secuencia" value="1"> 
                             <div class="form-group" align="center">
                              <br>
                                    <button  align="center"  type="submit" onmouseover="this.backgroundColor='blue' "  style="width: 450px;height: 40px ;visibility:hidden " name="guardar" id="guardar"  value="Guardar"> Guardar </button>
                            </div> 
         </div> 
      </form>
    </div>
  </div>
    
</div>  






@endsection



@section('script2')

 <script >

  //Consulta de Pedidos
$(document).ready(function()
{


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
  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/ConsultaMaquina/"+id+"";
 // var miurl =urlraiz+"/ConsultaMaquina02/"+id+"/"+id2+"";
  var nf=new Intl.NumberFormat(); 
  $.ajax({
    url:miurl
  }).done(function(data)
  {   
     
     var content=JSON.parse(data);  

 if((content[0].TIEMPOMOLDE)==0.00){
     piezaxh=parseInt((content[0].PIEZASXHORAS));
     total=piezaxh;

     }else{
     piezaxh=parseInt((content[0].PIEZASXHORAS));
     tiempomolde=parseInt((content[0].TIEMPOMOLDE));
     total=piezaxh+tiempomolde;
      
     }

     

    $("#idm_tiempocm").val( content[0].TIEMPOMOLDE);
    $("#idm_cantidadxh").val(total);



   
   var vcantidadaproducir=$("#cantidadaproducir").val();


    var vcantixturno=total;    //$('#piezaxhora').val();
    r=vcantixturno*8;// piezas por turno
     
    v01= parseFloat(vcantidadaproducir).toFixed(2) ;
    v04=parseFloat(vcantixturno).toFixed(2) ;

    v02=parseFloat(r);
    
    v03=Math.round(v01/v04);
     v05=Math.round(v03/8);
   
   $("#idm_totalhoras").val(v03);  
 // $("#piezaxturno").val(v03);
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








$('#idm_cantidadxh').keyup(function(){
    
    var vcantixturno=document.getElementById('idm_cantidadxh').value;    //$('#piezaxhora').val();
    var vcantidadaproducir=document.getElementById('cantidadaproducir').value;  //$('#cantidadaproducir').val();
    r=vcantixturno*8;// piezas por turno

    v01= parseFloat(vcantidadaproducir).toFixed(2) ;
    v02=parseFloat(r);
    v03=Math.round(v01/v02);

    //r2 = vcantidadaproducir/r; //turnos necesarios
    
    document.getElementById("idm_cantidadxh").value=r;
   document.getElementById("cantidadturnos").value=v03;
    
  })

});


$('#cantidadaproducir').keyup(function(){

    var vcantixturno=document.getElementById('idm_cantidadxh').value;    //$('#piezaxhora').val();
    var vcantidadaproducir=document.getElementById('cantidadaproducir').value;  //$('#cantidadaproducir').val();
    r=vcantixturno*8;// piezas por turno

    v01= parseFloat(vcantidadaproducir).toFixed(2) ;
    v02=parseFloat(r);
    v04=v01/v02;

    v03=Math.round(v04);



    //r2 = vcantidadaproducir/r; //turnos necesarios

    document.getElementById("idm_cantidadxh").value=r;
    document.getElementById("cantidadturnos").value=v03;

});

// Boton de Planificacion
$('#planificar').click(function(){
   
eliminarFilas();
ValdiarCampos();

  
  var dataString=$('#form_planificacion').serialize();



  
  var vcantidadaproducir=document.getElementById('cantidadaproducir').value;  
  id2= parseFloat(vcantidadaproducir).toFixed(2) ;
  
  var id=$("#idm_totalhoras").val();//total de horas
  var id3="TERMINADO";// operacion a realizar
  var id4=document.getElementById('id_fecha').value;//fecha selecionada
  var id5=document.getElementById('id_hora').value;// hora selecionada
  var id6=document.getElementById('id_centrocosto').value;//maquina a utilizar
  var id7=$("#idm_totalturnos").val();

  var urlraiz=$("#url_raiz_proyecto").val();
  var miurl =urlraiz+"/planificar/"+id+"/"+id4+"/"+id5+"/"+id6+"/"+id3+"";

  
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
          '<td bgcolor="#FF0000">'+content[i].fecha+'</td>'+
          '<td bgcolor="#FF0000">'+content[i].thoraini+'</td>'+
          '<td bgcolor="#FF0000">'+content[i].thorafin+'</td>'+
          '<td bgcolor="#FF0000">'+content[i].horas+'</td>'+
          '<td bgcolor="#FF0000">'+content[i].cantidad+'</td>'+
          '<td bgcolor="#FF0000">'+content[i].turno+'</td>'+
          '<td bgcolor="#FF0000">'+content[i].operacion+'</td>'+
          '</tr>';

           }  
          if(content[i].turno=='3'){
          d+='<tr>'+
          '<td bgcolor="#00FF00" >'+$no+'</td>'+
          '<td bgcolor="#00FF00">'+content[i].centrocosto+'</td>'+
          '<td bgcolor="#00FF00">'+content[i].fecha+'</td>'+
          '<td bgcolor="#00FF00">'+content[i].thoraini+'</td>'+
          '<td bgcolor="#00FF00">'+content[i].thorafin+'</td>'+
          '<td bgcolor="#00FF00">'+content[i].horas+'</td>'+
          '<td bgcolor="#00FF00">'+content[i].cantidad+'</td>'+
          '<td bgcolor="#00FF00">'+content[i].turno+'</td>'+
          '<td bgcolor="#00FF00">'+content[i].operacion+'</td>'+
          '</tr>';
          }    

          if(content[i].turno=='2'){
            d+='<tr>'+
          '<td bgcolor="#FFFF00">'+$no+'</td>'+
          '<td bgcolor="#FFFF00">'+content[i].centrocosto+'</td>'+
          '<td bgcolor="#FFFF00">'+content[i].fecha+'</td>'+
          '<td bgcolor="#FFFF00">'+content[i].thoraini+'</td>'+
          '<td bgcolor="#FFFF00">'+content[i].thorafin+'</td>'+
          '<td bgcolor="#FFFF00">'+content[i].horas+'</td>'+
          '<td bgcolor="#FFFF00">'+content[i].cantidad+'</td>'+
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
 if(pedido=="0" ){
  alert(' Tiene que Selecionar un  pedido');
  return false;
 }
 
}


function ValidarCkecked(){

 

  if($(this.normal).prop('checked')){

   
    $('.checar').prop('checked',false);
  }else{
    $('.checar').prop('checked',true);
  }
}




 
</script>


@endsection
 

 

