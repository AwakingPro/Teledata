$(document).ready(function() {
	$('.listaUsuarios').load('../ajax/registroUsuario/listaUSuarios.php',function(){
		var count = $('.listaUsuarios > .tabeData tr th').length -1;
		$('.listaUsuarios > .tabeData').dataTable({
			"columnDefs": [{
				'orderable': false,
				'targets': [count]
			}, ]
		});
	});

	$('.insertUsurio').click(function() {
		$.postFormValues('../ajax/registroUsuario/insertUser.php','.container-form',function(data){
			if (Number(data) > 0){
				bootbox.alert('<h3 class="text-center">El Usuario se registro con éxito.</h3>');
				$('.listaUsuarios').load('../ajax/registroUsuario/listaUSuarios.php',function(){
					var count = $('.listaUsuarios > .tabeData tr th').length -1;
					$('.listaUsuarios > .tabeData').dataTable({
						"columnDefs": [{
							'orderable': false,
							'targets': [count]
						}, ]
					});
				});
			}else{
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
			}
		});

	});

	$(document).on('click', '.delete-usuarios', function(event) {
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
								}, ]
							});
						});
					});
				}
			}
		});
	});

});