$(document).ready(function($) 
{
	
	
	var user_dial = $('#user_dial').val();
	var pass_dial = $('#pass_dial').val();
	var fono_discado = $("#fono_discado").val();
	var finalizar = "source=test&user="+user_dial+"&pass="+pass_dial+"&agent_user="+user_dial+"&function=external_status&value=B";
	var pausar = "source=test&user="+user_dial+"&pass="+pass_dial+"&agent_user="+user_dial+"&function=external_pause&value=PAUSE";
	var pausa_admin = "source=test&user="+user_dial+"&pass="+pass_dial+"&agent_user="+user_dial+"&function=pause_code&value=ADMIN"; 
	var cortar = "source=test&user="+user_dial+"&pass="+pass_dial+"&agent_user="+user_dial+"&function=external_hangup&value=1"; 

	$('#nuevo_telefono').on('click', function(){
		bootbox.dialog({
			title: "Ingrese Nuevo Telefono",
			message:'<div class="row"> ' + '<div class="col-md-12"> ' +
					'<form class="form-horizontal"> ' + '<div class="form-group"> ' +
					'<label class="col-md-4 control-label" for="name">Nuevo Telefono</label> ' +
					'<div class="col-md-4"> ' +
					'<input id="fono_discado_nuevo" name="name" type="number" placeholder="" class="form-control input-md"> ' +
					' </div> ' +
					'</div> ' + '<div class="form-group"> ' +
					'' +
					'<div class="col-md-8"> <div class="form-block"> ' +
					'' +
					'</div>' +
					'</div> </div>' + '</form> </div> </div><script></script>',
			buttons: {
				success: {
					label: "Guardar",
					className: "btn-primary",
					callback: function() {
						var fono_discado_nuevo = $('#fono_discado_nuevo').val();
						var rut_fono = $('#rut_ultimo').val();
						var data_fono_nuevo = "rut="+rut_fono+"&fono_discado_nuevo="+fono_discado_nuevo;
						$.ajax(
						{
							type: "POST",
							url: "../includes/crm/insertar_fonos.php",
							data:data_fono_nuevo, 
							success: function(response)
							{
								$('#mostrar_fonos').html(response);
								console.log(response);
								$('#mostrar_fonos_ocultar').hide();
								var tiempo = 
								{
								    hora: 0,
							        minuto: 0,
							        segundo: 0
								};
								var tiempo_corriendo = null;
								$('.llamar_api').click(function()
								{
									$('#next_rut').prop("disabled",true);
									$('#prev_rut').prop("disabled",true);
									
									var idc = $('#idc').val();
									var trid = $(this).closest('tr').attr('id');
									var id_bg = '#'+trid;
									var id_bg_a = '#'+idc;
									var call = '#call'+trid;
									var cut = '#cut'+trid;
									console.log(call);
									
									if ( $(this).val() == 1 )
									{
							            var fono2 = '#telefono'+trid;
										fono_discado = $(fono2).val();
										var i = 1;
										while(i<=20)
										{
											$('#call'+i).prop("disabled",true);
											i++;
										}	
										$(call).prop("disabled",false);
										var mensaje = 'Llamando al :'+fono_discado+' ....';
										console.log(mensaje);
										$.niftyNoty(
										{
											type: 'success',
											icon : 'fa fa-volume-control-phone',
											message : mensaje,
											container : 'page',
											screenSize : 'lg',
											timer : 3000
										});
										$("#fono_discado").val(fono_discado);
										console.log(fono_discado);
										var data_llamar = "source=test&user="+user_dial+"&pass="+pass_dial+"&agent_user="+user_dial+"&function=external_dial&value="+fono_discado+"&phone_code=1&search=YES&preview=NO&focus=NO&vendor_id=16624472";
										console.log(data_llamar);
										$.ajax(
									    {
											type: "GET",
											url: "http://192.168.1.80/agent/api.php",
											data:data_llamar, 
											dataType: 'json',
											success: function(response)
											{
												console.log(response);
											}
										});	
							            
							            $(this).removeClass('btn-success');
										$(this).addClass('btn-danger fa fa-times llamar_api');
										$(this).val('0');
										$(this).text(' Cortar');
							            tiempo_corriendo = setInterval(function(){
							                // Segundos
							                tiempo.segundo++;
							                if(tiempo.segundo >= 60)
							                {
							                    tiempo.segundo = 0;
							                    tiempo.minuto++;
							                }      

							                // Minutos
							                if(tiempo.minuto >= 60)
							                {
							                    tiempo.minuto = 0;
							                    tiempo.hora++;
							                }

							                $("#hour").text(tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora);
							                $("#minute").text(tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto);
							                $("#second").text(tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo);
							            }, 1000);
							        }
							        else 
							        {
							            $(this).val(1);
							            $(this).removeClass('btn-danger');
										$(this).addClass('btn-success llamar_api'); 
										$(this).text(' Llamar');
										$(call).prop("disabled",true);
							            clearInterval(tiempo_corriendo);
							            var tiempo_hora = 0;
							            var tiempo_minuto = 0;
							            var tiempo_segundo = 0;
							            if(tiempo.hora<10)
							            {
							            	tiempo_hora = '0'+tiempo.hora;
							            }
							            else
							            {
							            	tiempo_hora = tiempo.hora;
							            }	
							            if(tiempo.minuto<10)
							            {
							            	tiempo_minuto = '0'+tiempo.minuto;
							            }
							            else
							            {
							            	tiempo_minuto = tiempo.minuto;
							            }		
							            if(tiempo.segundo<10)
							            {
							            	tiempo_segundo = '0'+tiempo.segundo;
							            }
							            else
							            {
							            	tiempo_segundo = tiempo.segundo;
							            }			
							            var duracion_llamada = tiempo_hora+':'+tiempo_minuto+':'+tiempo_segundo;
										$('#duracion_llamada').val(duracion_llamada);
										console.log(duracion_llamada);
							            tiempo = 
										{
										    hora: 0,
									        minuto: 0,
									        segundo: 0
										};
										$("#guardar").prop("disabled",false);
										$('#respuesta_rapida_ocultar').hide();
										$('#respuesta_rapida').show();
										$("#cortar_valor").val(1);
										var trid = $(this).closest('tr').attr('id');
										var call = '#call'+trid;
										var cut = '#cut'+trid;
										
										$(cut).prop("disabled",true);
										$.niftyNoty(
										{
											type: 'danger',
											icon : 'fa fa-volume-control-phone',
											message : 'Llamada Cortada',
											container : 'page',
											screenSize : 'lg',
											timer : 1000
										});
										console.log(cortar);
										$.ajax(
									    {
											type: "GET",
											url: "http://192.168.1.80/agent/api.php",
											data:cortar, 
											dataType: 'json',
											success: function(response)
											{
												console.log(response);
											}
										});	
							            
							        }

									
									if(idc==0 || idc==trid)
									{
										
										$(id_bg).css("background-color", "#585858").css("color", "#FFFFFF");
										$('#idc').val(trid);
										

									}
									else	
									{
										$(id_bg).css("background-color", "#585858").css("color", "#FFFFFF");
										$(id_bg_a).css("background-color", "").css("color", "");
										console.log('else');
										$('#idc').val(trid);
										// var i = 1;
										// while(i<=7)
										// {
										// 	$('#call'+i).prop("disabled",true);
										// 	$('#cut'+i).prop("disabled",true);
										// 	i++;
										// }	
										// $(cut).prop("disabled",false);

									}	
								});
							}
						});		

						$.niftyNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : "Registro Guardado",
							container : 'floating',
							timer : 4000
						});
					}
				}
			}
		});	
	});
	
	$('#seleccione_cedente').change(function() 
	{
    	var id = $('#seleccione_cedente').val();
    	console.log(id);
    	var data = "id="+id;
    	$('#cedente').val(id);
    	$.ajax(
	    {
			type: "POST",
			url: "../includes/crm/seleccione_cedente.php",
			data:data, 
			success: function(response)
			{	
				$('#colas').hide();
				$('#colas_mostrar').show();
				$('#colas_mostrar').html(response);
				$('#seleccione_estrategia').change(function() 
				{
					var idc = $('#seleccione_estrategia').val();
					var data = "id="+idc;
			    	$.ajax(
				    {
						type: "POST",
						url: "../includes/crm/seleccione_cola.php",
						data:data, 
						success: function(response)
						{	
							$('#colas2').hide();
							$('#colas_mostrar2').show();
							$('#colas_mostrar2').html(response);
							$('#nivel_1_ocultar').hide();
							var ce1 = $('#cedente').val();
							var ce = "cedente="+ce1;
							$.ajax(
							{
								type: "POST",
								url: "../includes/crm/nivel_1.php",
								data:ce, 
								success: function(response)
								{
									$('#nivel_1_mostrar').html(response);
									$('#seleccione_nivel1').change(function() 
									{
										$('#nivel_2_ocultar').hide();
										var nivel2 = $('#seleccione_nivel1').val();
										var nivel2 = "nivel2="+nivel2;
										$.ajax(
										{
											type: "POST",
											url: "../includes/crm/nivel_2.php",
											data:nivel2, 
											success: function(response)
											{
												$('#nivel_2_mostrar').html(response);
												$('#seleccione_nivel2').change(function() 
												{
													$('#nivel_3_ocultar').hide();
													var nivel3 = $('#seleccione_nivel2').val();
													var nivel3 = "nivel3="+nivel3;
													$.ajax(
													{
														type: "POST",
														url: "../includes/crm/nivel_3.php",
														data:nivel3, 
														success: function(response)
														{
															$('#nivel_3_mostrar').html(response);
															var tipo_gestion = $('#tipo_gestion').val();
															if (tipo_gestion==5)
															{
																$('#seleccione_nivel3').html("<select class='select1' id='seleccione_nivel3' name='seleccione_nivel3'><option value='0'>Seleccione</option><option value='0'>Comrpomiso</option></select>");
															}
															else
															{
																$('#nivel_3_mostrar').html(response);
															}	
															
															$('#seleccione_nivel3').change(function() 
															{
																var cortar_valor = $('#cortar_valor').val();
																var nivel4 = "id_tipo="+tipo_gestion+"&cortar_valor="+cortar_valor;
																$.ajax(
																{
																	type: "POST",
																	url: "../includes/crm/nivel_4.php",
																	data:nivel4, 
																	success: function(response)
																	{
																		$('#grupo1_ocultar').hide();
																		$('#grupo1').html(response);
																		$('#guardar').click(function()
																		{
																			var i = 1;
																			while(i<=7)
																			{
																				$('#call'+i).prop("disabled",false);
																				i++;
																			}
																			$('#next_rut').prop("disabled",false);
																			$('#prev_rut').prop("disabled",false);	
																			var fecha_compromiso = $('#fecha_compromiso').val();
																			var monto_compromiso = $('#monto_compromiso').val();
																			var cedente = $('#cedente').val();
																			var comentario= $('#comentario').val();
																			var nivel1 = $('#seleccione_nivel1').val();
																			var nivel2 = $('#seleccione_nivel2').val();
																			var nivel3 = $('#seleccione_nivel3').val();
																			var tipo_gestion2 = $('#tipo_gestion').val();
																			var rut_ultimo = $('#rut_ultimo').val();
																			if(tipo_gestion2==5)
																			{
																				if(fecha_compromiso.length < 1)
																				{
																					$.niftyNoty(
																					{
																						type: 'danger',
																						icon : 'fa fa-close',
																						message : 'Fecha Compromiso Vacio , no se puede guardar!' ,
																						container : 'floating',
																						timer : 2000
																					});
																				}
																				else if(monto_compromiso.length < 1)
																				{
																					$.niftyNoty(
																					{
																						type: 'danger',
																						icon : 'fa fa-close',
																						message : 'Monto Compromiso Vacio , no se puede guardar!' ,
																						container : 'floating',
																						timer : 2000
																					});
																					
																				}
																				else
																				{
																					var fecha = new Date();
																					var fecha_gestion = fecha.getFullYear()+"-"+(fecha.getMonth()+1)+"-"+fecha.getDate();
																					var hora_gestion = fecha.getHours()+":"+fecha.getMinutes()+":"+fecha.getSeconds();
																					var insertar2 = "nivel1="+nivel1+"&nivel2="+nivel2+"&nivel3="+nivel3+"&comentario="+comentario+"&fecha_gestion="+fecha_gestion+"&hora_gestion="+hora_gestion+"&rut="+rut_ultimo+"&fono_discado="+fono_discado+"&tipo_gestion="+tipo_gestion2+"&cedente="+cedente+"&fecha_compromiso="+fecha_compromiso+"&monto_compromiso="+monto_compromiso;
																					$.ajax(
																					{
																						type: "POST",
																						url: "../includes/crm/insertar2.php",
																						data:insertar2, 
																						success: function(response)
																						{
																							console.log(response);
																							$('#seleccione_nivel1').prop('selectedIndex',0);
																							$('#seleccione_nivel2').prop('selectedIndex',0);
																							$('#seleccione_nivel3').prop('selectedIndex',0);
																							$("#guardar").prop("disabled",true);
																							$("textarea").val("");
																							$("#fecha_compromiso").val("");
																							$("#monto_compromiso").val("");
																							$('#respuesta').prop('selectedIndex',0);
																							console.log(finalizar);
																							$.ajax(
																							{
																								type: "GET",
																								url: "http://192.168.1.80/agent/api.php",
																								data: finalizar, 
																								success: function(response)
																								{
																									
																								}
																							});	
																							setTimeout(function() 
																							{
																						      	console.log('primer timeout 2seg');
																								console.log(pausar);
																								$.ajax(
																								{
																									type: "GET",
																									url: "http://192.168.1.80/agent/api.php",
																									data:pausar, 
																									success: function(response)
																									{
																										
																									}
																								});	
																						     }, 2000);
																							setTimeout(function() 
																							{
																						      	console.log('segundo timeout 1seg');
																								console.log(pausa_admin);
																								$.ajax(
																								{
																									type: "GET",
																									url: "http://192.168.1.80/agent/api.php",
																									data:pausa_admin, 
																									success: function(response)
																									{
																										
																									}
																								});	
																						     }, 3000);
																							$.niftyNoty(
																							{
																								type: 'success',
																								icon : 'fa fa-check',
																								message : 'Respuesta Integral Guardada' ,
																								container : 'floating',
																								timer : 2000
																							});
																						}
																					});	
																				}
																			}		
																			else
																			{
																				var fecha = new Date();
																				var fecha_gestion = fecha.getFullYear()+"-"+(fecha.getMonth()+1)+"-"+fecha.getDate();
																				var hora_gestion = fecha.getHours()+":"+fecha.getMinutes()+":"+fecha.getSeconds();
																				var insertar1 = "nivel1="+nivel1+"&nivel2="+nivel2+"&nivel3="+nivel3+"&comentario="+comentario+"&fecha_gestion="+fecha_gestion+"&hora_gestion="+hora_gestion+"&rut="+rut_ultimo+"&fono_discado="+fono_discado+"&tipo_gestion="+tipo_gestion2+"&cedente="+cedente;
																				$.ajax(
																				{
																					type: "POST",
																					url: "../includes/crm/insertar1.php",
																					data:insertar1, 
																					success: function(response)
																					{
																						console.log(response);
																						$('#seleccione_nivel1').prop('selectedIndex',0);
																						$('#seleccione_nivel2').prop('selectedIndex',0);
																						$('#seleccione_nivel3').prop('selectedIndex',0);
																						$("textarea").val("");
																						$("#guardar").prop("disabled",true);
																						$('#respuesta').prop('selectedIndex',0);
																						console.log(finalizar);
																						$.ajax(
																						{
																							type: "GET",
																							url: "http://192.168.1.80/agent/api.php",
																							data:finalizar, 
																							success: function(response)
																							{
																								
																							}
																						});	
																						setTimeout(function() 
																						{
																					      	console.log('primer timeout 32');
																							console.log(pausar);
																							$.ajax(
																							{
																								type: "GET",
																								url: "http://192.168.1.80/agent/api.php",
																								data:pausar, 
																								success: function(response)
																								{
																									
																								}
																							});	
																					      	
																					     }, 2000);
																						setTimeout(function() 
																							{
																						      	console.log('segundo timeout 1seg');
																								console.log(pausa_admin);
																								$.ajax(
																								{
																									type: "GET",
																									url: "http://192.168.1.80/agent/api.php",
																									data:pausa_admin, 
																									success: function(response)
																									{
																										
																									}
																								});	
																						      	
																						     }, 3000);

																						$.niftyNoty(
																						{
																							type: 'success',
																							icon : 'fa fa-check',
																							message : 'Respuesta Integral Guardada' ,
																							container : 'floating',
																							timer : 2000
																						});
																					}
																				});	
																			}	
																		});
																	}
																});	
															});		
														}
													});
												});		
											}
										});	
									});
								}
							});	
							$('#respuesta').change(function() 
							{
								
								$('#next_rut').prop("disabled",false);
								$('#prev_rut').prop("disabled",false);
								var i = 1;
								while(i<=7)
								{
									$('#call'+i).prop("disabled",false);
									i++;
								}	
								var cedente = $('#cedente').val();
								var resp = $('#respuesta').val();
								if(resp==1 || resp==2 || resp==5)
								{
									var nivel1 = 4;
									var nivel2 = 217;
									var nivel3 = 4989;
									var tipo_gestion2 = 3;
								}
								else if(resp==3)
								{
									var nivel1 = 4;
									var nivel2 = 225;
									var nivel3 = 4989;
									var tipo_gestion2 = 3;
								}
								else if(resp==4)
								{
									var nivel1 = 4;
									var nivel2 = 161;
									var nivel3 = 4989;
									var tipo_gestion2 = 4;
								}	
								var rut_ultimo = $('#rut_ultimo').val();
								var fecha = new Date();
								var fecha_gestion = fecha.getFullYear()+"-"+(fecha.getMonth()+1)+"-"+fecha.getDate();
								var hora_gestion = fecha.getHours()+":"+fecha.getMinutes()+":"+fecha.getSeconds();
								var duracion_llamada2 = $('#duracion_llamada').val();
								console.log(duracion_llamada2);
								var insertar3 = "nivel1="+nivel1+"&nivel2="+nivel2+"&nivel3="+nivel3+"&fecha_gestion="+fecha_gestion+"&hora_gestion="+hora_gestion+"&rut="+rut_ultimo+"&fono_discado="+fono_discado+"&tipo_gestion="+tipo_gestion2+"&cedente="+cedente+"&duracion_llamada="+duracion_llamada2+"&user_dial="+user_dial;
								$.ajax(
								{
									type: "POST",
									url: "../includes/crm/insertar3.php",
									data:insertar3, 
									success: function(response)
									{
										console.log(response);
										$('#seleccione_nivel1').prop('selectedIndex',0);
										$('#seleccione_nivel2').prop('selectedIndex',0);
										$('#seleccione_nivel3').prop('selectedIndex',0);
										$("#guardar").prop("disabled",true);
										$("textarea").val("");
										$("#fecha_compromiso").val("");
										$("#monto_compromiso").val("");
										$('#respuesta').prop('selectedIndex',0);
										$('#respuesta_rapida_ocultar').show();
										$('#respuesta_rapida').hide();
										$('#respuesta').prop('selectedIndex',0);
										console.log(finalizar);
										$.ajax(
										{
											type: "GET",
											url: "http://192.168.1.80/agent/api.php",
											data:finalizar, 
											success: function(response)
											{
												
											}
										});	
										setTimeout(function() 
										{
									      	console.log('primer timeout 32');
											console.log(pausar);
											$.ajax(
											{
												type: "GET",
												url: "http://192.168.1.80/agent/api.php",
												data:pausar, 
												success: function(response)
												{
													
												}
											});	
									      	
									     }, 2000);
										setTimeout(function() 
										{
									      	console.log('segundo timeout 1seg');
											console.log(pausa_admin);
											$.ajax(
											{
												type: "GET",
												url: "http://192.168.1.80/agent/api.php",
												data:pausa_admin, 
												success: function(response)
												{
													
												}
											});	
									      	
									     }, 3000);
										$.niftyNoty(
										{
											type: 'success',
											icon : 'fa fa-check',
											message : 'Respuesta Rapida Guardada' ,
											container : 'floating',
											timer : 2000
										});
									}
								});		
							});
							$('#seleccione_cola').change(function() 
							{
								var idq = $('#seleccione_cola').val();
								var data = "id="+idq;
								console.log('asd');
								$('#nuevo_telefono').prop("disabled",false);
						    	$.ajax(
							    {
									type: "POST",
									url: "../includes/crm/seleccione_query.php",
									data:data, 
									dataType: 'json',
									success: function(response)
									{	
										$('#ocultar_rut').hide();
										$('#mostrar_rut').show();
										$('#mostrar_rut').html(response.uno);
										$('#mostrar_rut2').html(response.cinco);
										$('#next_rut').val(response.dos);
										$('#prev_rut').val(response.dos);
										$('#rut_ultimo').val(response.dos);
										$('#mostrar_nombre').html(response.tres);
										$('#mostrar_nombre_ocultar').hide();
										$('#prefijo').val(response.cuatro);

										var data_direccion = "rut="+response.dos;
										$.ajax(
										{
											type: "POST",
											url: "../includes/crm/mostrar_direcciones.php",
											data:data_direccion, 
											success: function(response)
											{
												$('#mostrar_direcciones').html(response);
												$('#mostrar_direcciones_ocultar').hide();
											}
										});
										var cedente= $('#cedente').val();
										var data_deudas = "rut="+response.dos+"&cedente="+cedente;
										console.log(data_deudas);
										$.ajax(
										{
											type: "POST",
											url: "../includes/crm/deudas.php",
											data:data_deudas, 
											success: function(response)
											{
												console.log(response);
												$('#mostrar_deudas').html(response);
												$('#mostrar_deudas_ocultar').hide();
											}
										});		
										console.log(response.cuatro);
										var data_reg = "rut="+response.dos+"&prefijo="+response.cuatro;
										$.ajax(
										{
											type: "POST",
											url: "../includes/crm/mostrar_reg.php",
											data:data_reg, 
											success: function(response)
											{
												$('#cantidad').html(response);
											}
										});
											
										var data_fono = "rut="+response.dos+"&prefijo="+response.cuatro;
										$.ajax(
										{
											type: "POST",
											url: "../includes/crm/mostrar_fonos.php",
											data:data_fono, 
											success: function(response)
											{
												$('#mostrar_fonos').html(response);
												$('#mostrar_fonos_ocultar').hide();
												var tiempo = 
												{
												    hora: 0,
											        minuto: 0,
											        segundo: 0
												};
												var tiempo_corriendo = null;
												$('.llamar_api').click(function()
												{
													$('#next_rut').prop("disabled",true);
													$('#prev_rut').prop("disabled",true);
													
													var idc = $('#idc').val();
													var trid = $(this).closest('tr').attr('id');
													var id_bg = '#'+trid;
													var id_bg_a = '#'+idc;
													var call = '#call'+trid;
													var cut = '#cut'+trid;
													console.log(call);
													console.log($(this).val());
													if ( $(this).val() == 1 )
        											{
											           
											            var fono2 = '#telefono'+trid;
														fono_discado = $(fono2).val();
														var i = 1;
														while(i<=20)
														{
															$('#call'+i).prop("disabled",true);
															console.log('por aca');
															i++;
														}	
														$(call).prop("disabled",false);
														var mensaje = 'Llamando al :'+fono_discado+' ....';
														console.log(mensaje);
														$.niftyNoty(
														{
															type: 'success',
															icon : 'fa fa-volume-control-phone',
															message : mensaje,
															container : 'page',
															screenSize : 'lg',
															timer : 3000
														});
														$("#fono_discado").val(fono_discado);
														console.log(fono_discado);
														var data_llamar = "source=test&user="+user_dial+"&pass="+pass_dial+"&agent_user="+user_dial+"&function=external_dial&value="+fono_discado+"&phone_code=1&search=YES&preview=NO&focus=NO&vendor_id=16624472";
														console.log(data_llamar);
														$.ajax(
													    {
															type: "GET",
															url: "http://192.168.1.80/agent/api.php",
															data:data_llamar, 
	    													dataType: 'json',
															success: function(response)
															{
																console.log(response);
															}
														});	
											            
											            $(this).removeClass('btn-success');
														$(this).addClass('btn-danger fa fa-times llamar_api');
														$(this).val('0');
														$(this).text(' Cortar');
											            tiempo_corriendo = setInterval(function(){
											                // Segundos
											                tiempo.segundo++;
											                if(tiempo.segundo >= 60)
											                {
											                    tiempo.segundo = 0;
											                    tiempo.minuto++;
											                }      

											                // Minutos
											                if(tiempo.minuto >= 60)
											                {
											                    tiempo.minuto = 0;
											                    tiempo.hora++;
											                }

											                $("#hour").text(tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora);
											                $("#minute").text(tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto);
											                $("#second").text(tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo);
											            }, 1000);
											        }
											        else 
											        {
											            $(this).val(1);
											            $(this).removeClass('btn-danger');
														$(this).addClass('btn-success llamar_api'); 
														$(this).text(' Llamar');
														$(call).prop("disabled",true);
											            clearInterval(tiempo_corriendo);
											            var tiempo_hora = 0;
											            var tiempo_minuto = 0;
											            var tiempo_segundo = 0;
											            if(tiempo.hora<10)
											            {
											            	tiempo_hora = '0'+tiempo.hora;
											            }
											            else
											            {
											            	tiempo_hora = tiempo.hora;
											            }	
											            if(tiempo.minuto<10)
											            {
											            	tiempo_minuto = '0'+tiempo.minuto;
											            }
											            else
											            {
											            	tiempo_minuto = tiempo.minuto;
											            }		
											            if(tiempo.segundo<10)
											            {
											            	tiempo_segundo = '0'+tiempo.segundo;
											            }
											            else
											            {
											            	tiempo_segundo = tiempo.segundo;
											            }			
											            var duracion_llamada = tiempo_hora+':'+tiempo_minuto+':'+tiempo_segundo;
														$('#duracion_llamada').val(duracion_llamada);
														console.log(duracion_llamada);
											            tiempo = 
														{
														    hora: 0,
													        minuto: 0,
													        segundo: 0
														};
														$("#guardar").prop("disabled",false);
														$('#respuesta_rapida_ocultar').hide();
														$('#respuesta_rapida').show();
														$("#cortar_valor").val(1);
														var trid = $(this).closest('tr').attr('id');
														var call = '#call'+trid;
														var cut = '#cut'+trid;
														
														$(cut).prop("disabled",true);
														$.niftyNoty(
														{
															type: 'danger',
															icon : 'fa fa-volume-control-phone',
															message : 'Llamada Cortada',
															container : 'page',
															screenSize : 'lg',
															timer : 1000
														});
														console.log(cortar);
														$.ajax(
													    {
															type: "GET",
															url: "http://192.168.1.80/agent/api.php",
															data:cortar, 
	    													dataType: 'json',
															success: function(response)
															{
																console.log(response);
															}
														});	
											            
											        }

													
													if(idc==0 || idc==trid)
													{
														
														$(id_bg).css("background-color", "#585858").css("color", "#FFFFFF");
														$('#idc').val(trid);
														

													}
													else	
													{
														$(id_bg).css("background-color", "#585858").css("color", "#FFFFFF");
														$(id_bg_a).css("background-color", "").css("color", "");
														console.log('else');
														$('#idc').val(trid);
														// var i = 1;
														// while(i<=7)
														// {
														// 	$('#call'+i).prop("disabled",true);
														// 	$('#cut'+i).prop("disabled",true);
														// 	i++;
														// }	
														// $(cut).prop("disabled",false);

													}	
												});
											}
										});		
										$('#next_rut').click(function()
										{
											var rut = $('#next_rut').val();
											var prefijo = $('#prefijo').val();
											var data = "rut="+rut+"&prefijo="+prefijo;
											console.log(data);
											$.ajax(
										    {
												type: "POST",
												url: "../includes/crm/next_rut.php",
												data:data, 
												dataType: 'json',
												success: function(response)
												{	
													$('#mostrar_rut').html(response.uno);
													$('#mostrar_rut2').html(response.cinco);
													$('#next_rut').val(response.dos);
													$('#prev_rut').val(response.dos);
													$('#rut_ultimo').val(response.dos);
													$('#mostrar_nombre').html(response.tres);
													$('#prefijo').val(response.cuatro);
													console.log(response);
													var data_direccion = "rut="+response.dos;
													$.ajax(
													{
														type: "POST",
														url: "../includes/crm/mostrar_direcciones.php",
														data:data_direccion, 
														success: function(response)
														{
															$('#mostrar_direcciones').html(response);
															$('#mostrar_direcciones_ocultar').hide();
														}
													});	
													var cedente= $('#cedente').val();
													var data_deudas = "rut="+response.dos+"&cedente="+cedente;
													console.log(data_deudas);
													$.ajax(
													{
														type: "POST",
														url: "../includes/crm/deudas.php",
														data:data_deudas, 
														success: function(response)
														{
															console.log(response);
															$('#mostrar_deudas').html(response);
															$('#mostrar_deudas_ocultar').hide();
														}
													});
													var data_reg = "rut="+response.dos+"&prefijo="+response.cuatro;
													$.ajax(
													{
														type: "POST",
														url: "../includes/crm/mostrar_reg.php",
														data:data_reg, 
														success: function(response)
														{
															$('#cantidad').html(response);
														}
													});	
													var data_fono = "rut="+response.dos+"&prefijo="+response.cuatro;
													$.ajax(
													{
														type: "POST",
														url: "../includes/crm/mostrar_fonos.php",
														data:data_fono, 
														success: function(response)
														{
															
															$('#mostrar_fonos').html(response);
															var tiempo = 
															{
															    hora: 0,
														        minuto: 0,
														        segundo: 0
															};
															var tiempo_corriendo = null;
															$('.llamar_api').click(function()
															{
															    
																$('#next_rut').prop("disabled",true);
																$('#prev_rut').prop("disabled",true);
																var idc = $('#idc').val();
																var trid = $(this).closest('tr').attr('id');
																var id_bg = '#'+trid;
																var id_bg_a = '#'+idc;
																var call = '#call'+trid;
																var cut = '#cut'+trid;
																console.log(call);
																
																if ( $(this).val() == 1 )
			        											{
														            var fono2 = '#telefono'+trid;
																	fono_discado = $(fono2).val();
																	var i = 1;
																	while(i<=7)
																	{
																		$('#call'+i).prop("disabled",true);
																		i++;
																	}	
																	$(call).prop("disabled",false);
																	var mensaje = 'Llamando al :'+fono_discado+' ....';
																	console.log(mensaje);
																	$.niftyNoty(
																	{
																		type: 'success',
																		icon : 'fa fa-volume-control-phone',
																		message : mensaje,
																		container : 'page',
																		screenSize : 'lg',
																		timer : 3000
																	});
																	$("#fono_discado").val(fono_discado);
																	console.log(fono_discado);
																	var data_llamar = "source=test&user="+user_dial+"&pass="+pass_dial+"&agent_user="+user_dial+"&function=external_dial&value="+fono_discado+"&phone_code=1&search=YES&preview=NO&focus=NO&vendor_id=16624472";
																	console.log(data_llamar);
																	$.ajax(
																    {
																		type: "GET",
																		url: "http://192.168.1.80/agent/api.php",
																		data:data_llamar, 
				    													dataType: 'json',
																		success: function(response)
																		{
																			console.log(response);
																		}
																	});	
														            
														            $(this).removeClass('btn-success');
																	$(this).addClass('btn-danger fa fa-times llamar_api');
																	$(this).val('0');
																	$(this).text(' Cortar');
														            tiempo_corriendo = setInterval(function(){
														                // Segundos
														                tiempo.segundo++;
														                if(tiempo.segundo >= 60)
														                {
														                    tiempo.segundo = 0;
														                    tiempo.minuto++;
														                }      

														                // Minutos
														                if(tiempo.minuto >= 60)
														                {
														                    tiempo.minuto = 0;
														                    tiempo.hora++;
														                }

														                $("#hour").text(tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora);
														                $("#minute").text(tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto);
														                $("#second").text(tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo);
														            }, 1000);
														        }
														        else 
														        {
														            $(this).val(1);
														            $(this).removeClass('btn-danger');
																	$(this).addClass('btn-success llamar_api'); 
																	$(this).text(' Llamar');
																	$(call).prop("disabled",true);
														            clearInterval(tiempo_corriendo);
														            var tiempo_hora = 0;
														            var tiempo_minuto = 0;
														            var tiempo_segundo = 0;
														            if(tiempo.hora<10)
														            {
														            	tiempo_hora = '0'+tiempo.hora;
														            }
														            else
														            {
														            	tiempo_hora = tiempo.hora;
														            }	
														            if(tiempo.minuto<10)
														            {
														            	tiempo_minuto = '0'+tiempo.minuto;
														            }
														            else
														            {
														            	tiempo_minuto = tiempo.minuto;
														            }		
														            if(tiempo.segundo<10)
														            {
														            	tiempo_segundo = '0'+tiempo.segundo;
														            }
														            else
														            {
														            	tiempo_segundo = tiempo.segundo;
														            }			
														            var duracion_llamada = tiempo_hora+':'+tiempo_minuto+':'+tiempo_segundo;
																	$('#duracion_llamada').val(duracion_llamada);
																	console.log(duracion_llamada);

														            tiempo = 
																	{
																	    hora: 0,
																        minuto: 0,
																        segundo: 0
																	};
																	$("#guardar").prop("disabled",false);
																	$('#respuesta_rapida_ocultar').hide();
																	$('#respuesta_rapida').show();
																	$("#cortar_valor").val(1);
																	var trid = $(this).closest('tr').attr('id');
																	var call = '#call'+trid;
																	var cut = '#cut'+trid;
																	
																	$(cut).prop("disabled",true);
																	$.niftyNoty(
																	{
																		type: 'danger',
																		icon : 'fa fa-volume-control-phone',
																		message : 'Llamada Cortada',
																		container : 'page',
																		screenSize : 'lg',
																		timer : 1000
																	});
																	console.log(cortar);
																	$.ajax(
																    {
																		type: "GET",
																		url: "http://192.168.1.80/agent/api.php",
																		data:cortar, 
				    													dataType: 'json',
																		success: function(response)
																		{
																			console.log(response);
																		}
																	});	
														            
											        			}

																if(idc==0 || idc==trid)
																{
																	
																	$(id_bg).css("background-color", "#585858").css("color", "#FFFFFF");
																	$('#idc').val(trid);
																	

																}
																else	
																{
																	$(id_bg).css("background-color", "#585858").css("color", "#FFFFFF");
																	$(id_bg_a).css("background-color", "").css("color", "");
																	console.log('else');
																	$('#idc').val(trid);
																
																}	

															});
														}
													});		
												}
											});		
										});
										$('#prev_rut').click(function()
										{
											var rut = $('#prev_rut').val();
											var prefijo = $('#prefijo').val();
											var data = "rut="+rut+"&prefijo="+prefijo;
											console.log(data);
											$.ajax(
										    {
												type: "POST",
												url: "../includes/crm/prev_rut.php",
												data:data, 
												dataType: 'json',
												success: function(response)
												{	
													$('#mostrar_rut').html(response.uno);
													$('#mostrar_rut2').html(response.cinco);
													$('#next_rut').val(response.dos);
													$('#prev_rut').val(response.dos);
													$('#rut_ultimo').val(response.dos);
													$('#mostrar_nombre').html(response.tres);
													$('#prefijo').val(response.cuatro);
													console.log(response);
													var data_direccion = "rut="+response.dos;
													$.ajax(
													{
														type: "POST",
														url: "../includes/crm/mostrar_direcciones.php",
														data:data_direccion, 
														success: function(response)
														{
															$('#mostrar_direcciones').html(response);
															$('#mostrar_direcciones_ocultar').hide();
														}
													});	
													var cedente= $('#cedente').val();
													console.log('#rut_ultimo');
													var data_deudas = "rut="+response.dos+"&cedente="+cedente;
													console.log(data_deudas);
													$.ajax(
													{
														type: "POST",
														url: "../includes/crm/deudas.php",
														data:data_deudas, 
														success: function(response)
														{
															console.log(response);
															$('#mostrar_deudas').html(response);
															$('#mostrar_deudas_ocultar').hide();
														}
													});	
													var data_reg = "rut="+response.dos+"&prefijo="+response.cuatro;
													$.ajax(
													{
														type: "POST",
														url: "../includes/crm/mostrar_reg.php",
														data:data_reg, 
														success: function(response)
														{
															$('#cantidad').html(response);
														}
													});
													var data_fono = "rut="+response.dos+"&prefijo="+response.cuatro;
													$.ajax(
													{
														type: "POST",
														url: "../includes/crm/mostrar_fonos.php",
														data:data_fono, 
														success: function(response)
														{
															$('#mostrar_fonos').html(response);
															var tiempo = 
															{
															    hora: 0,
														        minuto: 0,
														        segundo: 0
															};
															var tiempo_corriendo = null;
															$('.llamar_api').click(function()
															{
															    
																$('#next_rut').prop("disabled",true);
																$('#prev_rut').prop("disabled",true);
																var idc = $('#idc').val();
																var trid = $(this).closest('tr').attr('id');
																var id_bg = '#'+trid;
																var id_bg_a = '#'+idc;
																var call = '#call'+trid;
																var cut = '#cut'+trid;
																console.log(call);
																
																if ( $(this).val() == 1 )
			        											{
														            var fono2 = '#telefono'+trid;
																	fono_discado = $(fono2).val();
																	var i = 1;
																	while(i<=7)
																	{
																		$('#call'+i).prop("disabled",true);
																		i++;
																	}	
																	$(call).prop("disabled",false);
																	var mensaje = 'Llamando al :'+fono_discado+' ....';
																	console.log(mensaje);
																	$.niftyNoty(
																	{
																		type: 'success',
																		icon : 'fa fa-volume-control-phone',
																		message : mensaje,
																		container : 'page',
																		screenSize : 'lg',
																		timer : 3000
																	});
																	$("#fono_discado").val(fono_discado);
																	console.log(fono_discado);
																	var data_llamar = "source=test&user="+user_dial+"&pass="+pass_dial+"&agent_user="+user_dial+"&function=external_dial&value="+fono_discado+"&phone_code=1&search=YES&preview=NO&focus=NO&vendor_id=16624472";
																	console.log(data_llamar);
																	$.ajax(
																    {
																		type: "GET",
																		url: "http://192.168.1.80/agent/api.php",
																		data:data_llamar, 
				    													dataType: 'json',
																		success: function(response)
																		{
																			console.log(response);
																		}
																	});	
														            
														            $(this).removeClass('btn-success');
																	$(this).addClass('btn-danger fa fa-times llamar_api');
																	$(this).val('0');
																	$(this).text(' Cortar');
														            tiempo_corriendo = setInterval(function(){
														                // Segundos
														                tiempo.segundo++;
														                if(tiempo.segundo >= 60)
														                {
														                    tiempo.segundo = 0;
														                    tiempo.minuto++;
														                }      

														                // Minutos
														                if(tiempo.minuto >= 60)
														                {
														                    tiempo.minuto = 0;
														                    tiempo.hora++;
														                }

														                $("#hour").text(tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora);
														                $("#minute").text(tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto);
														                $("#second").text(tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo);
														            }, 1000);
														        }
														        else 
														        {
														            $(this).val(1);
														            $(this).removeClass('btn-danger');
																	$(this).addClass('btn-success llamar_api'); 
																	$(this).text(' Llamar');
																	$(call).prop("disabled",true);
														            clearInterval(tiempo_corriendo);
														            var tiempo_hora = 0;
														            var tiempo_minuto = 0;
														            var tiempo_segundo = 0;
														            if(tiempo.hora<10)
														            {
														            	tiempo_hora = '0'+tiempo.hora;
														            }
														            else
														            {
														            	tiempo_hora = tiempo.hora;
														            }	
														            if(tiempo.minuto<10)
														            {
														            	tiempo_minuto = '0'+tiempo.minuto;
														            }
														            else
														            {
														            	tiempo_minuto = tiempo.minuto;
														            }		
														            if(tiempo.segundo<10)
														            {
														            	tiempo_segundo = '0'+tiempo.segundo;
														            }
														            else
														            {
														            	tiempo_segundo = tiempo.segundo;
														            }			
														            var duracion_llamada = tiempo_hora+':'+tiempo_minuto+':'+tiempo_segundo;
																	$('#duracion_llamada').val(duracion_llamada);
																	console.log(duracion_llamada);
														            tiempo = 
																	{
																	    hora: 0,
																        minuto: 0,
																        segundo: 0
																	};
																	$("#guardar").prop("disabled",false);
																	$('#respuesta_rapida_ocultar').hide();
																	$('#respuesta_rapida').show();
																	$("#cortar_valor").val(1);
																	var trid = $(this).closest('tr').attr('id');
																	var call = '#call'+trid;
																	var cut = '#cut'+trid;
																	
																	$(cut).prop("disabled",true);
																	$.niftyNoty(
																	{
																		type: 'danger',
																		icon : 'fa fa-volume-control-phone',
																		message : 'Llamada Cortada',
																		container : 'page',
																		screenSize : 'lg',
																		timer : 1000
																	});
																	console.log(cortar);
																	$.ajax(
																    {
																		type: "GET",
																		url: "http://192.168.1.80/agent/api.php",
																		data:cortar, 
				    													dataType: 'json',
																		success: function(response)
																		{
																			console.log(response);
																		}
																	});	
														            
											        			}

																if(idc==0 || idc==trid)
																{
																	
																	$(id_bg).css("background-color", "#585858").css("color", "#FFFFFF");
																	$('#idc').val(trid);
																	

																}
																else	
																{
																	$(id_bg).css("background-color", "#585858").css("color", "#FFFFFF");
																	$(id_bg_a).css("background-color", "").css("color", "");
																	console.log('else');
																	$('#idc').val(trid);
																
																}
															});		
															
														}
													});		
												}
											});		
										});				
									}
								});	
							});
						}
					});	
				});
			}
		});			
	});
});