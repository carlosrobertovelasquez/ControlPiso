<div class="box box-default">
  	 	<div class="box-header with-border">
  	 		<h2 class="box-title">ESPECIFICACION DE PRODUCTOS</h2>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
  	 	</div>

  	 	<div class="box-body">
  	 		<div class="col-md-6">
  	 		 	<div class="form-group">
                    <div class="form-group">
                          <label > FECHA : </label>
                          <input  type="text" class="form-control" id="id_fecha"  name="id_fecha"    value="{{$ft_ficha->FECHA}}" readonly="readonly" >      
                    </div>
                </div>
            </div>
             <div class="col-md-6">
             	<div class="form-group">
                        <label>REVISION : </label>
                        <input id="id_articulo" name="id_articulo" type="text" class="form-control" value="{{$ft_ficha->REVISION}}" readonly="readonly" >
                </div>               
             </div>
  	 	</div>

  	 </div>