<div class="row container-form-datosTecnicos" attr="insertArriendoEquipos.php">
	<div class="col-md-12">
		<h3>Arriendo de equipos</h3>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label">Seleccione Origen</label>
			<select class="form-control" name="origen_tipo" data-live-search="true">
				<option value="">Seleccione Opción</option>
				<option value="1">Bodega</option>
				<option value="2">Cliente</option>
			</select>
		</div>
	</div>

	<div class="col-md-12 origen">
		<div class="form-group">
			<label class="control-label">Seleccione <span id="span_origen">Bodega</span></label>
			<select class="form-control" name="origen_id" data-live-search="true">
				<option value="">Seleccione Opción</option>
			</select>
		</div>
	</div>

	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label">Activo a Transferir</label>
			<select class="form-control" name="producto_id" data-live-search="true">
				<option value="">Seleccione Opción</option>
			</select>
		</div>
	</div>

	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label">Seleccione Destino</label>
			<select class="form-control" name="destino_tipo" data-live-search="true">
				<option value="">Seleccione Opción</option>
				<option value="1">Bodega</option>
				<option value="2">Cliente</option>
			</select>
		</div>
	</div>

	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label">Seleccione <span id="span_destino">Bodega</span></label>
			<select class="form-control" name="destino_id" data-live-search="true">
				<option value="">Seleccione Opción</option>
			</select>
		</div>
	</div>

</div>