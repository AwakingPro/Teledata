$(document).ready(function() {
	$('#cliente').load('../ajax/tickets/listCliente.php');
	$('.listaAbiertos').load('../ajax/tickets/listAbiertos.php',function(){
		$('.listaAbiertos .tabeData').dataTable();
	});
	$('.guardarTicket').click(function() {
		$.postFormValues('../ajax/tickets/insertData.php','.cont-form1',function(data){
			if (Number(data) > 0){
				$('.listaAbiertos').load('../ajax/tickets/listAbiertos.php',function(){
					$('.listaAbiertos .tabeData').dataTable();
				});
				bootbox.alert('<h3 class="text-center">El ticket se registro con exito.</h3>');
			}else{
				bootbox.alert('<h3 class="text-center">Se produjo un error al guardar el ticket.</h3>');
			}
		});
	});
});