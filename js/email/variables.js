$(document).ready(function(){
	$('#tipo').on('change', function(){
        var tipo = $('#tipo').val();
		if(tipo == 'tabla'){
			$('#agregar').css('display', 'block');
			$('#previsualizar').css('display', 'block');
			$('#operacion-wrapper').css('display', 'none');
		} else if(tipo == 'operacion'){
			$('#agregar').css('display', 'none');
			$('#operacion-wrapper').css('display', 'block');
			$('#previsualizar').css('display', 'none');
		} else {
			$('#agregar').css('display', 'none');
			$('#operacion-wrapper').css('display', 'none');
			$('#previsualizar').css('display', 'none');
		}
	});
	$('#tabla').on('change', function(){
        var tabla = $('#tabla').val();	
		if(tabla == 'Persona'){
			$('#campos-deuda').css("display","none");
			$('#campos-persona').css("display","block");
		} else if(tabla == 'Deuda'){
			$('#campos-persona').css("display","none");
			$('#campos-deuda').css("display","block");
		}
	});
	$('#agregar').on('click', function(){
        var tabla = $('#tabla').val();	
        var selector = tabla.toLowerCase();
        var campo = $('#campos-'+selector+' select').val();

        var fields = $("#fields").val();
        if(fields == ''){
        	$("#fields").val(campo);
        } else{
        	$("#fields").val(fields+','+campo);        	
        }
        $("#previsualizar table thead tr").append('<th>'+campo+'</th>');
	}); 
	$("#guardar-variable").on('click', function(){
		var nombre = $("#nombre").val();
		var tipo = $("#tipo").val();
		var tabla = $("#tabla").val();
		if(tipo == 'tabla'){
			var campos = $("#fields").val();
		} else{
	        var selector = tabla.toLowerCase();
	        var campos = $('#campos-'+selector+' select').val();
		}
		var operacion = $("#operacion").val();

		if(nombre !== ''){
			$.ajax({
				type: "POST",
				url: "../includes/email/guardar-variable.php",
				data: { nombre: nombre, tabla:tabla, tipo:tipo, campos:campos, operacion:operacion},
				dataType: "html",
				beforeSend: function(){
					$("#message").css("display","block");
					$(".alert").addClass("alert-info");
					$(".alert").html("Guardando");
				},
				success: function(result){
					
					if(result == 1){
						$(".alert").addClass("alert-success");
						$(".alert").html("Variable guardada con éxito");
					} else if(result == 3){
						$(".alert").addClass("alert-danger");
						$(".alert").html("Variable ya exíste. Por favor ingrese un nombre diferente.");
					} else {
						$(".alert").addClass("alert-danger");
						$(".alert").html("Error al guardar variable");
					}
				},
				error: function(){
					$("#message").css("display","block");
					$(".alert").addClass("alert-danger");
					$(".alert").html("Error al guardar variable");
				}
			}); 
		} else{
			$("#message").css("display","block");
			$(".alert").addClass("alert-danger");
			$(".alert").html("Ingrese un nombre de variable");			
		}
		
		setTimeout(function() { 
			$("#message").fadeOut(1000);
			$(".alert").html(""); 
			$(".alert").removeClass("alert-danger");
			$(".alert").removeClass("alert-success"); 
		}, 7000);
	});
	$('#clean').on('click', function(){
		$("#nombre").val('');
        $("#previsualizar table thead tr").html('');
    });
    //USAR TEMPLATE
	$(".edit-var").each(function(){

		$(this).on('click', function(){
			var vid = $(this).data('id');

			$.ajax({
				type: "POST",
				url: "../includes/email/select-var.php",
				data: { id:vid },
				dataType: "html",
				beforeSend: function(){
					$("#message").css("display","block");
				},
				success: function(result){		
					var data = JSON.parse(result);
					$
					$("#current-var").val(data[0]);
					$("#nombre").val(data[1]);	
					$("#tipo").val(data[2]);
					$("#tabla").val(data[3]);	
					$("#operacion").val(data[5]);
					$('#campos-persona').css("display","none");
					$('#campos-deuda').css("display","none");
        			var selector = data[3].toLowerCase();
					if(data[2] == 'valor'){
						$("#campos-"+selector).css('display','block');
						$("#campos-"+selector+" select").val(data[4]);
						$("#previsualizar").css('display','none');
						$("#operacion-wrapper").css('display','none');
					}else if(data[2] == 'tabla'){
						$("#campos-"+selector).css('display','block');
						$("#fields").val(data[4]);
						$("#previsualizar").css('display','block');
						$("#previsualizar table thead tr").html(data[6]);
						$("#operacion-wrapper").css('display','none');
					} else {
						$("#campos-"+selector).css('display','block');
						$("#campos-"+selector+" select").val(data[4]);
						$("#operacion-wrapper").css('display','block');
						$("#previsualizar").css('display','none');
					}
					$('.selectpicker').selectpicker('refresh')
					$("#actualizar-variable").css('display','inline-block');	
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

	// ELIMINAR TEMPLATE
	$(".delete-var").each(function(){

		$(this).on('click', function(){
			var vid = $(this).data('id');

			$.ajax({
				type: "POST",
				url: "../includes/email/delete-var.php",
				data: { vid:vid },
				dataType: "html",
				beforeSend: function(){
					$("#message").css("display","block");
				},
				success: function(result){									
					if(result == 2){
						$(".alert").addClass("alert-danger");
						$(".alert").html("Error al eliminar variable");
					} else {
						$('tr[data-id="'+vid+'"]').remove();
						$(".alert").addClass("alert-success");
						$(".alert").html("Variable eliminada.");						
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
	$("#actualizar-variable").on('click', function(){
		var id = $("#current-var").val();
		var nombre = $("#nombre").val();
		var tipo = $("#tipo").val();
		var tabla = $("#tabla").val();
		if(tipo == 'tabla'){
			var campos = $("#fields").val();
		} else{
	        var selector = tabla.toLowerCase();
	        var campos = $('#campos-'+selector+' select').val();
		}
		var operacion = $("#operacion").val();

		if(nombre !== ''){
			$.ajax({
				type: "POST",
				url: "../includes/email/actualizar-variable.php",
				data: { id:id, nombre: nombre, tabla:tabla, tipo:tipo, campos:campos, operacion:operacion},
				dataType: "html",
				beforeSend: function(){
					$("#message").css("display","block");
					$(".alert").addClass("alert-info");
					$(".alert").html("Guardando");
				},
				success: function(result){
					
					if(result == 1){
						$(".alert").addClass("alert-success");
						$(".alert").html("Cambios guardados con éxito");
					} else if(result == 3){
						$(".alert").addClass("alert-danger");
						$(".alert").html("Variable ya existe, por favor ingrese otro nombre.");
					} else {
						$(".alert").addClass("alert-danger");
						$(".alert").html("Error al guardar cambios");
					}
				},
				error: function(){
					$("#message").css("display","block");
					$(".alert").addClass("alert-danger");
					$(".alert").html("Error al guardar cambios");
				}
			}); 
		} else{
			$("#message").css("display","block");
			$(".alert").addClass("alert-danger");
			$(".alert").html("Ingrese un nombre de variable");			
		}
		
		setTimeout(function() { 
			$("#message").fadeOut(1000);
			$(".alert").html(""); 
			$(".alert").removeClass("alert-danger");
			$(".alert").removeClass("alert-success"); 
		}, 7000);
	});
});
