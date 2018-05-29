var maxLat = Math.atan(Math.sinh(Math.PI)) * 180 / Math.PI;
var center
var mapOptions
var map
var mapCenter

$(document).ready(function() {
	
	$('[name="Rut"]').rut({ useThousandsSeparator: false });

	$('.Giro').load('../ajax/cliente/selectGiros.php', function () {
		$('.Giro').selectpicker('refresh');
	});

	$('.ClaseCliente').load('../ajax/cliente/selectClaseCliente.php', function () {
		$('.ClaseCliente').selectpicker('refresh');
	});

	google.maps.event.addDomListener(window, 'load', initialize);

	function initialize() {

		center = new google.maps.LatLng(-41.3214705, -73.0138898);

		mapOptions = {
			zoom: 13,
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

	$('[name="UsuarioPppoeTeorico"]').on('blur', function(event) {
		var camo = this;
		$.post('../ajax/servicios/UsuarioPppoeTeorico.php', {user: $(this).val()}, function(data) {
			if (data == "true") {
				$(camo).parent('.form-group').addClass('has-error');
				$(camo).val('');
				bootbox.alert('<h3 class="text-center">El usuario Pppoe ya esta registrado.</h3>');

			}
		});
	});

	$('[name="Valor"]').number(true, 2, ',', '.');
	$('[name="Descuento"]').number(true, 0, '.', '');
	$('[name="CostoInstalacion"]').number(true, 2, ',', '.');

	$('select[name="Rut"]').load('../ajax/servicios/selectClientes.php', function() {
		$('select[name="Rut"]').selectpicker('refresh');
	});

	$('select[name="TipoServicio"]').change(function(event) {

		Latitud = $('#Latitud').val()
		Longitud = $('#Longitud').val()

		switch ($(this).val()) {
			case '1':
				url = "arriendoEquipos.php";
				$('#otrosServicios').show()
				break;
			case '2':
				url = "servicioInternet.php";
				$('#otrosServicios').show()
				break;
			case '3':
				url = "mensualidadPuertoPublicos.php";
				$('#otrosServicios').hide()
  				$('#otrosServicios').find('input').val('');  
				break;
			case '4':
				url = "mensualidadIPFija.php";
				$('#otrosServicios').hide()
  				$('#otrosServicios').find('input').val('');  
				break;
			case '5':
				url = "mantencionRed.php";
				$('#otrosServicios').hide()
  				$('#otrosServicios').find('input').val('');  
				break;
			case '6':
				url = "traficoGenerado.php";
				$('#otrosServicios').hide()
  				$('#otrosServicios').find('input').val('');  
				break;
			default:
				url = "404.html";
				$('#otrosServicios').hide()
  				$('#otrosServicios').find('input').val('');    
		}

		$('#Latitud').val(Latitud)
 		$('#Longitud').val(Longitud)

 		if (Longitud && Longitud) {

			mapCenter = new google.maps.LatLng(Longitud, Longitud);

			setTimeout(function() {
				google.maps.event.trigger(Map, "resize");
				Map.setCenter(mapCenter);
				Map.setZoom(Map.getZoom());
			}, 1000)
		}

		$('.containerTipoServicioFormulario').load('../clientesServicios/viewTipoServicio/' + url, function() {
			$('select').selectpicker();
			if (url.trim() == 'arriendoEquipos.php' || url.trim() == 'servicioInternet.php') {
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
					$('.selectpicker').selectpicker('refresh');
				}, 1000);
			}
		});
	});

	$('#BooleanCostoInstalacion').change(function(event) {
		if($(this).val() == 1){
			$('#divCostoInstalacion').show();
			$('input[name="CostoInstalacion"]').attr('validation','not_null')
		}else{
			$('#divCostoInstalacion').hide();
			$('input[name="CostoInstalacion"]').removeAttr('validation')
		}
	});

	$('select[name="TipoFactura"]').load('../ajax/servicios/selectTipoFactura.php', function() {
		$('select[name="TipoFactura"]').selectpicker('refresh');
	});
	$('select[name="TipoServicio"]').load('../ajax/servicios/selectTipoServicio.php', function() {
		$('select[name="TipoServicio"]').selectpicker('refresh');
	});

	$('select[name="Grupo"]').load('../ajax/servicios/listGrupo.php', function() {
		$('select[name="Grupo"]').selectpicker('refresh');
	});

	$('body').on('focus',".date", function(){
		$('.date').datetimepicker({
	        locale: 'es',
	        format: 'DD-MM-YYYY'
	    });
	});

	var swalFunction = function(){
		Rut = $('#Rut').val()
        swal({
            title: "Desea cobrar de inmediato el costo de instalacion?",
            text: "Confirmar facturación!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Si",
            cancelButtonText: "No",
            closeOnConfirm: true,
            allowOutsideClick: false
        },function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url: "../ajax/servicios/updateCostoInstalacion.php",
                    type: 'POST',
                    data:"&id="+servicio_id,
                    success:function(response){
                        setTimeout(function() {
                            if(response == 1){
                            	setTimeout(function() {
									$('html,body').animate({
							          scrollTop: $(".panel-heading").offset().top-90,
							        }, 1500);
								}, 1000);
                                bootbox.alert('<h3 class="text-center">El servicio #' + servicio_id + ' se registro con éxito.</h3>');
                                $('#otrosServicios').hide()
                            }else{
                                swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
                            }
                        }, 1000);
                    },
                    error:function(){
                        swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
                    }
                });
            }else{
            	bootbox.alert('<h3 class="text-center">El servicio #' + servicio_id + ' se registro con éxito.</h3>');
            }

            $('#formServicio')[0].reset();
			$('.selectpicker').selectpicker('refresh')
			$('#Rut').val(Rut)
			$('#divCostoInstalacion').show()
			$('.selectpicker').selectpicker('refresh')

        });
	};

	$(document).on('click', '.guardarServ', function() {

		Rut = $('#Rut').val()
		BooleanCostoInstalacion = $('#BooleanCostoInstalacion').val();

		$.postFormValues('../ajax/servicios/insertServicio.php', '.container-form', function(data) {
			if (Number(data) > 0) {

				servicio_id = data

				if(BooleanCostoInstalacion == 1){
					swalExtend({
				        swalFunction: swalFunction,
				        hasCancelButton: true,
				        buttonNum: 1,
				        buttonColor: ["gray"],
				        buttonNames: ["Cancelar"],
				        clickFunctionList: [
				            function() {
				            	$.post('../ajax/cliente/eliminarServicio.php', {
									id: servicio_id
								}, function(data) {
									$.post('../ajax/cliente/dataCliente.php', {
										rut: Rut
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

									swal.close()

								});
				            }
				        ]
				    });
				}else{
					bootbox.alert('<h3 class="text-center">El servicio #' + servicio_id + ' se registro con éxito.</h3>');
					$('#formServicio')[0].reset();
					$('.selectpicker').selectpicker('refresh')
					$('#divCostoInstalacion').show()
					$('#Rut').val(Rut)
					$('.selectpicker').selectpicker('refresh')
					$('#otrosServicios').hide()
					setTimeout(function() {
						$('html,body').animate({
				          scrollTop: $(".panel-heading").offset().top-90,
				        }, 1500);
					}, 1000);
				}

			} else {
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
			}

			$.post('../ajax/cliente/dataCliente.php', {
				rut: Rut
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

				text = $('#Rut option:selected').text()
				split = text.split('-');
				tipo_cliente = split[2].trim()

				if(tipo_cliente == "Boleta"){

					$("#TipoFactura option[value='FSMI']").remove();
					$("#TipoFactura option[value='FSMIOC']").remove();

					if($("#TipoFactura option[value='BSMI']").length == 0){
						$("#TipoFactura").append('<option value="BSMI">BSMI - Boleta Servicio Mensual Individual</option>');
					}
				}else{

					$("#TipoFactura option[value='BSMI']").remove();

					if($("#TipoFactura option[value='FSMI']").length == 0){
						$("#TipoFactura").append('<option value="FSMI">FSMI - Factura servicio mensual</option>');
						$("#TipoFactura").append('<option value="FSMIOC">FSMIOC - Factura servicio Mensual Orden de Compra</option>');
					}
				}

				$('#TipoFactura').selectpicker('refresh');
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
				$('.selectpicker').selectpicker();
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
						$.post('../ajax/cliente/dataCliente.php', {rut: $('select[name="Rut"]').selectpicker('val')}, function(data) {
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