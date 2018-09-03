$('.listaLog').html('<div style="text-align:center; font-size:15px;">Cargando Informacion...</div><div class="spinner loading"></div>');

$(document).ready(function() {
	$('.listaLog').load('../ajax/logQuery/listaLog.php',function(){
		$('.listaLog > .tabeData').dataTable({
			order: [[1, 'desc']]
		});
	});
});