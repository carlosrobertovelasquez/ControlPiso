<h1 align="center">PRODUCCION PENDIENTE DE REGISTAR </h1>
            <!-- /.box-header -->
                <div class="table-responsive" >
                  <table class="table table-sm"   >
                    <thead>
                        <tr>
                          <th>Turno</th>
                          <th>Inicio</th>
                          <th>Fin</th>    
                          <th>Cantidad</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      @foreach($produccionnoregistrada as $registrohoras)
                        <tr>
                                <td >{{ $registrohoras->turno }}</td>
                                <td >{{Carbon\Carbon::parse( $registrohoras->fhoraini)->format('d-m-Y H:i:s') }}</td>
                                <td >{{Carbon\Carbon::parse( $registrohoras->fhorafin)->format('d-m-Y H:i:s') }}</td> 
                                <td>{{ number_format($registrohoras->cantidad ,2)}}</td>
                                
                               
                               
                        </tr>
                      @endforeach
                     
                    </tbody>
                    
                   
                  </table>
                </div>