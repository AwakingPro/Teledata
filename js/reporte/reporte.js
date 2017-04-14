$(document).ready(function() 
{
	$('#enviar').click(function()
	{
		$('body').addClass("loading");
		var fecha = $('.fecha').val();
		var cedente = $('#cedente').val();
		var data = 'fecha='+fecha+"&cedente="+cedente;
		$.ajax(
	    {
			type: "POST",
			url: "../includes/reporte/mostrarReporteOnce.php",
    		data: data,
			success: function(response)
			{
				$('#reporte11').html(response);
				$('#demo-dt-basic').DataTable();
				$('body').removeClass("loading");
			}	
		});		
	});	

	$('#seleccionarFecha').click(function()
	{
		var fechaInicio = $('.fechaInicio').val();
		var fechaTermino = $('.fechaTermino').val();
		alert(fechaInicio + fechaTermino);
	});
	
});
