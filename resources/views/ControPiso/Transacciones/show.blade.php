<div class="modal fade" id="showModal" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
				<h4> PLANIFICAR</h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
				    <div class="row">
				    	<div class="col-md-6">
	                        <div class="form-group">
						 		<label>Order Produccion </label>
						 		<input id="idm_norden" name="idm_norden" type="text" class="form-control" value="{{ $ordenproduccion->ORDEN_PRODUCCION}}" 	readonly="readonly" >
	                        </div>
				            <div class="form-group">
			                    <label>Cantidad a Producir </label>
			                    <input type="text" id="id_cantidad"  class="form-control"  readonly="readonly">
			                    <input type="hidden" name="operacion" id="operacion">
	                        </div>

							<div class="form-group">
			                    <label>Centro Costo </label>
			                    <select id="id_centrocosto" name="id_centrocosto" class="form-control">
			                    	
			                    </select>
			                    
	                        </div>

	                        <div class="form-group">
			                    <label>Tiempo por Cambio Molde  </label>
			                    <input type="number" id="idm_tiempocm" name="idm_tiempocm" class="form-control" >
	                        </div>

	                       
	                       <div class="form-group">
                          <fieldset data-role="controlgroup" data-type="horizontal" >
                            <legend>Horarios </legend>
                            <label for="normal">Turno A</label>
							<input type="checkbox" name="turno" id="turnoA" value="A" class="turno" checked onclick="ValidarTurnoa()" >
							<label for="normal">Turno B</label>
							<input type="checkbox" name="turno" id="turnoB" value="B" class="turno" checked onclick="ValidarTurnob()" >
							<label for="normal">Turno C</label>
							<input type="checkbox" name="turno" id="turnoC" value="C" class="turno" checked onclick="ValidarTurnoc()" >
                            <label for="normal">Admin</label>
							<input type="checkbox" name="admin" id="admin" value="admin"    onclick="ValidarAdmin()" >  
                          </fieldset>

                         </div>
	                       
                    <div class="form-group" >
						
                          <fieldset data-role="controlgroup" data-type="horizontal" id="turnoa" >
								<div id="turnoa" >
							<h4> Turno A (06:00 am- 02:00 pm)</h4>
                            <label for="lunes">L</label>
                            <input type="checkbox" name="lunes_ta" id="lunes_ta" value="12"  class="turnoa"  checked >
                            <label for="martes">M</label>
                            <input type="checkbox" name="martes_ta" id="martes_ta" value="13" class="turnoa" checked   >
                            <label for="miercoles">K</label>
                            <input type="checkbox" name="miercoles_ta" id="miercoles_ta" value="14" class="turnoa" checked  >
                            <label for="red">J</label>
                            <input type="checkbox" name="jueves_ta" id="jueves_ta" value="15" class="turnoa" checked  >
                            <label for="red">V</label>
                            <input type="checkbox" name="viernes_ta" id="viernes_ta" value="16"  class="turnoa"  checked >
                            <label for="red">S</label>
                            <input type="checkbox" name="sabado_ta" id="sabado_ta" value="17"  class="turnoa" checked >
                            <label for="red">D</label>
							<input type="checkbox" name="domingo_ta" id="domingo_ta" value="11" class="turnoa"  >
						</div>  
						</fieldset>
						
						  <fieldset data-role="controlgroup" data-type="horizontal" id="turnob">	
						<div id="turnob" >
                            <h4>Turno B (02:00 pm- 09:00 pm)</h4>
                            <label for="lunes">L</label>
                            <input type="checkbox" name="lunes_tb" id="lunes_tb" value="22"  class="turnob"  checked >
                            <label for="martes">M</label>
                            <input type="checkbox" name="martes_tb" id="martes_tb" value="23" class="turnob" checked   >
                            <label for="miercoles">K</label>
                            <input type="checkbox" name="miercoles_tb" id="miercoles_tb" value="24" class="turnob" checked >
                            <label for="red">J</label>
                            <input type="checkbox" name="jueves_tb" id="jueves_tb" value="25" class="turnob"  checked >
                            <label for="red">V</label>
                            <input type="checkbox" name="viernes_tb" id="viernes_tb" value="26"  class="turnob" checked >
                            <label for="red">S</label>
                            <input type="checkbox" name="sabado_tb" id="sabado_tb" value="27"  class="turnob"  >
                            <label for="red">D</label>
							<input type="checkbox" name="domingo_tb" id="domingo_tb" value="21" class="turnob"  >
						</div>
						</fieldset>	
							<fieldset data-role="controlgroup" data-type="horizontal" id="turnoc">	
						<div id="turnoc" >
							<h4>Turno C (09:00 pm- 06:00 am)</h4>
                            <label for="lunes">L</label>
                            <input type="checkbox" name="lunes_tc" id="lunes_tc" value="32"  class="turnoc"  checked >
                            <label for="martes">M</label>
                            <input type="checkbox" name="martes_tc" id="martes_tc" value="33" class="turnoc"  checked  >
                            <label for="miercoles">K</label>
                            <input type="checkbox" name="miercoles_tc" id="miercoles_tc" value="34" class="turnoc" checked >
                            <label for="red">J</label>
                            <input type="checkbox" name="jueves_tc" id="jueves_tc" value="35" class="turnoc"  checked >
                            <label for="red">V</label>
                            <input type="checkbox" name="viernes_tc" id="viernes_tc" value="36"  class="turnoc" checked >
                            <label for="red">S</label>
                            <input type="checkbox" name="sabado_tc" id="sabado_tc" value="37"  class="checar" >
                            <label for="red">D</label>
							<input type="checkbox" name="domingo_tc" id="domingo_tc" value="31" class="checar"  >
						</div>
                          </fieldset>
						  <fieldset data-role="controlgroup" data-type="horizontal" id="turnoad">	
						<div id="turnoad" >
							<h4>Turno Admi (08:00 pm- 05:00 am)</h4>
                            <label for="lunes">L</label>
                            <input type="checkbox" name="lunes_tad" id="lunes_tad" value='2'  class="turnoad"  checked >
                            <label for="martes">M</label>
                            <input type="checkbox" name="martes_tad" id="martes_tad" value="3" class="turnoad"  checked  >
                            <label for="miercoles">K</label>
                            <input type="checkbox" name="miercoles_tad" id="miercoles_tad" value="4" class="turnoad" checked >
                            <label for="red">J</label>
                            <input type="checkbox" name="jueves_tad" id="jueves_tad" value="5" class="turnoad"  checked >
                            <label for="red">V</label>
                            <input type="checkbox" name="viernes_tad" id="viernes_tad" value="6"  class="turnoad" checked >
                            <label for="red">S</label>
							<input type="checkbox" name="sabado_tad" id="sabado_tad" value="7"  class="turnoad" >
							<label for="red">D</label>
							<input type="checkbox" name="domingo_tad" id="domingo_tad" value="1" class="turnoad"  >
						</div>
                          </fieldset>

                         

					</div>
						 
						 



	                    </div>

	                    <div class="col-md-6">
	                        <div class="form-group">
						 		<label>Articulo A Producir </label>
						 		<input id="id_articulo" name="id_articulo" type="text" class="form-control" value="{{ $ordenproduccion->ORDEN_PRODUCCION}}" 	readonly="readonly" >
	                        </div>
				            <div class="form-group">
			                    <label >Operacion </label>
			                    <input type="text" id="Mid_opera" name="Mid_opera" class="form-control"   >
	                        </div>
                                 <input type="hidden"  id="id_secuencia" name="id_secuencia"  />      
							<div class="form-group">
			                    <label>Cantidad de unidades por Hora</label>
			                    <input type="Number" id="idm_cantidadxh" readonly="readonly" name="idm_cantidadxh" class="form-control"  >
	                        </div>

	                        <div class="form-group">
			                    <label>Total Horas </label>
			                    <input type="text" id="idm_totalhoras" name="idm_totalhoras" class="form-control" readonly="readonly" >
	                        </div>
	                        <div class="form-group">
			                    <label>Total de Turnos Estimados </label>
			                    <input type="text" id="idm_totalturnos" name="idm_totalturnos" class="form-control" readonly="readonly" >
	                        </div>
	                        <div class="form-group">
		                          <label > Fecha : </label>
		                          <input  type="date" class="form-control" id="id_fecha"  name="id_fecha" style="width: 250px;height: 40px"   value="<?php echo date("Y-m-d");?>">      
                            </div>
                            <div class="form-group">
		                          <label > Hora : </label>
		                          <input  type="time" class="form-control" id="id_hora"  name="id_hora" style="width: 250px;height: 40px"   value="<?php echo date("H:i");?>">
		                                
                            </div>

                    </div>
                </div>   
			</div>
			
			<div class="modal-footer">
				<input type="button" onmouseover="this.backgroundColor='blue' "  style="width: 450px;height: 40px" 
				name="planificar" id="planificar"  value="Planificar Produccion" >
			</div>
		</div>
	</div>
</div>
