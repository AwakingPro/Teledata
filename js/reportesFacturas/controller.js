$(document).ready(function() {


	$(document).on('click', '.generarExcelCliente', function() {
		window.location = "../ajax/reportesFacturas/reporteFacturaClienteExcel.php";

	});

	$.post('../ajax/reportesFacturas/montoTotalfacturas.php', function(data) {
		value = $.parseJSON(data);
		$('.cantFacturas').html(value[0][1])
		$('.montoTotal').html(value[0][0])

	});

	$('.listaFActurasClientes').html('<div class="spinner loading"></div>');
	$('.listaFActurasClientes').load('../ajax/reportesFacturas/reporteFacturasClientes.php', function(){
		$('.listaFActurasClientes > .tabeData').dataTable({
			"columnDefs": [{
				'orderable': false,
				'targets': [0]
			}, ],
			"order": [
				[1, "asc"]
			],
		});
	});

	$('.tipoReporte').change(function() {
		switch($(this).selectpicker('val')) {
			case 'm':
				$('.reporteFacturas').load('../ajax/reportesFacturas/reporteMensual.php', function(){
					var count = $('.reporteFacturas > .dataTableReporteFacturas tr th').length -1;
					$('.reporteFacturas > .dataTableReporteFacturas').dataTable({
						"columnDefs": [{
							'orderable': false,
							'targets': [count]
						}, ]
					});
				});
				break;
			case 's':
				$('.reporteFacturas').load('../ajax/reportesFacturas/reporteSemestral.php', function(){
					var count = $('.reporteFacturas > .dataTableReporteFacturas tr th').length -1;
					$('.reporteFacturas > .dataTableReporteFacturas').dataTable({
						"columnDefs": [{
							'orderable': false,
							'targets': [count]
						}, ]
					});
				});
				break;
			case 'a':
				$('.reporteFacturas').load('../ajax/reportesFacturas/reporteAnual.php', function(){
					var count = $('.reporteFacturas > .dataTableReporteFacturas tr th').length -1;
					$('.reporteFacturas > .dataTableReporteFacturas').dataTable({
						"columnDefs": [{
							'orderable': false,
							'targets': [count]
						}, ]
					});
				});
				break;
			default:
       				 $('.reporteFacturas').html('')
		}
	});


});