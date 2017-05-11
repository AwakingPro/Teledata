$(document).ready(function() {
	$('#personal').load('../ajax/tickets/listUsuario.php');
	$('.listaAbiertos').load('../ajax/tickets/listAbiertos.php',function(){
		$('.listaAbiertos > .tabeData').dataTable({
			"columnDefs": [{
				'orderable': false,
				'targets': [10]
			}, ]
		});
	});
	$('.listaAsignados').load('../ajax/tickets/listAsignados.php',function(){
		$('.listaAsignados > .tabeData').dataTable({
			"columnDefs": [{
				'orderable': false,
				'targets': [10]
			}, ]
		});
	});
	$('.guardarTicket').click(function() {
		$.postFormValues('../ajax/tickets/insertData.php','.cont-form1',function(data){
			if (Number(data) > 0){
				$('.listaAbiertos').load('../ajax/tickets/listAbiertos.php',function(){
					$('.listaAbiertos > .tabeData').dataTable({
						"columnDefs": [{
							'orderable': false,
							'targets': [10]
						}, ]
					});
				});
				$('.listaAsignados').load('../ajax/tickets/listAsignados.php',function(){
					$('.listaAsignados  > .tabeData').dataTable({
						"columnDefs": [{
							'orderable': false,
							'targets': [10]
						}, ]
					});
				});
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
					'targets': [10]
				}, ]
			});
		});
	});
	$('[name="Tipo"]').change(function() {
		$.post('../ajax/tickets/listSubTipo.php', {tipo: $(this).val()}, function(data) {
			$('[name="Subtipo"]').html(data);
		});
	});
});