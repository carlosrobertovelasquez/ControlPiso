@extends('layouts.app')

@section('htmlheader_title')
    Mano de Obra
@endsection

@section('contentheader_title')
 Registro de Mano de Obra 
@endsection

@section('main-content')


<section class="content">
  <form  id="form_registrohoras" role="search" action="#" method="GET" >
          <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Datos Generales</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
      </div>

      <div class="box-body">
         <div class="col-md-6">
          <div class="form-group">
                 <div class="form-group">
                          <label > Fecha : </label>
                          <input  type="date" class="form-control" id="id_fecha"  name="id_fecha" style="width: 450px;height: 40px"   value="<?php echo date("Y-m-d");?>">      
                         </div>
                <!-- /.input group -->
              </div>
          
           <div class="form-group">
                        <label>Centro Costo : </label>
                        <input id="maquina" name="maquina" type="text" class="form-control" value="{{$encabezado->centrocosto}}" readonly="readonly" >
                      </div>
                 <div class="form-group">
                        <label>Orden Produccion : </label>
                        <input id="norden" name="norden" type="text" class="form-control" value="{{$encabezado->ordenproduccion}}" readonly="readonly" >
                      </div>     

                       </div>
             <div class="col-md-6">
               <div class="form-group">
                        <label>Articulo : </label>
                        <input id="id_articulo" name="id_articulo" type="text" class="form-control" value="{{$encabezado->articulo}}" readonly="readonly" >
                      </div>     
                       <div class="form-group">

                           <label>Selecione el Operacion : </label>

                          <select id="id_operacion" name="id_operacion" onchange="actualizar()" class="form-control select2" style="width: 100%;">  
                             
                                   @foreach($operacion as $operacion)
                                   <option value="{{ $operacion->OPERACION }}">{{ $operacion->DESCRIPCION }} </option>
                                   @endforeach
                          </select>


                         </div>

                         <div class="form-group">

                           <label>Selecione Turno y Fecha : </label>

                          <select id="id_turno" name="id_turno" class="form-control select2" onchange="actualizar()" style="width: 100%;">
                                
                             
                                   @foreach($detalle as $detalle)
                                   <option value="{{ $detalle->id }}">{{ number_format($detalle->turno)}} -- {{ $detalle->fhoraini }} -- {{ $detalle->fhorafin }}</option>
                                   @endforeach
                          </select>


                         </div>

                



             </div>

      </div>

     </div>

    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Registro Horas Trabajadas</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
      </div>

 
       <div class="box-body">

       
              <div class="row">
        
              
               
                <div class="col-xs-2">
                  <input type="text" name="hora1" class="timepicker" id="hora1" value=""  >
                  
                </div>
                <div class="col-xs-2">
                  <input type="text" name="hora2" class="timepicker" id="hora2" onblur="restarHoras();">
                </div>
                <div class="col-xs-2">
                  <input type="text" name="horatotal" class="form-control" placeholder="Tiempo Minutos"  id="horatotal">
                </div>
   
                <div class="col-xs-2">
                    <select id="id_clave" name="id_clave" class="form-control select2" style="width: 100%;">
                                       <option value="0">SELECIONES UNA OPERACION:</option>
                                 
                                       @foreach($clave_mo as $clave_mo)
                                       <option value="{{ $clave_mo->CLAVE }}">{{ $clave_mo->CLAVE }}-{{$clave_mo->DESCRIPCION}} </option>
                                       @endforeach
                    </select>
                </div>   

                


     

                
                <div class="col-xs-2">
                  <input type="text" name="comentarios" id="comentarios" class="form-control" placeholder="Comentarios">
                </div>
                <div class="col-xs-2">
                  <button type="button" class="form-control" onclick="crear()" >Adicionar</button> 
                </div>
                 
              </div>


         
            </div>
          

                <div id="lista_horas"></div>

               <div class="box-body">
                <div class="row">
                <div class="col-xs-2">
                  <label>HORAS DE TURNO</label>
                  <input type="text" name="hturno" class="form-control" id="hturno" value=""  >   
                </div>
                <div class="col-xs-2">
                  <label>TIEMPO PERDIDO</label>
                  <input type="text" name="tperdido" class="form-control" id="tperdido" value=""  >   
                </div>
                <div class="col-xs-2">
                  <label>TIEMPO TRABAJADO</label>
                  <input type="text" name="ttrabajo" class="form-control" id="ttrabajo" value=""  >   
                </div>
              </div>
            </div>
      </div>

    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Registro Empleados</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          
          </div>
      </div>
        <div class="box-body">
              <div class="row">
                <div class="col-xs-2">
                  <input type="text" class="form-control" name="searchempleado"  placeholder="Codigo o Nombre" id="searchempleado">
                </div>
              
              
                <div class="col-xs-4">
                  <input type="text" id="nombre" name="nombre"  class="form-control" placeholder="Nombre">
                </div>
              <div class="col-xs-3">
                  <select id="id_rol" name="id_rol" class="form-control select2" style="width: 100%;">
                  <option selected="selected">Operario</option>
                  <option>Lider</option>
                  <option>Supervisor</option>
                  </select>
              </div>

              <div class="col-xs-2">
                  <button type="" class="form-control" onclick="crearemple()" >Adicionar</button> 
              </div>
            
               <div id="lista_empleados"></div>
      </div>
    </div>
  </div>
 </form> 
</section>




@endsection





@section('script2')


<script>
 $(document).ready(function(){
  listhoras();
  listaempleados();
 
     var urlraiz=$("#url_raiz_proyecto").val();
     var miurl =urlraiz+"/registro/buscarempleado";
  $('#searchempleado').autocomplete({
    
      source:miurl,
      minlenght:1,
      autoFocus:true,
      select:function(e,ui){
      
        $('#nombre').val(ui.item.id);
      }
  });
  
 });
function listhoras(){
var id= document.getElementById("norden").value;
var id2= document.getElementById("id_turno").value;
var id3= document.getElementById("id_operacion").value; 
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/registro/listarhoras/"+id+"/"+id2+"/"+id3+"";
$.ajax({
  type:'get',
  url:miurl,
  success:function(data){
    $('#lista_horas').empty().html(data);
  }
 });
}
function listaempleados(){
var id= document.getElementById("norden").value;
var id2= document.getElementById("id_turno").value;
var id3= document.getElementById("id_operacion").value; 
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/registro/listaremple/"+id+"/"+id2+"/"+id3+"";
$.ajax({
  type:'get',
  url:miurl,
  success:function(data){
    $('#lista_empleados').empty().html(data);
  }
 });
}
 
function actualizar(){
  listhoras();
  listaempleados();
}
 
  
  function restarHoras(){
   inicio=document.getElementById("hora1").value;
   fin=document.getElementById("hora2").value;
   inicioMinutos=parseInt(inicio.substr(3,2));
   inicioHoras=parseInt(inicio.substr(0,2));
   finMinutos=parseInt(fin.substr(3,2));
   finHoras=parseInt(fin.substr(0,2));
   transcurridoMinutos=finMinutos-inicioMinutos;
   transcurridoHoras=finHoras-inicioHoras;
   if(transcurridoMinutos<0){
    transcurridoHoras--;
    transcurridoMinutos= 60 + transcurridoMinutos;
   }
   horas=transcurridoHoras.toString();
   minutos=transcurridoMinutos.toString();
   if(horas.length<2){
    horas="0"+horas;
   }
   if(minutos.length<2){
    minutos="0"+minutos;
   }
   document.getElementById("horatotal").value=horas+":"+minutos;
  }
  function crear(){
    var dataString=$('#form_registrohoras').serialize();
    var urlraiz=$("#url_raiz_proyecto").val();
     var miurl =urlraiz+"/registro/agregar/";
    
  
  $.ajax({
     url:miurl,
    data:dataString,
  }).done(function(data){
    listhoras();
    document.getElementById("hora1").value="";
    document.getElementById("hora2").value="";
    document.getElementById("horatotal").value="";
    document.getElementById("comentarios").value="";
  });
  }
   function crearemple(){
    var dataString=$('#form_registrohoras').serialize();
    var urlraiz=$("#url_raiz_proyecto").val();
     var miurl =urlraiz+"/registro/agregaremple/";
    
  
  $.ajax({
     url:miurl,
    data:dataString,
  }).done(function(data){
    listaempleados();
    document.getElementById("searchempleado").value="";
    document.getElementById("nombre").value="";
    
  });
  }
function eliminar(id){
   //var id=$(this).attr("fila");
   var urlraiz=$("#url_raiz_proyecto").val();
     var miurl =urlraiz+"/registro/eliminar/"+id+"";
      
    
    
    if(!confirm("Esta seguro de Eliminar")){
      return false;
    }
    $.ajax({
      url:miurl,
    }).done(function(data){
       listhoras();
    });
}
function eliminaremple(id){
   //var id=$(this).attr("fila");
   var urlraiz=$("#url_raiz_proyecto").val();
     var miurl =urlraiz+"/registro/eliminaremple/"+id+"";
      
    
    
    if(!confirm("Esta seguro de Eliminar")){
      return false;
    }
    $.ajax({
      url:miurl,
    }).done(function(data){
       listaempleados();
    });
}
$('.timepicker').pickatime({
    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'OK', // text for done-button
    cleartext: 'Clear', // text for clear-button
    canceltext: 'Cancel', // Text for cancel-button
    autoclose: false, // automatic close timepicker
    ampmclickable: true, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
  });
  
    
 
  
   
   
 
</script>
@endsection