@extends('layouts.app')

@section('htmlheader_title')
    Fichas Tecnica EXTRUSION
@endsection
@section('contentheader_title')
   Ficha Tecnica EXTRUSION
@endsection


@section('main-content')

<section class="content">
  <form  id="form_registrohoras" role="search" action="#" method="GET" >
          <input type="hidden" name="_token" value="{{csrf_token()}}">
         
         
        

   
    

   
    
     

    

     

      

     
    
  

    @if(is_null($ft_ficha))
            <p>.</p>
        @else
 
        @include('ControlCalidad.Ficha_Tecnica.Extrusion.layouts.informacion_producto')
    @endif

    @if(is_null($ft_especificacion))
            <p>.</p>
        @else
 
        @include('ControlCalidad.Ficha_Tecnica.Extrusion.layouts.especificacion')
    @endif
  


    
    
</div>     

   
   

 </form> 
</section>




@endsection





@section('script2')


<script>


 </script>
@endsection