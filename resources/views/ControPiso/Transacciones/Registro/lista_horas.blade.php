<table class="table table-sm">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Hora Inicio</th>
                      <th>Hora Fin</th>
                      <th>Tiempo</th>
                      <th>Clave</th>
                      <th>Tipo Clave</th>
                      <th>Comentarios</th>
                    </tr>
                  </thead>
                  <tbody>
   
                      @foreach($registrohoras as $registrohoras)
                        <tr id="fila">
                          <th>{{$registrohoras->ID}}</th>
                          <td>{{$registrohoras->HORAINICIO}}</td>
                          <td>{{$registrohoras->HORAFIN}}</td>
                          <td>{{$registrohoras->TIEMPO}}</td>
                          <td>{{$registrohoras->CLAVE}}</td>
                          <td>{{$registrohoras->OPERA}}</td>
                          <td>{{$registrohoras->COMENTARIOS}}</td>
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