<table class="table table-sm">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>NoPiezasXCiclo</th>
                      <th>MataXTurno</th>
                      <th>Produccion</th>
                      <th>%Eficiencia</th>
                      <th>Despe.Recu</th>
                      <th>Despe.NoRecu</th>
                      <th>Total</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
   
                      @foreach($registroproduccion as $registroproduccion)
                        <tr id="fila">
                          <th>{{$registroproduccion->ID}}</th>
                          <td>{{$registroproduccion->CICLOPIEZA}}</td>
                          <td>{{$registroproduccion->METATURNO}}</td>
                          <td>{{$registroproduccion->PRODUCCION}}</td>
                          <td>{{$registroproduccion->EFICIENCIA}}</td>
                          <td>{{$registroproduccion->DESPERDICIORECU}}</td>
                          <td>{{$registroproduccion->DESPERDICIONORECU}}</td>
                          <td>{{$registroproduccion->TOTAL}}</td>
                          <td>{{$registroproduccion->FECHA}}</td>
                           <td>         
                           {!!Form::open(['route'=>['registro.eliminarregistroproduccion',$registroproduccion->ID],'method'=>'GET'])!!}             
                            <a href="#"  class="btn-delete" onclick="eliminarregistroproduccion({{$registroproduccion->ID}})">
                              <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                            </a>
                           {!!Form::close()!!} 
                          </td>    

                        </tr>
                      @endforeach
                  </tbody>
                </table>