$(document).ready(function(){
	// Enviar Email Masivo
    $('#enviar-mail').on('click', function(){
        var est = $('#estrategia').val();
        var cant = $('#cantidad-emails').val();
        var asunto = $('#asunto').val();
        var html = $('#summernote').summernote('code');
        if($('#facturas').prop('checked') ) {
			var adjuntar = 1;
		} else {
			var adjuntar = 0;
		}
        if(cant > 0){
			$.ajax({
				type: "POST",
				url: "../includes/email/enviar-correo.php",
				data: { est:est, cant:cant, asunto:asunto, html:html, adjuntar},
				dataType: "html",
				beforeSend: function(){
					$("#message").css("display","block");
					$(".alert").html("Por favor, Espere.");
				},
				success: function(result){
					alert(result);
					if(result==1){
						$(".alert").addClass("alert-warning");
						$(".alert").html("Error, Ya existe un envío programado para la estrategia "+est);
					} else if(result==2) {
						$(".alert").addClass("alert-success");
						$(".alert").html("Envío de email programado");
					} else if(result==3){
						$(".alert").addClass("alert-success");
						$(".alert").html("Envío de email en proceso");
					} else{
						$(".alert").addClass("alert-danger");
						$(".alert").html("Error al intentar envío de correo de correos.");
					}
				},
				error: function(){
					alert('error');
				}
			});
		} else {
			$(".alert").addClass("alert-danger");
			$(".alert").html("Error, La estrategia debe tener al menos un email válido para proceder con el envío.");	
		}
		setTimeout(function() { 
			$("#message").fadeOut(1000);
			$(".alert").html(""); 
			$(".alert").html("");
			$(".alert").removeClass("alert-danger");
			$(".alert").removeClass("alert-warning");
			$(".alert").removeClass("alert-success"); 
		}, 7000);
    });

	// Ejecutar Cron
    $('#ejecutar-cron').on('click', function(){
        $.ajax({
			type: "POST",
			url: "cron-email-masivo.php",
			beforeSend: function(){
				$("#message").css("display","block");
			},
			success: function(result){
				alert(result);
				if(result==1){
					$(".alert").addClass("alert-info");
					$(".alert").html("No existen registros de envío de email programados");

				}else if(result==2) {
					$(".alert").addClass("alert-info");
					$(".alert").html("No ha transcurrido el tiempo de espera para el próximo envío.");
				}else if(result==3) {
					$(".alert").addClass("alert-info");
					$(".alert").html("Envío programado procesado, el próximo envío se ejecutará en 30 min.");
				}
			},
			error: function(){
			}
		});
		setTimeout(function() { 
			$("#message").fadeOut(1000);
			$(".alert").html(""); 
		}, 7000);
    });

    // USAR TEMPLATE
    $('#template').on('change', function(){
        var id = $('#template').val();
		$.ajax({
			type: "POST",
			url: "../includes/email/select-template.php",
			data: { id:id},
			dataType: "html",
			beforeSend: function(){
			},
			success: function(result){
				var data = JSON.parse(result);
				$('#summernote').summernote('code',data[0]);
			},
			error: function(){
				alert('Error seleccionando template');
			}
		});
    });
    // Buscar correos
    $('#estrategia').on('change', function(){
        var table = $('#estrategia').val();
		$.ajax({
			type: "POST",
			url: "../includes/email/info-estrategia.php",
			data: { table:table},
			dataType: "html",
			beforeSend: function(){
			},
			success: function(result){
				var data = JSON.parse(result);
				$('#cantidad-rut').val(data[0]);
				$('#cantidad-emails').val(data[1]);
				$('#enviados').html(data[2]);
				$('#espera').html(data[3]);
				$('#hora').html(data[4]);
			},
			error: function(){
			}
		});
    });
	$("#enviar-prueba").on('click', function(){
		var to = $("#email-prueba").val();
		var asunto = $("#asunto").val();
		var html = $('#summernote').summernote('code');
		if(to){

			$.ajax({
				type: "POST",
				url: "../includes/email/enviar-prueba.php",
				data: { to:to, html:html, asunto: asunto},
				dataType: "html",
				beforeSend: function(){
					$("#message").css("display","block");
					$(".alert").addClass("alert-info");
					$(".alert").html("Enviando");
				},
				success: function(result){
					
					$(".alert").addClass("alert-success");
					$(".alert").html("Email enviado con éxito");
				},
				error: function(){
					$(".alert").addClass("alert-danger");
					$(".alert").html("Error al enviar email");
				}
			});
		} else {
			alert('Indique al menos un correo electrónico.');
		}

		setTimeout(function() { 
			$("#message").fadeOut(1000);
			$(".alert").html(""); 
			$(".alert").removeClass("alert-danger");
			$(".alert").removeClass("alert-success"); 
		}, 7000);
		
	});

	// SUMMERNOTE CLICK TO EDIT
    $('#clean-temp').on('click', function(){
        $('#summernote').summernote('code','');
		//var tname = $("#nombre-template").val('');
    });


    $('.save-temp').on('click', function(){
		var tname = $("#nombre-template").val();
		var template = $('#summernote').summernote('code');
		$("#message").css("display","block");

		$.ajax({
			type: "POST",
			url: "../includes/email/save-template.php",
			data: { tname:tname, template:template},
			dataType: "html",
			beforeSend: function(){
				$("#message").css("display","block");
				$(".alert").addClass("alert-info");
				$(".alert").html("Guardando");
			},
			success: function(result){
				if(result == 1){
					$(".alert").addClass("alert-success");
					$(".alert").html("Template guardado con éxito");
				} else {
					$(".alert").addClass("alert-danger");
					$(".alert").html("Error al guardar template");
				}
			},
			error: function(){
				$("#message").css("display","block");
				$(".alert").addClass("alert-danger");
				$(".alert").html("Error al guardar template");
			}
		}); 
		
		setTimeout(function() { 
			$("#message").fadeOut(1000);
			$(".alert").html(""); 
			$(".alert").removeClass("alert-danger");
			$(".alert").removeClass("alert-success"); 
		}, 7000);
    });
    //UPDATE TEMPLATE (EDITAR)
	$("#update-temp").on('click', function(){
		var tname = $("#nombre-template").val();
		var template = $('#summernote').summernote('code');
		var id = $('#current-template').val();
		if(id){
			$.ajax({
				type: "POST",
				url: "../includes/email/update-template.php",
				data: { tname:tname, template:template, templateid:id},
				dataType: "html",
				beforeSend: function(){
					$("#message").css("display","block");
					$(".alert").addClass("alert-info");
					$(".alert").html("Actualizando");
				},
				success: function(result){
					if(result == 1){
						$(".alert").addClass("alert-success");
						$(".alert").html("Template actualizado con éxito");
					} else {
						$(".alert").addClass("alert-danger");
						$(".alert").html("Error al actualizar template");
					}
				},
				error: function(){
					alert('error');
					$(".alert").addClass("alert-danger");
					$(".alert").html("Error al actualizar template");
				}
			});
		}
		setTimeout(function() { 
			$("#message").fadeOut(1000);
			$(".alert").html(""); 
			$(".alert").removeClass("alert-danger");
			$(".alert").removeClass("alert-success"); 
		}, 7000);
	});
	// ELIMINAR TEMPLATE
	$(".delete-template").each(function(){

		$(this).on('click', function(){
			var tid = $(this).data('id');

			$.ajax({
				type: "POST",
				url: "../includes/email/delete-templates.php",
				data: { templateid:tid },
				dataType: "html",
				beforeSend: function(){
					$("#message").css("display","block");
				},
				success: function(result){
									
					if(result == 2){
						$(".alert").addClass("alert-danger");
						$(".alert").html("Error al eliminar template");
					} else {
						$('tr[data-id="'+tid+'"]').remove();
						$(".alert").addClass("alert-success");
						$(".alert").html("Template eliminado exitosamente.");						
					}
				},
				error:function(){
					alert('error');
				}
			});
			setTimeout(function() { 
				$("#message").fadeOut(1000); 
				$(".alert").html("");
				$(".alert").removeClass("alert-danger");
				$(".alert").removeClass("alert-success"); 
			}, 7000);

		});
	});
	//USAR TEMPLATE
	$(".use-template").each(function(){

		$(this).on('click', function(){
			var tid = $(this).data('id');

			$.ajax({
				type: "POST",
				url: "../includes/email/select-template.php",
				data: { id:tid },
				dataType: "html",
				beforeSend: function(){
					$("#message").css("display","block");
				},
				success: function(result){		
					var data = JSON.parse(result);
					$('#summernote').summernote('code',data[0]);
					$("#current-template").val(data[2]);
					$("#nombre-template").val(data[1]);
					$(".alert").addClass("alert-success");
					$(".alert").html("Template seleccionado.");		
					$("#update-temp").removeClass('disabled');	
				}
			});
			setTimeout(function() { 
				$("#message").fadeOut(1000); 
				$(".alert").html("");
				$(".alert").removeClass("alert-danger");
				$(".alert").removeClass("alert-success"); 
			}, 7000);
		});
	});
	//USAR TEMPLATE
	$(".save-conf").on('click', function(){
		var protocolo = $("input:radio[name=protocol]:checked").val();
		var secure = $("input:radio[name=secure]:checked").val();
		var host = $("#host").val();
		var puerto = $("#port").val();
		var email = $("#email").val();
		var password = $("#pass").val();
		var from = $("#from").val();
		var fromname = $("#fromname").val();

		$.ajax({
			type: "POST",
			url: "../includes/email/save-config.php",
			data: { prot:protocolo,secure:secure,host:host,port:puerto,email:email,pass:password,from:from,fromname:fromname },
			dataType: "html",
			beforeSend: function(){
				$("#message").css("display","block");;
			},
			success: function(result){	
				if(result == 1){	
					$(".alert").removeClass("alert-danger");	
					$(".alert").addClass("alert-success");
					$(".alert").html("Configuración guardada exitosamente.");
				}
			},
			error: function(){
				$(".alert").removeClass("alert-success");
				$(".alert").addClass("alert-danger");
				$(".alert").html("Error al guardar cambios");
			}
		});
		setTimeout(function() { 
			$("#message").fadeOut(1000); 
			$(".alert").html("");
			$(".alert").removeClass("alert-danger");
			$(".alert").removeClass("alert-success"); 
		}, 7000);
	});

	// Reenviar
    $(".reenviar").each(function(){

		$(this).on('click', function(){
			var id = $(this).data('id');

			$.ajax({
				type: "POST",
				url: "../includes/email/reenviar-correo.php",
				data: { id:id },
				dataType: "html",
				beforeSend: function(){
					$("#message").css("display","block");
				},
				success: function(result){									
					if(result == 1){
						$('tr[data-id="'+tid+'"] button').addClass("disabled");
						$(".alert").addClass("alert-success");
						$(".alert").html("Email reenviado exitósamente.");

					} else {		
						$(".alert").addClass("alert-danger");
						$(".alert").html("Error en el envío, por favor intente de nuevo más tarde.");				
					}
				},
				error:function(){
					alert('error');
				}
			});
			setTimeout(function() { 
				$("#message").fadeOut(1000); 
				$(".alert").html("");
				$(".alert").removeClass("alert-danger");
				$(".alert").removeClass("alert-success"); 
			}, 7000);

		});
	});
});