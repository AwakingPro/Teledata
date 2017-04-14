$(document).ready(function()
{
	var nombre_valid = false;
	var email1_valid = false;
	var email2_valid = false;
	var pass1_valid = false;
	var pass2_valid = false;
	var disable = '<input type="submit" value="Registrar"  disabled class="form-input-main-btn-dsb" id="registrar"></div>';
	var enable = '<input type="submit" value="Registrar"  class="form-input-main-btn" id="registrar"></div>';
	var email1 = '';
	var email2 = '';
	var pass1 = '';
	var pass2 = '';
	$("#nombre").keyup(function(){
		var nombre = $(this).val();
		if(nombre == '')
		{
			$("#form-reg-alert").html('El Campo de Nombre no debe estar en blanco');
			$("#btn-dsb").html(disable);
			nombre_valid = false;
		}
		else if(nombre.length >= 80)
		{
			$("#form-reg-alert").html("El Campo de Nombre supera los 80 Caracteres");
			$("#btn-dsb").html(disable);
			nombre_valid = false;
		}
		else
		{	
			nombre_valid = true;
			$("#form-reg-alert").html('');

			if(nombre_valid==true && email1_valid ==true && email2_valid ==true && pass1_valid==true && pass2_valid==true)
			{
				$("#btn-dsb").html(enable);
			}
			else
			{
				$("#btn-dsb").html(disable);
			}
		}
	});	
	$('#email1').keyup(function()
	{
		$('#email1').filter(function()
		{
			email1 = $('#email1').val();
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			if( !emailReg.test(email1) || email1.length==0) 
			{
				$("#form-reg-alert").html("Correo Invalido");
				$("#btn-dsb").html(disable);
				email1_valid = false;
			} 
			else 
			{
				email1_valid = true;
				$("#form-reg-alert").html("");
				if(nombre_valid==true && email1_valid ==true && email2_valid ==true && pass1_valid==true && pass2_valid==true)
				{
					$("#btn-dsb").html(enable);

				}
				else
				{
					$("#btn-dsb").html(disable);
				}
			}
		});
	});	
	$("#email2").keyup(function() 
	{
		email2 = $(this).val();
		if(email1 == email2)
		{
			email2_valid = true;
			$("#form-reg-alert").html("");
			if(nombre_valid==true && email2_valid ==true && email2_valid ==true && pass1_valid==true && pass2_valid==true)
			{
				$("#btn-dsb").html(enable);
			}
			else
			{
				$("#btn-dsb").html(disable);
			}
		}
		else
		{
			$("#form-reg-alert").html("Las Correos no coinciden");
			email2_valid = false;
		}	
	});	

	$("#pass1").keyup(function() 
	{
		pass1 = $(this).val();
		if ( pass1.length < 8  ) 
		{
			$("#btn-dsb").html(disable);
			$("#form-reg-alert").html("La Contraseña debe tener al menos 8 caracteres");
			pass1 = false;
		} 
		else 
		{
			if(pass1.match(/\d/))
			{
				$("#form-reg-alert").html("");
				if(pass1.match(/[A-z]/))
				{
					pass1_valid = true;
					$("#form-reg-alert").html("");
					if(nombre_valid==true && email2_valid ==true && email2_valid ==true && pass1_valid==true && pass2_valid==true)
					{
						$("#btn-dsb").html(enable);
					}
					else
					{
						$("#btn-dsb").html(disable);
					}
				}
				else
				{
					$("#form-reg-alert").html("La Contraseña debe tener al menos 1 Letra");
					pass1_valid = false;
				}	
			}
			else
			{
				$("#form-reg-alert").html("La Contraseña debe tener al menos 1 Numero");
				pass1_valid = false;
			}	
		}
	});	
	$("#pass2").keyup(function() 
	{
		pass2 = $(this).val();
		if(pass1 == pass2)
		{
			pass2_valid = true;
			$("#form-reg-alert").html("");
			if(nombre_valid==true && email2_valid ==true && email2_valid ==true && pass1_valid==true && pass2_valid==true)
			{
				$("#btn-dsb").html(enable);
			}
			else
			{
				$("#btn-dsb").html(disable);
			}
		}
		else
		{
			$("#form-reg-alert").html("Las Contraseñas no coinciden");
			pass2_valid = false;
		}	
	});
	$('#formulario').submit(function(e)
	{
		e.preventDefault();
		$('#gif_carga').show("slow");
		var nombre = $('#nombre').val();
		var pass = $('#pass1').val();
		var email = $('#email1').val();
		var data = 'user='+nombre+'&pass='+pass+'&email='+email;
		$.ajax(
		{
			type : "POST",
			url : "class/inserta.php",
			data : data,
			success : function(resp)
			{
				$('#gif_carga').hide();
				$("#form-reg-alert").html(resp);
			}
		});	
	});
});