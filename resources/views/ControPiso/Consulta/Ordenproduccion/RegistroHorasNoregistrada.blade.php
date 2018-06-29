

 <h1 align="center">HORAS NO REGISTRADAS </h1>
                <div class="table-responsive" >
                  <table class="table table-sm"   >
                    <thead>
                        <tr>
                          <th>Turno</th>
                          <th>Fecha Inicio</th>
                          <th>Fecha Fin</th>
                          <th>Horas</th>
                          
                        
                        </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                      @foreach($horasnoregistradas as $registrohoras)
                        <tr>
                         
                                <td >{{ $registrohoras->turno }}</td> 
                                <td >{{Carbon\Carbon::parse( $registrohoras->fhoraini)->format('d-m-Y H:i:s') }}</td> 
                                <td >{{Carbon\Carbon::parse( $registrohoras->fhorafin)->format('d-m-Y H:i:s') }}</td> 
                                <td>{{ $registrohoras->horas }}</td> 
                                
                               
                              
                               
                               
                        </tr>
                      @endforeach
                    
                    </tbody>
                    
                  </table>
                </div>
   