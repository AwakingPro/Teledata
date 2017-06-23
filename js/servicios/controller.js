$(document).ready(function() {
	$('[name="Valor"]').number( true, 2 );
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
				bootbox.alert('<h3 class="text-center">El servicio #'+data+' se registro con exito.</h3>');
			}else{
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar el ticket.</h3>');
			}
		});
	});

	$(document).on('click', '.guardarCliente', function() {
		$.postFormValues('../ajax/cliente/insertCliente.php','.container-form2',function(data){
			if (Number(data) > 0){
				bootbox.alert('<h3 class="text-center">El cliente #'+data+' se registro con exito.</h3>');
			}else{
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar el ticket.</h3>');
			}
		});
	});


});