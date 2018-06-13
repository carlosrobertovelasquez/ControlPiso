@extends('layouts.app')

@section('htmlheader_title')
    Fichas Tecnica BOLILLOS
@endsection
@section('contentheader_title')
   Ficha Tecnica Bolillos
@endsection


@section('main-content')

  <div class="row">
         <div class="col-xs-12">
         
         <div class="box">
            
            
            
            <a href="#" class="add-modal"><span class="btn btn-primary" aria-hidden="true">ADICIONAR FICHA</span></a>            
            <!-- /.box-header -->
            <div class="box-body">
                      <div class="form-group">
             
                </div>
              <table id="example1" class="display compact"  style="width:100%" >
                <thead>
                <tr>
                  <th>Id</th>
				  <th>REVISION</th>
                  <th>ARTICULO</th>
                  <th>DESCRIPCION</th>
                  <th>FAMILIA</th>
				  <th>CLIENTE</th>
				  <th>PAIS</th>
                  <th>SELECIONAR</th>
                </tr>
                </thead>
                <tbody>
                   <?php
                        $modal=0;
                        ?>
                 {{csrf_field()}}       
                 
				 		

                       @foreach($ficha as $ficha)
               <tr>
                            <td>{{$ficha->id}}</td>
							<td>{{$ficha->REVISION}}</td>
                            <td>{{$ficha->ARTICULO}}</td>
                            <td>{{$ficha->DESCRIPCION}}</td> 
                            <td>{{$ficha->FAMILIA}}</td> 
							<td>{{$ficha->CLIENTE}}</td>
							<td>{{$ficha->PAIS}}</td>  
                            <td>
                              
							   <a href="{{route('Ficha_TecnicaBolillo',[$ficha->id])}}" 
							   class="btn btn-primary" title="Ver" ><span class="glyphicon glyphicon-search" ></span></a>
                 <a href="{{route('Ficha_TecnicaBolillo',[$ficha->id])}}" 
							   class="btn btn-primary"title="Editar" ><span class="glyphicon glyphicon-pencil" ></span></a>
                 <a href="{{route('Ficha_TecnicaBolillo',[$ficha->id])}}" 
							   class="btn btn-primary" title="Copiar" ><span class="glyphicon glyphicon-file"></span></a>
                             </td>                

               </tr>

                  @endforeach
                </tbody>
                <tfoot>
                <tr>
				<th>Id</th>
				  <th>REVISION</th>
                  <th>ARTICULO</th>
                  <th>DESCRIPCION</th>
                  <th>FAMILIA</th>
				  <th>CLIENTE</th>
				  <th>PAIS</th>
                  <th>SELECIONAR</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  


@endsection

@section('script2')
<script>

 



</script>

@endsection