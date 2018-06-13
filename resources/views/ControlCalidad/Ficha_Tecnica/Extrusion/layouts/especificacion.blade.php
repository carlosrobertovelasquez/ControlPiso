<div class="box box-default">
  	 	<div class="box-header with-border">
  	 		<h3 class="box-title"  >ESPECIFICACION DE PRODUCTO</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
  	 	</div>

        <div class="box-body">
        <div class="col-md-6">
  	 		 	<div class="form-group">
                    <div class="form-group">
                          <label > COLOR : </label>
                          <input  type="text" class="form-control" id="id_fecha"  name="id_fecha"  value="{{$ft_especificacion->COLOR}}" readonly="readonly">      
                    </div>
                </div>
                <div class="form-group">
                        <label>LARGO : </label>
                        <input id="id_articulo" name="id_articulo" type="text" class="form-control" value="{{$ft_especificacion->LARGO}}" readonly="readonly" >
                </div> 
               

                <div class="form-group">
                    <div class="form-group">
                          <label > DIAMETRO : </label>
                          <input  type="text" class="form-control" id="id_fecha"  name="id_fecha"  value="{{$ft_especificacion->DIAMETRO_ART}}" readonly="readonly">      
                    </div>
                </div>


        </div>
             <div class="col-md-6">
             	<div class="form-group">
                        <label>ESTANDAR DE EMPAQUE : </label>
                        <input id="id_articulo" name="id_articulo" type="text" class="form-control" value="{{$ft_especificacion->ESTANDAR_EMPAQUE}}" readonly="readonly" >
                </div>
                <div class="form-group">
                        <label>TOLERANCIA : </label>
                        <input id="id_articulo" name="id_articulo" type="text" class="form-control" value="{{$ft_especificacion->TOLERANCIA1}}" readonly="readonly" >
                </div>
                
                <div class="form-group">
                    <div class="form-group">
                          <label > TOLERANCIA : </label>
                          <input  type="text" class="form-control" id="id_fecha"  name="id_fecha"  value="{{$ft_especificacion->TOLERANCIA2}}" readonly="readonly">      
                    </div>
                </div>              
             </div>     
 

        </div>
    </div>