//Consulta de Pedidos
$(document).ready(function(){
    document.getElementById('turnoad').style.display='none';
    $('#showModal').on('hidden.bs.modal',function(e){
       $(this).removeData();
    });
    $('#id_pedido').on('change',function () {
      var id =$('#id_pedido').val();
      var urlraiz=$("#url_raiz_proyecto").val();
      var miurl =urlraiz+"/ConsultaPedidos/"+id+"";
      $.ajax({
        url:miurl
      }).done(function(data){
         var content=JSON.parse(data);
        $("#nombrecliente").val(content[0].DESC_DIREC_EMBARQUE);
        $("#Pais").val(content[0].PAIS);
        $("#fecharequerida").val(content[0].FECHA_PROMETIDA);
      }) 
    });
    //Consulta de Centro de Costo
    $('#id_centrocosto').on('change',function () {
      var id =$('#id_centrocosto').val();
      var id2=$('#articulo').val();
      var id3=$('#Mid_opera').val();
      var urlraiz=$("#url_raiz_proyecto").val();
      var miurl =urlraiz+"/ConsultaMaquina/";
      var nf=new Intl.NumberFormat(); 
      $.ajax({
        url:miurl,
        type:'get',
        data:{"id":id,"id2":id2,"id3":id3}
      }).done(function(data)
      {   
        var content=JSON.parse(data);  
        if((content[0].CP_TIEMPOCAMBIOMOLDE)==0.00){
          piezaxh=parseInt((content[0].HORASXHORA));
          total=piezaxh;
        }else{
          piezaxh=parseInt((content[0].HORASXHORA));
          tiempomolde=parseInt((content[0].CP_TIEMPOCAMBIOMOLDE));
          total=piezaxh+tiempomolde;
        }
        $("#idm_tiempocm").val( content[0].CP_TIEMPOCAMBIOMOLDE);
        $("#idm_cantidadxh").val(total);  
        var vcantidadaproducir=$("#id_cantidad").val();
        var vcantixturno=total;    //$('#piezaxhora').val();
        r=vcantixturno*8;// piezas por turno   
        v01= parseFloat(vcantidadaproducir).toFixed(2) ;
        v04=parseFloat(vcantixturno).toFixed(2) ;
        v02=parseFloat(r);
        v03=Math.round(v01/v04);
        v05=Math.round(v03/8);
        $("#idm_totalhoras").val(v03);
        $("#idm_totalturnos").val(v05);
      })
    });
    //Cambiar el Tiempo del Molde
    $('#idm_tiempocm').on('change',function () {
      //procedemos a ver el valor Tiempo de cambio de Molde 
      var nuevovalor=$("#idm_tiempocm").val();
      var totalhoras=$("#idm_totalhoras").val();
      if(nuevovalor==0){
        $("#idm_totalhoras").val(totalhoras);
        var total=totalhoras;
      }else{
        v01=parseInt(nuevovalor);
        v02=parseInt(totalhoras);   
        var total=v01+v02;
        $("#idm_totalhoras").val(total);
      } 
      v01=parseInt(nuevovalor);
      v02=parseInt(totalhoras);   
      var total=v01+v02;
      $("#idm_totalhoras").val(total);
      v04=total ;
      v05=Math.round(v04/8);
      $("#idm_totalturnos").val(v05);
    //fin   
    });
    //Cambiar Unidades por Hora
    $('#idm_cantidadxh').on('change',function (){
    //procedemos a ver el valor Tiempo de cambio de Molde 
    var nuevovalor=$("#idm_cantidadxh").val();
    var cambiomolde=$("#idm_tiempocm").val();
    if(nuevovalor==0){
      alert('No puede quedar Cero')
      $("#idm_cantidadxh").val(nuevovalor);
      var total=nuevovalor;
    }else{
      v01=parseInt(nuevovalor);
      if(cambiomolde==0){
        v02=0.00;
      }else{
        v02=parseInt(cambiomolde);  
      }
      var total=v01+v02;
      $("#idm_cantidadxh").val(total);
    } 
    var vcantidadaproducir=$("#id_cantidad").val();
    var vcantixturno=total;    //$('#piezaxhora').val();
    r=vcantixturno*8;// piezas por turno
    v01= parseFloat(vcantidadaproducir).toFixed(2) ;
    v04=parseFloat(vcantixturno).toFixed(2) ;
    v02=parseFloat(r);
    v03=Math.round(v01/v04);
    v05=Math.round(v03/8);
    $("#idm_totalhoras").val(v03);
    $("#idm_totalturnos").val(v05);
    //fin   
    });
    $('#piezaxhora').keyup(function(){ 
      var vcantixturno=document.getElementById('piezaxhora').value;    //$('#piezaxhora').val();
      var vcantidadaproducir=document.getElementById('cantidadaproducir').value;  //$('#cantidadaproducir').val();
      r=vcantixturno*8;// piezas por turno
      v01= parseFloat(vcantidadaproducir).toFixed(2) ;
      v02=parseFloat(r);
      v03=Math.round(v01/v02);
      document.getElementById("piezaxturno").value=r;
      document.getElementById("cantidadturnos").value=v03;   
    })
    });
    $('#cantidadaproducir').keyup(function(){
      var vcantixturno=document.getElementById('piezaxhora').value;    //$('#piezaxhora').val();
      var vcantidadaproducir=document.getElementById('cantidadaproducir').value;  //$('#cantidadaproducir').val();
      r=vcantixturno*8;// piezas por turno
      v01= parseFloat(vcantidadaproducir).toFixed(2) ;
      v02=parseFloat(r);
      v04=v01/v02;
      v03=Math.round(v04);
      //r2 = vcantidadaproducir/r; //turnos necesarios
      document.getElementById("piezaxturno").value=r;
      document.getElementById("cantidadturnos").value=v03;
    });
    // Boton de Planificacion
    $('#planificar').click(function(){ 
      eliminarFilas();
      ValdiarCampos();
      procesos2();
      var dataString=$('#form_planificacion').serialize();
      var id8=document.getElementById('id_ficha').value;
      var vcantidadaproducir=document.getElementById('id_cantidad').value;  
      id2= parseFloat(vcantidadaproducir).toFixed(2) ;  
      var id=$("#idm_totalhoras").val();//total de horas
      var id3=$("#Mid_opera").val();// operacion a realizar
      var id4=document.getElementById('id_fecha').value;//fecha selecionada
      var id5=document.getElementById('id_hora').value;// hora selecionada
      var id6=document.getElementById('id_centrocosto').value;//maquina a utilizar
      var id7=$("#idm_totalturnos").val();
      var id9=document.getElementById('idm_tiempocm').value;
      var urlraiz=$("#url_raiz_proyecto").val();
      var miurl =urlraiz+"/planificar/"; 
      var d='<tr>'+
       '<th>No</th>'+
       '<th>Centro Costo</th>'+
       '<th>Fecha</th>'+
       '<th>Hora Inicio</th>'+
       '<th>Hora Fin</th>'+
       '<th>Horas</th>'+
       '<th>Cantidad</th>'+
       '<th>Turno</th>'+
       '<th>Operacion</th>'+
       '</tr>';
      $.ajax({
        url:miurl,
        data:dataString,
      }).done(function(data){ 
        var valor=data 
        if(valor==1){
          alert("No Existe Disponibilidad para esta Fecha");
        }else{ 
          $no=0 
          $acumulado=0
          v01= parseFloat(vcantidadaproducir).toFixed(2) ;
          $variable= id3;
          $variable=$variable.replace(/,/g,""); 
          $variable=parseFloat($variable);
          var nf=new Intl.NumberFormat();
          var df=new Intl.DateTimeFormat("en-US");
          var content=JSON.parse(data);
          for(var i=0;i<content.length;i++){
              $no=$no+1
              $acumulado=$variable+$acumulado  ;
              if($no==id7){
                $x=vcantidadaproducir-$acumulado;
                id3=$variable+$x
                id3=nf.format(id3);
              }else{
                id3=nf.format($variable);
              }   
              id3=$("#idm_cantidadxh").val();  
              id3=id3*content[i].horas;  
              id3=parseFloat(id3).toFixed(2);
              if(content[i].turno=='1'){
                d+='<tr>'+
                '<td bgcolor="#FF0000" >'+$no+'</td>'+
                '<td bgcolor="#FF0000">'+content[i].centrocosto+'</td>'+
                '<td bgcolor="#FF0000">'+moment(content[i].fecha).format('DD/MM/YYYY')+'</td>'+
                '<td bgcolor="#FF0000">'+content[i].thoraini+'</td>'+
                '<td bgcolor="#FF0000">'+content[i].thorafin+'</td>'+
                '<td bgcolor="#FF0000">'+content[i].horas+'</td>'+
                '<td bgcolor="#FF0000" Align="right" >'+formatNumber.new(content[i].cantidad)+'</td>'+
                '<td bgcolor="#FF0000">'+content[i].turno+'</td>'+
                '<td bgcolor="#FF0000">'+content[i].operacion+'</td>'+
                '</tr>';
              }  
              if(content[i].turno=='4'){
                d+='<tr>'+
                '<td bgcolor="#E6E6FA" >'+$no+'</td>'+
                '<td bgcolor="#E6E6FA">'+content[i].centrocosto+'</td>'+
                '<td bgcolor="#E6E6FA">'+moment(content[i].fecha).format('DD/MM/YYYY')+'</td>'+
                '<td bgcolor="#E6E6FA">'+content[i].thoraini+'</td>'+
                '<td bgcolor="#E6E6FA">'+content[i].thorafin+'</td>'+
                '<td bgcolor="#E6E6FA">'+content[i].horas+'</td>'+
                '<td bgcolor="#E6E6FA" Align="right" >'+formatNumber.new(content[i].cantidad)+'</td>'+
                '<td bgcolor="#E6E6FA">'+content[i].turno+'</td>'+
                '<td bgcolor="#E6E6FA">'+content[i].operacion+'</td>'+
                '</tr>';
              }  
              if(content[i].turno=='3'){
                d+='<tr>'+
                '<td bgcolor="#00FF00" >'+$no+'</td>'+
                '<td bgcolor="#00FF00">'+content[i].centrocosto+'</td>'+
                '<td bgcolor="#00FF00">'+moment(content[i].fecha).format('DD/MM/YYYY')+'</td>'+
                '<td bgcolor="#00FF00">'+content[i].thoraini+'</td>'+
                '<td bgcolor="#00FF00">'+content[i].thorafin+'</td>'+
                '<td bgcolor="#00FF00">'+content[i].horas+'</td>'+
                '<td bgcolor="#00FF00" Align="right"  >'+formatNumber.new(content[i].cantidad)+'</td>'+
                '<td bgcolor="#00FF00">'+content[i].turno+'</td>'+
                '<td bgcolor="#00FF00">'+content[i].operacion+'</td>'+
                '</tr>';
              }    
              if(content[i].turno=='2'){
                d+='<tr>'+
                '<td bgcolor="#FFFF00">'+$no+'</td>'+
                '<td bgcolor="#FFFF00">'+content[i].centrocosto+'</td>'+
                '<td bgcolor="#FFFF00">'+moment(content[i].fecha).format('DD/MM/YYYY')+'</td>'+
                '<td bgcolor="#FFFF00">'+content[i].thoraini+'</td>'+
                '<td bgcolor="#FFFF00">'+content[i].thorafin+'</td>'+
                '<td bgcolor="#FFFF00">'+content[i].horas+'</td>'+
                '<td bgcolor="#FFFF00" Align="right" >'+formatNumber.new(content[i].cantidad)+'</td>'+
                '<td bgcolor="#FFFF00">'+content[i].turno+'</td>'+
                '<td bgcolor="#FFFF00">'+content[i].operacion+'</td>'+
                '</tr>';
              }            
            }
            $("#tabla").append(d);
              document.getElementById('guardar').style.visibility='visible';
          } 
        $('#showModal').modal('hide');
      })
    });
    
    function procesos2()
    {
    var id= document.getElementById("articulo").value;
    var urlraiz=$("#url_raiz_proyecto").val();
    var miurl =urlraiz+"/planificador/procesos";
    $.ajax({
      type:'get',
      url:miurl,
      data:{id:id},
      success:function(resul){
        $("#procesos").val(resul);
      }
     });
    }
    
    function eliminarFilas()
    {
    var Parent =document.getElementById("tabla");
    while(Parent.hasChildNodes())
     {
      Parent.removeChild(Parent.firstChild);
     }
    };
    
    function ValdiarCampos()
    {
      var pedido=$('#id_pedido').val();
      var ficha=$('#id_ficha').val();
      if(pedido=="0" ){
        alert(' Tiene que Selecionar un  pedido');
        return false;
      }
      if(ficha=="0" ){
        alert(' Tiene que Selecionar un  cliente');
        return false;
      } 
    }
    
    function ValdiarCampos2()
    {
      var ficha=$('#id_ficha').val();
      if(ficha=="0" ){
        alert(' Tiene que Selecionar un  cliente');
        return false;
      }
    }
    
    function ValidarCkecked()
    {
      if($(this.normal).prop('checked')){ 
        $('.admin').prop('checked',false);
      }else{
        $('.admin').prop('checked',true);
      }
    }
    
    function ValidarAdmin()
    {
     if($(this.admin).prop('checked')){
      $('.turno').prop('checked',false);
      document.getElementById('turnoad').style.display='block';
      document.getElementById('turnoa').style.display='none';
      document.getElementById('turnob').style.display='none';
      document.getElementById('turnoc').style.display='none'; 
     }else{
      $('.turno').prop('checked',true);
      document.getElementById('turnoad').style.display='none';
      document.getElementById('turnoa').style.display='block';
      document.getElementById('turnob').style.display='block';
      document.getElementById('turnoc').style.display='block';
     }
    }
    
    function ValidarTurnoa()
    {
      if($(this.turnoA).prop('checked')){
        document.getElementById('turnoa').disabled=false;
        document.getElementById('turnoa').style.display='block';
      }else{
        document.getElementById('turnoa').disabled=true;
        document.getElementById('turnoa').style.display='none';
      }
    }
    
    function ValidarTurnob()
    {
      if($(this.turnoB).prop('checked')){
        document.getElementById('turnob').disabled=false;
        document.getElementById('turnob').style.display='block';
      }else{  
        document.getElementById('turnob').disabled=true;
        document.getElementById('turnob').style.display='none';
      }
    }
    
    function ValidarTurnoc()
    {
      if($(this.turnoC).prop('checked')){
        document.getElementById('turnoc').disabled=false;
        document.getElementById('turnoc').style.display='block';
      }else{
        document.getElementById('turnoc').disabled=true;
        document.getElementById('turnoc').style.display='none';
      }  
    }  
    
    
    function modal(btn)
    {
    //alert (btn.value);
     $("#operacion").val('hola');
     $("#showModal").modal('show');
    }
    
    $(document).on('click','.show-modal',function(e){
      //ValdiarCampos(); 
      if(ValdiarCampos()==false){
        $('#showModal').modal('hide');
      }else{
        var art=document.getElementById("articulo").value;// ARTICULO
        var ope=$(this).data('id');// OPERACION
        var ope2=$(this).data('id2');
        var sec=$(this).data('title');
        kg(art,ope);
        AppendMaquinas(art,ope);
        $('#Mid_opera').val(ope2);
        $('#id_articulo').val(art);
        $('#id_secuencia').val(sec);
        $('#showModal').modal('show');
      }
    });
    
    $(function(){
      $('#showModal').on('hidden.bs.modal',function(e){
        $(this).removeData();
      });
    });
    
    function kg(art,ope)
    {
      var cant=document.getElementById("id_cantidadaproducir").value;
      var urlraiz=$("#url_raiz_proyecto").val();
      var miurl =urlraiz+"/kilosArticulo/";
      $.ajax({
        type:'get',
        url:miurl,
        data:{"art":art,"ope":ope}
        }).done(function(data){
        var content=JSON.parse(data);  
        kilos=content[0].KILOS;
        cant2=cant*kilos;
        $('#id_cantidad').val(cant2);
        });
    }
    
    function TurnosMaquina(equipo)
    {
     /*
       var urlraiz=$("#url_raiz_proyecto").val();
      var miurl =urlraiz+"/TurnoEquipo/";
      $.ajax({
        url:miurl,
        type:'get',
        data:{"equipo":equipo}
      }).done(function(data){
         var content=JSON.parse(data);
         $.each(content,function(i,item){
           if((content[i].ATRIBUTO)=='TURNOA'){
             document.getElementById('turnoa').disabled=false;
             document.getElementById('turnoa').style.display='block';
           }
         });
    
      });
    */
    }
    
    function AppendMaquinas(art,ope)
    {
      var dropDown = document.getElementById("id_centrocosto");
      dropDown.selectedIndex = 0;
      var urlraiz=$("#url_raiz_proyecto").val();
      var miurl =urlraiz+"/ListarArticuloOperacion/";
      $ciudaditems = $('.cityItems').remove();
      $.ajax({
        url:miurl,
        type:'get',
        data:{"art":art,"ope":ope}    
      }).done(function(data){
        var content=JSON.parse(data);
        $.each(content,function(i,item){
          $('#id_centrocosto').append('<option value="'+content[i].RUBRO+'"class="cityItems">'+content[i].RUBRO+"-"+content[i].DESCRIP_RUBRO +'</option>' );
            if((content[0].CP_TIEMPOCAMBIOMOLDE)==0.0){
              piezaxh=parseInt((content[0].HORASXHORA));
              total=piezaxh;
            }else{
              piezaxh=parseInt((content[0].HORASXHORA));
              tiempomolde=parseInt((content[0].CP_TIEMPOCAMBIOMOLDE));
              total=piezaxh+tiempomolde;
            }
          $("#idm_tiempocm").val( content[0].CP_TIEMPOCAMBIOMOLDE);
          $("#idm_cantidadxh").val(total);
          var vcantidadaproducir=$("#id_cantidad").val();
          var vcantixturno=total;    //$('#piezaxhora').val();
          r=vcantixturno*8;// piezas por turno
          v01= parseFloat(vcantidadaproducir).toFixed(2) ;
          v04=parseFloat(vcantixturno).toFixed(2) ;
          v02=parseFloat(r);
          v03=Math.round(v01/v04);
          v05=Math.round(v03/8);
          $("#idm_totalhoras").val(v03);
          $("#idm_totalturnos").val(v05);
              //f=moment(content[0].fechamax).format('YYYY-MM-DD');  
          f=moment(content[0].fechamax).format('YYYY-MM-DD');
          h=moment(content[0].fechamax).format('HH:m');  
          $("#id_fecha").val(f);
          $("#id_hora").val(h);
          TurnosMaquina(content[0].RUBRO);
        });
      });
    }