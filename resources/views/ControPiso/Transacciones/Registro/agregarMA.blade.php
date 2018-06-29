<div class="modal fade" id="showModal" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
				<h4> ENTREGA DE MATERIALES</h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
				    <div class="row">
				    	<div class="col-md-6">
	                        <div class="form-group">
						 		<label>ORDEN DE PRODUCCION </label>
                                 <input type="text" id="id_ordenproduccion" name="id_ordenproduccion" class="form-control"   >
								 <input type="hidden" id="id_operacion" name="id_operacion"    >
								 <input type="hidden" id="id" name="id"    >
	                        </div>
                            <div class="form-group">
						 		<label>DESCRIPCION </label>
                                 <input type="text" id="id_descripcion" name="id_descripcion" class="form-control"   >
	                        </div>
                            <div class="form-group">
						 		<label>CANTIDAD ENTREGADA </label>
                                 <input type="number" id="id_cantidadentregada" name="id_articuloentregada" class="form-control"    >
	                        </div>
					    </div>
						

	                    <div class="col-md-6">
	                        <div class="form-group">
						 		<label>ARTICULO </label>
						 		<input id="id_articulo" name="id_articulo" type="text" class="form-control"  >
	                        </div>
                            <div class="form-group">
						 		<label>CANTIDAD SOLICITADA </label>
						 		<input id="id_cantidad" name="id_cantidad" type="number" class="form-control" 	 >
	                        </div>
                            <div class="form-group">
						 		<label>OPERACION </label>
						 		<select name="id_operacion1" id="id_operacion1" class="form-control">
                                 <option value='C'>Consumo</option>
                                 <option value='D'>Devolucion</option>
                                 <option value='A'>Anulacion</option>
                                 <option value='R'>Remision</option>
                                 </select>
	                        </div>
                        </div>
						<div class="col-md-2">

						 <div class="form-group" >
						  <textarea name="comentarios" id="comentarios" cols="88" rows="5"placeholder="Comentarios ......"></textarea>
			            </div>
						</div>
						
                    </div>   
                   
                 

			    </div>
				
				
				
			</div>
			
			<div class="modal-footer">
				<input type="button" onmouseover="this.backgroundColor='blue' "  style="width: 450px;height: 40px" 
				name="registroMA" id="registroMA"  onclick="registroMA2()" value="Registar Materiales"/>
			</div>
		</div>
	</div>
</div>
