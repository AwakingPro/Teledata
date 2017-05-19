$(document).ready(function() {
	$('#personal').load('../ajax/tickets/listUsuario.php');
	$('[name="Prioridad"]').load('../ajax/tickets/selectPrioridad.php');
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
				bootbox.alert('<h3 class="text-center">El ticket se registro con exito.</h3>');
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
	$(document).on('click', '.deleteRow', function() {
		$.post('../ajax/tickets/deleteTikets.php', {id: $(this).attr('attr')}, function(data) {
			console.log(data);
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
		});
	});
});