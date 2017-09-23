$(document).ready(function() {
	$('[name="Valor"]').number( true, 0,',','.');

	$('select[name="Rut"]').load('../ajax/servicios/selectClientes.php',function(){
		$('select[name="Rut"]').selectpicker();
	});
	$('select[name="TipoFactura"]').load('../ajax/servicios/selectTipoFactura.php',function(){
		$('select[name="TipoFactura"]').selectpicker();
	});
	$('select[name="TipoServicio"]').load('../ajax/servicios/selectTipoServicio.php',function(){
		$('select[name="TipoServicio"]').selectpicker();
	});

	$(document).on('click', '.guardarServ', function() {
		$.postFormValues('../ajax/servicios/insertServicio.php','.container-form',function(data){
			if (Number(data) > 0){
				bootbox.alert('<h3 class="text-center">El servicio #'+data+' se registro con éxito.</h3>');
			}else{
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
			}

			Rut = $('#Rut').val()

			$('#formServicio')[0].reset();
			$('.selectpicker').selectpicker('refresh')
			$('#Rut').val(Rut)

			$.post('../ajax/cliente/dataCliente.php', {rut: $('select[name="Rut"]').selectpicker('val')}, function(data) {
				values = $.parseJSON(data);
				$('.dataServicios').html(values[1]);
				var count = $('.dataServicios > .tabeData tr th').length -1;
				$('.dataServicios > .tabeData').dataTable({
						"columnDefs": [{
						'orderable': false,
						'targets': [count]
					}, ],	
					language: {
                        processing:     "Procesando ...",
                        search:         '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>',
                        searchPlaceholder: "BUSCAR",
                        lengthMenu:     "Mostrar _MENU_ Registros",
                        info:           "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                        infoEmpty:      "Mostrando 0 a 0 de 0 Registros",
                        infoFiltered:   "(filtrada de _MAX_ registros en total)",
                        infoPostFix:    "",
                        loadingRecords: "...",
                        zeroRecords:    "No se encontraron registros coincidentes",
                        emptyTable:     "No hay servicios",
                        paginate: {
                            first:      "Primero",
                            previous:   "Anterior",
                            next:       "Siguiente",
                            last:       "Ultimo"
                        },
                        aria: {
                            sortAscending:  ": habilitado para ordenar la columna en orden ascendente",
                            sortDescending: ": habilitado para ordenar la columna en orden descendente"
                        }
                    }
				});
			});

		});
	});

	$(document).on('click', '.agregarTipoFacturacion', function() {
		$.postFormValues('../ajax/servicios/insertTipoFacturacion.php','.containerTipoFactura',function(data){
			if (Number(data) > 0){
				$('select[name="TipoFactura"]').load('../ajax/servicios/selectTipoFactura.php',function(){
					$('select[name="TipoFactura"]').selectpicker('refresh');
				});
				bootbox.alert('<h3 class="text-center">Se registro con éxito.</h3>');
			}else{
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
			}
		});
	});

	$(document).on('click', '.guardarCliente', function() {
		$.postFormValues('../ajax/cliente/insertCliente.php','.container-form2',function(data){
			if (Number(data) > 0){
				bootbox.alert('<h3 class="text-center">El cliente #'+data+' se registro con éxito.</h3>');
			}else{
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar el ticket.</h3>');
			}
		});
	});


	$(document).on('change', 'select[name="Rut"]', function() {

		if ($('select[name="Rut"]').selectpicker('val') != '') {
			$.post('../ajax/cliente/dataCliente.php', {rut: $('select[name="Rut"]').selectpicker('val')}, function(data) {
				values = $.parseJSON(data);
				$('.dataServicios').html(values[1]);
				var count = $('.dataServicios > .tabeData tr th').length -1;
				$('.dataServicios > .tabeData').dataTable({
						"columnDefs": [{
						'orderable': false,
						'targets': [count]
					}, ],	
					language: {
                        processing:     "Procesando ...",
                        search:         '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>',
                        searchPlaceholder: "BUSCAR",
                        lengthMenu:     "Mostrar _MENU_ Registros",
                        info:           "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                        infoEmpty:      "Mostrando 0 a 0 de 0 Registros",
                        infoFiltered:   "(filtrada de _MAX_ registros en total)",
                        infoPostFix:    "",
                        loadingRecords: "...",
                        zeroRecords:    "No se encontraron registros coincidentes",
                        emptyTable:     "No hay servicios",
                        paginate: {
                            first:      "Primero",
                            previous:   "Anterior",
                            next:       "Siguiente",
                            last:       "Ultimo"
                        },
                        aria: {
                            sortAscending:  ": habilitado para ordenar la columna en orden ascendente",
                            sortDescending: ": habilitado para ordenar la columna en orden descendente"
                        }
                    }
				});
			});
		}
	});

	$(document).on('click', '.listDatosTecnicos', function() {
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

	$(document).on('click', '.agregarDatosTecnicos', function() {

		var id = $(this).attr('attr');

		$.post('../ajax/cliente/tipoViewModal.php', {id: id}, function(data) {

			$('.containerTipoServicio').load('../clientesServicios/viewTipoServicio/'+data,function(){
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
							$('.dataServicios').html(values[1]);
							var count = $('.dataServicios > .tabeData tr th').length -1;
							$('.dataServicios > .tabeData').dataTable({
									"columnDefs": [{
									'orderable': false,
									'targets': [count]
								}, ],	
								language: {
			                        processing:     "Procesando ...",
			                        search:         '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>',
			                        searchPlaceholder: "BUSCAR",
			                        lengthMenu:     "Mostrar _MENU_ Registros",
			                        info:           "Mostrando _START_ a _END_ de _TOTAL_ Registros",
			                        infoEmpty:      "Mostrando 0 a 0 de 0 Registros",
			                        infoFiltered:   "(filtrada de _MAX_ registros en total)",
			                        infoPostFix:    "",
			                        loadingRecords: "...",
			                        zeroRecords:    "No se encontraron registros coincidentes",
			                        emptyTable:     "No hay servicios",
			                        paginate: {
			                            first:      "Primero",
			                            previous:   "Anterior",
			                            next:       "Siguiente",
			                            last:       "Ultimo"
			                        },
			                        aria: {
			                            sortAscending:  ": habilitado para ordenar la columna en orden ascendente",
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
		$.postFormValues('../ajax/cliente/'+url,'.container-form-datosTecnicos',function(data){
			if (Number(data) > 0){
				$('.modal').modal('hide')
				bootbox.alert('<h3 class="text-center">Los datos se registraron con éxito.</h3>');
			}else{
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar.</h3>');
			}
		});
	});

});