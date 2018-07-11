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
			language: {
				processing: "Procesando ...",
				search: 'Buscar',
				lengthMenu: "Mostrar _MENU_ Registros",
				info: "Mostrando _START_ a _END_ de _TOTAL_ Registros",
				infoEmpty: "Mostrando 0 a 0 de 0 Registros",
				infoFiltered: "(filtrada de _MAX_ registros en total)",
				infoPostFix: "",
				loadingRecords: "...",
				zeroRecords: "No se encontraron registros coincidentes",
				emptyTable: "No hay datos disponibles en la tabla",
				paginate: {
					first: "Primero",
					previous: "Anterior",
					next: "Siguiente",
					last: "Ultimo"
				},
				aria: {
					sortAscending: ": habilitado para ordenar la columna en orden ascendente",
					sortDescending: ": habilitado para ordenar la columna en orden descendente"
				}
			}
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
						}, ],
						language: {
							processing: "Procesando ...",
							search: 'Buscar',
							lengthMenu: "Mostrar _MENU_ Registros",
							info: "Mostrando _START_ a _END_ de _TOTAL_ Registros",
							infoEmpty: "Mostrando 0 a 0 de 0 Registros",
							infoFiltered: "(filtrada de _MAX_ registros en total)",
							infoPostFix: "",
							loadingRecords: "...",
							zeroRecords: "No se encontraron registros coincidentes",
							emptyTable: "No hay datos disponibles en la tabla",
							paginate: {
								first: "Primero",
								previous: "Anterior",
								next: "Siguiente",
								last: "Ultimo"
							},
							aria: {
								sortAscending: ": habilitado para ordenar la columna en orden ascendente",
								sortDescending: ": habilitado para ordenar la columna en orden descendente"
							}
						}
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
						}, ],
						language: {
							processing: "Procesando ...",
							search: 'Buscar',
							lengthMenu: "Mostrar _MENU_ Registros",
							info: "Mostrando _START_ a _END_ de _TOTAL_ Registros",
							infoEmpty: "Mostrando 0 a 0 de 0 Registros",
							infoFiltered: "(filtrada de _MAX_ registros en total)",
							infoPostFix: "",
							loadingRecords: "...",
							zeroRecords: "No se encontraron registros coincidentes",
							emptyTable: "No hay datos disponibles en la tabla",
							paginate: {
								first: "Primero",
								previous: "Anterior",
								next: "Siguiente",
								last: "Ultimo"
							},
							aria: {
								sortAscending: ": habilitado para ordenar la columna en orden ascendente",
								sortDescending: ": habilitado para ordenar la columna en orden descendente"
							}
						}
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
						}, ],
						language: {
							processing: "Procesando ...",
							search: 'Buscar',
							lengthMenu: "Mostrar _MENU_ Registros",
							info: "Mostrando _START_ a _END_ de _TOTAL_ Registros",
							infoEmpty: "Mostrando 0 a 0 de 0 Registros",
							infoFiltered: "(filtrada de _MAX_ registros en total)",
							infoPostFix: "",
							loadingRecords: "...",
							zeroRecords: "No se encontraron registros coincidentes",
							emptyTable: "No hay datos disponibles en la tabla",
							paginate: {
								first: "Primero",
								previous: "Anterior",
								next: "Siguiente",
								last: "Ultimo"
							},
							aria: {
								sortAscending: ": habilitado para ordenar la columna en orden ascendente",
								sortDescending: ": habilitado para ordenar la columna en orden descendente"
							}
						}
					});
				});
				break;
			default:
       				 $('.reporteFacturas').html('')
		}
	});


});