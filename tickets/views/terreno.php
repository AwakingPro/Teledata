<div class="row">
	<div class="col-md-12">
		<div class="panel ">
			<div class="panel-heading">
				<div class="panel-control">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a data-toggle="tab" href="#tab-1">Buscar ticket</a>
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
				</div>
				<h3 class="panel-title">Modulo Tickets</h3>
			</div>
			<div class="panel-body">
				<div class="tab-content">
					<div id="tab-1" class="tab-pane fade active in cont-form2">
						<div class="row">
							<div class="col-md-12">
								<h3>Buscar tiket en el sistema</h3><br>
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
					<div id="tab-3" class="tab-pane fade">
						<div class="row">
							<div class="col-md-12">
								<h3>Tickets Abiertos</h3><br>
							</div>
						</div>
						<div class="listaAbiertos">
						</div>
					</div>
					<div id="tab-4" class="tab-pane fade">
						<div class="row">
							<div class="col-md-12">
								<h3>Tickets Incunplidos</h3><br>
							</div>
						</div>
						<div class="listaIncumplidos">
						</div>
					</div>
					<div id="tab-5" class="tab-pane fade">
						<div class="row">
							<div class="col-md-12">
								<h3>Tickets con Personal asignado</h3><br>
							</div>
						</div>
						<div class="listaAsignados">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>