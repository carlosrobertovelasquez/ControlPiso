@extends('layouts.app')

@section('htmlheader_title')
    Planificacion
@endsection


@section('main-content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
         <h2 class="page-header">
           Comprobante
         </h2>
         <a class="btn btn-default btn-lg btn-block" href="{{url('invoice/add')}}"> Nuevo Comprobante</a>
         <table class="table table-striped">
           <thaed>
             <tr>
               <th> cliente</th>
               <th style="width:160px;" class="text-right"> IVA </th>
               <th style="width:160px;" class="text-right"> Sub Total </th>
               <th style="width:160px;" class="text-right"> Total </th>
               <th style="width:160px;" class="text-right"> Creado </th>
             </tr>
           </thaed>
           <tbody>
           <?php  for ($i=1; $i <=10 ; $i++):?> 
              <?php 
                 $total     =1180 * $i;
                 $subtotal  =$total/1.10;
                 $iva       =$total-$subtotal;
              ?>
             <tr>
               <td> Cliente {{$i}}</td>
               <td class="text-right">{{number_format($iva,2)}}</td>
               <td class="text-right">{{number_format($subtotal,2)}}</td>
               <td class="text-right">{{number_format($total,2)}}</td>
               <td class="text-right">02/02/2017</td>
             </tr>
           <?php endfor;?>
           </tbody>
           
         </table>
        </div>
    </div>
</div>

@endsection





