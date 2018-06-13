<div class="box box-default">
  	 	<div class="box-header with-border">
  	 		<h3 class="box-title"  >INFORMACION DE PRODUCTO</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
  	 	</div>

        <div class="box-body">
        <div class="col-md-6">
  	 		 	<div class="form-group">
                    <div class="form-group">
                          <label > PRODUCTO : </label>
                          <input  type="text" class="form-control" id="id_fecha"  name="id_fecha"  value="{{$ft_ficha->DESCRIPCION_ART}}" readonly="readonly">      
                    </div>
                </div>
                <div class="form-group">
                        <label>PAIS : </label>
                        <input id="id_articulo" name="id_articulo" type="text" class="form-control" value="{{$ft_ficha->PAIS}}" readonly="readonly" >
                </div> 
               

                <div class="form-group">
                    <div class="form-group">
                          <label > FECHA : </label>
                          <input  type="text" class="form-control" id="id_fecha"  name="id_fecha"  value="{{$ft_ficha->FECHA}}" readonly="readonly">      
                    </div>
                </div>


        </div>
             <div class="col-md-6">
             	<div class="form-group">
                        <label>CODIGO PRODUCTO : </label>
                        <input id="id_articulo" name="id_articulo" type="text" class="form-control" value="{{$ft_ficha->ARTICULO}}" readonly="readonly" >
                </div>
                <div class="form-group">
                        <label>CLIENTE : </label>
                        <input id="id_articulo" name="id_articulo" type="text" class="form-control" value="{{$ft_ficha->CLIENTE}}" readonly="readonly" >
                </div>
                
                <div class="form-group">
                    <div class="form-group">
                          <label > MAQUINA : </label>
                          <input  type="text" class="form-control" id="id_fecha"  name="id_fecha"  value="{{$ft_especificacion->MAQUINA1}}" readonly="readonly">      
                    </div>
                </div>              
             </div>     
 

        </div>
    </div>