$(document).ready(function() 
{
	$('#enviar').click(function()
	{
		$('body').addClass("loading");
		var cedente = $('#cedente').val();
		var data = "cedente="+cedente;
		$.ajax(
	    {
			type: "POST",
			url: "../includes/reporte/mostrarReporteSupervisor.php",
    		data: data,
			success: function(response)
			{
				$('#reporte11').html(response);
				$('#demo-dt-basic').DataTable();
				$('body').removeClass("loading");
			}	
		});		
	});	
	
});
