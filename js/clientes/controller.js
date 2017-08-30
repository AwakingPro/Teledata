$(document).ready(function() {

	$('[name="Rut_update"], [name="Rut"]').number( true, 0,'','');

	$('select[name="rutCliente"]').load('../ajax/cliente/selectRutCliente.php',function(){
		$('select[name="rutCliente"]').selectpicker();
	});

	$('.listaCliente').load('../ajax/cliente/listClientes.php',function(){
		var count = $('.listaCliente > .tabeData tr th').length -1;
		$('.listaCliente > .tabeData').dataTable({
			"columnDefs": [{
				'orderable': false,
				'targets': [count]
			}, ]
		});
	});

	$(document).on('click', '.guardarCliente', function() {
		$.postFormValues('../ajax/cliente/insertCliente.php','.form-cont1',function(data){
			if (Number(data) > 0){
				$('.listaCliente').load('../ajax/cliente/listClientes.php',function(){
					var count = $('.listaCliente > .tabeData tr th').length -1;
					$('.listaCliente > .tabeData').dataTable({
						"columnDefs": [{
							'orderable': false,
							'targets': [count]
						}, ]
					});
				});
				bootbox.alert('<h3 class="text-center">El cliente #'+data+' se registro con éxito.</h3>');
			}else{
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
			}
		});
	});

	$(document).on('change', '.tipoBusqueda', function() {
		if ($('.tipoBusqueda').selectpicker('val') == '1') {
			$('select[name="rutCliente"]').load('../ajax/cliente/selectRutCliente.php',function(){
				$('select[name="rutCliente"]').selectpicker('refresh');
			});
		}else{
			$('select[name="rutCliente"]').load('../ajax/cliente/selectNombreCliente.php',function(){
				$('select[name="rutCliente"]').selectpicker('refresh');
			});
		}
	});

	$(document).on('click', '.buscarDatosClientes', function() {
		if ($('select[name="rutCliente"]').selectpicker('val') != '') {
			$.post('../ajax/cliente/dataCliente.php', {rut: $('select[name="rutCliente"]').selectpicker('val')}, function(data) {
				values = $.parseJSON(data);
				$('.dataFacturacion').html(values[0]);
				$('.dataServicios').html(values[1]);
				var count = $('.dataServicios > .tabeData tr th').length -1;
				$('.dataServicios > .tabeData').dataTable({
						"columnDefs": [{
						'orderable': false,
						'targets': [count]
					}, ]
				});
			});
		}
	});

	$(document).on('click', '.agregarDatosTecnicos', function() {

		var id = $(this).attr('attr');

		$.post('../ajax/cliente/tipoViewModal.php', {id: id}, function(data) {

			$('.containerTipoServicio').load('viewTipoServicio/'+data,function(){
				$('[name="idServicio"]').val(id);
				$('#destino_id').val(id)
				$('select').selectpicker();
			});

			if(data.trim() == 'arriendoEquipos.php'){

				$.ajax({
										type: "POST",
										url: "../includes/inventario/egresos/getBodega.php",
										success: function(response){

												$.each(response.array, function( index, array ) {
														$('#origen_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
												});
										}
								});

								setTimeout(function() {
									$('#origen_id').selectpicker('render');
									$('#origen_id').selectpicker('refresh');
								}, 1000);
			}
		});
	});

	$(document).on('click', '.listDatosTecnicos', function() {
		var id = $(this).attr('attr');
		$.post('../ajax/cliente/tipolistModal.php', {id: id}, function(data) {
			console.log(data);
			$.post('../ajax/cliente/'+data, {id: id}, function(data) {
				console.log(data);
				$('.containerListDatosTecnicos').html(data);
				var count = $('.containerListDatosTecnicos > .tabeData tr th').length -1;
				$('.containerListDatosTecnicos > .tabeData').dataTable({
						"columnDefs": [{
						'orderable': false,
						'targets': [count]
					}, ]
				});
				$('.containerListDatosTecnicos').attr('idTipoLista',id);
			});
		});
	});

	$(document).on('click', '.guardarDatosTecnicos', function() {
		var url = $('.container-form-datosTecnicos').attr('attr');
		console.log(url);
		$.postFormValues('../ajax/cliente/'+url,'.container-form-datosTecnicos',function(data){
			if (Number(data) > 0){
				$('.modal').modal('hide')
				bootbox.alert('<h3 class="text-center">Los datos se registraron con éxito.</h3>');
			}else{
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar.</h3>');
			}
		});
	});

	$(document).on('click', '.eliminarServicio', function() {
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
					$.post('../ajax/cliente/eliminarServicio.php', {id: id}, function(data) {
						$.post('../ajax/cliente/dataCliente.php', {rut: $('select[name="rutCliente"]').selectpicker('val')}, function(data) {
							values = $.parseJSON(data);
							$('.dataFacturacion').html(values[0]);
							$('.dataServicios').html(values[1]);
							var count = $('.dataServicios > .tabeData tr th').length -1;
							$('.dataServicios > .tabeData').dataTable({
									"columnDefs": [{
									'orderable': false,
									'targets': [count]
								}, ]
							});
						});
					});
				}
			}
		});
	});

	$(document).on('click', '.delete-personaempresa', function() {
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
					$.post('../ajax/cliente/eliminarCliente.php', {id: id}, function(data) {
						$('.listaCliente').load('../ajax/cliente/listClientes.php',function(){
							var count = $('.listaCliente > .tabeData tr th').length -1;
							$('.listaCliente > .tabeData').dataTable({
								"columnDefs": [{
									'orderable': false,
									'targets': [count]
								}, ]
							});
						});
					});
				}
			}
		});
	});

	$(document).on('click', '.update-personaempresa', function(event) {
		$('#editarCliente').modal('show');
		$.post('../ajax/cliente/dataClienteUpdate.php', {id: $(this).attr('attr')}, function(data) {
			value = $.parseJSON(data);
			$('[name="Nombre_update"]').val(value[0][3]);
			$('[name="Rut_update"]').val(value[0][1]);
			$('[name="Dv_update"]').selectpicker('val',value[0][2]);
			$('[name="DireccionComercial_update"]').val(value[0][4]);
			$('[name="Contacto_update"]').val(value[0][7]);
			$('[name="Telefono_update"]').val(value[0][9]);
			$('[name="Correo_update"]').val(value[0][6]);
			$('[name="Giro_update"]').val(value[0][4]);
			$('[name="Comentario_update"]').val(value[0][8]);
			$('[name="IdCliente"]').val(value[0][0]);
		});
	});

	$(document).on('click', '.actualizarCliente', function() {
		$.postFormValues('../ajax/cliente/updateCliente.php','.container-form-update',function(data){
			$('.listaCliente').load('../ajax/cliente/listClientes.php',function(){
				var count = $('.listaCliente > .tabeData tr th').length -1;
				$('.listaCliente > .tabeData').dataTable({
					"columnDefs": [{
						'orderable': false,
						'targets': [count]
					}, ]
				});
			});
			$('#editarCliente').modal('hide');
			bootbox.alert('<h3 class="text-center">El cliente se actualizo con éxito.</h3>');
		});
	});

	$(document).on('click', '.delete-arriendo_equipos_datos', function() {
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
					$.post('../ajax/cliente/eliminarArriendoEquipo.php', {id: id}, function(data) {
						$.post('../ajax/cliente/tipolistModal.php', {id: $('.containerListDatosTecnicos').attr('idTipoLista')}, function(data) {
							$.post('../ajax/cliente/'+data, {id: $('.containerListDatosTecnicos').attr('idTipoLista')}, function(data) {
								$('.containerListDatosTecnicos').html(data);
								var count = $('.containerListDatosTecnicos > .tabeData tr th').length -1;
								$('.containerListDatosTecnicos > .tabeData').dataTable({
										"columnDefs": [{
										'orderable': false,
										'targets': [count]
									}, ]
								});
							});
						});
					});
				}
			}
		});
	});

	$(document).on('click', '.delete-mantencion_red', function() {
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
					$.post('../ajax/cliente/eliminarMatencionRed.php', {id: id}, function(data) {
						$.post('../ajax/cliente/tipolistModal.php', {id: $('.containerListDatosTecnicos').attr('idTipoLista')}, function(data) {
							$.post('../ajax/cliente/'+data, {id: $('.containerListDatosTecnicos').attr('idTipoLista')}, function(data) {
								$('.containerListDatosTecnicos').html(data);
								var count = $('.containerListDatosTecnicos > .tabeData tr th').length -1;
								$('.containerListDatosTecnicos > .tabeData').dataTable({
										"columnDefs": [{
										'orderable': false,
										'targets': [count]
									}, ]
								});
							});
						});
					});
				}
			}
		});
	});

	$(document).on('click', '.delete-mensualidad_puerdo_publicos', function() {
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
					$.post('../ajax/cliente/eliminarMensualidadPuertoPublico.php', {id: id}, function(data) {
						$.post('../ajax/cliente/tipolistModal.php', {id: $('.containerListDatosTecnicos').attr('idTipoLista')}, function(data) {
							$.post('../ajax/cliente/'+data, {id: $('.containerListDatosTecnicos').attr('idTipoLista')}, function(data) {
								$('.containerListDatosTecnicos').html(data);
								var count = $('.containerListDatosTecnicos > .tabeData tr th').length -1;
								$('.containerListDatosTecnicos > .tabeData').dataTable({
										"columnDefs": [{
										'orderable': false,
										'targets': [count]
									}, ]
								});
							});
						});
					});
				}
			}
		});
	});

	$(document).on('click', '.delete-trafico_generado', function() {
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
					$.post('../ajax/cliente/eliminarArriendoEquipo.php', {id: id}, function(data) {
						$.post('../ajax/cliente/tipolistModal.php', {id: $('.containerListDatosTecnicos').attr('idTipoLista')}, function(data) {
							$.post('../ajax/cliente/'+data, {id: $('.containerListDatosTecnicos').attr('idTipoLista')}, function(data) {
								$('.containerListDatosTecnicos').html(data);
								var count = $('.containerListDatosTecnicos > .tabeData tr th').length -1;
								$('.containerListDatosTecnicos > .tabeData').dataTable({
										"columnDefs": [{
										'orderable': false,
										'targets': [count]
									}, ]
								});
							});
						});
					});
				}
			}
		});
	});

	$('.agregarCampTele').on('click', function() {
		$('.contenedorExtraTelefono').append('<div class="row">'+
					'<div class="col-md-9 form-group">'+
					'<label>Telefono</label>'+
						'<input name="extra_telefono" class="form-control">'+
					'</div>'+
					'<div class="col-md-3">'+
						'<button type="button" class="btn btn-danger btn-block mgExtraButton removeCampTele"><i class="glyphicon glyphicon-remove"></i></button>'+
					'</div>'+
				'</div>');
	});


	$(document).on('click', '.removeCampTele', function() {
		$(this).parents('.row').remove()
	});

	$('.agregarCampCorreo').on('click', function() {
		$('.contenedorExtraCorreo').append('<div class="row">'+
					'<div class="col-md-9 form-group">'+
					'<label>Correo</label>'+
						'<input name="extra_telefono" class="form-control">'+
					'</div>'+
					'<div class="col-md-3">'+
						'<button type="button" class="btn btn-danger btn-block mgExtraButton removeCampCorreo"><i class="glyphicon glyphicon-remove"></i></button>'+
					'</div>'+
				'</div>');
	});


	$(document).on('click', '.removeCampCorreo', function() {
		$(this).parents('.row').remove()
	});









		$(document).on('change', '#origen_id', function () {

				$('#producto_id').empty();
				$('#producto_id').append(new Option('Seleccione Opción',''));

				origen_tipo = 1
				origen_id = $(this).val();

				if(origen_id){

					$.ajax({
							type: "POST",
							url: "../includes/inventario/egresos/getProducto.php",
							data:"&origen_tipo="+origen_tipo+"&origen_id="+origen_id,
							success: function(response){

									$.each(response.array, function( index, array ) {
											$('#producto_id').append('<option value="'+array.id+'" data-content="'+array.tipo + ' ' + array.marca + ' ' + array.modelo+ ' - ' + array.numero_serie+'"></option>');
									});
							}
					});
			}

			setTimeout(function() {
						$('#producto_id').selectpicker('render');
						$('#producto_id').selectpicker('refresh');
				}, 1000);

		});

});