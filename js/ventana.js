
$(document).ready(function($) 
{
	$("#nivel1").change(function() 
    {
    	var id_nivel1 = $('#nivel1').val();
        
    	var id_nivel1 = 'id_nivel1='+id_nivel1;
    	$.ajax(
    	{
         	type: "POST",
        	url: "nivel1.php",
         	data:id_nivel1, 
         	success: function(response)
            {	
			 	$("#midiv").html(response);
			 	$("#ocultar").hide();
			 	$("#nivel2").change(function() 
			    {
			    	var id_nivel2 = $('#nivel2').val();
    				var id_nivel2 = 'id_nivel2='+id_nivel2;
    				$.ajax(
				    {
				        type: "POST",
				        url: "nivel2.php",
				        data:id_nivel2, 
				        success: function(response)
            			{	
            				$("#midiv2").html(response);
			 				$("#ocultar2").hide();
            			}
            		});		
			    });
			} 
		});		
    });	
    $('.ti-save').click(function(e)
    {
        e.preventDefault();
        var nivel1= $('#nivel1').val();
        var nivel2= $('#nivel2').val();
        var nivel3= $('#nivel3').val();
        var monto = $('#monto').val();
        var hora1 = $('#hora1').val();
        var rut = $('#rut').val();
        var fono= $('#fono').val();
        var monto= $('#monto').val();
        var record= $('#record').val();
        var id_personal= $('#id_personal').val();
        var fecha_agendamiento = $('#demo-msk-date2').val();
        var observacion= $('#observacion').val();
        if (nivel1 == 0) 
        {
            $.niftyNoty(
            {
                type: 'danger',
                icon : 'fa fa-warning',
                message : "Debes Seleccionar un Tipo de Gestión" ,
                container : 'floating',
                timer : 3000
            });
        } 
        else 
        {
            if (nivel2 == 0) 
            {
                $.niftyNoty(
                {
                    type: 'danger',
                    icon : 'fa fa-warning',
                    message : "Debes Seleccionar una Respuesta" ,
                    container : 'floating',
                    timer : 3000
                });
            } 
            else
            {   
                if (nivel3 == 0) 
                {
                    $.niftyNoty(
                    {
                        type: 'danger',
                        icon : 'fa fa-warning',
                        message : "Debes Seleccionar un Motivo" ,
                        container : 'floating',
                        timer : 3000
                    });
                } 
                else
                {
                    if (monto=== '' || Number(monto)==false) 
                    {
                        $.niftyNoty(
                        {
                            type: 'danger',
                            icon : 'fa fa-warning',
                            message : "Debe Ingresar Monto Compromiso y Valor Entero" ,
                            container : 'floating',
                            timer : 3000
                        });
                    } 
                    else
                    {
                        if (observacion=== '') 
                        {
                            $.niftyNoty(
                            {
                                type: 'danger',
                                icon : 'fa fa-warning',
                                message : "Debe Ingresar Observacion" ,
                                container : 'floating',
                                timer : 3000
                            });
                        } 
                        else
                        {
                            if (fecha_agendamiento=== '') 
                            {
                                $.niftyNoty(
                                {
                                    type: 'danger',
                                    icon : 'fa fa-warning',
                                    message : "Debe Ingresar Agendamiento" ,
                                    container : 'floating',
                                    timer : 3000
                                });
                            } 
                            else
                            {
                                bootbox.alert("Registro Guardado Exitosamente!", function()
                                {               
                                
                                    var data = 'nivel1='+nivel1+'&hora1='+hora1+'&fecha_agendamiento='+fecha_agendamiento+'&rut='+rut+'&fono='+fono+'&observacion='+observacion+'&monto='+monto+'&record='+record+'&id_personal='+id_personal;
                                    $.ajax(
                                    {
                                        type: "POST",
                                        url: "insert.php",
                                        data:data, 
                                        success: function(response)
                                        {
                                            console.log(fecha_agendamiento);
                                            window.open('index.php', '_self', '');
                                            window.close();
                                            console.log(response);
                                        }
                                    });        
                                });
                            } 
                        } 
                    } 
                }    
            }    
        }
    });
});