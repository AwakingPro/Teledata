$(document).ready(function() {
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