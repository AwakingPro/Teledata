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
						<li>
							<a data-toggle="tab" href="#tab-6">Finalizados <span class="badge coutnFinalizado label-warning">0</span></a>
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
								<select class="form-control" name="NombreCliente" data-live-search="true">
									<option value="">Seleccione...</option>
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
					<div id="tab-2" class="tab-pane fade">
						<div class="row">
							<div class="col-md-12">
								<h3>Nuevo Ticket</h3><br>
							</div>
						</div>
						<div class="tab-base">
							<!--Nav Tabs-->
							<ul class="nav nav-tabs">
								<li class="active">
									<a data-toggle="tab" href="#tab-cliente"><h4>Cliente</h4></a>
								</li>
								<li>
									<a data-toggle="tab" href="#tab-interno"><h4>Interno</h4></a>
								</li>
							</ul>
							<!--Tabs Content-->
							<div class="tab-content" style="box-shadow: 0px 0px;">
								<div id="tab-cliente" class="tab-pane fade active in cont-form1">
									<div class="row">
										<div class="col-md-12 form-group">
											<label>Cliente</label>
											<select name="Cliente" class="form-control" id="cliente" data-live-search="true">
												<option value="">Seleccione...</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 form-group">
											<label>Servicio</label>
											<select name="Servicio" class="selectpicker form-control" data-live-search="true">
												<option value="">Seleccione...</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label >Origen</label>
											<select name="Origen" class="selectpicker form-control"  data-live-search="true">
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
											<select name="Departamento" class="selectpicker form-control" data-live-search="true">
												<option value="">Seleccione...</option>
												<option>Soporte Tecnico</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label >Tipo</label>
											<div class="input-group">
												<select name="Tipo" class="form-control" data-live-search="true">
													<option value="">Seleccione...</option>
												</select>
												<span class="input-group-btn">
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTipos"><i class="fa fa-plus" aria-hidden="true"></i></button>
												</span>
											</div>
										</div>
										<div class="col-md-6 form-group">
											<label >Subtipo</label>
											<div class="input-group">
												<select name="Subtipo" class="selectpicker form-control subTipo" data-live-search="true">
													<option value="">Seleccione...</option>
												</select>
												<span class="input-group-btn">
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSubTipo"><i class="fa fa-plus" aria-hidden="true"></i></button>
												</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label >Prioridad</label>
											<div class="input-group">
												<select name="Prioridad" class="form-control" data-live-search="true">
												</select>
												<span class="input-group-btn">
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tiempoPrioridad"><i class="fa fa-plus" aria-hidden="true"></i></button>
												</span>
											</div>
										</div>
										<div class="col-md-6 form-group">
											<label >Asignar a</label>
											<select name="AsignarA" class="form-control" id="personal" data-live-search="true">
												<option value="">Seleccione...</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 form-group">
											<label >Estado</label>
											<select name="Estado" class="selectpicker form-control" data-live-search="true">
												<option value="">Seleccione...</option>
												<option>Abierto</option>
												<option>Cerrado</option>
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
								<div id="tab-interno" class="tab-pane fade cont-form3">
									<div class="row">
										<div class="col-md-12 form-group">
											<label>Cliente</label>
											<div class="input-group">
												<select name="Cliente" class="form-control" id="cliente" data-live-search="true">
													<option value="">Seleccione...</option>
													<option value="1">Cliente de prueba</option>
												</select>
												<span class="input-group-btn">
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalClienteExtra"><i class="fa fa-plus" aria-hidden="true"></i></button>
												</span>
											</div>
											<input type="hidden"  name="Origen">
											<input type="hidden" name="Departamento">
											<input type="hidden" name="Prioridad">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 form-group">
											<label>Asunto</label>
											<input type="text" name="Servicio" class="form-control">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label >Tipo</label>
											<div class="input-group">
												<select name="Tipo" class="form-control" data-live-search="true">
													<option value="">Seleccione...</option>
												</select>
												<span class="input-group-btn">
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTipos"><i class="fa fa-plus" aria-hidden="true"></i></button>
												</span>
											</div>
										</div>
										<div class="col-md-6 form-group">
											<label >Subtipo</label>
											<div class="input-group">
												<select name="Subtipo" class="selectpicker form-control" data-live-search="true">
													<option value="">Seleccione...</option>
												</select>
												<span class="input-group-btn">
													<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSubTipo"><i class="fa fa-plus" aria-hidden="true"></i></button>
												</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 form-group">
											<label >Asignar a</label>
											<select name="AsignarA" class="form-control" id="personal" data-live-search="true">
												<option value="">Seleccione...</option>
											</select>
										</div>
										<div class="col-md-6 form-group">
											<label >Estado</label>
											<select name="Estado" class="selectpicker form-control" data-live-search="true">
												<option value="">Seleccione...</option>
												<option>Abierto</option>
												<option>Cerrado</option>
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
											<button type="button" class="btn btn-primary guardarTicketInterno">Guardar</button>
										</div>
									</div>
								</div>
							</div>
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
					<div id="tab-6" class="tab-pane fade">
						<div class="row">
							<div class="col-md-12">
								<h3>Tickets Finalizados</h3><br>
							</div>
						</div>
						<div class="listaFinalizados">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>