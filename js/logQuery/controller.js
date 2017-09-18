$(document).ready(function() {
	$('.listaLog').load('../ajax/logQuery/listaLog.php',function(){
		$('.listaLog > .tabeData').dataTable();
	});
});