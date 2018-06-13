<form  role="search" action="#" method="GET" >
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
                          <input  type="text" class="form-control" id="descripcion_art"  name="descripcion_id"  value="{{$ft_ficha->DESCRIPCION_ART}}" >      
                    </div>
                </div>
                <div class="form-group">
                        <label>PAIS : </label>
                        <input id="pais" name="pais" type="text" class="form-control" value="{{$ft_ficha->PAIS}}"  >
                </div> 
               

                <div class="form-group">
                    <div class="form-group">
                          <label > CODIGO DUN : </label>
                          <input  type="text" class="form-control" id="codigo_dun"  name="codigo_dun"  value="{{$ft_ficha->CODIGO_DUN}}" >      
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group">
                          <img src="{{$ft_ficha->IMAGEN_CODIGODUN}}" width="250"> 
                    </div>
                </div>
                <div class="modal-footer">
				<input  type="submit" class="btn btn-primary" value="GUARDAR">
               
			</div>


        </div>
             <div class="col-md-6">
             	<div class="form-group">
                        <label>CODIGO PRODUCTO : </label>
                        <input id="articulo" name="articulo" type="text" class="form-control" value="{{$ft_ficha->ARTICULO}}"  >
                </div>
                <div class="form-group">
                        <label>CLIENTE : </label>
                        <input id="cliente" name="cliente" type="text" class="form-control" value="{{$ft_ficha->CLIENTE}}"  >
                </div>
                
                <div class="form-group">
                    <div class="form-group">
                          <label > CODIGO BARRA : </label>
                          <input  type="text" class="form-control" id="codigo_barra"  name="codigo_barra"  value="{{$ft_ficha->CODIGO_BARRA}}" >      
                    </div>
                </div>     

                <div class="form-group">
                    <div class="form-group">
                          <img src="{{$ft_ficha->IMAGEN_CODIGODUN}}" width="250"> 
                    </div>
                </div>    
                       
             </div>     
 

        </div>

    </div>
    </form>