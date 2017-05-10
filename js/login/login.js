$(document).ready(function(){
	$('.enviarForm').click(function(){
		$.postFormValues('ajax/login/session.php', '.cont-form', function(data){
			values = $.parseJSON(data);
			if (values[0] ==true) {
				window.location = values[1];
			}else{
				bootbox.alert('<h3 class="text-center">Usuario o Contraseña incorecctos</h3>');
			}
		});
	});
});


