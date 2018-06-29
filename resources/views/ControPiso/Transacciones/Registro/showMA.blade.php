
      
      <table   class="table table-condensed table-bordered table-hover" >
                  <thead>
                        <tr>
                        <th>ID</th>
                          <th>ORDEN PRODUCCION</th>
                          <th>ARTICULO</th>
                          <th>DESCRIPCION</th>
                          <th>CANTIDAD</th>
                          <th>PROCESO</th>
                          <th >COMENTARIOS</th>
                          <th width="125">Selecionar</th>
                        </tr>
                    </thead>
                    <tbody>
                         
                      
                      @foreach($cp_consumo as $cp_consumo)
                        <tr >
                        
                                <td >{{ $cp_consumo->id}}</td>
                                <td >{{ $cp_consumo->orden_produccion}}</td>
                                <td >{{ $cp_consumo->articulo}}</td>
                                <td >{{ $cp_consumo->descripcion}}</td>
                                <td >{{ number_format($cp_consumo->cantidad,2)}}</td>
                                <td >{{ $cp_consumo->operacion}}</td>
                                <td  >{{ $cp_consumo->comentarios}}</td>
                                <td>
                                
                                 <a href="#"  class="btn btn-primary"  title="Eliminar" onclick="eliminar({{$cp_consumo->id}})">
                                   <span class="glyphicon glyphicon-remove " aria-hidden="true"></span>
                                 </a>
                                
                                  @if($cp_consumo->aprobada=='N')
                                    <a href="#"  class="btn btn-primary"  title="Aprobar" onclick="aprobar({{$cp_consumo->id}})">
                                   <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                    </a>
                                  @elseif($cp_consumo->conforme=='N')
                                    <a href="#"  class="btn btn-primary"  title="Recibi Conforme" onclick="conforme({{$cp_consumo->id}})">
                                   <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
                                    </a>
                                  @endif
                                 
                                 
                               </td>
                        </tr>
                        @endforeach
                  </tbody>
               </table>
    
