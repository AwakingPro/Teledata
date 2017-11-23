var maxLat = Math.atan(Math.sinh(Math.PI)) * 180 / Math.PI;
var center
var mapOptions
var map
var mapCenter

$(document).ready(function() {

	google.maps.event.addDomListener(window, 'load', initialize);

	function initialize() {

		center = new google.maps.LatLng(0, 0);

		mapOptions = {
			zoom: 20,
			center: center,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		Map = new google.maps.Map(document.getElementById("Map"), mapOptions);
	}

	function isNumber(n) {
		return !isNaN(parseFloat(n)) && isFinite(n);
	}

	function latRange(n) {
		return Math.min(Math.max(parseInt(n), -maxLat), maxLat);
	}

	function lngRange(n) {
		return Math.min(Math.max(parseInt(n), -180), 180);
	}

	function validLatitude(lat) {
		return isFinite(lat) && Math.abs(lat) <= 90;
	}

	function validLongitude(lng) {
		return isFinite(lng) && Math.abs(lng) <= 180;
	}

	$(".coordenadas").on('blur', function() {

		latitud = $('#Latitud').val();
		longitud = $('#Longitud').val();

		if ($(this).attr('id') == 'Latitud' && latitud) {
			if (latitud) {
				if (!validLatitude(latitud)) {
					bootbox.alert("Ups! Debe ingresar una latitud valida");
					$(this).val('')
				}
			}
		} else if ($(this).attr('id') == 'Longitud' && longitud) {
			if (!validLongitude(longitud)) {
				bootbox.alert("Ups! Debe ingresar una longitud valida");
				$(this).val('')
			}
		}

		if (latitud && longitud) {

			mapCenter = new google.maps.LatLng(latitud, longitud);

			setTimeout(function() {
				google.maps.event.trigger(Map, "resize");
				Map.setCenter(mapCenter);
				Map.setZoom(Map.getZoom());
			}, 1000)
		}
	})

	$('[name="UsuarioPppoe"]').on('blur', function(event) {
		var camo = this;
		$.post('../ajax/servicios/usuarioPPPoE.php', {user: $(this).val()}, function(data) {
			if (data == "true") {
				$(camo).parent('.form-group').addClass('has-error');
				$(camo).val('');
				bootbox.alert('<h3 class="text-center">El usuario Pppoe ya esta registrado.</h3>');

			}
		});
	});

	$('[name="Valor"]').number(true, 2, ',', '.');
	$('.selectpicker').selectpicker();

	$('select[name="Rut"]').load('../ajax/servicios/selectClientes.php', function() {
		$('select[name="Rut"]').selectpicker();
	});

	$('select[name="TipoServicio"]').change(function(event) {
		switch ($(this).val()) {
			case '1':
				url = "arriendoEquipos.php";
				$('#divCostoInstalacion').show();
				break;
			case '2':
				url = "servicioInternet.php";
				$('#divCostoInstalacion').show();
				break;
			case '3':
				url = "mensualidadPuertoPublicos.php";
				$('#divCostoInstalacion').hide();
				break;
			case '4':
				url = "mensualidadIPFija.php";
				$('#divCostoInstalacion').hide();
				break;
			case '5':
				url = "mantencionRed.php";
				$('#divCostoInstalacion').hide();
				break;
			case '6':
				url = "traficoGenerado.php";
				$('#divCostoInstalacion').hide();
				break;
			default:
				url = "404.html";
				$('#divCostoInstalacion').hide();
		}

		$('.containerTipoServicioFormualario').load('../clientesServicios/viewTipoServicio/' + url, function() {
			$('select').selectpicker();
			if (url.trim() == 'arriendoEquipos.php') {
				$.ajax({
					type: "POST",
					url: "../includes/inventario/egresos/getBodega.php",
					success: function(response) {
						$.each(response.array, function(index, array) {
							$('#origen_id').append('<option value="' + array.id + '" data-content="' + array.nombre + '"></option>');
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

	$('select[name="TipoFactura"]').load('../ajax/servicios/selectTipoFactura.php', function() {
		$('select[name="TipoFactura"]').selectpicker();
	});
	$('select[name="TipoServicio"]').load('../ajax/servicios/selectTipoServicio.php', function() {
		$('select[name="TipoServicio"]').selectpicker();
	});

	$('select[name="Grupo"]').load('../ajax/servicios/listGrupo.php', function() {
		$('select[name="Grupo"]').selectpicker('refresh');
	});



	$(document).on('click', '.guardarServ', function() {
		$.postFormValues('../ajax/servicios/insertServicio.php', '.container-form', function(data) {
			console.log(data);
			if (Number(data) > 0) {

				servicio_id = data

				if($('#CostoInstalacion').val() == 1 && ($('#TipoServicio').val() == 1 || $('#TipoServicio').val() == 2)){
					var ObjectMe = $(this);

			        swal({
			            title: "Desea facturar de inmediato el costo de instalacion?",
			            text: "Confirmar facturación!",
			            type: "warning",
			            showCancelButton: true,
			            confirmButtonColor: "#DD6B55",
			            confirmButtonText: "Aceptar!",
			            cancelButtonText: "Cancelar",
			            closeOnConfirm: true
			        },function(isConfirm){
			            if (isConfirm) {
			                $.ajax({
			                    url: "../ajax/servicios/updateCostoInstalacion.php",
			                    type: 'POST',
			                    data:"&id="+servicio_id,
			                    success:function(response){
			                        setTimeout(function() {
			                            if(response == 1){
			                                bootbox.alert('<h3 class="text-center">El servicio #' + servicio_id + ' se registro con éxito.</h3>');
			                            }else{
			                                swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
			                            }
			                        }, 1000);
			                    },
			                    error:function(){
			                        swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
			                    }
			                });
			            }
			        });
				}else{
					bootbox.alert('<h3 class="text-center">El servicio #' + servicio_id + ' se registro con éxito.</h3>');
				}

				Rut = $('#Rut').val()

				$('#formServicio')[0].reset();
				$('.selectpicker').selectpicker('refresh')
				$('#Rut').val(Rut)

			} else {
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
			}
			$.post('../ajax/cliente/dataCliente.php', {
				rut: $('select[name="Rut"]').selectpicker('val')
			}, function(data) {
				values = $.parseJSON(data);
				$('.dataServicios').html(values[1]);
				var count = $('.dataServicios > .tabeData tr th').length - 1;
				$('.dataServicios > .tabeData').dataTable({
					"scrollX": true,
					"columnDefs": [{
						'orderable': false,
						'targets': [count]
					}, ],
					language: {
						processing: "Procesando ...",
						search: '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>',
						searchPlaceholder: "BUSCAR",
						lengthMenu: "Mostrar _MENU_ Registros",
						info: "Mostrando _START_ a _END_ de _TOTAL_ Registros",
						infoEmpty: "Mostrando 0 a 0 de 0 Registros",
						infoFiltered: "(filtrada de _MAX_ registros en total)",
						infoPostFix: "",
						loadingRecords: "...",
						zeroRecords: "No se encontraron registros coincidentes",
						emptyTable: "No hay servicios",
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
	});

	$(document).on('click', '.agregarTipoFacturacion', function() {
		$.postFormValues('../ajax/servicios/insertTipoFacturacion.php', '.containerTipoFactura', function(data) {
			if (Number(data) > 0) {
				$('select[name="TipoFactura"]').load('../ajax/servicios/selectTipoFactura.php', function() {
					$('select[name="TipoFactura"]').selectpicker('refresh');
				});
				bootbox.alert('<h3 class="text-center">Se registro con éxito.</h3>');
			} else {
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
			}
		});
	});

	$(document).on('click', '.agregarGrupo', function() {
		$.postFormValues('../ajax/servicios/insertGrupo.php', '.containerGrupo', function(data) {
			if (Number(data) > 0) {
				$('select[name="Grupo"]').load('../ajax/servicios/listGrupo.php', function() {
					$('select[name="Grupo"]').selectpicker('refresh');
				});
				bootbox.alert('<h3 class="text-center">Se registro con éxito.</h3>');
			} else {
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
			}
		});
	});

	$(document).on('click', '.guardarCliente', function() {
		$.postFormValues('../ajax/servicios/insertCliente.php', '.container-form2', function(data) {
			if (Number(data) > 0) {
				$('.modal').modal('hide');
				bootbox.alert('<h3 class="text-center">El cliente #' + data + ' se registro con éxito.</h3>');
			} else {
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar el cliente.</h3>');
			}
		});
	});


	$(document).on('change', 'select[name="Rut"]', function() {

		if ($('select[name="Rut"]').selectpicker('val') != '') {
			$.post('../ajax/cliente/dataCliente.php', {
				rut: $('select[name="Rut"]').selectpicker('val')
			}, function(data) {
				values = $.parseJSON(data);
				$('.dataServicios').html(values[1]);
				var count = $('.dataServicios > .tabeData tr th').length - 1;
				$('.dataServicios > .tabeData').dataTable({
					"scrollX": true,
					"columnDefs": [{
						'orderable': false,
						'targets': [count]
					}, ],
					language: {
						processing: "Procesando ...",
						search: '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>',
						searchPlaceholder: "BUSCAR",
						lengthMenu: "Mostrar _MENU_ Registros",
						info: "Mostrando _START_ a _END_ de _TOTAL_ Registros",
						infoEmpty: "Mostrando 0 a 0 de 0 Registros",
						infoFiltered: "(filtrada de _MAX_ registros en total)",
						infoPostFix: "",
						loadingRecords: "...",
						zeroRecords: "No se encontraron registros coincidentes",
						emptyTable: "No hay servicios",
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
		}
	});

	$(document).on('click', '.listDatosTecnicos', function() {
		$('.containerListDatosTecnicos').html('<div style="text-align:center; font-size:15px;">Cargando Informacion...</div><div class="spinner loading"></div>');
		var id = $(this).attr('attr');
		$.post('../ajax/cliente/tipolistModal.php', {
			id: id
		}, function(data) {
			$.post('../ajax/cliente/' + data, {
				id: id
			}, function(data) {
				$('.containerListDatosTecnicos').html(data);
				var count = $('.containerListDatosTecnicos > .tabeData tr th').length - 1;
				$('.containerListDatosTecnicos > .tabeData').dataTable({
					"columnDefs": [{
						'orderable': false,
						'targets': [count]
					}, ]
				});
				$('.containerListDatosTecnicos').attr('idTipoLista', id);
			});
		});
	});

	$(document).on('click', '.agregarDatosTecnicos', function() {
		$('.containerTipoServicio').html('<div style="text-align:center; font-size:15px;">Cargando Informacion...</div><div class="spinner loading"></div>');
		var id = $(this).attr('attr');

		$.post('../ajax/cliente/tipoViewModal.php', {
			id: id
		}, function(data) {

			$('.containerTipoServicio').load('../clientesServicios/viewTipoServicio/' + data, function() {
				$('[name="idServicio"]').val(id);
				$('#destino_id').val(id)
				$('select').selectpicker();
				if (data.trim() == 'arriendoEquipos.php') {

					$.ajax({
						type: "POST",
						url: "../includes/inventario/egresos/getBodega.php",
						success: function(response) {
							$.each(response.array, function(index, array) {
								$('#origen_id').append('<option value="' + array.id + '" data-content="' + array.nombre + '"></option>');
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
			callback: function(result) {
				if (result == true) {
					$.post('../ajax/cliente/eliminarServicio.php', {
						id: id
					}, function(data) {
						$.post('../ajax/cliente/dataCliente.php', {
							rut: $('select[name="rutCliente"]').selectpicker('val')
						}, function(data) {
							values = $.parseJSON(data);
							$('.dataServicios').html(values[1]);
							var count = $('.dataServicios > .tabeData tr th').length - 1;
							$('.dataServicios > .tabeData').dataTable({
								"scrollX": true,
								"columnDefs": [{
									'orderable': false,
									'targets': [count]
								}, ],
								language: {
									processing: "Procesando ...",
									search: '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>',
									searchPlaceholder: "BUSCAR",
									lengthMenu: "Mostrar _MENU_ Registros",
									info: "Mostrando _START_ a _END_ de _TOTAL_ Registros",
									infoEmpty: "Mostrando 0 a 0 de 0 Registros",
									infoFiltered: "(filtrada de _MAX_ registros en total)",
									infoPostFix: "",
									loadingRecords: "...",
									zeroRecords: "No se encontraron registros coincidentes",
									emptyTable: "No hay servicios",
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

	$(document).on('click', '.guardarDatosTecnicos', function() {
		var url = $('.container-form-datosTecnicos').attr('attr');
		$.postFormValues('../ajax/cliente/' + url, '.container-form-datosTecnicos', function(data) {
			if (Number(data) > 0) {
				$('.modal').modal('hide')
				bootbox.alert('<h3 class="text-center">Los datos se registraron con éxito.</h3>');
			} else {
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar.</h3>');
			}
		});
	});

	$(document).on('change', '#origen_id', function() {

		$('#producto_id').empty();
		$('#producto_id').append(new Option('Seleccione Opción', ''));

		origen_tipo = 1
		origen_id = $(this).val();

		console.log(origen_tipo + '  ' + origen_id);

		if (origen_id) {

			$.ajax({
				type: "POST",
				url: "../includes/inventario/egresos/getProducto.php",
				data: "&origen_tipo=" + origen_tipo + "&origen_id=" + origen_id,
				success: function(response) {
					console.log(response);
					$.each(response.array, function(index, array) {
						$('#producto_id').append('<option value="' + array.id + '" data-content="' + array.tipo + ' ' + array.marca + ' ' + array.modelo + ' - ' + array.numero_serie + '"></option>');
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

		if (rut) {
			$.post('../ajax/cliente/listCliente.php', {
				rut: rut
			}, function(data) {
				data = $.parseJSON(data);
				if (data.length) {
					bootbox.alert('<h3 class="text-center">Este rut ya esta registrado.</h3>');
					$(input).val('')
				}
			});
		}
	});

	$('select[name="TipoCliente"]').on('change', function() {
		if ($(this).val() == "Boleta") {
			$('input[name="Giro"]').removeAttr('validate')
		} else {
			$('input[name="Giro"]').attr('validate', 'not_null')
		}
	});

});