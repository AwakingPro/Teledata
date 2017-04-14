$(document).ready(function()
{

  var cedente = $('#cedente').val();
  var nombreUsuario = $('#nombreUsuario').val();
  var datos = "cedente="+cedente+"&nombreUsuario="+nombreUsuario;
  $.ajax({
      type:"POST",
      url:"../includes/estrategia/estrategia.php",
      data:datos,
      success:function(data){
        $('.listadoEstretegias').html(data);
        $('#TablaVerEstrategia').dataTable();

      }
  });

  $(document).on('click', '.VerEstrategia', function()
  {
		var IdEstrategia=  this.id;
		var SesionEstrategia = "Id="+IdEstrategia;
	  	$.ajax(
		{
			type:"POST",
			url:"../includes/estrategia/SesionEstrategia.php",
			data:SesionEstrategia,
			success:function(response)
			{
				window.location.replace("VerEstrategias.php");
			}
		});
  });




 	$('#refrescar').submit(function(e)
	{
		e.preventDefault();
	 	window.location.reload(true);
	});
 	$("#tablas").change(function()
    {
	    var id_tabla2 = $('#tablas').val();
	    var id_tabla = 'id_tabla='+id_tabla2;
		var disable_columna;
		var disable_logica;
		var disable_valor;
		var disable_cola;
		var disable_submit;
	 	if(id_tabla2==='0')
	    {
	    	disable_columna = '<select disabled="disabled" name="columnas" class="text2">';
		    disable_columna += '<option value="0">Seleccione Columna</option></select>';
			$("#midiv").html(disable_columna);
			disable_logica = '<select   disabled="disabled" name="columnas" class="text2">';
			disable_logica += '<option value=0>Seleccione Lógica</option></select>';
	     	$("#midiv2").html(disable_logica);
			disable_valor = '<input type="text" value="  Ingrese Valor" ';
			disable_valor += 'disabled="disabled" class="text2">';
	     	$("#midiv3").html(disable_valor);
			disable_cola = '<br><input type="text" value="  Nombre Cola"';
			disable_cola += 'disabled="disabled" class="text2">';
	     	$("#midiv4").html(disable_cola);
			disable_submit = '<br><input type="submit" disabled="disabled" value="Crear Consulta"';
			disable_submit += 'class="btn btn-primary btn-block">';
	     	$("#midiv5").html(disable_submit);
		}
	  	else
	    {
	    	$("#midiv2").html(disable_logica);
			$("#midiv3").html(disable_valor);
			$("#midiv4").html(disable_cola);
			$("#midiv5").html(disable_submit);
		    $.ajax(
		    {
		        type: "POST",
		        url: "../includes/estrategia/columnas.php",
		        data:id_tabla,
		        success: function(response)
            	{
					$("#midiv").html(response);
					$("#columnas").change(function()
			    	{
		                console.log("aca");
						var id_columnas = $('#columnas').val();
					    var id_columna = 'id_columna='+id_columnas;
			     		if(id_columnas==="0")
			        	{
					        console.log('si');

							disable_logica = '<select   disabled="disabled" name="columnas" class="text2">';
							disable_logica += '<option value=0>Seleccione Lógica</option></select>';
							$("#midiv2").html(disable_logica);
							disable_valor = '<input type="text" value="  Ingrese Valor" ';
							disable_valor += 'disabled="disabled" class="text2">';
							$("#midiv3").html(disable_valor);
							disable_cola = '<br><input type="text" value="  Nombre Cola"';
							disable_cola += 'disabled="disabled" class="text2">';
							$("#midiv4").html(disable_cola);
							disable_submit = '<br><input type="submit" disabled="disabled" value="Crear Consulta"';
							disable_submit += 'class="btn btn-primary btn-block">';
							$("#midiv5").html(disable_submit);
						}
			     		else
			        	{
					        console.log('no');
							$("#midiv3").html(disable_valor);
					        $("#midiv4").html(disable_cola);
						    $("#midiv5").html(disable_submit);
                     		$.ajax(
                        	{
		                        type: "POST",
		        				url: "../includes/estrategia/logica.php",
		                        data:id_columna,
		                        success: function(response)
                            	{
						 			$("#midiv2").html(response);
									$("#logica").change(function()
							    	{
							   		 	var id_logica = $('#logica').val();
							    		if(id_logica==='0')
							       		{
										    $("#midiv3").html(disable_valor);
										    $("#midiv4").html(disable_cola);
										    $("#midiv5").html(disable_submit);
										}
										else
										{
				     						var id_columna = 'id_columna='+id_columnas;
											$('body').addClass("loading");

							     			$.ajax(
				                        	{
						                        type: "POST",
						                        url: "../includes/estrategia/valor.php",
						                        data:id_columna,
						                        success: function(response)
				                            	{
													$("#midiv3").html(response);
													$('body').removeClass("loading");
												    var input_cola = '<br /><input type="text" title="Debe darle un nombre a la cola"';
													input_cola += 'placeholder="  Nombre Cola" required id="nombre_nivel"';
													input_cola += ' class="text1" name="nombre_nivel">';
													$("#midiv4").html(input_cola);
													var input_submit = '<br><input type="submit" value="Crear Consulta"';
													input_submit += 'class="btn btn-primary btn-block" >';
					                                $("#midiv5").html(input_submit);
                                            	}
                                       		});
                                    	}
							    	});
				           		}
                        	});
			        	}
                	});
				}
	   	 	});
		}
	});
	$('#form1').submit(function(e)
    {
	    e.preventDefault();
        $('body').addClass("loading");
        var nivel = $('#nivel').val();
	    var tablas = $('#tablas').val();
	    var id_clases = $('#id_clases').val();
		console.log(id_clases);
	    var columnas = $('#columnas').val();
	    var id_estrategia= $('#id_estrategia').val();
	    var logica = $('#logica').val();
	    var valor = $('#valor').val();
	    var cedente= $('#cedente').val();
		console.log(valor);
	    var siguiente_nivel = $('#siguiente_nivel').val();
	    var nombre_nivel = $('#nombre_nivel').val();
	    var datos_formulario = 'id_clases='+id_clases+'&tablas='+tablas+'&columnas='+columnas+'&logica='+logica+'&valor='+valor+'&siguiente_nivel='+siguiente_nivel+'&nombre_nivel='+nombre_nivel+'&id_estrategia='+id_estrategia+'&cedente='+cedente;
	    if(nivel==="0")
	  	{
	        $.ajax(
	    	{
			    type: "POST",
				url: "../includes/estrategia/relacion1.php",
				data:datos_formulario,
				dataType: 'json',
				success: function(response)
				{
					$('body').removeClass("loading");
					$('.oculto').show();
					$('.mostrar').hide();
					//$('#demo-dt-basic tr:last').after(response.first);
					$('#id_clases').html(response.second);
					$('#form1')[0].reset();
					$('#midiv200').html('<div class="alert alert-warning fade in">Todos los Registros Seleccionados</div>');
					$('#midiv100').hide();
					var disable_columna;
					var disable_logica;
					var disable_valor;
					var disable_cola;
					var disable_submit;
					var disable_tabla = '<select   disabled="disabled" class="select2"><option value="">';
					disable_tabla += 'Seleccione Tabla</option></select><br><br>';
					$('#midiv101').html(disable_tabla);
					disable_columna = '<select disabled="disabled" name="columnas" class="text2">';
					disable_columna += '<option value="0">Seleccione Columna</option></select>';
					$("#midiv").html(disable_columna);
					disable_logica = '<select   disabled="disabled" name="columnas" class="text2">';
					disable_logica += '<option value=0>Seleccione Lógica</option></select>';
					$("#midiv2").html(disable_logica);
					disable_valor = '<input type="text" value="  Ingrese Valor" ';
					disable_valor += 'disabled="disabled" class="text2">';
					$("#midiv3").html(disable_valor);
					disable_cola = '<br><input type="text" value="  Nombre Cola"';
					disable_cola += 'disabled="disabled" class="text2">';
					$("#midiv4").html(disable_cola);
					disable_submit = '<br><input type="submit" disabled="disabled" value="Crear Consulta"';
					disable_submit += 'class="btn btn-primary btn-block">';
					$("#midiv5").html(disable_submit);
					location.reload();
           		}
	    	});
	    }
	    else
	    {
	        $('body').addClass("loading");
		   	nivel = $('#nivel').val();
		    id_clases = $('#id_clases').val();
			console.log('acaid'+id_clases);
		    tablas = $('#tablas').val();
		    columnas = $('#columnas').val();
		    id_estrategia= $('#id_estrategia').val();
		    logica = $('#logica').val();
		    valor = $('#valor').val();
		    cedente= $('#cedente').val();
		    siguiente_nivel = $('#siguiente_nivel').val();
		    nombre_nivel = $('#nombre_nivel').val();
	    	datos_formulario = 'id_clases='+id_clases+'&tablas='+tablas+'&columnas='+columnas+'&logica='+logica+'&valor='+valor+'&siguiente_nivel='+nivel+'&nombre_nivel='+nombre_nivel+'&id_estrategia='+id_estrategia+'&cedente='+cedente;
	     	$.ajax(
	    	{
			    type: "POST",
				url: "../includes/estrategia/relacion2.php",
				data:datos_formulario,
				dataType: 'json',
				success: function(response)
				{
					$('body').removeClass("loading");
		            //$("#" + nivel ).after(response.uno);
		            var folder='#b'+nivel;
		            var est='#d'+nivel;
		            var trash='#f'+nivel;
		            $(folder).show();
		            $(trash).show();
		            $(est).hide();
		            $('#id_clases').html(response.dos);
					console.log(response.dos);
		            $('#form1')[0].reset();
					$('#midiv200').html('<div class="alert alert-warning fade in">Todos los Registros Seleccionados</div>');
					$('#midiv100').hide();
					$('#midiv101').show();
					var disable_tabla = '<select   disabled="disabled" class="select2"><option value="">';
					disable_tabla += 'Seleccione Tabla</option></select><br><br>';
					$('#midiv101').html(disable_tabla);
					var disable_columna = '<select disabled="disabled" name="columnas" class="text2">';
					disable_columna += '<option value="0">Seleccione Columna</option></select>';
					$("#midiv").html(disable_columna);
					var disable_logica = '<select   disabled="disabled" name="columnas" class="text2">';
					disable_logica += '<option value=0>Seleccione Lógica</option></select>';
					$("#midiv2").html(disable_logica);
					var disable_valor = '<input type="text" value="  Ingrese Valor" ';
					disable_valor += 'disabled="disabled" class="text2">';
					$("#midiv3").html(disable_valor);
					var disable_cola = '<br><input type="text" value="  Nombre Cola"';
					disable_cola += 'disabled="disabled" class="text2">';
					$("#midiv4").html(disable_cola);
					var disable_submit = '<br><input type="submit" disabled="disabled" value="Crear Consulta"';
					disable_submit += 'class="btn btn-primary btn-block">';
					$("#midiv5").html(disable_submit);
                	location.reload();

				}
			});
	   	}
    });
 	$('#crear_estrategia').submit(function(e)
    {
        e.preventDefault();
        if($("#nombre_estrategia").val().length < 5)
        {
	        alert("El nombre debe tener como mínimo 5 caracteres");
	        return false;
        }
        else
        {
		    var nombre_estrategia = $('#nombre_estrategia').val();
		    var tipo_estrategia = $('#tipo_estrategia').val();
		    var comentario_estrategia = $('#comentario_estrategia').val();
		    var usuario = $('#usuario').val();
		    var cedente = $('#cedente').val();
        var idUsuario = $('#idUsuario').val();
		    console.log(usuario);
		    var datos_estrategia = 'nombre_estrategia='+nombre_estrategia+'&comentario_estrategia='+comentario_estrategia+'&tipo_estrategia='+tipo_estrategia+'&cedente='+cedente+'&usuario='+usuario+'&idUsuario='+idUsuario;
     		$.ajax(
	   		{
			  type: "POST",
				url: "../includes/estrategia/crear_estrategia.php",
				data:datos_estrategia,
				dataType: 'json',
				success: function(response)
				{
	                $('#estrategia').html(response.uno);
	                var id_estrategia = response.dos;
	                window.location.replace("ver_estrategias.php?id_estrategia="+id_estrategia);
					//window.location("ver_estrategias.php?id_estrategia"+id_estrategia);

				}
			});
   		}
    });
    $('.subestrategia_editar').click(function(e)
    {
        e.preventDefault();
        var trid = $(this).closest('tr').attr('id');
        var trid_nivel = '<input type="hidden" value="'+trid+'" id="nivel" name="nivel">';
        $('#divnivel').html(trid_nivel);
        $('#midiv101').hide();
        $('#midiv99').hide();
        $('#midiv100').show();
        var data='id='+trid;
        $.ajax(
        {
			type: "POST",
			url: "cambiar.php",
			data:data,
			success: function(response)
			{
                $('#midiv200').html(response);
				$.niftyNoty(
					{
						type: 'warning',
						icon : 'fa fa-check',
						message : response ,
						container : 'floating',
						timer : 2000
					});
			}
		});
    });
	$('.cambiar_prioridad').change(function(e)
    {
		e.preventDefault();
		var id_prioridad  = $(this).closest('tr').attr('id');
		var valor_prioridad = $('#p'+id_prioridad).val();
		var patron = /^\d*$/;
		console.log(patron);
		if (!patron.test(valor_prioridad))
		{
			$.niftyNoty(
				{
					type: 'danger',
					icon : 'fa fa-check',
					message : "Campo no actualizado , Solo Numeros Enteros" ,
					container : 'floating',
					timer : 2000
				});
		}
		else
		{
			var data_p='id_prioridad='+id_prioridad+'&valor_prioridad='+valor_prioridad;
			$.ajax(
			{
				type: "POST",
				url: "../includes/estrategia/prioridad.php",
				data:data_p,
				success: function()
				{
					$.niftyNoty(
					{
						type: 'success',
						icon : 'fa fa-check',
						message : "Prioridad Cambiada" ,
						container : 'floating',
						timer : 2000
					});
				}
			});
		}
    });
	$( ".cambiar_comentario" ).change(function()
	{
  		var id_com  = $(this).closest('tr').attr('id');
		var valor_com = $('#q'+id_com).val();
		console.log(valor_com);
		var data_com = "valor_com="+valor_com+"&id_com="+id_com;
		$.ajax(
	    {
			type: "POST",
			url: "../includes/estrategia/comentario.php",
			data:data_com,
			success: function()
			{
				$.niftyNoty(
				{
					type: 'success',
					icon : 'fa fa-check',
					message : "Comentario Actualizado" ,
					container : 'floating',
					timer : 2000
				});
			}
		});
  	});
  	$( ".cambiar_cola" ).change(function()
	{
  		var id_cola  = $(this).closest('tr').attr('id');
		var valor_cola = $('#cola'+id_cola).val();
		console.log(valor_cola);
		var data_cola = "valor_cola="+valor_cola+"&id_cola="+id_cola;
		$.ajax(
	    {
			type: "POST",
			url: "../includes/estrategia/cambiar_cola.php",
			data:data_cola,
			success: function()
			{
				$.niftyNoty(
				{
					type: 'success',
					icon : 'fa fa-check',
					message : "Cola Actualizada" ,
					container : 'floating',
					timer : 2000
				});
			}
		});
  	});
	$('.checkeo').on('click',function()
    {
		var mivar = $(this).closest('tr').attr('id');
        var clase='#k'+mivar;
		console.log(clase);
        var datos_update1 = 'id='+mivar;
        if ($(clase).is(':checked'))
        {


			$.ajax(
			{
				type: "POST",
				url: "update1.php",
				data:datos_update1,
				success: function()
				{
					$.niftyNoty(
					{
						type: 'success',
						icon : 'fa fa-check',
						message : "Cola Terminal Seleccionada" ,
						container : 'floating',
						timer : 2000
					});
				}
			});
	 	}
        else
        {

            $.ajax(
            {
				type: "POST",
                url: "update2.php",
                data:datos_update1,
                success: function()
                {
					$.niftyNoty(
						{
							type: 'success',
							icon : 'fa fa-check',
							message : "Cola No Terminal" ,
							container : 'floating',
							timer : 2000
						});
				}
            });
         }
	});
	$('#deshacer').click(function(e)
	{
    var result = confirm("¿Esta seguro que desea eliminar las estrategias?")
      if (result)
      {
        e.preventDefault();
	      var id = ($(this).val());
	      var data='id='+id;
	      $.ajax(
	      {
			  type: "POST",
			  url: "deshacer.php",
			  data:data,
			  success: function()
			  {
	              window.location.replace("ver_estrategias.php?id_estrategia="+id);

			  }
		    });
      };

	});


	$('#refrescar').click(function(e)
	{
	    e.preventDefault();
		$('body').addClass("loading");
	    var id = ($(this).val());
	    var data='id='+id;
	    $.ajax(
	    {
			type: "POST",
			url: "refrescar.php",
			data:data,
			success: function(response)
			{
	           	$('body').removeClass("loading");
				$.niftyNoty(
						{
							type: 'success',
							icon : 'fa fa-check',
							message : "Querys Actualizadas" ,
							container : 'floating',
							timer : 2000
						});
			 	window.location.replace("ver_estrategias.php?id_estrategia="+id);


			}

		});
	});
	$('#categoria').submit(function(e)
    {
        e.preventDefault();
		var color = $('#color').val();
		var tipo_contacto = $('#tipo_contacto').val();
		var dias = $('#dias').val();
		var cant1 = $('#cant1').val();
		var cond1 = $('#cond1').val();
		var logica = $('#logica').val();
		var cant2 = $('#cant2').val();
		var cond2 = $('#cond2').val();
		var w = $('#w').val();
		var mundo = $('#mundo').val();

		if(color == null || tipo_contacto == null || dias == "" || cant1 == "")
        {
        	$.niftyNoty(
						{
							type: 'danger',
							icon : 'fa fa-close',
							message : "Debe completar todos los campos!" ,
							container : 'floating',
							timer : 5000
						});
        }
        else
        {




			var data_categoria = "color="+color+"&tipo_contacto="+tipo_contacto+"&dias="+dias+"&cant1="+cant1+"&cond1="+cond1+"&logica="+logica+"&cant2="+cant2+"&cond2="+cond2+"&w="+w+"&mundo="+mundo;
			console.log(data_categoria);


			$.ajax(
			{
				type: "POST",
				url: "../includes/estrategia/categoria.php",
				data:data_categoria,
				success: function(response)
				{
					if(response == 1)
					{
						$('body').removeClass("loading");
						$('#categoria')[0].reset();
						location.reload();
					}
					else
					{
						$.niftyNoty(
						{
							type: 'danger',
							icon : 'fa fa-close',
							message : "El color ya existe en la base de datos." ,
							container : 'floating',
							timer : 5000
						});
					}
				}
			});
        }

	});
	$('#logica').change(function()
    {
    	var logica = $('#logica').val();
    	console.log(logica);
    	if( logica != 1)
    	{
     		$(".condicion_oculta").show();
     		$(".condicion_ver").hide();
     	}
     	else
     	{
			$(".condicion_oculta").hide();
			$(".condicion_ver").show();
     	}
    });
    $('#crear_categoria').submit(function(e)
    {
        e.preventDefault();
		var color = $('#color').val();


		var nombre = $('#nombre').val();
		if(nombre.length < 4)
        {
	        	$.niftyNoty(
						{
							type: 'danger',
							icon : 'fa fa-close',
							message : "El nombre debe tener a lo menos 3 catacteres!" ,
							container : 'floating',
							timer : 5000
						});
	    }
	    else
	    {
			var comentario= $('#comentario').val();
			var data_crear_categoria = "color="+color+"&nombre="+nombre+"&comentario="+comentario;

			$.ajax(
			{
				type: "POST",
				url: "../includes/estrategia/crear_categoria.php",
				data:data_crear_categoria,
				success: function(response)
				{
					if(response == 1)
					{

						$('body').removeClass("loading");
						$('#crear_categoria')[0].reset();

						$.niftyNoty(
						{
							type: 'success',
							icon : 'fa fa-check',
							message : "Color creado." ,
							container : 'floating',
							timer : 5000
						});
						location.reload();
					}
					else
					{
						$.niftyNoty(
						{
							type: 'danger',
							icon : 'fa fa-close',
							message : "Color Seleccionado ya existe" ,
							container : 'floating',
							timer : 5000
						});
					}

				}
			});
		}
	});
	$('#java').submit(function(e)
    {
        e.preventDefault();
        var data = "data=1";
		$.ajax(
		{
			type: "POST",
			url: "../includes/estrategia/java.php",
			data:data,
			success: function(response)
			{

					if(response==1)
					{
						$.niftyNoty(
						{
							type: 'warning',
							icon : 'fa fa-check',
							message : "Ya hay un proceso en Ejecucion" ,
							container : 'floating',
							timer : 5000
						});
					}
					else
					{
						$.niftyNoty(
						{
							type: 'success',
							icon : 'fa fa-check',
							message : "Ejecutando Proceso" ,
							container : 'floating',
							timer : 5000
						});
					}

			}
		});
	});

	$('#javaIvr').submit(function(e)
    {
        e.preventDefault();
        var data = "data=1";
		$.ajax(
		{
			type: "POST",
			url: "../includes/estrategia/javaIvr.php",
			data:data,
			success: function(response)
			{

					if(response==1)
					{
						$.niftyNoty(
						{
							type: 'warning',
							icon : 'fa fa-check',
							message : "Ya hay un proceso en Ejecucion" ,
							container : 'floating',
							timer : 5000
						});
					}
					else
					{
						$.niftyNoty(
						{
							type: 'success',
							icon : 'fa fa-check',
							message : "Ejecutando Proceso" ,
							container : 'floating',
							timer : 5000
						});
					}

			}
		});
	});
	$('#categoria_ivr').submit(function(e)
    {
        e.preventDefault();
		var color = $('#color').val();
		var tipo_contacto = $('#tipo_contacto').val();
		var dias = $('#dias').val();
		var cant1 = $('#cant1').val();
		var cond1 = $('#cond1').val();
		var logica = $('#logica').val();
		var cant2 = $('#cant2').val();
		var cond2 = $('#cond2').val();
		var w = $('#w').val();
		var mundo = $('#mundo').val();

		if(color == null || tipo_contacto == null || dias == "" || cant1 == "")
        {
        	$.niftyNoty(
						{
							type: 'danger',
							icon : 'fa fa-close',
							message : "Debe completar todos los campos!" ,
							container : 'floating',
							timer : 5000
						});
        }
        else
        {




			var data_categoria = "color="+color+"&tipo_contacto="+tipo_contacto+"&dias="+dias+"&cant1="+cant1+"&cond1="+cond1+"&logica="+logica+"&cant2="+cant2+"&cond2="+cond2+"&w="+w+"&mundo="+mundo;
			console.log(data_categoria);


			$.ajax(
			{
				type: "POST",
				url: "../includes/estrategia/categoria_ivr.php",
				data:data_categoria,
				success: function(response)
				{
					if(response == 1)
					{
						$('body').removeClass("loading");
						$('#categoria_ivr')[0].reset();
						location.reload();
					}
					else
					{
						$.niftyNoty(
						{
							type: 'danger',
							icon : 'fa fa-close',
							message : "El color ya existe en la base de datos." ,
							container : 'floating',
							timer : 5000
						});
					}
				}
			});
        }

	});
});
