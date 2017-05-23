$(document).ready(function() {
	$('#personal').load('../ajax/tickets/listUsuario.php');
	$('[name="Prioridad"]').load('../ajax/tickets/selectPrioridad.php');

	$('select[name="NumeroTicket"]').load('../ajax/tickets/listNroTickets.php',function(){
		$('select[name="NumeroTicket"]').selectpicker();
	});

	$('.listaPrioridad').load('../ajax/tickets/listPrioridad.php',function(){
		$('.listaPrioridad > .tabeData').dataTable({
			"columnDefs": [{
				'orderable': false,
				'targets': [2]
			}, ]
		});
	});
	$('.listaAbiertos').load('../ajax/tickets/listAbiertos.php',function(){
		$('.listaAbiertos > .tabeData').dataTable({
			"columnDefs": [{
				'orderable': false,
				'targets': [8]
			}, ]
		});
	});
	$('.listaIncumplidos').load('../ajax/tickets/listIncumplidos.php',function(){
		$('.listaIncumplidos > .tabeData').dataTable({
			"columnDefs": [{
				'orderable': false,
				'targets': [7]
			}, ]
		});
	});
	$('.listaAsignados').load('../ajax/tickets/listAsignados.php',function(){
		$('.listaAsignados > .tabeData').dataTable({
			"columnDefs": [{
				'orderable': false,
				'targets': [7]
			}, ]
		});
	});

	$('.coutAbiertos').load('../ajax/tickets/coutAbiertos.php');
	$('.coutnAsigados').load('../ajax/tickets/coutnAsigados.php');
	$('.coutnIncumplidos').load('../ajax/tickets/coutnIncumplido.php');

	$('.guardarTicket').click(function() {
		$.postFormValues('../ajax/tickets/insertData.php','.cont-form1',function(data){
			if (Number(data) > 0){
				$('.listaAbiertos').load('../ajax/tickets/listAbiertos.php',function(){
					$('.listaAbiertos > .tabeData').dataTable({
						"columnDefs": [{
							'orderable': false,
							'targets': [8]
						}, ]
					});
				});
				$('.listaAsignados').load('../ajax/tickets/listAsignados.php',function(){
					$('.listaAsignados  > .tabeData').dataTable({
						"columnDefs": [{
							'orderable': false,
							'targets': [7]
						}, ]
					});
				});
				$('.coutAbiertos').load('../ajax/tickets/coutAbiertos.php');
				$('.coutnAsigados').load('../ajax/tickets/coutnAsigados.php');
				$('input, select').val('');
				bootbox.alert('<h3 class="text-center">El ticket #'+data+' se registro con exito.</h3>');

			}else{
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar el ticket.</h3>');
			}
		});
	});
	$('.busqueda').click(function() {
		$.postFormValues('../ajax/tickets/listBuscar.php','.cont-form2',function(data){
			$('.listaBusqueda').html(data);
			$('.listaBusqueda > .tabeData').dataTable({
				"columnDefs": [{
					'orderable': false,
					'targets': [8]
				}, ]
			});
		});
	});
	$('.guardarPrioridad').click(function() {
		$.postFormValues('../ajax/tickets/dataPrioridad.php','.cont-form3',function(data){
			if (Number(data) > 0) {
				$('.listaPrioridad').load('../ajax/tickets/listPrioridad.php',function(){
					$('.listaPrioridad > .tabeData').dataTable({
						"columnDefs": [{
							'orderable': false,
							'targets': [2]
						}, ]
					});
				});
				$('[name="Prioridad"]').load('../ajax/tickets/selectPrioridad.php');
				bootbox.alert('<h3 class="text-center">la prioridad se registro con exito.</h3>');
			}else{
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar.</h3>');
			}
		});
	});
	$('[name="Tipo"]').change(function() {
		$.post('../ajax/tickets/listSubTipo.php', {tipo: $(this).val()}, function(data) {
			$('[name="Subtipo"]').html(data);
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
							$('.listaAbiertos > .tabeData').dataTable({
								"columnDefs": [{
									'orderable': false,
									'targets': [8]
								}, ]
							});
						});
						$('.listaIncumplidos').load('../ajax/tickets/listIncumplidos.php',function(){
							$('.listaIncumplidos > .tabeData').dataTable({
								"columnDefs": [{
									'orderable': false,
									'targets': [7]
								}, ]
							});
						});
						$('.listaAsignados').load('../ajax/tickets/listAsignados.php',function(){
							$('.listaAsignados > .tabeData').dataTable({
								"columnDefs": [{
									'orderable': false,
									'targets': [7]
								}, ]
							});
						});

						$('.coutAbiertos').load('../ajax/tickets/coutAbiertos.php');
						$('.coutnAsigados').load('../ajax/tickets/coutnAsigados.php');
						$('.coutnIncumplidos').load('../ajax/tickets/coutnIncumplido.php');
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
							$('.listaPrioridad > .tabeData').dataTable({
								"columnDefs": [{
									'orderable': false,
									'targets': [2]
								}, ]
							});
						});
						$('[name="Prioridad"]').load('../ajax/tickets/selectPrioridad.php');
					});
				}
			}
		});
	});




});