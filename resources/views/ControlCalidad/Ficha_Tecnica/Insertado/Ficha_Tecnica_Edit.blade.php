@extends('layouts.app')

@section('htmlheader_title')
    Fichas Tecnica Editar
@endsection
@section('contentheader_title')
   Ficha Tecnica Editar
@endsection


@section('main-content')

<section class="content">
  <form  id="form_registrohoras" role="search" action="#" method="GET" >
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          @include('ControlCalidad.Ficha_Tecnica.insertado.Edit.especificacion')
          @include('ControlCalidad.Ficha_Tecnica.insertado.Edit.informacion_producto')
          @include('ControlCalidad.Ficha_Tecnica.insertado.Edit.insertado')
          @include('ControlCalidad.Ficha_Tecnica.insertado.Edit.soporte')
          @include('ControlCalidad.Ficha_Tecnica.insertado.Edit.fibra_alambre')
          @include('ControlCalidad.Ficha_Tecnica.insertado.Edit.Dimension_cepillo')
          @include('ControlCalidad.Ficha_Tecnica.insertado.Edit.bolillo')
          @include('ControlCalidad.Ficha_Tecnica.insertado.Edit.corrugado')

   
    

   
    
     

    

     

      

     
    
  

    @if(is_null($ft_gancho))
            <p>.</p>
        @else
 
    @include('ControlCalidad.Ficha_Tecnica.insertado.Edit.alambre')
    @endif
    
    
</div>     

   
   

 </form> 
</section>




@endsection





@section('script2')


<script>


 </script>
@endsection