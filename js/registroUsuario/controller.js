$(document).ready(function() {

	$('.listaUsuarios').html('<div class="spinner loading"></div>');
	$('.listaUsuarios').load('../ajax/registroUsuario/listaUSuarios.php',function(){
		var count = $('.listaUsuarios > .tabeData tr th').length -1;
		$('.listaUsuarios > .tabeData').dataTable({
			"columnDefs": [{
				'orderable': false,
				'targets': [count],
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
			}, ]
		});
	});

	$('.insertUsurio').click(function() {
		$.postFormValues('../ajax/registroUsuario/insertUser.php','.container-form', {},function(data){
			if (Number(data) > 0){
				bootbox.alert('<h3 class="text-center">El Usuario se registro con éxito.</h3>');
				$('.listaUsuarios').load('../ajax/registroUsuario/listaUSuarios.php',function(){
					var count = $('.listaUsuarios > .tabeData tr th').length -1;
					$('.listaUsuarios > .tabeData').dataTable({
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
			}else{
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
			}
		});

	});

	$(document).on('click', '.delete-usuarios', function(event) {
        bootbox.alert('<h3 class="text-center">Acción inhabilitada temporalmente</h3>');
        return;
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
					$.post('../ajax/registroUsuario/deleteUsuario.php', {id: id}, function(data) {
						$('.listaUsuarios').load('../ajax/registroUsuario/listaUSuarios.php',function(){
							var count = $('.listaUsuarios > .tabeData tr th').length -1;
							$('.listaUsuarios > .tabeData').dataTable({
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

	$(document).on('click', '.update-usuarios', function() {
		$('#editarPerfil').modal('show')
		$('[name="passUpdate"]').val('');
		$.post('../ajax/registroUsuario/dataPerfil.php', {id: $(this).attr('attr')}, function(data) {
			value = $.parseJSON(data);
			$('[name="usuarioUpdate"]').val(value[0][1]);
			$('[name="nombreUpdate"]').val(value[0][2]);
			$('[name="nivelUpdate"]').selectpicker('val',value[0][4]);
			$('[name="cargoUpdate"]').val(value[0][5]);
			$('[name="correoUpdate"]').val(value[0][6]);
			$('[name="idPerfil"]').val(value[0][0]);
		});
	});

	$(document).on('click', '.actualizarPerfil', function() {
		$.postFormValues('../ajax/registroUsuario/updatePerfil.php','.container-form-update', {},function(data){
			$('.listaUsuarios').load('../ajax/registroUsuario/listaUSuarios.php',function(){
				var count = $('.listaUsuarios > .tabeData tr th').length -1;
				$('.listaUsuarios > .tabeData').dataTable({
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
			$('#editarPerfil').modal('hide');
			bootbox.alert('<h3 class="text-center">El Perfil se actualizo con éxito.</h3>');
		});
	});
});