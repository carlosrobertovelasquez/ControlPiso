<table class="table table-sm">
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


              