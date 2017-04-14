$(document).ready(function($) {

  onload=function(){
alert("aqui");
};

    $(document).on('','#demo',DataTable(){
    });







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
	 console.log(id_tabla2);
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
	  var nivel = $('#nivel').val();
	  var tablas = $('#tablas').val();
	  var columnas = $('#columnas').val();
	  var logica = $('#logica').val();
	  var valor = $('#valor').val();
	  var siguiente_nivel = $('#siguiente_nivel').val();
	  var nombre_nivel = $('#nombre_nivel').val();
	  var datos_formulario = 'tablas='+tablas+'&columnas='+columnas+'&logica='+logica+'&valor='+valor+'&siguiente_nivel='+siguiente_nivel+'&nombre_nivel='+nombre_nivel;
	  if(nivel==0)
	  {
	  $.ajax(
	    {
	      type: "POST",
		  url: "ver.php",
		  data:datos_formulario,
		  success: function(response)
			{
			 $('.oculto').show();
			 $('.mostrar').hide();
			 $('#demo-dt-basic tr:last').after(response);
			 $('#form1')[0].reset();
			 $('#midiv200').html('Todos los Registros Seleccionados<br><br>');
			 $('#midiv100').hide();
			 $('#midiv101').html('<select   disabled="disabled" class="select2"><option value="">Seleccione Tabla</option></select><br><br>');
			 $('#midiv').html('<select   disabled="disabled" class="select2"><option value="">Seleccione Columna</option></select>');
			 $('#midiv2').html('<select   disabled="disabled" class="select2"><option value="">Seleccione Lógica</option></select>');
             $("#midiv3").html('<input type="text" disabled="disabled" name="valor" placeholder="  Ingrese Valor" id="valor" class="text2">');
			 $("#midiv4").html('<br /><input type="text" disabled="disabled" placeholder="  Nombre Cola" id="nombre_nivel" class="text2" name="nombre_nivel">');
             $("#midiv5").html('<br><input type="submit" disabled="disabled" class="btn btn-primary btn-block" >');
             $('.subestrategia').click(function(e)
                {
                  e.preventDefault();
    	          var bid = this.id; // button ID
                  var trid = $(this).closest('tr').attr('id');
                  $('#divnivel').html('<input type="hidden" value="1" id="nivel" name="nivel">');
                  $('#midiv101').hide();
                  $('#midiv100').show();
                  //$('#demo-dt-basic tr:last').before("<tr><td></td><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td><td></td></tr>");

                })
            }
	    })

	   }
	   else
	   {
	   	alert('otro nivel');
	   }
    })
 $('#crear_estrategia').submit(function(e)
    {
      e.preventDefault();
      if($("#nombre_estrategia").val().length < 5) {
        alert("El nombre debe tener como mínimo 5 caracteres");
        return false;
    }
    else
    {
      var nombre_estrategia = $('#nombre_estrategia').val();
      var comentario_estrategia = $('#comentario_estrategia').val();
      var titulo_condiciones = 'Condiciones Para la Estrategia <b>'+nombre_estrategia+'<b>';
      $('#titulo_condiciones').html(titulo_condiciones);
      $('#mostrar_estrategia').hide();
	  $('.mostrar_condiciones').show();
	  $('.oculto').hide();
      $('#midiv99').hide();
      $('#midiv100').show();
    }

    })

});
