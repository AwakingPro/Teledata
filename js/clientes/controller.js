$(document).ready(function() {
	$('select[name="selectCliente"]').load('../ajax/cliente/selectClientes.php',function(){
		$('select[name="selectCliente"]').selectpicker();
	});

	$(document).on('click', '.guardarCliente', function() {
		$.postFormValues('../ajax/cliente/insertCliente.php','.form-cont1',function(data){
			if (Number(data) > 0){
				bootbox.alert('<h3 class="text-center">El cliente #'+data+' se registro con exito.</h3>');
			}else{
				console.log(data);
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar el ticket.</h3>');
			}
		});
	});

	$(document).on('click', '.buscarCliente', function() {
		$.post('../ajax/cliente/dataCliente.php', {rut: $('select[name="selectCliente"]').selectpicker('val')}, function(data) {
			console.log(data)
		});
	});
});