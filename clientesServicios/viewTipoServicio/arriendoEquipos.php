<div class="row container-form-datosTecnicos" attr="insertArriendoEquipos.php">
	<?php $Velocidad = isset($_POST['Velocidad']) ? trim($_POST['Velocidad']) : "" ?>
	<?php $Plan = isset($_POST['Plan']) ? trim($_POST['Plan']) : "" ?>
	<div class="col-md-12">
		<h3>Arriendo de equipos</h3>
	</div>

	<div class="productos">
		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Seleccione <span id="span_origen">Bodega</span></label>
				<select class="form-control selectpicker" id="origen_id" name="origen_id"   data-live-search="true" data-nombre="Origen" data-container="body">
					<option value="">Seleccione Opción</option>
				</select>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label">Activo a Transferir</label>
				<select class="form-control selectpicker" id="producto_id" name="producto_id"   data-live-search="true" data-nombre="Activo a Transferir" data-container="body">
					<option value="">Seleccione Opción</option>
				</select>
			</div>
		</div>
		<input type="hidden" id="destino_tipo" value="2" name="destino_tipo">
	</div>
	<input name="idServicio" type="hidden">
	<input name="Tipo" type="hidden" value="1">

	<div class="col-md-4 form-group" rows="5">
		<label>Velocidad</label>
		<input name="velocidad" id="velocidad" class="form-control" value="<?php echo $Velocidad ?>">
	</div>
	<div class="col-md-4 form-group" rows="5">
		<label>Plan</label>
		<input name="plan" id="plan" class="form-control" value="<?php echo $Plan ?>">
	</div>

</div>