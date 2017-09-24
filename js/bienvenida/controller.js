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
});