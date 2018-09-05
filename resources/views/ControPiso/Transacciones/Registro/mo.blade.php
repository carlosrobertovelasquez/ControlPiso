@extends('layouts.app')

@section('htmlheader_title')
    Mano de Obra
@endsection

@section('contentheader_title')
 Registro de Mano de Obra 
@endsection

@section('main-content')

         
        
<section class="content">
<a href=" {{url('registroMO')}}" ><span class="btn btn-primary" aria-hidden="true">Regresar</span></a>
<form  id="form_registrohoras" role="search" action="#" method="GET" >
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <input type="hidden" name="planificacion_id" name="planificacion_id" value="{{$encabezado->id}}">
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
          <input id="id_operacion" name="id_operacion" type="text" class="form-control" value="{{$encabezado->operacion}}" readonly="readonly" >
        </div>
        <div class="form-group">
          <label>Selecione Turno y Fecha : </label>
          <select id="id_turno" name="id_turno" class="form-control select2" onchange="actualizar()" style="width: 100%;">
            @foreach($detalle as $detalle)
              <option value="{{ $detalle->id }}">{{ number_format($detalle->turno)}} -- {{ $detalle->thoraini }} -- {{ $detalle->thorafin }} ==({{ $detalle->fecha }}) <> HORAS PLANIFICADAS ({{$detalle->horas}})</option>
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
                     <input  type="time" class="form-control select2" id="hora1"  name="hora1"    value="<?php echo date("H:i");?>">
                  </div>
                  <div class="col-xs-2">
                     <input  type="time" class="form-control select2" id="hora2" onblur="restarHoras();"  name="hora2"    value="<?php echo date("H:i");?>">
                  </div>
                  <div class="col-xs-1">
                    <input type="text" readonly="readonly" name="horatotal" class="form-control" placeholder="Tiempo Minutos"  id="horatotal">
                  </div>
                  <div class="col-xs-2">
                      <select   id="id_clave" name="id_clave" class="form-control select2" ">
                                       <option value="0">SELECIONES UNA OPERACION:</option>
                                 
                                       @foreach($clave_mo as $clave_mo)
                                       <option value="{{ $clave_mo->CLAVE }}">{{ $clave_mo->CLAVE }}-{{$clave_mo->DESCRIPCION}} </option>
                                       @endforeach
                      </select>
                  </div>
                  <div class="col-xs-2" >
                    <select name="id_subclave" class="subclave" style="width: 100% ; font-size: 14px;  padding: 6px 12px;" id="id_subclave">
                        <option selected="selected">SELECIONAR SUBCLAVE</option>
                    </select>
                  </div>   
                  <div class="col-xs-2">
                    <input type="text" name="comentarios"  id="comentarios" class="form-control select2" placeholder="Comentarios">
                  </div>
                  <div >
                    <button type="button"   id="btnadicionar" class="show-modal btn btn-success"  onclick="crear()">Guardar</button> 
                  </div>
                 
              </div>
            </div>
          

                <div id="lista_horas"></div>

               <div class="box-body">
                <div class="row">
                <div class="col-xs-2">
                  <label>HORAS DE TURNO</label>
                        <input id="total_horas" name="total_horas" type="text" class="form-control"  readonly="readonly" >
                     
                </div>
                <div class="col-xs-2">
                  <label>TIEMPO PERDIDO</label>
                  <input type="text" name="horasPeridas" class="form-control" id="horasPerdidas" readonly="readonly"   >   
                </div>
                <div class="col-xs-2">
                  <label>TIEMPO TRABAJADO</label>
                    <input type="text" name="horasTrabajadas" class="form-control" id="horasTrabajadas" readonly="readonly"   >   
                </div>
                <div class="col-xs-2">
                  <label>HORAS PLANIFICADAS</label>
                    <input type="text" name="horasPlanificadas" class="form-control" id="horasPlanificadas" readonly="readonly"   >   
                </div>
                <div class="col-xs-2">
                <label></label>
                  <button type="button"   id="btnadicionarh" class="show-modal btn btn-success" onclick="crear2()" style="width: 100% ; font-size: 16px;  padding: 6px 16px;" >Adicionar Horas </button> 
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
                <div class="col-xs-4">
                  <input type="text" class="form-control" name="searchempleado"  placeholder="Codigo o Nombre" id="searchempleado">
                </div>   
                 <div class="col-xs-3">
                  <select id="id_rol" name="id_rol" class="form-control select2" style="width: 100%;">
                  <option selected="selected">Operario</option>
                  <option>Lider</option>
                  <option>Supervisor</option>
                  </select>
                </div>

                <input type="hidden" name="id_empleado" id="id_empleado" value="">
                <input type="hidden" name="nombre" id="nombre" value="">

                <div class="col-xs-3">
                  <input type="number" id="participacion" name="participacion" min="10" max="100" required="required" value="100"
                  class="form-control select2" placeholder="Participacion" >
                </div>
                <div class="col-xs-2">
                  <button type="button"   id="btncrearEmpleado" class="form-control" onclick="crearemple()" >Adicionar</button> 
                </div>
            
              
      </div>
      <div id="lista_empleados"></div>
      </div>

    <div class="box box-default">
      <div class="box-header with-border">

        <h3 class="box-title">Registro de Produccion</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
      </div>

      <div class="box-body">
         <div class="col-md-6">
          <div class="form-group">
                 <div class="form-group">
                          <label> No.DE PIEZAS POR CICLO : </label>
                          <input  type="number" class="form-control" id="piezasxhora"  name="piezasxhora" readonly="readonly"  value="{{$encabezado->cantidad}}">      
                         </div>
                <!-- /.input group -->
              </div>
          
           <div class="form-group">
                        <label>PRODUCCION : </label>
                        <input id="produccion" name="produccion" type="number" class="form-control"  value=0.0 " >
                      </div>
                 <div class="form-group">
                        <label>DESPERDICIO RECUPERABLE : </label>
                        <input id="desrecuperable" name="desrecuperable" type="number" class="form-control" value=0.0 >
                      </div>     

                  <div class="form-group">
                        <label>DESPERDICIO NO RECUPERABLE : </label>
                        <input id="desnorecuperable" name="desnorecuperable" type="number" class="form-control" value=0.0 >
                      </div>

                       </div>
             <div class="col-md-6">
               <div class="form-group">
                        <label> META POR TURNO : </label>
                        <input id="meta" name="meta" type="number" class="form-control"  readonly="readonly" >
                      </div>     
                       <div class="form-group">

                           <label>%EFICIENCIA : </label>
                        <input id="eficiencia" name="eficiencia" type="number" class="form-control"  readonly="readonly" >
                             
                         </div>
                         <div class="form-group">
                           <label>TOTAL : </label>
                          <input id="total" name="total" type="number" class="form-control"  readonly="readonly" >
                         </div>
                        

                          <div class="form-group ">                                  
                                    
                                          
                                    <button type="button" name="aprobar" id="aprobar" style=" display:none;"  onclick="yy()" 
                                     class="btn btn-default btn-lg" title="Aprobar Registro de MO" >
                                     <span class="glyphicon glyphicon-floppy-saved" >
                                     </span> Aprobar Registro de M.O. </button>  
                                      
                         </div>
                         <div class="form-group">                                  
                       

                                  <button type="button" 
                                           name="aprobarproduccion" 
                                           id="aprobarproduccion" 
                                           style="display:none;" 
                                           onclick="AprobarProduccion1()"
                                    class="btn btn-default btn-lg" title="Confirmar Registro de MO">
                                     <span class="glyphicon glyphicon-floppy-save">
                                    </span> Confirmar Registro de MO
                                  </button>             
                         </div>
                             
             </div>
             

      </div>
      
     </div>  
     <div id="lista_produccion"></div> 
 </form>
  
</section>




@endsection





@section('script2')


<script>


 $(document).ready(function(){
  listhoras();
  totalHoras();
  horasPerdidas();
  horasTrabajadas();
  horasplanificadas();
  metaxTurno();
  listaempleados();
  listarproduccion();
  listaproduccion2();
  var novalidar;
 
 

     var urlraiz=$("#url_raiz_proyecto").val();
     var miurl =urlraiz+"/registro/buscarempleado";
  $('#searchempleado').autocomplete({
    
      source:miurl,
      minlenght:1,
      autoFocus:true,
      select:function(e,ui){
      
        $('#nombre').val(ui.item.nombre);
        $('#id_empleado').val(ui.item.id);
      }




  });
  
 });

$('#id_clave').change(function(){
   var claveId = $(this).val();
      $ciudaditems = $('.cityItems').remove();
      
        $.get('/subclaves/'+claveId, function(data){
            $.each(data, function(index, element){
              //console.log(element);
              $('select#id_subclave').append('<option value="'+element.SUBCLAVE+'"class="cityItems">'+element.DESCRIPCION+'</option>')
            });
        }, 'json');
    });



$('#produccion').on('change',function () 
{
  var meta= document.getElementById("meta").value;
  var produccion=document.getElementById("produccion").value;

  var eficiencia=(produccion/meta)*100;
   var v04=eficiencia.toFixed(2) ;
   $("#eficiencia").val(v04);
   $("#total").val(produccion);
  
  

   if(produccion>0){
     
    document.getElementById("aprobar").style.display='inline';
   // aprobar.style.display='inline';
   }else{
    document.getElementById("aprobar").style.display='none';
   }

 
});

$('#desrecuperable').on('change',function () 
{
   $("#total").val(0);
  var desperdicio2= document.getElementById("desnorecuperable").value;
  var desperdicio= document.getElementById("desrecuperable").value;
  var produccion=document.getElementById("produccion").value;

  var total=parseFloat(produccion)+parseFloat(desperdicio)+parseFloat(desperdicio2);
   

   $("#total").val(total);

 
});

$('#desnorecuperable').on('change',function () 
{
   $("#total").val(0);
   var desperdicio= document.getElementById("desrecuperable").value; 
  var desperdicio2= document.getElementById("desnorecuperable").value;
  var produccion=document.getElementById("produccion").value;

  var total=parseFloat(produccion)+parseFloat(desperdicio)+parseFloat(desperdicio2);
   
   $("#total").val(total);

 
});



function totalHoras()
{
var id= document.getElementById("norden").value;
var id2= document.getElementById("id_turno").value;
var id3= document.getElementById("id_operacion").value; 
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/registro/totalhoras";

$.ajax({
  type:'get',
  url:miurl,
  data:{id:id,id2:id2,id3:id3},
  success:function(resul){
    
    $('#total_horas').val(resul);
  }
 });
}

function horasPerdidas()
{
var id= document.getElementById("norden").value;
var id2= document.getElementById("id_turno").value;
var id3= document.getElementById("id_operacion").value; 
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/registro/tiempoPerdido";

$.ajax({
  type:'get',
  url:miurl,
  data:{id:id,id2:id2,id3:id3},
  success:function(resul){

    $('#horasPerdidas').val(resul);
  }
 });
}

function horasTrabajadas()
{
var id= document.getElementById("norden").value;
var id2= document.getElementById("id_turno").value;
var id3= document.getElementById("id_operacion").value; 
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/registro/horasTrabajadas";

$.ajax({
  type:'get',
  url:miurl,
  data:{id:id,id2:id2,id3:id3},
  success:function(resul){

    $('#horasTrabajadas').val(resul);

  }
 });
}

function metaxTurno()
{
var id= document.getElementById("norden").value;
var id2= document.getElementById("id_turno").value;
var id3= document.getElementById("id_operacion").value; 
var id4= document.getElementById("maquina").value;
var id5= document.getElementById("id_articulo").value;
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/registro/metaxTurno";

$.ajax({
  type:'get',
  url:miurl,
  data:{id:id,id2:id2,id3:id3,id4:id4,id5:id5},
  success:function(resul){
    
    if(resul==0){
       meta2();
       novalidar="N";
    }else{
       novalidar="S";
    $('#meta').val(resul.cantidad);  
    }
    
  }
 });
}

function meta2(){
  var id= document.getElementById("norden").value;
var id2= document.getElementById("id_turno").value;
var id3= document.getElementById("id_operacion").value; 
var id4= document.getElementById("maquina").value;
var id5= document.getElementById("id_articulo").value;
var ht=document.getElementById("horasTrabajadas").value;
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/registro/metaxTurno2";

$.ajax({
  type:'get',
  url:miurl,
  data:{id:id,id2:id2,id3:id3,id4:id4,id5:id5},
  success:function(resul){
     if(ht=="0"){
      $('#meta').val(parseFloat(resul));
     }else{
      var horas=parseFloat(resul)*parseFloat(ht);

      $('#meta').val(horas);
     }
     
  }
 });

}
function horasplanificadas()
{
var id= document.getElementById("norden").value;
var id2= document.getElementById("id_turno").value;
var id3= document.getElementById("id_operacion").value; 
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/registro/horasplanificadas";

$.ajax({
  type:'get',
  url:miurl,
  data:{id:id,id2:id2,id3:id3},
  success:function(resul){
    $('#horasPlanificadas').val(resul);
  }
 });
}




function listhoras(){

var id= document.getElementById("norden").value;
var id2= document.getElementById("id_turno").value;
var id3= document.getElementById("id_operacion").value; 
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/registro/listarhoras";

$.ajax({
  type:'get',
  url:miurl,
  data:{id:id,id2:id2,id3:id3},
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
var miurl =urlraiz+"/registro/listaremple";

$.ajax({
  type:'get',
  url:miurl,
  data:{id:id,id2:id2,id3:id3},
  success:function(data){
    $('#lista_empleados').empty().html(data);
  }
 });
}

function listaproduccion2(){
var id= document.getElementById("norden").value;
var id2= document.getElementById("id_turno").value;
var id3= document.getElementById("id_operacion").value; 
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/registro/listarproducc2";

$.ajax({
  type:'get',
  url:miurl,
  data:{id:id,id2:id2,id3:id3},
  success:function(data){
    $('#lista_produccion').empty().html(data);
  }
 });
}




function listarproduccion(){
var id= document.getElementById("norden").value;
var id2= document.getElementById("id_turno").value;
var id3= document.getElementById("id_operacion").value; 
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/registro/listarproduccion";


$.ajax({
  type:'get',
  url:miurl,
  data:{id:id,id2:id2,id3:id3},
  success:function(resul){
     
    if(resul.PRODUCCION==null ){
     
    $('#produccion').val(0.00);
    $('#desrecuperable').val(0.00);
    $('#desnorecuperable').val(0.00);
    $('#eficiencia').val(0.00);
    $('#total').val(0.00);
     document.getElementById("aprobar").style.display='none';
     document.getElementById("aprobarproduccion").style.display='none';
    }else{
     $('#produccion').val(resul.PRODUCCION);
    $('#desrecuperable').val(resul.DESPERDICIORECU);
    $('#desnorecuperable').val(resul.DESPERDICIONORECU);
    $('#eficiencia').val(resul.EFICIENCIA);
    $('#total').val(resul.TOTAL);
      document.getElementById("aprobar").style.display='block';
      document.getElementById("aprobarproduccion").style.display='block';
      document.getElementById("aprobar").value='Actualizar Produduccion';
       
    }
    
  }
 });

} 

function actualizar(){
  listhoras();
  totalHoras();
  horasPerdidas();
  horasTrabajadas();
  horasplanificadas();
  metaxTurno();
  listaempleados();
  listarproduccion();
  listaproduccion2();
  document.getElementById("btnadicionar").disabled=false;
  document.getElementById("comentarios").disabled=false;
  document.getElementById("id_clave").disabled=false;
  document.getElementById("horatotal").disabled=false;
}
 
  

function restarHoras(){
    
   var inicio=document.getElementById("hora1").value;
   var fin=document.getElementById("hora2").value;
   var id= document.getElementById("horasPlanificadas").value;
   var horastrabajadas=document.getElementById("total_horas").value;
   horast=parseInt(horastrabajadas.substr(0,2));

  
   inicioHoras=parseInt(inicio.substr(0,2));
  
 


  if(inicio>fin){
    inicioHoras=24-inicioHoras;
    inicioMinutos=parseInt(inicio.substr(3,2));
    finMinutos=parseInt(fin.substr(3,2));
    finHoras=parseInt(fin.substr(0,2));
    transcurridoMinutos=finMinutos-inicioMinutos;
    transcurridoHoras=finHoras+inicioHoras;
  }else{
    inicioHoras=parseInt(inicio.substr(0,2));
    inicioMinutos=parseInt(inicio.substr(3,2));
    finMinutos=parseInt(fin.substr(3,2));
    finHoras=parseInt(fin.substr(0,2));
    transcurridoMinutos=finMinutos-inicioMinutos;
    transcurridoHoras=finHoras-inicioHoras;  
  }
  if(transcurridoMinutos<0){
    transcurridoHoras--;
    transcurridoMinutos= 60 + transcurridoMinutos;
  }
  horas=transcurridoHoras.toString();
  minutos=transcurridoMinutos.toString();
  total01=horast+transcurridoHoras
  
  if(total01>id){
      if (novalidar=="S"){
        document.getElementById("btnadicionar").disabled=true;
        document.getElementById("comentarios").disabled=true;
        document.getElementById("id_clave").disabled=true;  
        window.alert('A superado la Cantidad de Horas Planificadas Solicitar Aumento de Horas....');
      }
  }else{
    document.getElementById("btnadicionar").disabled=false;
    document.getElementById("comentarios").disabled=false;
    document.getElementById("id_clave").disabled=false;
    if(horas.length<2){
      horas="0"+horas;
    }
    if(minutos.length<2){
      minutos="0"+minutos;
    }
  }  
  document.getElementById("horatotal").value=horas+":"+minutos;

}


function crear(){
    var id=document.getElementById("horatotal").value;

    if (id==""){
      alert("Tiene que ingresar datos");
    }else{

    var dataString=$('#form_registrohoras').serialize();
    var urlraiz=$("#url_raiz_proyecto").val();
     var miurl =urlraiz+"/registro/agregar/";
    
  
  $.ajax({
     url:miurl,
    data:dataString,
  }).done(function(data){
    listhoras();
    totalHoras();
    horasPerdidas();
    horasTrabajadas();
    document.getElementById("hora1").value="";
    document.getElementById("hora2").value="";
    document.getElementById("horatotal").value="";
    document.getElementById("comentarios").value="";


  });

 }
}

function crear2(){
 
    var dataString=$('#form_registrohoras').serialize();
    var urlraiz=$("#url_raiz_proyecto").val();
     var miurl =urlraiz+"/registro/agregar2/";
    
  
  $.ajax({
     url:miurl,
    data:dataString,
  }).done(function(data){
    listhoras();
    totalHoras();
    horasPerdidas();
    horasTrabajadas();
    document.getElementById("hora1").value="";
    document.getElementById("hora2").value="";
    document.getElementById("horatotal").value="";
    document.getElementById("comentarios").value="";
  });

 
}


function yy(){

var dataString=$('#form_registrohoras').serialize();
    var urlraiz=$("#url_raiz_proyecto").val();
     var miurl =urlraiz+"/registro/agregarproduccion/";
    
    
  $.ajax({
     url:miurl,
    data:dataString,
  }).done(function(data){
    //listaempleados();
    //document.getElementById("searchempleado").value="";
    //document.getElementById("nombre").value="";
    


  });

   alert('Se actualizo Correctamente');

   actualizar();


  }

function AprobarProduccion1(){
   

var dataString=$('#form_registrohoras').serialize();
    var urlraiz=$("#url_raiz_proyecto").val();
     var miurl =urlraiz+"/registro/aprobarproduccion/";
    
  
  $.ajax({
     url:miurl,
    data:dataString,
  }).done(function(data){
    //listaempleados();
    //document.getElementById("searchempleado").value="";
    //document.getElementById("nombre").value="";
    


  });

   alert('Se Aprobo Existosamente');

   actualizar();



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
       totalHoras();
       horasPerdidas();
       horasTrabajadas();
    });
      document.getElementById("btnadicionar").disabled=false;
    document.getElementById("comentarios").disabled=false;
    document.getElementById("id_clave").disabled=false;

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

function eliminarregistroproduccion(id){
   //var id=$(this).attr("fila");
   var urlraiz=$("#url_raiz_proyecto").val();
     var miurl =urlraiz+"/registro/eliminarregistroproduccion/"+id+"";
    if(!confirm("Esta seguro de Eliminar")){
      return false;
    }
    $.ajax({
      url:miurl,
    }).done(function(data){
       listaproduccion2();
    });
}
  
    
</script>
@endsection