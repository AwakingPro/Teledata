$(document).ready(function() {
	$('.listaLog').load('../ajax/logLogin/listaLog.php',function(){
		$('.listaLog > .tabeData').dataTable();
	});
});