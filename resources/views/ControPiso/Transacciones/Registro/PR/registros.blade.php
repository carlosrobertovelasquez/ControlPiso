<table class="table table-sm">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>orden Produccion</th>
                      <th>Articulo</th>
                      <th>Descripcion</th>
                      <th>Cantidad</th>
                      <th>Operacion</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
   
                      @foreach($listarproduccion as $listarproduccion)
                        <tr id="fila">
                          <td>{{$listarproduccion->id}}</td>
                          <td>{{$listarproduccion->orden_produccion}}</td>
                          <td>{{$listarproduccion->articulo}}</td>
                          <td>{{$listarproduccion->descripcion}}</td>
                          <td>{{number_format($listarproduccion->cantidad,2)}}</td>
                          <td>{{$listarproduccion->operacion}}</td>
                           <td>         
                           {!!Form::open(['route'=>['registro.eliminarproduccion2',$listarproduccion->id],'method'=>'GET'])!!}             
                            <a href="#"  class="btn-delete" onclick="eliminarproduccion({{$listarproduccion->id}})">
                              <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                            </a>
                           {!!Form::close()!!} 
                          </td>    

                        </tr>
                      @endforeach
                  </tbody>
                </table>