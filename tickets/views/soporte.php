<div class="row">
	<div class="col-sm-12">
		<div class="tab-base ">
			<ul class="nav nav-tabs ">
				<li class="active">
					<a data-toggle="tab" href="#tab-1">Buscar ticket</a>
				</li>
				<li>
					<a data-toggle="tab" href="#tab-2">Nuevo</a>
				</li>
				<li>
					<a data-toggle="tab" href="#tab-3">Abiertos <span class="badge coutAbiertos label-warning">0</span></a>
				</li>
				<li>
					<a data-toggle="tab" href="#tab-4">Inclumplidos <span class="badge coutnIncumplidos label-warning">0</span></a>
				</li>
				<li>
					<a data-toggle="tab" href="#tab-5">Asignados <span class="badge coutnAsigados label-warning">0</span></a>
				</li>
			</ul>
			<div class="tab-content">
				<div id="tab-1" class="tab-pane fade active in cont-form2">
					<div class="row">
						<div class="col-md-12">
							<h4>Buscar tiket en el sistema:</h4>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<label>Nombre del Cliente</label>
							<select class="selectpicker form-control" name="NombreCliente" data-live-search="true">
								<option value="">Seleccione...</option>
								<option value="1">Cliente de prueba</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<label >Numero de ticket</label>
							<select class=" form-control" name="NumeroTicket" data-live-search="true">
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button type="button" class="btn btn-primary busqueda">Realizar Busqueda</button>
						</div>
					</div>
					<br>
					<br>
					<div class="listaBusqueda">
					</div>
				</div>
				<div id="tab-2" class="tab-pane fade cont-form1">
					<div class="row">
						<div class="col-md-12">
							<h4>Nuevo Ticket:</h4>
							<div class="pull-right">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<label>Cliente</label>
							<select name="Cliente" class="form-control" id="cliente">
								<option value="">Seleccione...</option>
								<option value="1">Cliente de prueba</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<label>Servicio</label>
							<select name="Servicio" class="form-control">
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<label >Origen</label>
							<select name="Origen" class="form-control" id="cliente">
								<option value="">Seleccione...</option>
								<option>Llamado Telefónico</option>
								<option>Correo Electrónico</option>
								<option>Presencial</option>
								<option>Pagina Web</option>
								<option>Interno</option>
								<option>Carta</option>
								<option>Otros</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
							<label >Departamento</label>
							<select name="Departamento" class="form-control" id="cliente">
								<option value="">Seleccione...</option>
								<option>Soporte Tecnico</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<label >Tipo</label>
							<select name="Tipo" class="form-control" >
								<option value="">Seleccione...</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
							<label >Subtipo</label>
							<select name="Subtipo" class="form-control" >
								<option value="">Seleccione...</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<label >Prioridad</label>
							<select name="Prioridad" class="form-control" >
							</select>
						</div>
						<div class="col-md-6 form-group">
							<label >Asignar a</label>
							<select name="AsignarA" class="form-control" id="personal">
								<option value="">Seleccione...</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<label >Estado</label>
							<select name="Estado" class="form-control" >
								<option>Abierto</option>
								<option>Finalizado</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group">
							<label >Observaciones</label>
							<textarea name="Observaciones" class="form-control" rows="5"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button type="button" class="btn btn-primary guardarTicket">Guardar</button>
						</div>
					</div>
				</div>
				<div id="tab-3" class="tab-pane fade">
					<div class="row">
						<div class="col-md-12">
							<h4>Tickets Abiertos:</h4>
						</div>
					</div>
					<div class="listaAbiertos">
					</div>
				</div>
				<div id="tab-4" class="tab-pane fade">
					<div class="row">
						<div class="col-md-12">
							<h4>Tickets Incunplidos:</h4>
						</div>
					</div>
					<div class="listaIncumplidos">
					</div>
				</div>
				<div id="tab-5" class="tab-pane fade">
					<div class="row">
						<div class="col-md-12">
							<h4>Tickets con Personal asignado:</h4>
						</div>
					</div>
					<div class="listaAsignados">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>