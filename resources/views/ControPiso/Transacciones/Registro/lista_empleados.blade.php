<table class="table table-sm">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Codigo</th>
                      <th>Nombre</th>
                      <th>Rol</th>
                      <th>Participacion</th>
                      <th>Selecion</th>
                    </tr>
                  </thead>
                  <tbody>
   
                      @foreach($registroempleados as $registroempleados)
                        <tr id="fila">
                          <th>{{$registroempleados->ID}}</th>
                          <td>{{$registroempleados->EMPLEADO}}</td>
                          <td>{{$registroempleados->NOMBRE}}</td>
                          <td>{{$registroempleados->ROL}}</td>
                          <td>{{$registroempleados->PARTICIPACION}}</td>

                           <td>         
                           {!!Form::open(['route'=>['registro.eliminar',$registroempleados->ID],'method'=>'GET'])!!}             
                            <a href="#"  class="btn-delete" onclick="eliminaremple({{$registroempleados->ID}})">
                              <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                            </a>
                           {!!Form::close()!!} 
                          </td>    

                        </tr>
                      @endforeach
                  </tbody>
                </table>