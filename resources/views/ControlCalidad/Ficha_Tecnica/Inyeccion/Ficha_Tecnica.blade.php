@extends('layouts.app')

@section('htmlheader_title')
    Fichas Tecnica INYECCION
@endsection
@section('contentheader_title')
   Ficha Tecnica INYECCION
@endsection


@section('main-content')

<section class="content">
  <form  id="form_registrohoras" role="search" action="#" method="GET" >
          <input type="hidden" name="_token" value="{{csrf_token()}}">
         
         
        

   
    

   
    
     

    

     

      

     
    
  

    @if(is_null($ft_ficha))
            <p>.</p>
        @else
 
        @include('ControlCalidad.Ficha_Tecnica.Inyeccion.layouts.informacion_producto')
    @endif

    @if(is_null($ft_bolillo))
            <p>.</p>
        @else
 
        @include('ControlCalidad.Ficha_Tecnica.Inyeccion.layouts.bolillo')
    @endif
    @if(is_null($ft_corrugado))
            <p>.</p>
        @else
 
        @include('ControlCalidad.Ficha_Tecnica.Inyeccion.layouts.corrugado')
    @endif


    
    
</div>     

   
   

 </form> 
</section>




@endsection





@section('script2')


<script>


 </script>
@endsection