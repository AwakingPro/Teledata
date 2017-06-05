$(document).ready(function() {
	$('select[name="Rut"]').load('../ajax/servicios/selectClientes.php',function(){
		$('select[name="Rut"]').selectpicker();
	});
	$('select[name="TipoFacturacion"]').load('../ajax/servicios/selectTipoFactura.php',function(){
		$('select[name="TipoFacturacion"]').selectpicker();
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
});