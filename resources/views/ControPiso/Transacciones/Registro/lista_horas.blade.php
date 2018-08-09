<table class="table table-sm">
                  <thead>
                    <tr>
                      <th>Hora Inicio</th>
                      <th>Hora Fin</th>
                      <th>Tiempo</th>
                      <th>Clave</th>
                      <th>SubClave</th>
                      <th>Tipo Clave</th>
                      <th>Comentarios</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
   
                      @foreach($registrohoras as $registrohoras)
                        <tr id="fila">
                          <td>{{$registrohoras->HORAINICIO}}</td>
                          <td>{{$registrohoras->HORAFIN}}</td>
                          <td>{{$registrohoras->TIEMPO}}</td>
                          <td>{{$registrohoras->CLAVE}}</td>
                          <td>{{$registrohoras->subclave}}</td>
                          <td>{{$registrohoras->OPERA}}</td>
                          <td>{{$registrohoras->COMENTARIOS}}</td>
                          <td>{{Carbon\Carbon::parse($registrohoras->FECHA)->format('d-m-Y')}}</td>
                           <td>         
                           {!!Form::open(['route'=>['registro.eliminar',$registrohoras->ID],'method'=>'GET'])!!}             
                            <a href="#"  class="btn-delete" onclick="eliminar({{$registrohoras->ID}})">
                              <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                            </a>
                           {!!Form::close()!!} 
                          </td>    

                        </tr>
                      @endforeach
                  </tbody>
                </table>