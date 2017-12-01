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
									}, ]
								});
							});
						});
					}
				}
			});
		});

	$(document).on('click', '.agregarTipoFacturacion', function() {
		$.postFormValues('../ajax/servicios/insertTipoFacturacion.php','.containerTipoFactura',function(data){
			if (Number(data) > 0){
				$('.listTipoCobro').load('../ajax/TipoCobroServicio/listaCobroServicio.php',function(){
					var count = $('.listTipoCobro > .tabeData tr th').length -1;
					$('.listTipoCobro > .tabeData').dataTable({
						"columnDefs": [{
							'orderable': false,
							'targets': [count]
						}, ]
					});
				});

				$('.containerTipoFactura input').val('');
				bootbox.alert('<h3 class="text-center">Se registro con éxito.</h3>');
			}else{
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
			}
		});
	});
});