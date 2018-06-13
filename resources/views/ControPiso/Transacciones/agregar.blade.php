<div class="modal fade" id="editComment{{ $modal}}" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
				<h4> PLANIFICARRRRR</h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
				    <div class="row">
				    	<div class="col-md-6">
	                        <div class="form-group">
						 		<label>Order Produccionn </label>
						 		<input id="norden" name="norden" type="text" class="form-control" value="{{ $ordenproduccion->ORDEN_PRODUCCION}}" 	readonly="readonly" >
	                        </div>
				            <div class="form-group">
			                    <label>Cantidad a Producir </label>
			                    <input type="text" id="cantidadaproducir" name="cantidadaproducir" class="form-control" value=" {{ ($ordenproduccion->CANTIDAD_ARTICULO-$ordenproduccion->CANTIDAD_PRODUCCI)}}" readonly="readonly">
	                        </div>

							<div class="form-group">
			                    <label>Centro Costo </label>
			                    <select id="centrocosto" class="form-control">
			                    	<option value="0"> 501</option>
			                    	
			                    </select>
			                    
	                        </div>

	                        <div class="form-group">
			                    <label>Tiempo por Cambio Molde  </label>
			                    <input type="text" id="operacion" name="operacion" class="form-control" >
	                        </div>
	                        <div class="form-group">
			                    <label>Horario Estandar </label>
			                    <input type="text" id="operacion" name="operacion" class="form-control">
	                        </div>
	                        <div class="form-group">
			                    <label>L M K J V S D</label>
			                    <input type="text" id="operacion" name="operacion" class="form-control" >
	                        </div>
	                    </div>

	                    <div class="col-md-6">
	                        <div class="form-group">
						 		<label>Articulo A Producir </label>
						 		<input id="norden" name="norden" type="text" class="form-control" value="{{ $ordenproduccion->ORDEN_PRODUCCION}}" 	readonly="readonly" >
	                        </div>
				            <div class="form-group">
			                    <label >Operacion </label>
			                    <input type="text" id="id_opera" name="id_opera" class="form-control"  value="{{$centrocosto->DESCRIPCION}}" readonly="readonly">
	                        </div>

							<div class="form-group">
			                    <label>Cantidad por Hora</label>
			                    <input type="text" id="cantidadaproducir" name="cantidadaproducir" class="form-control" >
	                        </div>

	                        <div class="form-group">
			                    <label>Turno Inicio </label>
			                    <input type="text" id="operacion" name="operacion" class="form-control" >
	                        </div>
	                        <div class="form-group">
			                    <label>Fecha Inicio </label>
			                    <input type="text" id="operacion" name="operacion" class="form-control" >
	                        </div>
	                        <div class="bootstrap-timepicker">
			                    <label>Hora Inicio</label>
			                    <input type="text" id="horainicio" class="form-control timepicker">
			                    
	                        </div>
	                    </div>    
                    </div>
                </div>   
			</div>
			
			<div class="modal-footer">
				<input type="submit" class="btn btn-primary" value="Planificar">
			</div>
		</div>
	</div>
</div>
