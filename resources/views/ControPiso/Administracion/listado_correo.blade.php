@extends('layouts.app')

@section('htmlheader_title')
    Correo
@endsection

@section('contentheader_title')
 Correo 
@endsection

@section('main-content')


  <div class="row">
      <div class="col-xs-12">
         
          <div class="box">
            <div class="box-header">
            
          
            <!-- /.box-header -->
                <div class="table-responsive" >
                  <table id="example1" class="display nowrap"    >
                    <thead>
                        <tr>
                          <th>ID</th>
                          <th>correo</th>
                          <th>Producion</th>
                          <th>Cambio estado</th>
                          <th>Liquidacion</th>
                          <th>Registro MA</th>
                          <th>Registo MO</th>
                          <th>Cierre de orden</th>
                          <th>Cambio de Fecha</th>
                         
                        </tr>
                    </thead>
                    <tbody>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                      @foreach($email as $email)
                        <tr>
                                <td >{{ $email->id}}</td>
                                <td >{{ $email->email}}</td>
                                <td >{{ $email->email01 }}</td> 
                                <td>{{ $email->email02 }}</td> 
                                <td>{{ $email->email03}}</td>
                                <td>{{$email->email04}}</td>
                                <td>{{$email->email05}}</td>
                                <td>{{$email->email06}}</td>
                                <td>{{$email->email07}}</td>
                               
                                
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                       <th>ID</th>
                          <th>correo</th>
                          <th>Producion</th>
                          <th>Cambio estado</th>
                          <th>Liquidacion</th>
                          <th>Registro MA</th>
                          <th>Registo MO</th>
                          <th>Cierre de orden</th>
                          <th>Cambio de Fecha</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
         </div>
      </div>
  </div>       
  







@endsection