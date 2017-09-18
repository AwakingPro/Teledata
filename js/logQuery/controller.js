$(document).ready(function() {
	$('.listaLog').load('../ajax/logQuery/listaLog.php',function(){
		var count = $('.listaLog > .tabeData tr th').length -1;
		$('.listaLog > .tabeData').dataTable({
			"columnDefs": [{
				'orderable': false,
				'targets': [count]
			}, ]
		});
	});
});