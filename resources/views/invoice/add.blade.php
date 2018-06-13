@extends('layouts.app')

@section('htmlheader_title')
    Planificacion
@endsection


@section('main-content')

<div class="container">
<div class="row">
   <div class="col-md-12">
    <h2 class="page-header"></h2>
      Nuevo comprobante

<invoice> </invoice>
   </div>
</div>
  
</div>



@endsection

@section('script2')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <script src="{{asset('bower_components/riot/riot.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('bower_components/riot/riot+compiler.min.js')}}" type="text/javascript"></script>


<script src="{{asset('components/invoice.tag')}}" type="riot/tag"></script>

<script>
$(document).ready(function () {
    riot.mount('invoice');
})

</script>


@endsection



  





 


