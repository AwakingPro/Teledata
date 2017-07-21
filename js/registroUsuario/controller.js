$(document).ready(function() {
	$('.listaUsuarios').load('../ajax/registroUsuario/listaUSuarios.php',function(){
		var count = $('.listaUsuarios > .tabeData tr th').length -1;
		$('.listaUsuarios > .tabeData').dataTable({
			"columnDefs": [{
				'orderable': false,
				'targets': [count]
			}, ]
		});
	});

});