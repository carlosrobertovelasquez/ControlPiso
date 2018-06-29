@extends('layouts.app')

@section('main-content')


         <!-- Content Header (Page header) -->
        
         <section class="content-header">
            <h1>
                PANTALLA DE CONTROL
                <small>ORDEN DE PRODUCCION</small>
            </h1>

          <form class="navbar-form" role="search"  action="{{route('planificador.index',[$anio])}}">  
           <div class="row">
            <div class="col-xs-6">
                    <label style="text-align:center" > Selecionar Sector :</label>
                    <select   id="id" name="id" class="form-control select2" style="width: 100%;">
                            <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
                            <option value="">TODOS</option>
                        @foreach($TipoEquipo as $TipoEquipo)
                        <option value="{{ $TipoEquipo->TIPO_EQUIPO }}">{{ $TipoEquipo->TIPO_EQUIPO }} </option>
                        @endforeach
                         </select>
                        
                </div>

                 <div>
                        <input name="buscar"  value="Buscar" class="btn btn-info active" type="submit"/>
                    </div> 
           </div>
          </form>     
                
             <script type="text/javascript">
                     setTimeout("document.location=document.location",55000); 
           </script>
         
        </section>

        <!-- Main content -->
        
        

        <section class="content">
            <!-- Small boxes (Stat box) -->

            <div class="row">
             
                @foreach($OrdenProduccion as $OrdenProduccion)
                <div class="col-lg-4 col-xs-8">
          
                
                      @if($OrdenProduccion->estado=='P')
                       <div class="small-box bg-green">
                              
                             

        
                      @elseif($OrdenProduccion->estado=='A')
                        <div class="small-box bg-yellow">
                             

                      @elseif($OrdenProduccion->estado=='B')  
                         <div class="small-box bg-red">
                             
                      @endif

    
                     

        



                     





                   
                        <div class="pull-right">
                            <i class="fa fa-clock-o"></i> {{Carbon\Carbon::parse($OrdenProduccion->FECHACREACION)->diffForHumans()}}
                       </div>
                     
                        <div class="inner">
                            <h1>ID :{{  number_format($OrdenProduccion->id)}}</h1>
                            <h4 class="center-block">OPERACION:</h4>
                            <p>{{$OrdenProduccion->operacion}} </p>
                            <h4 class="center-block">ORDEN PRODUCCION:</h4>
                            <p>{{$OrdenProduccion->ordenproduccion}} </p>
                            <h4 class="center-block">CENTRO COSTO:</h4>
                            <p>{{$OrdenProduccion->centrocosto}}</p>
                            <h4 class="center-block">Cantidad a Produccir:</h4>
                            <p>{{ number_format($OrdenProduccion->cantidad)}}</p>
                            <h4 class="center-block">Articulo :</h4>
                            <p>{{$OrdenProduccion->articulo}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <div>
                           
                            <a href="{{route('viajero',$OrdenProduccion->ordenproduccion)}}" class="btn btn-raised btn-primary">Viajero</a>
                            <a href="{{route('Ficha_Tecnica',$OrdenProduccion->FICHA_TECNICA)}}"" class="btn btn-raised btn-primary">Ficha Tec</a>

                            @if($OrdenProduccion->estado=='P')
                                     <a href="{{route('planificar.estadoP',$OrdenProduccion->id)}}" class="btn btn-raised btn-warning">Planificado</a>
                                   
                            @elseif($OrdenProduccion->estado=='A')
                                <a href="#" class="btn btn-raised btn-danger">En Produccion</a>

                                

                            @elseif($OrdenProduccion->estado=='B')
                                
                                  <a href="{{route('planificar.estadoB',$OrdenProduccion->id)}}" class="btn btn-raised btn-info">Liquidado  </a>

                            @endif
                           
                            
                        </div>

                    </div>

                </div><!-- ./col -->
               
                @endforeach
            </div><!-- /.row -->
@endsection