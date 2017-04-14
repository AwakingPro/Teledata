$(document).ready(function($) {

$('.link').on('click', function()
    {
	 console.log('click en eliminar');
     var mivar = $(this).attr("name");
     var dataString = 'id='+mivar;
     var mensaje = "Desea eliminar el Registro "+mivar;
	 var tabla = "#tabla"+mivar;
     bootbox.confirm(
    {
	     message : mensaje,
	     buttons: 
			{
		     confirm: 
				{
			     label: "Eliminar",
				}
			},
	 callback : function(result) 
	    {
		 if (result==true)
		    {
			 $(tabla).remove();
             $.ajax(
                {
		         type: "POST",
		         url: "estrategia/eliminar.php",
		         data:dataString, 
		         success: function()
		            {	
                    }
	            })
			}
		 else
		    {
		    }
		},
	 animateIn  : 'bounceIn',
	 animateOut : 'bounceOut'
	    });
	});
//Funcion Tablas
 $("#tablas").change(function(e) 
    {
	 var id_tabla2 = $('#tablas').val();
	 var id_tabla = 'id_tabla='+id_tabla2;
	 if(id_tabla2=='0')
	    {
		 console.log(id_tabla2);
	     $("#midiv").html('<select   disabled="disabled" name="columnas" class="LP2" ><option value="0">---Seleccione---</option></select>');
	     $("#midiv2").html('<select   disabled="disabled" name="columnas" class="LP2" ><option value="0">---Seleccione---</option></select>');
		}
	  else 
	    {
		 $.ajax({
         type: "POST",
         url: "estrategia/columnas.php",
         data:id_tabla, 
         success: function(response)
            {	
			 $("#midiv").html(response);
			 //Funcion Columnas
			 $("#columnas").change(function(e) 
			    {
                 var id_columnas = $('#columnas').val();
			     var id_columna = 'id_columna='+id_columnas;
			     if(id_columnas=='0')
			        {
			         console.log(id_columnas);
			         $("#midiv2").html('<select   disabled="disabled" name="columnas" class="LP2" ><option value="0">---Seleccione---</option></select>');
			        }
			     else 
			        {		 
                     $.ajax(
                        {
                         type: "POST",
                         url: "estrategia/logica.php",
                         data:id_columna, 
                         success: function(response)
                            {
				 			 $("#midiv2").html(response);
				 			 //Funcion Logica
							 $("#logica").change(function(e)
							    { 
								$("#midiv3").html('<input type="text" name="valor" id="valor" class="text1">');
								$("#midiv10").html('<br /><span class="titulo_LP">Siguiente Nivel</span><br><input type="text" class="text1" name="siguiente_nivel">');	
								$("#midiv11").html('<br /><span class="titulo_LP">Nombre Nivel</span><br><input type="text" class="text1" name="nombre_nivel">');
                                $("#midiv12").html('<br><input type="submit" class="btn btn-primary btn-block" >');
                               
                                    
								 })  
				            }
                        })
			        }
                e.stopPropagation();
                });
			}
	    })	
	e.stopPropagation();
	}
});
  $('#form1').submit(function(e)
                                                    {
                									 e.preventDefault();
                									 var tablas = $('#tablas').val();
                								     var columnas = $('#columnas').val();
                								     var logica = $('#logica').val();
                								     var valor = $('#valor').val();
                								     var siguiente_nivel = $('#siguiente_nivel').val();
                								     var nombre_nivel = $('#nombre').val();
                								     var datos_formulario = 'tablas='+tablas+'&columnas='+columnas+'&logica='+logica+'&valor='+valor+'&siguiente_nivel='+siguiente_nivel+'&nombre_nivel='+nombre_nivel;
                								     $.ajax(
                								        {
                                                          type: "POST",
											              url: "ver.php",
											              data:datos_formulario, 
											              success: function(response)
											                {	
											                  $('#demo-dt-basic tr:last').after(response);
											                  $('#form1')[0].reset();
	
													        }	 
                								        })
                                                    })
});