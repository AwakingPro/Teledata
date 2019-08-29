$(document).ready(function(){
	$('.enviarForm').click(function(){
		$('.load').html('<div class="spinner loading"></div>');
		$.postFormValues('ajax/login/session.php', '.cont-form', {}, function(data){
			values = $.parseJSON(data);
			if (values[0] ==true) {
				window.location = values[1];
			}else if(values[0] == 2){
				$('.load').html('');
				bootbox.alert('<h3 class="text-center">Ya existe una sessión con este usuario</h3>');
			}
			else{
				$('.load').html('');
				bootbox.alert('<h3 class="text-center">Usuario o Contraseña incorrectos</h3>');
			}
		});
	});

	$('[name="password"]').keypress(function(e) {
		if(e.which == 13) {
			$('.load').html('<div class="spinner loading"></div>');
			$.postFormValues('ajax/login/session.php', '.cont-form', {}, function(data){
				values = $.parseJSON(data);
				if (values[0] ==true) {
					window.location = values[1];
				}else{
					$('.load').html('');
					bootbox.alert('<h3 class="text-center">Usuario o Contraseña incorrectos</h3>');
				}
			});
		}
	});
});


