$.post('../ajax/privilegios.php', function(data) {
	$('#page-content').load('views/'+data+'.php', function(){

		$('.selectpicker').selectpicker();

		$('[name="AsignarA"], [name="AsignarAUpdate"]').load('../ajax/tickets/listUsuario.php',function(){
			$('[name="AsignarA"], [name="AsignarAUpdate"]').selectpicker();
		});
		$('[name="Prioridad"], [name="PrioridadUpdate"]').load('../ajax/tickets/selectPrioridad.php',function(){
			$('[name="Prioridad"], [name="PrioridadUpdate"]').selectpicker();
		});
		$('[name="Tipo"], [name="TipoUpdate"], [name="nombreTipo"]').load('../ajax/tickets/selectTipoTicket.php',function(){
			$('[name="Tipo"], [name="TipoUpdate"], [name="nombreTipo"]').selectpicker();
		});

		$('select[name="NumeroTicket"]').load('../ajax/tickets/listNroTickets.php',function(){
			$('select[name="NumeroTicket"]').selectpicker();
		});


		$('select[name="NombreCliente"], [name="Cliente"], [name="ClienteUpdate"]').load('../ajax/tickets/selectClientes.php',function(){
			$('select[name="NombreCliente"], [name="Cliente"], [name="ClienteUpdate"]').selectpicker();
		});

		$(document).on('change', '[name="Cliente"], [name="ClienteUpdate"]', function() {
			console.log($(this).selectpicker('val'));
			$.post('../ajax/tickets/listServicios.php',{id:$(this).selectpicker('val')},function(data){
				console.log(data);
				$('[name="Servicio"], [name="ServicioUpdate"]').html(data);
				$('[name="Servicio"], [name="ServicioUpdate"]').selectpicker('refresh');
			});
		});

		$('.listaPrioridad').load('../ajax/tickets/listPrioridad.php',function(){
			var count = $('.listaPrioridad > .tabeData tr th').length -1;
			$('.listaPrioridad > .tabeData').dataTable({
				"columnDefs": [{
					'orderable': false,
					'targets': [count]
				}, ]
			});
		});
		$('.listaAbiertos').load('../ajax/tickets/listAbiertos.php',function(){
			var count = $('.listaAbiertos > .tabeData tr th').length -1;
			$('.listaAbiertos > .tabeData').dataTable({
				"columnDefs": [{
					'orderable': false,
					'targets': [count]
				}, ]
			});
		});

		$('.listaFinalizados').load('../ajax/tickets/listFinalizados.php',function(){
			var count = $('.listaFinalizados > .tabeData tr th').length -1;
			$('.listaFinalizados > .tabeData').dataTable({
				"columnDefs": [{
					'orderable': false,
					'targets': [count]
				}, ]
			});
		});

		$('.listaIncumplidos').load('../ajax/tickets/listIncumplidos.php',function(){
			var count = $('.listaIncumplidos > .tabeData tr th').length -1;
			$('.listaIncumplidos > .tabeData').dataTable({
				"columnDefs": [{
					'orderable': false,
					'targets': [count]
				}, ]
			});
		});
		$('.listaAsignados').load('../ajax/tickets/listAsignados.php',function(){
			var count = $('.listaAsignados > .tabeData tr th').length -1;
			$('.listaAsignados > .tabeData').dataTable({
				"columnDefs": [{
					'orderable': false,
					'targets': [count]
				}, ]
			});
		});

		$('.listaTipoTicket').load('../ajax/tickets/listTipoTicket.php',function(){
			var count = $('.listaTipoTicket > .tabeData tr th').length -1;
			$('.listaTipoTicket > .tabeData').dataTable({
				"columnDefs": [{
					'orderable': false,
					'targets': [count]
				}, ]
			});
		});

		$('.listaSubTipoTicket').load('../ajax/tickets/listSubTipoTicket.php',function(){
			var count = $('.listaSubTipoTicket > .tabeData tr th').length -1;
			$('.listaSubTipoTicket > .tabeData').dataTable({
				"columnDefs": [{
					'orderable': false,
					'targets': [count]
				}, ]
			});
		});

		$('.coutAbiertos').load('../ajax/tickets/coutAbiertos.php');
		$('.coutnAsigados').load('../ajax/tickets/coutnAsigados.php');
		$('.coutnIncumplidos').load('../ajax/tickets/coutnIncumplido.php');
		$('.coutnFinalizado').load('../ajax/tickets/countFinalizados.php');

		$('.guardarTicket').click(function() {
			$.postFormValues('../ajax/tickets/insertData.php','.cont-form1',function(data){
				if (Number(data) > 0){
					$('.listaAbiertos').load('../ajax/tickets/listAbiertos.php',function(){
						var count = $('.listaAbiertos > .tabeData tr th').length -1;
						$('.listaAbiertos > .tabeData').dataTable({
							"columnDefs": [{
								'orderable': false,
								'targets': [count]
							}, ]
						});
					});
					$('.listaFinalizados').load('../ajax/tickets/listFinalizados.php',function(){
						var count = $('.listaFinalizados > .tabeData tr th').length -1;
						$('.listaFinalizados > .tabeData').dataTable({
							"columnDefs": [{
								'orderable': false,
								'targets': [count]
							}, ]
						});
					});
					$('.listaAsignados').load('../ajax/tickets/listAsignados.php',function(){
						var count = $('.listaAsignados > .tabeData tr th').length -1;
						$('.listaAsignados  > .tabeData').dataTable({
							"columnDefs": [{
								'orderable': false,
								'targets': [count]
							}, ]
						});
					});
					$('.listaIncumplidos').load('../ajax/tickets/listIncumplidos.php',function(){
						var count = $('.listaIncumplidos > .tabeData tr th').length -1;
						$('.listaIncumplidos > .tabeData').dataTable({
							"columnDefs": [{
								'orderable': false,
								'targets': [count]
							}, ]
						});
					});
					$('.coutAbiertos').load('../ajax/tickets/coutAbiertos.php');
					$('.coutnAsigados').load('../ajax/tickets/coutnAsigados.php');
					$('.coutnIncumplidos').load('../ajax/tickets/coutnIncumplido.php');
					$('.coutnFinalizado').load('../ajax/tickets/countFinalizados.php');

					$('input, select, textarea').val('');
					bootbox.alert('<h3 class="text-center">El ticket #'+data+' se registro con éxito.</h3>');

				}else{
					console.log(data);
					bootbox.alert('<h3 class="text-center">Se produjo un error al guardar el ticket.</h3>');
				}
			});
		});

		$('.guardarTicketInterno').click(function() {
			$.postFormValues('../ajax/tickets/insertData.php','.cont-form3',function(data){
				if (Number(data) > 0){
					$('.listaAbiertos').load('../ajax/tickets/listAbiertos.php',function(){
						var count = $('.listaAbiertos > .tabeData tr th').length -1;
						$('.listaAbiertos > .tabeData').dataTable({
							"columnDefs": [{
								'orderable': false,
								'targets': [count]
							}, ]
						});
					});
					$('.listaFinalizados').load('../ajax/tickets/listFinalizados.php',function(){
						var count = $('.listaFinalizados > .tabeData tr th').length -1;
						$('.listaFinalizados > .tabeData').dataTable({
							"columnDefs": [{
								'orderable': false,
								'targets': [count]
							}, ]
						});
					});
					$('.listaAsignados').load('../ajax/tickets/listAsignados.php',function(){
						var count = $('.listaAsignados > .tabeData tr th').length -1;
						$('.listaAsignados  > .tabeData').dataTable({
							"columnDefs": [{
								'orderable': false,
								'targets': [count]
							}, ]
						});
					});
					$('.listaIncumplidos').load('../ajax/tickets/listIncumplidos.php',function(){
						var count = $('.listaIncumplidos > .tabeData tr th').length -1;
						$('.listaIncumplidos > .tabeData').dataTable({
							"columnDefs": [{
								'orderable': false,
								'targets': [count]
							}, ]
						});
					});
					$('.coutAbiertos').load('../ajax/tickets/coutAbiertos.php');
					$('.coutnAsigados').load('../ajax/tickets/coutnAsigados.php');
					$('.coutnIncumplidos').load('../ajax/tickets/coutnIncumplido.php');
					$('.coutnFinalizado').load('../ajax/tickets/countFinalizados.php');

					$('input, select, textarea').val('');
					bootbox.alert('<h3 class="text-center">El ticket #'+data+' se registro con éxito.</h3>');

				}else{
					console.log(data);
					bootbox.alert('<h3 class="text-center">Se produjo un error al guardar el ticket.</h3>');
				}
			});
		});

		$('.busqueda').click(function() {
			$.postFormValues('../ajax/tickets/listBuscar.php','.cont-form2',function(data){
				$('.listaBusqueda').html(data);
				var count = $('.listaBusqueda > .tabeData tr th').length -1;
				$('.listaBusqueda > .tabeData').dataTable({
					"columnDefs": [{
						'orderable': false,
						'targets': [count]
					}, ]
				});
			});
		});
		$('.guardarPrioridad').click(function() {
			if ($('[name="idUpdatePrioridad"]').val() != "") {
				$.postFormValues('../ajax/tickets/updatePrioridad.php','.cont-form3',function(data){
					if (Number(data) > 0) {
						$('.listaPrioridad').load('../ajax/tickets/listPrioridad.php',function(){
							var count = $('.listaPrioridad > .tabeData tr th').length -1;
							$('.listaPrioridad > .tabeData').dataTable({
								"columnDefs": [{
									'orderable': false,
									'targets': [count]
								}, ]
							});
						});
						$('[name="Prioridad"]').load('../ajax/tickets/selectPrioridad.php');
						$('[name="nombre"]').val("");
						$('[name="tiempo"]').val("");
						$('[name="idUpdatePrioridad"]').val("");
						bootbox.alert('<h3 class="text-center">la prioridad se actualizo con éxito.</h3>');
					}else{
						console.log(data);
						bootbox.alert('<h3 class="text-center">Se produjo un error al guardar.</h3>');
					}
				});
			}else{
				$.postFormValues('../ajax/tickets/dataPrioridad.php','.cont-form3',function(data){
					if (Number(data) > 0) {
						var count = $('.listaPrioridad > .tabeData tr th').length -1;
						$('.listaPrioridad').load('../ajax/tickets/listPrioridad.php',function(){
							$('.listaPrioridad > .tabeData').dataTable({
								"columnDefs": [{
									'orderable': false,
									'targets': [count]
								}, ]
							});
						});
						$('[name="Prioridad"]').load('../ajax/tickets/selectPrioridad.php');
						bootbox.alert('<h3 class="text-center">la prioridad se registro con éxito.</h3>');
					}else{
						console.log(data);
						bootbox.alert('<h3 class="text-center">Se produjo un error al guardar.</h3>');
					}
				});
			}
		});
		$(document).on('click', '.cancelarPrioridad', function() {
			$('[name="nombre"]').val("");
			$('[name="tiempo"]').val("");
			$('[name="idUpdatePrioridad"]').val("");
		});
		$('[name="Tipo"]').change(function() {
			$.post('../ajax/tickets/selectSubTipoTicket.php', {id:$('[name="Tipo"]').val()}, function(data) {
				$('[name="Subtipo"]').html(data);
				$('[name="Subtipo"]').selectpicker('refresh');
			});
		});
		$('[name="TipoUpdate"]').change(function() {
			$.post('../ajax/tickets/selectSubTipoTicket.php', {id:$('[name="Tipo"]').val()}, function(data) {
				$('[name="SubtipoUpdate"]').html(data);
				$('[name="SubtipoUpdate"]').selectpicker('refresh');
			});
		});
		$(document).on('click', '.delete-tickets', function() {
			var id = $(this).attr('attr');
			bootbox.confirm({
				message: "<h3 class='text-center'>Esta seguro de querer eliminar los datos</h3>",
				buttons: {
					confirm: {
						label: 'Si borrar',
						className: 'btn-success'
					},
					cancel: {
						label: 'No borrar',
						className: 'btn-danger'
					}
				},
				callback: function (result) {
					if (result == true) {
						$.post('../ajax/tickets/deleteTikets.php', {id: id}, function(data) {
							$('.listaAbiertos').load('../ajax/tickets/listAbiertos.php',function(){
								var count = $('.listaAbiertos > .tabeData tr th').length -1;
								$('.listaAbiertos > .tabeData').dataTable({
									"columnDefs": [{
										'orderable': false,
										'targets': [count]
									}, ]
								});
							});
							$('.listaFinalizados').load('../ajax/tickets/listFinalizados.php',function(){
								var count = $('.listaFinalizados > .tabeData tr th').length -1;
								$('.listaFinalizados > .tabeData').dataTable({
									"columnDefs": [{
										'orderable': false,
										'targets': [count]
									}, ]
								});
							});
							$('.listaIncumplidos').load('../ajax/tickets/listIncumplidos.php',function(){
								var count = $('.listaIncumplidos > .tabeData tr th').length -1;
								$('.listaIncumplidos > .tabeData').dataTable({
									"columnDefs": [{
										'orderable': false,
										'targets': [count]
									}, ]
								});
							});
							$('.listaAsignados').load('../ajax/tickets/listAsignados.php',function(){
								var count = $('.listaAsignados > .tabeData tr th').length -1;
								$('.listaAsignados > .tabeData').dataTable({
									"columnDefs": [{
										'orderable': false,
										'targets': [count]
									}, ]
								});
							});

							$('.coutAbiertos').load('../ajax/tickets/coutAbiertos.php');
							$('.coutnAsigados').load('../ajax/tickets/coutnAsigados.php');
							$('.coutnIncumplidos').load('../ajax/tickets/coutnIncumplido.php');
							$('.coutnFinalizado').load('../ajax/tickets/countFinalizados.php');
						});
					}
				}
			});
		});

		$(document).on('click', '.delete-tiempo_prioridad', function() {
			var id = $(this).attr('attr');
			bootbox.confirm({
				message: "<h3 class='text-center'>Esta seguro de querer eliminar los datos</h3>",
				buttons: {
					confirm: {
						label: 'Si borrar',
						className: 'btn-success'
					},
					cancel: {
						label: 'No borrar',
						className: 'btn-danger'
					}
				},
				callback: function (result) {
					if (result == true) {
						$.post('../ajax/tickets/deletePrioridad.php', {id: id}, function(data) {
							$('.listaPrioridad').load('../ajax/tickets/listPrioridad.php',function(){
								var count = $('.listaPrioridad > .tabeData tr th').length -1;
								$('.listaPrioridad > .tabeData').dataTable({
									"columnDefs": [{
										'orderable': false,
										'targets': [count]
									}, ]
								});
							});
							$('[name="Prioridad"]').load('../ajax/tickets/selectPrioridad.php',function(){
								$('[name="Prioridad"]').selectpicker();
							});
						});
					}
				}
			});
		});

		$(document).on('click', '.finalizar-tickets', function() {
			var id = $(this).attr('attr');
			bootbox.confirm({
				message: "<h3 class='text-center'>Desea finalizar este ticket</h3>",
				buttons: {
					confirm: {
						label: 'Si',
						className: 'btn-success'
					},
					cancel: {
						label: 'No',
						className: 'btn-danger'
					}
				},
				callback: function (result) {
					if (result == true) {
						$.post('../ajax/tickets/finalizarTicket.php', {id: id}, function(data) {
							$('.listaAbiertos').load('../ajax/tickets/listAbiertos.php',function(){
								var count = $('.listaAbiertos > .tabeData tr th').length -1;
								$('.listaAbiertos > .tabeData').dataTable({
									"columnDefs": [{
										'orderable': false,
										'targets': [count]
									}, ]
								});
							});
							$('.listaFinalizados').load('../ajax/tickets/listFinalizados.php',function(){
								var count = $('.listaFinalizados > .tabeData tr th').length -1;
								$('.listaFinalizados > .tabeData').dataTable({
									"columnDefs": [{
										'orderable': false,
										'targets': [count]
									}, ]
								});
							});
							$('.listaIncumplidos').load('../ajax/tickets/listIncumplidos.php',function(){
								var count = $('.listaIncumplidos > .tabeData tr th').length -1;
								$('.listaIncumplidos > .tabeData').dataTable({
									"columnDefs": [{
										'orderable': false,
										'targets': [count]
									}, ]
								});
							});
							$('.listaAsignados').load('../ajax/tickets/listAsignados.php',function(){
								var count = $('.listaAsignados > .tabeData tr th').length -1;
								$('.listaAsignados > .tabeData').dataTable({
									"columnDefs": [{
										'orderable': false,
										'targets': [count]
									}, ]
								});
							});

							$('.coutAbiertos').load('../ajax/tickets/coutAbiertos.php');
							$('.coutnAsigados').load('../ajax/tickets/coutnAsigados.php');
							$('.coutnIncumplidos').load('../ajax/tickets/coutnIncumplido.php');
							$('.coutnFinalizado').load('../ajax/tickets/countFinalizados.php');
						});
					}
				}
			});
		});


		$(document).on('click', '.update-tickets', function(event) {
			var id = $(this).attr('attr');
			$('#actualizarTikect').modal('show');
			$.post('../ajax/tickets/dataUpdateTickets.php', {id:id}, function(data) {
				value = $.parseJSON(data);
				$('[name="idUpdateTicket"]').val(value[0][0])
				$('[name="ClienteUpdate"]').val(value[0][1]);
				$('[name="OrigenUpdate"]').val(value[0][2]);
				$('[name="DepartamentoUpdate"]').val(value[0][3]);
				$('[name="TipoUpdate"]').val(value[0][4]);
				$('[name="SubtipoUpdate"]').val(value[0][5]);
				$('[name="PrioridadUpdate"]').val(value[0][6]);
				$('[name="AsignarAUpdate"]').val(value[0][7]);
				$('[name="EstadoUpdate"]').val(value[0][8]);
				$('[name="ServicioUpdate"]').val(value[0][10]);
				$('[name="ObservacionesUpdate"]').val(value[0][11]);
				$.post('../ajax/tickets/selectSubTipoTicket.php', {id:value[0][4]}, function(data) {
					$('[name="SubtipoUpdate"]').html(data);
					$('[name="SubtipoUpdate"]').val(value[0][5]);
				});
			});
		});

		$(document).on('click', '.updateTicket', function(){
			$.postFormValues('../ajax/tickets/updateTickets.php','.cont-form4',function(data){
				$('.listaAbiertos').load('../ajax/tickets/listAbiertos.php',function(){
					var count = $('.listaAbiertos > .tabeData tr th').length -1;
					$('.listaAbiertos > .tabeData').dataTable({
						"columnDefs": [{
							'orderable': false,
							'targets': [count]
						}, ]
					});
				});
				$('.listaFinalizados').load('../ajax/tickets/listFinalizados.php',function(){
					var count = $('.listaFinalizados > .tabeData tr th').length -1;
					$('.listaFinalizados > .tabeData').dataTable({
						"columnDefs": [{
							'orderable': false,
							'targets': [count]
						}, ]
					});
				});
				$('.listaIncumplidos').load('../ajax/tickets/listIncumplidos.php',function(){
					var count = $('.listaAbiertos > .tabeData tr th').length -1;
					$('.listaIncumplidos > .tabeData').dataTable({
						"columnDefs": [{
							'orderable': false,
							'targets': [count]
						}, ]
					});
				});
				$('.listaAsignados').load('../ajax/tickets/listAsignados.php',function(){
					var count = $('.listaAsignados > .tabeData tr th').length -1;
					$('.listaAsignados > .tabeData').dataTable({
						"columnDefs": [{
							'orderable': false,
							'targets': [count]
						}, ]
					});
				});

				$('.coutAbiertos').load('../ajax/tickets/coutAbiertos.php');
				$('.coutnAsigados').load('../ajax/tickets/coutnAsigados.php');
				$('.coutnIncumplidos').load('../ajax/tickets/coutnIncumplido.php');
				$('.coutnFinalizado').load('../ajax/tickets/countFinalizados.php');
				bootbox.alert('<h3 class="text-center">El ticket se actualizo con éxito.</h3>');
			});
		});

		$(document).on('click', '.update-tiempo_prioridad', function() {
			id = $(this).attr('attr');
			$.post('../ajax/tickets/dataUpdatePrioridad.php', {id: id}, function(data) {
				value = $.parseJSON(data);
				$('[name="nombre"]').val(value[0][1]);
				$('[name="tiempo"]').val(value[0][2]);
				$('[name="idUpdatePrioridad"]').val(value[0][0]);
			});
		});

		$(document).on('click', '.guardarTipoTicket', function() {
			$.postFormValues('../ajax/tickets/insertTipoTicket.php','.cont-form5',function(data){
				if (Number(data) > 0) {
					$('.listaTipoTicket').load('../ajax/tickets/listTipoTicket.php',function(){
						var count = $('.listaTipoTicket > .tabeData tr th').length -1;
						$('.listaTipoTicket > .tabeData').dataTable({
							"columnDefs": [{
								'orderable': false,
								'targets': [count]
							}, ]
						});
					});
					$('[name="Tipo"], [name="TipoUpdate"], [name="nombreTipo"]').load('../ajax/tickets/selectTipoTicket.php');
					bootbox.alert('<h3 class="text-center">El tipo de ticket se registro con éxito.</h3>');
				}else{
					console.log(data);
					bootbox.alert('<h3 class="text-center">Se produjo un error al guardar.</h3>');
				}
			})
		});

		$(document).on('click', '.guardarSubTipoTicket', function() {
			$.postFormValues('../ajax/tickets/insertSubtipoticket.php','.cont-form6',function(data){
				if (Number(data) > 0) {
					$('.listaSubTipoTicket').load('../ajax/tickets/listSubTipoTicket.php',function(){
						var count = $('.listaSubTipoTicket > .tabeData tr th').length -1;
						$('.listaSubTipoTicket > .tabeData').dataTable({
							"columnDefs": [{
								'orderable': false,
								'targets': [count]
							}, ]
						});
					});
					$.post('../ajax/tickets/selectSubTipoTicket.php', {id:$('[name="Tipo"]').val()}, function(data) {
						$('[name="Subtipo"]').html(data);
					});
					bootbox.alert('<h3 class="text-center">El Subtipo de ticket se registro con éxito.</h3>');
				}else{
					console.log(data);
					bootbox.alert('<h3 class="text-center">Se produjo un error al guardar.</h3>');
				}
			})
		});

		$(document).on('click', '.comentarios', function() {
			id = $(this).attr('attr');
			$('.guardarComentario').attr('attr', id)
			$.post('../ajax/tickets/comentarios.php', {id:id}, function(data) {
				$('.cont-comentarios').html(data);
			});
		});

		$(document).on('click', '.guardarComentario', function() {
			id = $(this).attr('attr');
			comentario = $('.textComentario').val();
			$.post('../ajax/tickets/insertComentarios.php', {idTicket:id,comentario:comentario}, function(data) {
				$.post('../ajax/tickets/comentarios.php', {id:id}, function(data) {
					$('.cont-comentarios').html(data);
					$('.textComentario').val('');
				});
			});
		});

	});


	$(document).on('click', '.guardarCliente', function() {
		$.postFormValues('../ajax/tickets/insertCliente.php','.container-form2',function(data){
			value = $.parseJSON(data);
			$('[name="Cliente"]').append(value[1]);
			$('[name="Cliente"]').selectpicker('refresh');
			$('[name="Cliente"]').selectpicker('val', value[2]);
			if (Number(value[0]) > 0){
				$('#modalClienteExtra').modal('hide');
				bootbox.alert('<h3 class="text-center">El cliente #'+value[0]+' se registro con éxito.</h3>');
			}else{
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar el ticket.</h3>');
			}
		});
	});

});

