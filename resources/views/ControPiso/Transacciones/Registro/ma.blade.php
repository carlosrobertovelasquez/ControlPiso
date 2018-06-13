@extends('layouts.app')

@section('htmlheader_title')
    Materiales
@endsection
@section('contentheader_title')
 Materiales 
@endsection

@section('main-content')

<section class="content">

 <style>
        .boton {border:1px solid #808080;cursor:pointer;padding:2px 5px;color:Blue;}
    </style>
       

  <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Materiales</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
      </div>
      <div class="box-body">
          <div class="table-responsive"    >
                  <table  border="1" cellspacing="0" cellpadding="5"  >
                    <thead>
                        <tr>
                          <th>ORDEN PRODUCCION</th>
                          <th>ARTICULO</th>
                          <th>DESCRIPCION</th>
                          <th>CANTIDAD</th>
                          <th>UNIDAD</th>
                          <th>OPERACION</th>
                          <th>CANTIDAD</th>
                          <th>Selecionar</th>
                           <th>Procesar</th>
                        </tr>
                    </thead>
                    <tbody>
                     
                      
                      @foreach($consumo as $consumo)
                        <tr  >
                                <td  >{{ $consumo->ORDEN_PRODUCCION}}</td>
                                <td  ">{{ $consumo->ARTICULO}}</td>
                                <td  >{{ $consumo->DESCRIPCION }}</td> 
                                <td >{{ number_format($consumo->CANTIDAD_ESTANDAR ,2)}}</td>
                                <td  >{{$consumo->UNIDAD_ALMACEN}}</td>
                                <td >{{$consumo->OPERACION}}</td>
                                <td > <input name="cantidad" type="number"></td>
                                <td  >
                                  <select name='tipotrans'>
                                    <option value="01">Consumo</option>;
                                    <option value="01">Devolucion</option>;
                                    <option value="01">Otros</option>;
                                   </select>
                                </td>
                              
                                <td >
                           <a id="yy" href="#"   onclick="actualizar('{{$consumo->ARTICULO}}','{{$consumo->ORDEN_PRODUCCION}}'>Registar
                           <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                           </a>
                                  
                                 
                               </td>
                        </tr>
                      @endforeach
                    </tbody>         
                  </table>
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
         
        
          
              
              
                  <table  class="table table-sm"  >
                  <thead>
                        <tr>
                        <th>ID</th>
                          <th>ORDEN PRODUCCION</th>
                          <th>ARTICULO</th>
                          <th>DESCRIPCION</th>
                          <th>CANTIDAD</th>
                          <th>OPERACION</th>
                           
                          <th>Selecionar</th>
                        </tr>
                    </thead>
                    <tbody>
                         
                      
                      @foreach($cp_consumo as $cp_consumo)
                        <tr >
                        
                                <td >{{ $cp_consumo->id}}</td>
                                <td >{{ $cp_consumo->orden_produccion}}</td>
                                <td >{{ $cp_consumo->articulo}}</td>
                                <td >{{ $cp_consumo->descripcion}}</td>
                                <td >{{ $cp_consumo->cantidad}}</td>
                                <td >{{ $cp_consumo->operacion}}</td>
                                <td>
                                
                                 <a href="#"  class="btn-delete" onclick="eliminar({{$cp_consumo->id}})">
                              <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                            </a>
                               </td>
                        </tr>
                        @endforeach
                  </tbody>
               </table>
              
           
          
            

      </div>

     </div>   

  
 
 </section> 
  
@endsection

@section('script2')
<script>

function listarmateriales(){

};
function listarconsumos(){
/*
var id= document.getElementById("id_planificacion").value;
var id2= document.getElementById("id_orden").value;
var urlraiz=$("#url_raiz_proyecto").val();
var miurl =urlraiz+"/registro/ma/"+id+"/"+id2+"";



$.ajax({
  type:'get',
  url:miurl,
  //data:{id:id,id2:id2},
  success:function(data){
    $('#lista_registro').empty().html(data);
  }
 });
 */
};

function guardarmateriales(){
  

};

function eliminar(id){

};
function actualizar(id,id2,id3) {
 
alert(id3);

};

</script>
@endsection





