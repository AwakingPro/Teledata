
$(document).ready(function($) {
    $('.seleccione_tipo').on('click',function(e) {
                 var miva = this.id; // button ID 
                 var mivar = $(this).closest('tr').attr('id');
                 var data = 'id='+mivar;
                 var recorrer = $('.seleccione_tipo').length;
                 
							
                 // 
			  if ($('.seleccione_tipo').is(':checked')) 
			        { 
                        $.niftyNoty({
									type: 'success',
									icon : 'fa fa-check',
									message : "Tipo Seleccionado" ,
									container : 'floating',
									timer : 2000
								});
                       	for (var i=1; i<=recorrer; i++) {
                       		if (mivar==i){
					    	$('#uno'+i).attr("disabled" , false);
					    }
					    else {
					    $('#uno'+i).attr("disabled" , true);
                          }
					    }
                        $.ajax(
	                    {
					      type: "POST",
						  url: "seleccione_tipo.php",
						  data:data, 
						  success: function(response)
							{ 
								
								$('#mostrar_estrategia').show();			
                                $('#cambiar2').html(response);
								$('html,body').animate({
                               scrollTop: $("#cambiar").offset().top
                                 }, 1000);
                               
								$('.seleccione_estrategia').on('click',function(e) {
					                 var miva = this.id; // button ID 
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
								            		for (var j=1; j<=recorrer2; j++) {

						                       		if (mivar3==j){

											    	$('#dos'+j).attr("disabled" , false);
											        }
											        else {
											        $('#dos'+j).attr("disabled" , true); 
						                            }
											    }
						                        $.ajax(
							                    {
											      type: "POST",
												  url: "seleccione_estrategia.php",
												  data:data, 
												  success: function(response)
													{ 
														$('#mostrar_cola').show();
														$('#cambiar3').html(response);
														$('html,body').animate({
						                               scrollTop: $("#cambiar3").offset().top
						                                 }, 1000);
														$('.seleccione_cola').on('click',function(e) {
											                 var miva = this.id; // button ID 
											                 var mivar = $(this).closest('tr').attr('id');
											                 var mivar3 = $(this).closest('tr').attr('class');
											                 var data = 'id='+mivar;
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
														            		for (var k=1; k<=recorrer3; k++) {

												                       		if (mivar3==k){

																	    	$('#tres'+k).attr("disabled" , false);
																	        }
																	        else {
																	        $('#tres'+k).attr("disabled" , true); 
												                            }
																	    }
												                        $.ajax(
													                    {
																	      type: "POST",
																		  url: "seleccione_cola.php",
																		  data:data, 
																		  success: function(response)
																			{ 
																				$('#mostrar_gestor').show();
																				$('#gestores_seleccionados').show();
							                   									

																				$('html,body').animate({
												                               scrollTop: $("#cambiar4").offset().top
												                                 }, 1000);
														                    }
							                                            })        
									  	                            } 
									  	                   else 
									  	                        { 
									  	                        	for (var k=1; k<=recorrer3; k++) {
																    	$('#tres'+k).attr("disabled" , false);
																    }

									  	                        }  
										                }); 	
								                    }
	                                            })        
			  	                            } 
			  	                   else 
			  	                        { 
			  	                        	for (var j=1; j<=recorrer2; j++) {
											    	$('#dos'+j).attr("disabled" , false);
											    }
											    $('#mostrar_cola').hide();
											 

			  	                        }  
				                }); 	
							}
                        })        
			  	    } 
			  	    else 
			  	    { 
                       for (var i=1; i<=recorrer; i++) {
                       		
					    	$('#uno'+i).attr("disabled" , false);
					    }
					    $('#mostrar_estrategia').hide();
					    $('html,body').animate({
						 scrollTop: $("#cambiar").offset().top
						  }, 1000);
			  	    }
          
    }); 
 $('#gestor').change('click', function(){
		
		var id_gestor = $("#gestor").val();
		var id_gestor_post = 'id_gestor='+id_gestor;
		$.ajax({
         type: "POST",
         url: "gestores.php",
         data:id_gestor_post, 
         success: function(response)
                    {	
			        $("#gestores_mostrar").html(response);
			        $('#gestores').change('click', function(){
								    var id_gestores = $("#gestores").val();
									var id_gestores_post = 'id_gestores='+id_gestores;
									$.ajax({
							         type: "POST",
							         url: "gestores_seleccionados.php",
							         data:id_gestores_post, 
							         success: function(response)
							                    {	
										        $('html,body').animate({
						               			scrollTop: $("#cambiar20").offset().top
						 						 }, 1000);
										        if (response==1){
										        //$('#cambiar20').load("gestores_actualizar.php");
										        //$.getScript("../js/funciones_asignacion2.js");


										        }
										        else{ $.niftyNoty({
																				type: 'danger',
																				icon : 'fa fa-remove',
																				message : "Gestor Duplicado , seleecione otra opción!" ,
																				container : 'floating',
																				timer : 2000
																			});
										    	}

										        }
								            })    
				         }); 
			        }
			    })    
	}); 
 $('.eliminar_gestores').click(function(e) 
    {
		e.preventDefault();
		var miva = this.id; // button ID 
        var data = 'id='+miva;
        
		$.ajax({
					type: "POST",
					url: "eliminar_gestores.php",
					data:data, 
					success: function(response)
							                    {
							                    
							                    $('#'+miva).remove();

							                    }
				})



	});	
 $( "#formulario_asignacion").submit(function( event ) {
      var frm = $(this);
	  var formulario = $(this).serialize();
	  
	  if($('#formulario_asignacion').validationEngine('validate')){
	  $.post( "test.php", formulario)
		        .done(function(data){
		          alert(data);
			  $(frm)[0].reset();
			})
			.fail(function() {
            alert( "error no pude enviar los datos" );
			});
	  }
	  event.preventDefault();
	});



 
});