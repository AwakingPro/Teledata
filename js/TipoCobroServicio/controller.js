$(document).ready(function() {

	$('.listTipoCobro').html('<div class="spinner loading"></div>');
	$('.listTipoCobro').load('../ajax/TipoCobroServicio/listaCobroServicio.php',function(){
		var count = $('.listTipoCobro > .tabeData tr th').length -1;
		$('.listTipoCobro > .tabeData').dataTable({
			"columnDefs": [{
				'orderable': false,
				'targets': [count]
			}, ]
		});
	});

	$(document).on('click', '.delete-mantenedor_tipo_factura', function() {
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
						$.post('../ajax/TipoCobroServicio/deleteTipo.php', {id: id}, function(data) {
							$('.listTipoCobro').load('../ajax/TipoCobroServicio/listaCobroServicio.php',function(){
								var count = $('.listTipoCobro > .tabeData tr th').length -1;
								$('.listTipoCobro > .tabeData').dataTable({
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
						});
					}
				}
			});
		});

	$('.TipoCliente').load('../ajax/cliente/selectTipoCliente.php', function() {
		$('.TipoCliente').selectpicker('refresh');
	});

	$(document).on('click', '.agregarTipoFacturacion', function() {
		$(this).attr('disabled', 'disabled');
		if($('input[name=TipoFacCodigo]').val() == ''){
			bootbox.alert('<h3 class="text-center">Escriba Tipo Fac Código</h3>');
			$(this).removeAttr('disabled');
			return;
		}
		if($('input[name=TipoFacDescripcion]').val() == ''){
			bootbox.alert('<h3 class="text-center">Escriba Tipo Fac Descripción</h3>');
			$(this).removeAttr('disabled');
			return;
		}
		if($('input[name=TipoCliente]').val() == ''){
			bootbox.alert('<h3 class="text-center">Seleccione Tipo de Cliente</h3>');
			$(this).removeAttr('disabled');
			return;
		}

		$.postFormValues('../ajax/servicios/insertTipoFacturacion.php','.containerTipoFactura', {},function(data){

			if (Number(data) > 0){
				$('.listTipoCobro').load('../ajax/TipoCobroServicio/listaCobroServicio.php',function(){
					var count = $('.listTipoCobro > .tabeData tr th').length -1;
					$('.listTipoCobro > .tabeData').dataTable({
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

				$('.containerTipoFactura input').val('');
				bootbox.alert('<h3 class="text-center">Se registro con éxito.</h3>');
				
			}else
				if(Number(data) == 0){
					bootbox.alert('<h3 class="text-center">Ingrese el Tipo Fac Código</h3>');
				}else
					if(Number(data) == -1){
						bootbox.alert('<h3 class="text-center">Ingrese el Tipo Fac Descripción</h3>');
					}
					else{
						bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
					}
		});
		$(this).removeAttr('disabled');
	});
});