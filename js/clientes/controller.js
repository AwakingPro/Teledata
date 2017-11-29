$(document).ready(function() {

	//$('[name="Rut"]').number( true, 0,'','');

	$('select[name="rutCliente"]').load('../ajax/cliente/selectNombreCliente.php',function(){
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
		$.postFormValues('../ajax/cliente/insertCliente.php','.form-cont1, .container-form-extraTelefono, .container-form-extraCorreo',function(data){
			console.log(data);
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
				$('#insertCliente')[0].reset();
				$('.selectpicker').selectpicker('refresh')
			}else{
				console.log(data);

				if(data != "Dv"){
					bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
				}else{
					bootbox.alert('<h3 class="text-center">Disculpe el campo Dv es obligatorio.</h3>');
				}
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
		$('.containerTipoServicio').html('<div style="text-align:center; font-size:15px;">Cargando Informacion...</div><div class="spinner loading"></div>');

		var id = $(this).attr('attr');

		$.post('../ajax/cliente/tipoViewModal.php', {id: id}, function(data) {

			$('.containerTipoServicio').load('viewTipoServicio/'+data,function(){
				$('[name="idServicio"]').val(id);
				$('#destino_id').val(id)
				$('select').selectpicker();
				$('.date').datepicker({
					locale: 'es',
					format: 'yyyy-mm-dd'
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
	});

	$(document).on('click', '.listDatosTecnicos', function() {
		$('.containerListDatosTecnicos').html('<div style="text-align:center; font-size:15px;">Cargando Informacion...</div><div class="spinner loading"></div>');
		var id = $(this).attr('attr');
		$.post('../ajax/cliente/tipolistModal.php', {id: id}, function(data) {
			$.post('../ajax/cliente/'+data, {id: id}, function(data) {
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
		console.log('entre');
		var url = $('.container-form-datosTecnicos').attr('attr');
		$.postFormValues('../ajax/cliente/'+url,'.container-form-datosTecnicos',function(data){
			console.log(data);
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
			console.log(value[0][3]);
			$('[name="Nombre_update"]').val(value[0]['nombre']);
			$('[name="Rut_update"]').val(value[0][3]);
			$('[name="DireccionComercial_update"]').val(value[0]['direccion']);
			$('[name="Contacto_update"]').val(value[0]['contacto']);
			$('[name="Telefono_update"]').val(value[0]['telefono']);
			$('[name="Correo_update"]').val(value[0]['correo']);
			$('[name="Giro_update"]').val(value[0]['giro']);
			$('[name="Comentario_update"]').val(value[0]['comentario']);
			$('[name="TipoCliente_update"]').val(value[0]['tipo_cliente']);
			$('[name="Alias_update"]').val(value[0]['alias']);
			$('[name="Comuna_update"]').val(value[0]['comuna']);
			$('[name="Ciudad_update"]').val(value[0]['ciudad']);
			$('[name="IdCliente"]').val(value[0]['id']);
			$('.selectpicker').selectpicker('refresh');
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
						'<input name="extra_telefono[]" class="form-control">'+
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
						'<input name="extra_correo[]" class="form-control">'+
					'</div>'+
					'<div class="col-md-3">'+
						'<button type="button" class="btn btn-danger btn-block mgExtraButton removeCampCorreo"><i class="glyphicon glyphicon-remove"></i></button>'+
					'</div>'+
				'</div>');
	});


	$(document).on('click', '.removeCampCorreo', function() {
		$(this).parents('.row').remove()
	});

	$('.agregarCampContacto').on('click', function() {
		$('.contenedorContactosExtras').append('<div class="row">'+
					'<div class="col-md-5 form-group">'+
						'<label>Tipo de contacto</label>'+
						'<input name="extra_TipoContacto[]" class="form-control">'+
					'</div>'+
					'<div class="col-md-5 form-group">'+
						'<label>Contacto</label>'+
						'<input name="extra_Contacto[]" class="form-control">'+
					'</div>'+
					'<div class="col-md-2">'+
						'<button type="button" class="btn btn-danger btn-block mgExtraButton removeCampContacto"><i class="glyphicon glyphicon-remove"></i></button>'+
					'</div>'+
				'</div>');
	});


	$(document).on('click', '.removeCampContacto', function() {
		$(this).parents('.row').remove()
	});

	$(document).on('change', '#origen_id', function () {

		$('#producto_id').empty();
		$('#producto_id').append(new Option('Seleccione Opción',''));

		origen_tipo = 1
		origen_id = $(this).val();

		console.log(origen_tipo + '  ' +origen_id);

		if(origen_id){

			$.ajax({
					type: "POST",
					url: "../includes/inventario/egresos/getProducto.php",
					data:"&origen_tipo="+origen_tipo+"&origen_id="+origen_id,
					success: function(response){
							console.log(response);
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

	$('input[name="Rut"]').on('blur', function() {

		rut = $(this).val()
		input = $(this)

		if(rut){
			$.post('../ajax/cliente/listCliente.php', {rut: rut}, function(data) {
				data = $.parseJSON(data);
				if(data.length){
					bootbox.alert('<h3 class="text-center">Este rut ya esta registrado.</h3>');
					$(input).val('')
				}
			});
		}
	});

	$('select[name="TipoCliente"]').on('change', function() {
		if($(this).val() == "Boleta"){
			$('input[name="Giro"]').removeAttr('validate')
		}else{
			$('input[name="Giro"]').attr('validate','not_null')
		}
	});
});