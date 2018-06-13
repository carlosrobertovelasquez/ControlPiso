@extends('layouts.app')

@section('htmlheader_title')
    Fichas Tecnica INSERTADO
@endsection
@section('contentheader_title')
   Ficha Tecnica INSERTADO
@endsection


@section('main-content')

<section class="content">
  <form  id="form_registrohoras" role="search" action="#" method="GET" >
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          @include('ControlCalidad.Ficha_Tecnica.insertado.layouts.especificacion')
          @include('ControlCalidad.Ficha_Tecnica.insertado.layouts.informacion_producto')
          @include('ControlCalidad.Ficha_Tecnica.insertado.layouts.insertado')
          @include('ControlCalidad.Ficha_Tecnica.insertado.layouts.soporte')
          @include('ControlCalidad.Ficha_Tecnica.insertado.layouts.fibra_alambre')
          @include('ControlCalidad.Ficha_Tecnica.insertado.layouts.Dimension_cepillo')
          @include('ControlCalidad.Ficha_Tecnica.insertado.layouts.bolillo')
          @include('ControlCalidad.Ficha_Tecnica.insertado.layouts.corrugado')

   
    

   
    
     

    

     

      

     
    
  

    @if(is_null($ft_gancho))
            <p>.</p>
        @else
 
    @include('ControlCalidad.Ficha_Tecnica.insertado.layouts.alambre')
    @endif
    
    
</div>     

   
   

 </form> 
</section>




@endsection





@section('script2')


<script>


 </script>
@endsection