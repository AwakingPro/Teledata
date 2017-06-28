$(document).ready(function() {
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
				bootbox.alert('<h3 class="text-center">El cliente #'+data+' se registro con exito.</h3>');
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
			});
		});
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
			});
		});
	});

	$(document).on('click', '.guardarDatosTecnicos', function() {
		var url = $('.container-form-datosTecnicos').attr('attr');
		console.log(url);
		$.postFormValues('../ajax/cliente/'+url,'.container-form-datosTecnicos',function(data){
			console.log(data);
			if (Number(data) > 0){
				bootbox.alert('<h3 class="text-center">Los datos se registron con exito.</h3>');
			}else{
				console.log(data);
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
			$('[name="Dv_update"]').val(value[0][2]);
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
			bootbox.alert('<h3 class="text-center">El ticket se actualizo con exito.</h3>');
		});
	});

});