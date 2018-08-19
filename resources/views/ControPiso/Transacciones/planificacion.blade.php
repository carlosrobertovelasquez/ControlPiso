@extends('layouts.app')
@section('htmlheader_title')
    Planificacion
@endsection
@section('main-content')
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
<div class="container">
  <div class="row">
    <div  class="col-md-12">
      <a href=" {{url('Produccion')}}" ><span class="btn btn-primary" aria-hidden="true">Regresar</span></a>
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
                    <label>Selecione el Pedido </label>
                    <select id="id_pedido" name="id_pedido" class="form-control select2" style="width: 100%;">
                      <option value="0">SELECIONES UN PEDIDO:</option>
                      <option value="000000">PRODUCCION INTERNA</option>
                        @foreach($pedido as $pedido)
                      <option value="{{ $pedido->PEDIDO }}">{{ $pedido->PEDIDO }}--{{ $pedido->NOMBRE_CLIENTE }} </option>
                        @endforeach
                    </select>
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
                  <?php $modal=0;?>
                  @foreach($centrocosto as $centrocosto)
                <tr>
                  <td >{{ $centrocosto->OPERACION }}</td> 
                  <td>{{ $centrocosto->DESCRIPCION }}</td> 
                  <td>{{$centrocosto->SECUENCIA}}</td>
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
          </div>
          @include('ControPiso.Transacciones.agregar')
          @include('ControPiso.Transacciones.show')
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
                                    value="Guardar"> Guardar 
              </button>
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
  <script src="../js/ControlPiso/planificacion.js"></script>
@endsection
