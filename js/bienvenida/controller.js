$(document).ready(function() {

	$.post('../includes/facturacion/facturas/generarFacturasMensuales.php', function(data) {
		value = $.parseJSON(data);
	});

	$.post('../ajax/bienvenida/countTickets.php', function(data) {
		value = $.parseJSON(data);
		$('.total').html(value[0][0]);
	});

	$.post('../ajax/bienvenida/countTicketsAbierto.php', function(data) {
		value = $.parseJSON(data);
		$('.abiertos').html(value[0][0]);
	});

	$.post('../ajax/bienvenida/countTicketsCerrados.php', function(data) {
		value = $.parseJSON(data);
		$('.cerrados').html(value[0][0]);
	});

	$.post('../ajax/bienvenida/coutTicketsFinalizado.php', function(data) {
		value = $.parseJSON(data);
		$('.finalizados').html(value[0][0]);
	});

	$.post('../ajax/bienvenida/porcentajesTickes.php', function(data) {
		value = $.parseJSON(data);
		console.log(value);
		$('.porcAbiertos').css('width', value[0]+'%');
		$('.porcAbiertosTxt').html(value[0]+'%');

		$('.porcCerrados').css('width', value[1]+'%');
		$('.porcCerradosTxt').html(value[1]+'%');

		$('.porcFinalizado').css('width', value[1]+'%');
		$('.porcFinalizadoTxt').html(value[1]+'%');
	});


	$('.nameUser').html($('.username ').html());
	$('.imgUser').html('<img class="panel-media-img img-circle img-border-light" src="'+$('.img-user').attr('src')+'" alt="Profile Picture">');

	$('.listaCliente').load('../ajax/bienvenida/listaCliente.php',function(){
		$('.listaCliente > .tabeData').dataTable();
	});

	$('.listaServicio').load('../ajax/bienvenida/listaServicio.php',function(){
		$('.listaServicio > .tabeData').dataTable();
	});
});