
$('#id_pedido').on('change',function () {

   var pedido =$('#id_pedido').val();

    var urlraiz=$("#url_raiz_proyecto").val();
    var form=$('#f_consultar_pedidos');

    var miurl =urlraiz+"/ConsultaPedidos/"+pedido+"";

    var data =form.serialize();

   $.post(miurl,data,function (result) {

     alert(result);
   })


})







