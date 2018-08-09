@extends('layouts.app')

@section('htmlheader_title')
    Viajero
@endsection


@section('main-content')


  <div class="row">
      
      <div class="col-xs-12">
      <div class="box-title">
           <a href="{{url('ConsultaProduccion')}}" class="btn btn-primary">Regresar</a>
            </div>
         
          <div class="box">
            <div class="box-header">
              <h1 align="center">REGISTRO DE OPERACIONES</h1>
             @foreach($cp_planificacion as $cp_planificacion)
               <div>
                <h3 class="box-title">Ordenes de Produccion: {{$cp_planificacion->ordenproduccion}}</h3>
              </div>
               <div>
                <h3 class="box-title">Operacion: {{$cp_planificacion->operacion}}</h3>
              </div>
              <div>
                <h2 class="box-title">Articulo: {{$cp_planificacion->articulo}} </h2> 
              </div>
              <div>
                <h2 class="box-title">Porcentaje de Avance: {{$cp_planificacion->porcentaje2}}</h2> 
              </div>
              <div>
                <h2 class="box-title">Cantidad Planeada: {{number_format($cp_planificacion->cantidad,2)}}</h2> 
              </div>   
              <div>
                <h2 class="box-title">Cantidad Producida: {{number_format($cp_planificacion->cantidadproducidad,2)}}</h2> 
              </div>  
              <div>
                <h2 class="box-title">Fecha Inicio: {{Carbon\Carbon::parse($cp_planificacion->fechamin)->format('d-m-Y H:i:s')}}</h2> 
              </div>   
              <div>
                <h2 class="box-title">Fecha Fin: {{Carbon\Carbon::parse($cp_planificacion->fechamax)->format('d-m-Y H:i:s')}}</h2> 
              </div>


             @if(is_null($cp_planificacion->CONFIRMADA)|| empty($cp_planificacion->CONFIRMADA))
               <div>
                <a href="#" class="btn btn-primary">Falta Confirmacion</a>
              </div>
                 
                 @else
                  <div class="box-title">

                   <a href="{{route('registro.procesarsoftland',$cp_planificacion->id)}}"  onclick="return confirm('Esta seguro de Cargar registros a Softland  ')" class="btn btn-primary" >Procesar Softland</a>

                    
            </div>
              @endif

                
            @endforeach

            <br>
            <h1 align="center">REGISTRO DE PRODUCCION </h1>
            <!-- /.box-header -->
                <div class="table-responsive" >
                  <table class="table table-sm"   >
                    <thead>
                        <tr>
                          <th>Turno</th>
                          <th>Inicio</th>
                          <th>Fin</th>
                      
                        
                          <th>MetaxTurno</th>
                          <th>Produccion</th>
                          <th>Eficiencia</th>
                          <th>DesNoRec</th>
                          <th>DesRecu</th>
                          <th>T-Prod</th>
                        </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      @foreach($registroProduccion as $registrohoras)
                        <tr>
                                <td >{{ $registrohoras->turno }}</td>
                                <td >{{Carbon\Carbon::parse( $registrohoras->fhoraini)->format('d-m-Y H:i:s') }}</td>
                                <td >{{Carbon\Carbon::parse( $registrohoras->fhorafin)->format('d-m-Y H:i:s') }}</td> 
                                <td>{{ number_format($registrohoras->METATURNO ,2)}}</td>
                                <td>{{ number_format($registrohoras->PRODUCCION,2) }}</td>
                                <td>{{ $registrohoras->EFICIENCIA }}</td>
                                <td>{{ number_format($registrohoras->DESPERDICIONORECU ,2)}}</td>
                                <td>{{ number_format($registrohoras->DESPERDICIORECU,2) }}</td>
                                <td>{{ number_format($registrohoras->TOTAL,2) }}</td>
                              
                               
                               
                        </tr>
                      @endforeach
                     
                    </tbody>
                     <tfoot>
                      <tr>
                          <th></th> 
                          <th></th>
                         
                          <th>Totales</th>
                          <th>{{number_format($meta,2)}}</th>
                          <th>{{number_format($produccion,2)}}</th>
                          @if($meta==0)
                          <th>0.00 </th>
                          @else
                          <th>{{number_format((($produccion/$meta)*100),2)}} </th>
                          @endif
                          <th>{{number_format($desno,2)}}</th>
                          <th>{{number_format($desrec,2)}}</th>
                          <th>{{number_format($total,2)}}</th>     
                      </tr>
                    </tfoot>
                   
                  </table>
                </div>

               @if(is_null($produccionnoregistrada)|| empty($produccionnoregistrada))
            <p>.</p>
                 @else
 
                  @include('ControPiso.Consulta.Ordenproduccion.RegistroproduccionNoregistrada')
              @endif

    
  


                <h1 align="center">REGISTRO DE HORAS </h1>
                <div class="table-responsive" >
                  <table class="table table-sm"   >
                    <thead>
                        <tr>
                          <th>Turno</th>
                          <th>Fecha Inicio</th>
                          <th>Fecha</th>
                          <th>Clave</th>
                          <th>Operacion</th>
                          <th>Hora Inicio</th>
                          <th>Hora Fin</th>
                          <th>Tiempo</th>
                          <th>Comentarios</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                      @foreach($registroHoras as $registrohoras)
                        <tr>

                                <td >{{ $registrohoras->turno }}</td> 
                                <td >{{Carbon\Carbon::parse( $registrohoras->fhoraini)->format('d-m-Y H:i:s') }}</td> 
                                <td >{{Carbon\Carbon::parse( $registrohoras->fhorafin)->format('d-m-Y H:i:s') }}</td> 
                                <td>{{ $registrohoras->CLAVE }}</td> 
                                <td >{{ $registrohoras->OPERA }}</td>
                                <td>{{$registrohoras->HORAINICIO}}</td>
                                <td>{{ $registrohoras->HORAFIN }}</td>
                                <td>{{ $registrohoras->TIEMPO }}</td>
                                <td>{{ $registrohoras->COMENTARIOS }}</td>
                               
                              
                               
                               
                        </tr>
                      @endforeach
                    
                    </tbody>
                    
                  </table>
                </div>
                       
                     @if(is_null($horasnoregistradas) || empty($horasnoregistradas) )
                     <p></p>
                     @else
                    
                     @include('ControPiso.Consulta.Ordenproduccion.RegistroHorasNoregistrada')
                  @endif

                <h1 align="center">REGISTRO DE MANO OBRA </h1>
                <div class="table-responsive" >
                  <table class="table table-sm"    >
                    <thead>
                        <tr>
                          <th>Turno</th>
                          <th>Fecha Inicial</th>
                          <th>Fecha Final</th>
                          <th>Empleado</th>
                          <th>Nombre</th>
                         
                          <th>Rol</th>
                          <th>Participacion</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                      @foreach($registroEmpleados as $registroEmpleados)
                        <tr>

                                <td >{{ $registroEmpleados->turno }}</td> 
                                <td>{{Carbon\Carbon::parse( $registroEmpleados->fhoraini)->format('d-m-Y H:i:s')  }}</td> 
                                <td >{{Carbon\Carbon::parse( $registroEmpleados->fhorafin)->format('d-m-Y H:i:s')  }}</td>
                                <td>{{ $registroEmpleados->EMPLEADO}}</td>
                                <td>{{ $registroEmpleados->NOMBRE }}</td>
                                
                                <td>{{ $registroEmpleados->ROL }}</td>
                                <td>{{ $registroEmpleados->PARTICIPACION }}</td>   
                              
                               
                               
                        </tr>
                      @endforeach
                    </tbody>
                   
                  </table>
                </div>
                   @if(is_null($empleadonoregistados) || empty($empleadonoregistados))
            <p>.</p>
                 @else
 
                  @include('ControPiso.Consulta.Ordenproduccion.RegistroEmpleadoNoregistrado')
              @endif
                <h1 align="center">REGISTRO CONSUMOS </h1>
                <div class="table-responsive" >
                  <table class="table table-sm"    >
                    <thead>
                        <tr>
                          <th>Articulo</th>
                          <th>Descripcion</th>
                          <th>Cant.Con </th>
                          <th>Cant.Via </th>
                          <th>Proceso</th>
                          <th>Entregada</th>
                          <th>Recibida</th>
                          <th>Comentarios</th>
                        </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                      @foreach($registroConsumos as $registroConsumos)
                        <tr>
                                <td >{{ $registroConsumos->articulo }}</td> 
                                <td>{{ $registroConsumos->descripcion }}</td> 
                                <td >{{number_format( $registroConsumos->cantidad ,2)}}</td>
                                <td >{{number_format( $registroConsumos->cantidad_viajero ,2)}}</td>
                                <td>{{ $registroConsumos->operacion}}</td>
                                <td>{{ $registroConsumos->entregada }}</td>
                                <td>{{ $registroConsumos->recibida }}</td>
                                <td>{{ $registroConsumos->comentarios }}</td>
                                 
                              
                               
                               
                        </tr>
                      @endforeach
                    </tbody>
                      <tfoot>
                      <tr>
                        <th>Articulo</th>
                          <th>Descripcion</th>
                          <th>{{number_format($totalConsumo,2)}} </th>
                          <th>{{number_format($totalviajero,2)}} </th>
                          <th>Proceso</th>
                          <th>Entregada</th>
                          <th>Recibida</th>
                          <th>Comentarios</th>
                      </tr>
                    </tfoot>
                   
                  </table>
                </div>
            </div>
          
            

         </div>
      </div>
  </div>       
  







@endsection