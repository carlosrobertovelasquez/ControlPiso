<form  role="search" action="AgregarClave" method="GET" >
<div class="modal fade" id="addModal" role="dialog" >

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
				<h4> AGREGAR CLAVES</h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
				    <div class="row">
				    	<div class="col-md-6">
	                        <div class="form-group">
						 		<label>CLAVE </label>
						 		<input id="id_clave" name="id_clave" type="number" class="form-control"  	>
	                        </div>
				            <div class="form-group">
			                    <label>OPERACION </label>
			                    <select id="OPERACION" name="OPERACION">
                            <option value="SUMA">SUMA</option>
                            <option value="RESTA">RESTA</option>
                          </select>
	                        </div>
	                    </div>
	                    <div class="col-md-6">
				            <div class="form-group">
			                    <label >DESCIPCION </label>
			                    <input type="text" id="estado_show" name="id_opera" class="form-control"   >
	                        </div>
	                    </div>    
                    </div>
                </div>   
			</div>
			<div class="modal-footer">
				<input  type="submit" class="btn btn-primary" value="GUARDAR">
               
			</div>
		</div>
	</div>
</div>
</form>