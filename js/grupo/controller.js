$(document).ready(function() {
	$('.listGrupo').load('../ajax/grupo/listaGrupo.php',function(){
		var count = $('.listGrupo > .tabeData tr th').length -1;
		$('.listGrupo > .tabeData').dataTable({
			"columnDefs": [{
				'orderable': false,
				'targets': [count]
			}, ]
		});
	});

	$(document).on('click', '.delete-grupo_servicio', function() {
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
						$.post('../ajax/grupo/deleteGrupo.php', {id: id}, function(data) {
							$('.listGrupo').load('../ajax/grupo/listaGrupo.php',function(){
								var count = $('.listGrupo > .tabeData tr th').length -1;
								$('.listGrupo > .tabeData').dataTable({
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