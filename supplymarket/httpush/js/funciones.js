<script language="javascript">
var timestamp = null;
function cargar_push() 
{ 
	$.ajax({
	async:	true, 
    type: "POST",
    url: "httpush.php",
    data: "&timestamp="+timestamp,
	dataType:"html",
    success: function(data)
	{	
		var json    	   = eval("(" + data + ")");
		timestamp 		   = json.timestamp;
		mensaje     	   = json.mensaje;
		id        		   = json.id;
		status      	   = json.status;
		tipo      	   = json.tipo;
		
		if(timestamp == null)
		{
		
		}
		else
		{
			$.ajax({
			async:	true, 
			type: "POST",
			url: "mensajes.php",
			data: "",
			dataType:"html",
			success: function(data)
			{	
				$('#div'+tipo).html(data);
			}
			});	
		}
		setTimeout('cargar_push()',1000);
		    	
    }
	});		
}

$(document).ready(function()
{
	cargar_push();
});	 