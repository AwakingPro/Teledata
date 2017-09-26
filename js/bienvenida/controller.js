$(document).ready(function() {
	$.post('../ajax/bienvenida/countTickets.php', function(data) {
		value = $.parseJSON(data);
		console.log(value[0][0]);
		$('.total').html(value[0][0]);
	});

	$.post('../ajax/bienvenida/countTicketsAbierto.php', function(data) {
		value = $.parseJSON(data);
		console.log(value[0][0]);
		$('.abiertos').html(value[0][0]);
	});

	$.post('../ajax/bienvenida/countTicketsCerrados.php', function(data) {
		value = $.parseJSON(data);
		console.log(value[0][0]);
		$('.cerrados').html(value[0][0]);
	});

	$.post('../ajax/bienvenida/coutTicketsFinalizado.php', function(data) {
		value = $.parseJSON(data);
		console.log(value[0][0]);
		$('.finalizados').html(value[0][0]);
	});

	$('.nameUser').html($('.username ').html());
	$('.imgUser').html('<img class="panel-media-img img-circle img-border-light" src="'+$('.img-user').attr('src')+'" alt="Profile Picture">');

	$('.listaCliente').load('../ajax/bienvenida/listaCliente.php',function(){
		var count = $('.listaCliente > .tabeData tr th').length -1;
		$('.listaCliente > .tabeData').dataTable({
			"columnDefs": [{
				'orderable': false,
				'targets': [count]
			}, ]
		});
	});

	$('.listaServicio').load('../ajax/bienvenida/listaServicio.php',function(){
		$('.listaServicio > .tabeData').dataTable();
	});
});