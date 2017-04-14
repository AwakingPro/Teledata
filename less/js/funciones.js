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
							 $("#logica").change(function(e)
							    { 
								 $("#midiv3").html('<input type="text" name="valor" placeholder="  Ingrese Valor" id="valor" class="text1">');
								 $("#midiv4").html('<br /><input type="text" placeholder="  Nombre Cola" id="nombre_nivel" class="text1" name="nombre_nivel">');
                                 $("#midiv5").html('<br><input type="submit" class="btn btn-primary btn-block" >');     
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
	  var nombre_nivel = $('#nombre_nivel').val();
	  var datos_formulario = 'tablas='+tablas+'&columnas='+columnas+'&logica='+logica+'&valor='+valor+'&siguiente_nivel='+siguiente_nivel+'&nombre_nivel='+nombre_nivel;
	  $.ajax(
	    {
	      type: "POST",
		  url: "ver.php",
		  data:datos_formulario, 
		  success: function(response)
			{	

			 $('.mostrar').hide();
			 $('.oculto').show();
			 $('#demo-dt-basic tr:last').after(response);
			 $('#form1')[0].reset();
			 $('#midiv').html('<select name="tablas" id="tablas"  disabled="disabled" class="select2"><option value="">---Seleccione---</option></select>')
             $('.subestrategia').click(function(e)
                {
                  e.preventDefault();	
    	          var bid = this.id; // button ID 
                  var trid = $(this).closest('tr').attr('id');
                  $('#demo-dt-basic tr:last').prev();
    	          
                })	           
            }	 
	    })
    })


});