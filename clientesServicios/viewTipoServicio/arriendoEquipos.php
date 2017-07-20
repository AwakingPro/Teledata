<div class="row container-form-datosTecnicos" attr="insertArriendoEquipos.php">
	<div class="col-md-12">
		<h3>Arriendo de equipos</h3>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label">Seleccione Origen</label>
			<select class="form-control" id="origen_tipo" name="origen_tipo" validation="not_null"  data-live-search="true" data-nombre="Origen" data-container="body">
				<option value="">Seleccione Opción</option>
				<option value="1">Bodega</option>
				<option value="2">Cliente</option>
			</select>
		</div>
	</div>

	<div class="col-md-12 origen" style="display:none">
		<div class="form-group">
			<label class="control-label">Seleccione <span id="span_origen">Bodega</span></label>
			<select class="form-control"id="origen_id" name="origen_id" validation="not_null"  data-live-search="true" data-nombre="Origen" data-container="body">
				<option value="">Seleccione Opción</option>
			</select>
		</div>
	</div>

	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label">Activo a Transferir</label>
			<select class="form-control" id="producto_id" name="producto_id" validation="not_null"  data-live-search="true" data-nombre="Activo a Transferir" data-container="body">
				<option value="">Seleccione Opción</option>
			</select>
		</div>
	</div>

	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label">Seleccione Destino</label>
			<select class="form-control" id="destino_tipo" name="destino_tipo" validation="not_null"  data-live-search="true" data-nombre="Destino" data-container="body">
				<option value="">Seleccione Opción</option>
				<option value="1">Bodega</option>
				<option value="2">Cliente</option>
			</select>
		</div>
	</div>

	<div class="col-md-12 destino" style="display:none">
		<div class="form-group">
			<label class="control-label">Seleccione <span id="span_destino">Bodega</span></label>
			<select class="form-control" id="destino_id" name="destino_id" validation="not_null" data-live-search="true" data-nombre="Destino" data-container="body">
				<option value="">Seleccione Opción</option>
			</select>
		</div>
	</div>



</div>