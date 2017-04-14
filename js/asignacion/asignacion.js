$(document).ready(function($) 
{
	$('.seleccione_tipo').on('click',function() 
	{
    	var mivar = $(this).closest('tr').attr('id');
		console.log(mivar);
        var data = 'id='+mivar;
        var recorrer = $('.seleccione_tipo').length;
		if ($('.seleccione_tipo').is(':checked')) 
		{ 
        	$.niftyNoty(
			{
				type: 'success',
				icon : 'fa fa-check',
				message : "Tipo Seleccionado" ,
				container : 'floating',
				timer : 2000
			});
            for (var i=1; i<=recorrer; i++) 
			{
            	if (mivar==i)
				{
					$('#uno'+i).attr("disabled" , false);
				}
				else 
				{
					$('#uno'+i).attr("disabled" , true);
                }
			}
            $.ajax(
	        {
				type: "POST",
				url: "../../includes/asignacion/seleccione_tipo.php",
				data:data, 
				success: function(response)
				{ 
					$('#mostrar_estrategia').show();			
                    $('#cambiar2').html(response);
					$('html,body').animate({ scrollTop: $("#cambiar").offset().top }, 1000);    
					$('.seleccione_estrategia').on('click',function() 
					{
						console.log("haz seleccionado estrategia");
						var mivar2 = $(this).closest('tr').attr('id');
						var mivar3 = $(this).closest('tr').attr('class');
						var data = 'id='+mivar2;
						var recorrer2 = $('.seleccione_estrategia').length;	
						if ($('.seleccione_estrategia').is(':checked')) 
						{ 
							$.niftyNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : "Estrategia Seleccionada" ,
							container : 'floating',
							timer : 2000
						});
						for (var j=1; j<=recorrer2; j++) 
						{
							if (mivar3==j)
							{
								$('#dos'+j).attr("disabled" , false);
							}
							else 
							{
								$('#dos'+j).attr("disabled" , true); 
						    }
						}
						$.ajax(
						{
							type: "POST",
							url: "../../includes/asignacion/seleccione_estrategia.php",
							data:data, 
							success: function(response)
							{ 
								$('#mostrar_cola').show();
								$('#cambiar3').html(response);
								$('html,body').animate({scrollTop: $("#cambiar3").offset().top}, 1000);
								$('.seleccione_cola').on('click',function() 
								{
									var mivar9 = $(this).closest('tr').attr('id');
									var mivar3 = $(this).closest('tr').attr('class');
									console.log(mivar9);
									var recorrer3 = $('.seleccione_cola').length;	
									if ($('.seleccione_cola').is(':checked')) 
									{ 
										$.niftyNoty({
										type: 'success',
										icon : 'fa fa-check',
										message : "Cola Seleccionada" ,
										container : 'floating',
										timer : 2000
									});
									for (var k=1; k<=recorrer3; k++) 
									{
										if (mivar3==k)
										{
											$('#tres'+k).attr("disabled" , false);
										}
										else 
										{
											$('#tres'+k).attr("disabled" , true); 
										}
									}
									$('#mostrar_gestor').show();
									var link_id = '<input type="hidden" value="'+mivar9+'" name="id_nuevo" id="id_nuevo">';
									console.log(link_id);
									$('#id_nuevos').html(link_id);
									$('html,body').animate({scrollTop: $("#cambiar4").offset().top}, 1000);
	     
									} 
									else 
									{ 
										for (var k=1; k<=recorrer3; k++) 
										{
											$('#tres'+k).attr("disabled" , false);
										}
	
									}  
								}); 	
						 	}
	                	});      
			  		} 
					else 
					{		 
						for (var j=1; j<=recorrer2; j++) 
						{
							$('#dos'+j).attr("disabled" , false);
						}
						$('#mostrar_cola').hide();
					}  
				}); 	
			}
 		});     
	} 
	else 
	{ 
		for (var i=1; i<=recorrer; i++) 
		{                       		
			$('#uno'+i).attr("disabled" , false);
		}
		$('#mostrar_estrategia').hide();
		$('html,body').animate({ scrollTop: $("#cambiar").offset().top}, 1000);
	}       
}); 
$('#gestor').change('click', function()
{
	var id_gestor = $("#gestor").val();
	var id_gestor_post = 'id_gestor='+id_gestor;
	$.ajax(
	{
		type: "POST",
		url: "../../includes/asignacion/asignar_gestor.php",
		data:id_gestor_post, 
		success: function(response)
		{	
			$("#gestores_mostrar").html(response); 
		} 
	}); 
}); 
 $("#acciones").submit(function(e) 
 {
	  e.preventDefault();
	  var accion = $('#accion').val();
	  var gestores = $('#gestor').val();
	  var gestores_sel = $('#gestores').val();
	  var cant = $('#cant').val();
	  var exito = $('#exito').val();
	  var id_nuevo = $('#id_nuevo').val();
	  var data_acciones = 'id_nuevo='+id_nuevo+'&accion='+accion+'&gestores='+gestores+'&gestores_sel='+gestores_sel+'&cant='+cant+'&exito='+exito;	
	  console.log(data_acciones);
	   $.ajax(
		 {
			type: "POST",
			url: "../../includes/asignacion/insertar_accion.php",
			data:data_acciones, 
			success: function(response)
			{	
				console.log(response);
				$('#acciones')[0].reset();
				$('#acciones_seleccionadas2').show();
				$('#acciones_seleccionadas').show();
	  			$('#acciones_seleccionadas').html(response);
			} 
		}); 	  
	});
});