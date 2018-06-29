 
  

 <h1 align="center">MANO DE OBRA NO REGISTRADA </h1>
                <div class="table-responsive" >
                  <table class="table table-sm"    >
                    <thead>
                        <tr>
                          <th>Turno</th>
                          <th>Fecha Inicial</th>
                          <th>Fecha Final</th>
                         
                         
                          
                        </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                      @foreach($empleadonoregistados as $registroEmpleados)
                        <tr>

                                <td >{{ $registroEmpleados->turno }}</td> 
                                <td>{{Carbon\Carbon::parse( $registroEmpleados->fhoraini)->format('d-m-Y H:i:s') }}</td> 
                                <td >{{Carbon\Carbon::parse( $registroEmpleados->fhorafin)->format('d-m-Y H:i:s') }}</td>
                              
                                
                              
                               
                               
                        </tr>
                      @endforeach
                    </tbody>
                   
                  </table>
                </div>
          